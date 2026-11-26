<?php

declare(strict_types=1);

namespace Themes\Civic\Support;

use DateTimeInterface;
use IntlDateFormatter;

/**
 * Formattazione per Paese (issue #17): date, numeri, indirizzi, telefoni e CAP.
 *
 * Le viste NON scrivono `d/m/Y`, non concatenano indirizzi, non validano il CAP con
 * `\d{5}`: chiamano questi helper con i `formats` del {@see CountryProfile} corrente.
 *
 * Regole (ADR 0012):
 * - date/orari: `IntlDateFormatter` (ICU), MAI `date()`/`strtr` — i nomi dei mesi
 *   sono localizzati e `mt` ha forme che `date()` non conosce (`ta'`);
 * - numero di visualizzazione = `<lingua>_<PAESE>` (es. `it_IT`, `en_MT`): passare
 *   sempre la lingua corrente come `$locale`, il Paese arriva da `formats.country_code`;
 * - telefono e CAP: regole in `config/civic.php` (`phone_country_code`,
 *   `phone_pattern`, `phone_groups`, `postcode_pattern`, `postcode_normalize`),
 *   nessun `match ($country)` in questa classe;
 * - input non valido → si mostra potato, mai una correzione inventata.
 *
 * Ogni metodo e' puro: nessun `config()`, testabile senza applicazione.
 *
 * @see docs/i18n/formats.md
 * @see docs/adr/0012-formati-per-paese.md
 */
final class LocaleFormats
{
    /**
     * Data nel formato del profilo. `$locale` e' la lingua UI (`it`, `en`, `mt`...);
     * il Paese viene da `formats.country_code` (iniettato da `CountryProfile`).
     * Coppia finale: `<lingua>_<PAESE>`; se Intl non e' disponibile o non formatta,
     * ricade sul pattern numerico `dd/MM/yyyy` applicato con `DateTimeImmutable`.
     */
    public static function formatDate(
        DateTimeInterface|string|null $date,
        array $formats,
        ?string $locale = null,
    ): string {
        $dateTime = self::toDateTime($date);
        if ($dateTime === null) {
            return is_string($date) ? $date : '';
        }

        $pattern = is_string($formats['date'] ?? null) && $formats['date'] !== ''
            ? $formats['date']
            : 'dd/MM/yyyy';
        $icuLocale = self::icuLocale($locale, $formats);

        if ($icuLocale !== null && extension_loaded('intl')) {
            $formatter = new IntlDateFormatter(
                $icuLocale,
                IntlDateFormatter::NONE,
                IntlDateFormatter::NONE,
                null,
                IntlDateFormatter::GREGORIAN,
                $pattern,
            );
            $formatted = $formatter->format($dateTime);
            if (is_string($formatted) && $formatted !== '') {
                return $formatted;
            }
        }

        // Fallback senza Intl: solo il pattern numerico, mai `date()` con token CLDR.
        return $dateTime->format(self::numericPattern($pattern));
    }

    /** Data lunga localizzata (stile ICU `LONG`): «26 novembre 2026», «26 ta’ Novembru 2026». */
    public static function formatDateLong(
        DateTimeInterface|string|null $date,
        array $formats,
        ?string $locale = null,
        string $style = 'long',
    ): string {
        $dateTime = self::toDateTime($date);
        if ($dateTime === null || ! extension_loaded('intl')) {
            return self::formatDate($date, $formats, $locale);
        }
        $icuLocale = self::icuLocale($locale, $formats);
        if ($icuLocale === null) {
            return self::formatDate($date, $formats, $locale);
        }
        $formatter = new IntlDateFormatter(
            $icuLocale,
            $style === 'medium' ? IntlDateFormatter::MEDIUM : IntlDateFormatter::LONG,
            IntlDateFormatter::NONE,
        );
        $formatted = $formatter->format($dateTime);

        return is_string($formatted) && $formatted !== '' ? $formatted : self::formatDate($date, $formats, $locale);
    }

    /** Numero localizzato con i separatori ICU della coppia lingua-Paese. */
    public static function formatNumber(float|int|string $number, array $formats, ?string $locale = null, int $decimals = 2): string
    {
        if (! extension_loaded('intl')) {
            return (string) $number;
        }
        $icuLocale = self::icuLocale($locale, $formats) ?? 'en';
        $formatter = new \NumberFormatter($icuLocale, \NumberFormatter::DECIMAL);
        $formatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, $decimals);
        $formatted = $formatter->format((float) $number);

