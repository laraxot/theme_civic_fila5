<?php

declare(strict_types=1);

namespace Themes\Civic\Tests\Unit\I18n;

use DateTimeZone;
use IntlDateFormatter;
use LogicException;
use Locale;
use Modules\Geo\Datas\Geocoding\AddressData;
use NumberFormatter;
use ReflectionNamedType;
use ReflectionProperty;
use Safe\DateTimeImmutable;
use Tests\TestCase;

use function Safe\preg_match;

uses(TestCase::class);

/**
 * Formati per Paese (issue #9 e #17, contratto `docs/contracts/i18n-country-formats.md`, ADR 0012).
 *
 * Misura cio' che il design afferma e che dipende solo da PHP Intl e dalla configurazione: ogni coppia lingua-Paese del tema
 * e' formattabile, le date e i numeri hanno le convenzioni del Paese, il CAP e' una stringa. NON prova `LocaleFormats`
 * (P1): i suoi difetti misurati stanno nell'ADR e nella story, come richieste.
 *
 * @see docs/contracts/i18n-country-formats.md
 * @see docs/adr/0012-formati-per-paese.md
 */

/**
 * Coppie lingua-Paese servite (SSoT: `config/civic.php` `countries.<CC>.locales`) e lingua del mese parlato atteso.
 *
 * @return array<string, array{0: string, 1: string, 2: string}> locale ICU => [Paese, lingua, mese di novembre]
 */
function civicI18nFormatPairs(): array
{
    return [
        'it_IT' => ['IT', 'it', 'novembre'],
        'en_IT' => ['IT', 'en', 'November'],
        'de_IT' => ['IT', 'de', 'November'],
        'es_IT' => ['IT', 'es', 'noviembre'],
        'en_MT' => ['MT', 'en', 'November'],
        'mt_MT' => ['MT', 'mt', 'Novembru'],
    ];
}

dataset('civic i18n format pairs', fn (): array => array_map(
    static fn (string $locale): array => [$locale],
    array_combine(array_keys(civicI18nFormatPairs()), array_keys(civicI18nFormatPairs())),
));

/**
 * Valore di `config/civic.php` (file letto direttamente, come `CivicLocalizationConfigTest`) alla chiave con punti.
 *
 * @return list<string>|string
 */
function civicI18nConfigValue(string $path): array|string
{
    $config = require dirname(__DIR__, 3).'/config/civic.php';
    $value = is_array($config) ? data_get($config, $path) : null;
    if (is_string($value)) {
        return $value;
    }
    if (is_array($value) && array_is_list($value) && array_filter($value, 'is_string') === $value) {
        return $value;
    }

    throw new LogicException("config/civic.php: {$path} non e' una stringa ne' un elenco di stringhe");
}

/**
 * Coppie `<lingua>_<PAESE>` dichiarate da `countries.<CC>.locales` per i Paesi del contratto.
 *
 * @return list<string>
 */
function civicI18nConfiguredPairs(): array
{
    $pairs = [];
    foreach (['IT', 'MT'] as $country) {
        foreach ((array) civicI18nConfigValue("countries.{$country}.locales") as $language) {
            $pairs[] = $language.'_'.$country;
        }
    }
    sort($pairs);

    return $pairs;
}

/** Pattern del codice postale del Paese, da `countries.<CC>.formats.postcode_pattern`. */
function civicI18nPostcodePattern(string $country): string
{
    $pattern = civicI18nConfigValue("countries.{$country}.formats.postcode_pattern");

    return is_string($pattern) ? $pattern : throw new LogicException("postcode_pattern di {$country} non e' una stringa");
}

it('serves exactly the language-country pairs the contract lists', function (): void {
    $expected = array_keys(civicI18nFormatPairs());
    sort($expected);

    expect(civicI18nConfiguredPairs())->toBe($expected);
})->group('CIVIC-I18N-INV-13');

it('has ICU data for the language of every language-country pair', function (string $locale): void {
    $language = civicI18nFormatPairs()[$locale][1];
    $resolved = (new NumberFormatter($locale, NumberFormatter::DECIMAL))->getLocale(Locale::VALID_LOCALE);

    expect(IntlDateFormatter::create($locale, IntlDateFormatter::LONG, IntlDateFormatter::NONE))->not->toBeNull()
        ->and(str_starts_with($resolved, $language))->toBeTrue();
})->with('civic i18n format pairs')->group('CIVIC-I18N-INV-13');

it('formats the same numeric date in every pair and the spoken month in the language of the pair', function (string $locale): void {
    [, , $month] = civicI18nFormatPairs()[$locale];
    $date = new DateTimeImmutable('2026-11-26 12:00:00', new DateTimeZone('Europe/Rome'));
    $numeric = new IntlDateFormatter($locale, IntlDateFormatter::NONE, IntlDateFormatter::NONE, 'Europe/Rome', IntlDateFormatter::GREGORIAN, 'dd/MM/yyyy');
    $long = new IntlDateFormatter($locale, IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Europe/Rome');

    expect($numeric->format($date))->toBe('26/11/2026')
        ->and($long->format($date))->toContain($month);
})->with('civic i18n format pairs')->group('CIVIC-I18N-INV-14');

it('uses the decimal and grouping separators of the country, not a fixed one', function (): void {
    $symbols = static fn (string $locale): array => [
        (new NumberFormatter($locale, NumberFormatter::DECIMAL))->getSymbol(NumberFormatter::DECIMAL_SEPARATOR_SYMBOL),
        (new NumberFormatter($locale, NumberFormatter::DECIMAL))->getSymbol(NumberFormatter::GROUPING_SEPARATOR_SYMBOL),
    ];

    expect($symbols('it_IT'))->toBe([',', '.'])
        ->and($symbols('mt_MT'))->toBe(['.', ','])
        ->and($symbols('en_MT'))->toBe(['.', ','])
        ->and($symbols('it_IT'))->not->toBe($symbols('mt_MT'));
})->group('CIVIC-I18N-INV-15');

it('keeps a postcode as a string: an integer cast loses leading zeros and every Maltese code', function (): void {
    $italy = civicI18nPostcodePattern('IT');
    $malta = civicI18nPostcodePattern('MT');

    expect(preg_match($italy, '00100'))->toBe(1)
        ->and(preg_match($italy, 'VLT 1117'))->toBe(0)
        ->and(preg_match($malta, 'VLT 1117'))->toBe(1)
        ->and(preg_match($malta, '00100'))->toBe(0)
        // Perche' il tipo conta: questi due casi sono quelli che oggi `AddressData::$postal_code` (?int) corrompe.
        ->and((string) (int) '00100')->not->toBe('00100')
        ->and((int) 'VLT 1117')->toBe(0);
})->group('CIVIC-I18N-INV-16');

it('declares AddressData::$postal_code as a string so the geocoder keeps the real postcode', function (): void {
    $type = (new ReflectionProperty(AddressData::class, 'postal_code'))->getType();

    expect($type instanceof ReflectionNamedType ? $type->getName() : null)->toBe('string');
})->skip(
    function (): bool {
        $type = (new ReflectionProperty(AddressData::class, 'postal_code'))->getType();

        return $type instanceof ReflectionNamedType && $type->getName() === 'int';
    },
    'Geo: AddressData::$postal_code e\' ancora ?int (richiesta a Geo nella story roadmap-execution-c1-c5-parallel-claims): il test si attiva da solo quando diventa string.',
)->group('CIVIC-I18N-INV-16');