        return is_string($formatted) ? $formatted : (string) $number;
    }

    /**
     * Indirizzo da `formats.address_format` (template con token `{street}`,
     * `{locality}`, `{postcode}`, `{province}`, `{country}`): i segmenti vuoti
     * si omettono; le parentesi vuote di un token opzionale pure.
     *
     * @param  array<string, string|null>  $parts
     */
    public static function formatAddress(array $parts, array $formats): string
    {
        $template = is_string($formats['address_format'] ?? null) && $formats['address_format'] !== ''
            ? $formats['address_format']
            : '{street}, {locality} {postcode}, {country}';

        $segments = [];
        foreach (explode(',', $template) as $segment) {
            $rendered = trim((string) preg_replace_callback(
                '/\{([a-z_]+)\}/',
                static function (array $m) use ($parts): string {
                    $value = $parts[$m[1]] ?? null;

                    return is_string($value) ? trim($value) : '';
                },
                $segment,
            ));
            $rendered = (string) preg_replace('/\(\s*\)/', '', $rendered);
            $rendered = trim((string) preg_replace('/\s{2,}/', ' ', $rendered));
            if ($rendered !== '' && ! preg_match('/^[{}\s,()]*$/', $rendered)) {
                $segments[] = $rendered;
            }
        }

        return implode(', ', $segments);
    }

    /**
     * Telefono in forma visuale: `+<phone_country_code> <nazionale raggruppato>`.
     * `phone_groups` (lista di dimensioni, es. `[2]` → «06 12345678») e'
     * opzionale: senza, il numero nazionale resta unico. Input non valido
     * → testo originale potato.
     */
    public static function formatPhone(string $phone, array $formats, ?string $locale = null): string
    {
        $normalized = self::normalizePhone($phone, $formats);
        if ($normalized === '' || ! self::isValidPhone($phone, $formats)) {
            return trim($phone);
        }

        $countryCode = self::digitsOnly($formats['phone_country_code'] ?? null);
        $national = $countryCode !== '' && str_starts_with(ltrim($normalized, '+'), $countryCode)
            ? substr(ltrim($normalized, '+'), strlen($countryCode))
            : ltrim($normalized, '+');

        $groups = $formats['phone_groups'] ?? null;
        $display = is_array($groups) && $groups !== [] ? self::groupDigits($national, $groups) : $national;
        $international = $countryCode !== '' ? '+'.$countryCode : '';

        return trim($international.($display !== '' ? ' '.$display : ''));
    }

    /**
     * Normalizzazione: solo cifre e `+` iniziale; il prefisso `phone_country_code`
     * del profilo viene rimosso (serve per validare il numero nazionale).
     */
    public static function normalizePhone(string $phone, array $formats): string
    {
        $digits = (string) preg_replace('/[^\d+]/', '', $phone);
        $hasPlus = str_starts_with($digits, '+');
        $digits = ltrim($digits, '+');

        $countryCode = self::digitsOnly($formats['phone_country_code'] ?? null);
        if ($countryCode !== '' && str_starts_with($digits, $countryCode)) {
            $digits = substr($digits, strlen($countryCode));
        }

        return ($hasPlus ? '+' : '').$digits;
    }

    /**
     * Validazione: `formats.phone_pattern` (regex sul numero nazionale, es.
     * `/^0\d{5,10}$/` per i fissi IT) se dichiarata; altrimenti 4-15 cifre
     * (fascetta E.164). Nessuna regola cablata per Paese.
     */
    public static function isValidPhone(string $phone, array $formats): bool
    {
        $normalized = self::normalizePhone($phone, $formats);
        $digits = self::digitsOnly($normalized);
        if ($digits === '') {
            return false;
        }

        $pattern = $formats['phone_pattern'] ?? null;
        if (is_string($pattern) && $pattern !== '') {
            return preg_match($pattern, $digits) === 1;
        }

        $length = strlen($digits);

        return $length >= 4 && $length <= 15;
    }

    /** Codice postale: stringa ovunque. `postcode_pattern` assente = nessun vincolo. */
    public static function isValidPostcode(string $postcode, array $formats): bool
    {
        $pattern = $formats['postcode_pattern'] ?? null;
        if (! is_string($pattern) || $pattern === '') {
            return trim($postcode) !== '';
        }

        return preg_match($pattern, self::normalizePostcode($postcode, $formats)) === 1;
    }

    /**
     * Normalizzazione dichiara­ta dal profilo in `postcode_normalize`:
     * `uppercase` (solo maiuscole), `uppercase_space` (maiuscole + spazio singolo
     * fra lettere e cifre, es. `vlt1117` → `VLT 1117`). Senza flag: il testo
     * potato, mai una regola inventata.
     */
    public static function normalizePostcode(string $postcode, array $formats): string
    {
        $postcode = trim((string) preg_replace('/\s+/', ' ', $postcode));
        $mode = $formats['postcode_normalize'] ?? null;

        return match ($mode) {
            'uppercase' => strtoupper($postcode),
            'uppercase_space' => self::normalizePostcodeUpperSpace($postcode),
            default => $postcode,
        };
    }

    private static function toDateTime(DateTimeInterface|string|null $date): ?\DateTimeImmutable
    {
        if ($date === null || $date === '') {
            return null;
        }
        if ($date instanceof DateTimeInterface) {
            return \DateTimeImmutable::createFromInterface($date);
        }
        $timestamp = strtotime($date);
        if ($timestamp === false) {
            return null;
        }
        $dateTime = \DateTimeImmutable::createFromFormat('U', (string) $timestamp);

        return $dateTime === false ? null : $dateTime->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    }

    /**
     * Locale ICU `<lingua>_<PAESE>`: la lingua e' esplicita (`$locale`), il Paese
     * arriva da `formats.country_code`. Senza entrambi restituisce null e il
     * chiamante ricade sul pattern numerico — mai `en` da solo con un Paese noto.
     */
    private static function icuLocale(?string $locale, array $formats): ?string
    {
        $country = strtoupper(self::lettersOnly($formats['country_code'] ?? null));
        $language = strtolower(self::lettersOnly($locale ?? ''));

        if ($country === '') {
            return $language !== '' ? $language : null;
        }
        if ($language === '') {
            return $country; // es. `MT` da solo: meglio di niente, documentato
        }

        return $language.'_'.$country;
    }

    /** Solo le lettere del codice (`it`, `en`, `MT`...): niente `-`, `_`, spazi. */
    private static function lettersOnly(mixed $value): string
    {
        return is_string($value) || is_int($value)
            ? (string) preg_replace('/[^A-Za-z]/', '', (string) $value)
            : '';
    }

    private static function digitsOnly(mixed $value): string
    {
        return is_string($value) || is_int($value) ? (string) preg_replace('/\D/', '', (string) $value) : '';
    }

    /** `vlt1117`/`VLT  1117` → `VLT 1117`: maiuscole e un solo spazio fra parti. */
    private static function normalizePostcodeUpperSpace(string $postcode): string
    {
        $postcode = strtoupper($postcode);
        if (preg_match('/^([A-Z]+)\s*(\d+)$/', $postcode, $m) === 1) {
            return $m[1].' '.$m[2];
        }

        return $postcode;
    }

    /** @param list<int> $sizes */
    private static function groupDigits(string $digits, array $sizes): string
    {
        $groups = [];
        $offset = 0;
        foreach ($sizes as $size) {
            if ($offset >= strlen($digits)) {
                break;
            }
            $groups[] = substr($digits, $offset, $size);
            $offset += $size;
        }
        if ($offset < strlen($digits)) {
            $groups[] = substr($digits, $offset);
        }

        return implode(' ', array_filter($groups, static fn (string $g): bool => $g !== ''));
    }

    /**
     * Riduce un pattern CLDR (`dd/MM/yyyy`, `d MMMM yyyy`) al sottoinsieme
     * supportato da `DateTimeImmutable::format` — SOLO se Intl non c'e'.
     * `MMMM`/`MMM` non hanno reso in `date()`: diventano `m`/`n`? No: per non
     * mostrare numeri al posto dei nomi li traduciamo in `F`/`M` (nome inglese)
     * solo se il chiamante ha chiesto Intl e non c'e' — meglio un nome inglese
     * di un numero. Documentato: il fallback e' degrado, non sostituto.
     */
    private static function numericPattern(string $pattern): string
    {
        $map = [
            'yyyy' => 'Y',
            'yy' => 'y',
            'MMMM' => 'F',
            'MMM' => 'M',
            'MM' => 'm',
            'dd' => 'd',
            'HH' => 'H',
            'mm' => 'i',
        ];
        uksort($map, static fn (string $a, string $b): int => strlen($b) <=> strlen($a));

        return strtr($pattern, $map);
    }
}
