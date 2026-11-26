<?php

declare(strict_types=1);

namespace Themes\Civic\Support;

/**
 * Profilo Paese/ente del tenant (issue #6): paese, lingue, tipo di ente e formati di presentazione.
 *
 * Il profilo NON contiene testi UI: le etichette istituzionali vivono in `lang/<locale>/entity.php`
 * (terminologia per profilo, vedi `entity.profiles.<profilo>`) e i contenuti in CMS/JSON. Qui ci sono
 * solo dati strutturali: codice paese, lingue servite, etichetta dell'ente e puntatori ai formati.
 *
 * Risoluzione: `civic.country` (override per tenant, impostato dall'host) → `civic.default_country`
 * → profilo generico. Un paese sconosciuto ricade sul default, mai su un hardcode italiano.
 *
 * @see docs/i18n/country-profiles.md
 * @see config/civic.php
 */
final readonly class CountryProfile
{
    /**
     * @param  list<string>  $locales
     * @param  array{singular?: string, plural?: string}  $entity
     * @param  array<string, mixed>  $formats
     */
    private function __construct(
        public string $code,
        public array $locales,
        public array $entity,
        public array $formats,
        public bool $isFallback,
        public string $entityProfile = 'generic',
    ) {}

    /**
     * Profilo corrente: usa `civic.country` se impostato, altrimenti `civic.default_country`.
     * Richiede l'applicazione; nei test senza bootstrap usare `resolve()` con l'array config.
     */
    public static function current(): self
    {
        /** @var array<string, mixed>|null $config */
        $config = (function_exists('app') && app()->bound('config')) ? config('civic') : null;

        return self::resolve(
            is_string($config['country'] ?? null) ? $config['country'] : null,
            is_array($config) ? $config : [],
        );
    }

    /**
     * Risolve un codice paese (`it`, `IT`, `mt`, `MT`...) contro la configurazione data.
     * Funzione pura: nessuna dipendenza dal container, quindi testabile senza applicazione.
     *
     * @param  array<string, mixed>  $config  contenuto di `config/civic.php`
     */
    public static function resolve(?string $requested, array $config): self
    {
        $countries = is_array($config['countries'] ?? null) ? $config['countries'] : [];
        $default = is_string($config['default_country'] ?? null) ? strtoupper($config['default_country']) : 'IT';

        $code = self::normalize($requested) ?? $default;
        $isFallback = ! isset($countries[$code]);
        if ($isFallback) {
            $code = isset($countries[$default]) ? $default : self::firstCountry($countries);
        }

        /** @var array<string, mixed> $profile */
        $profile = $countries[$code] ?? [];
        $formats = (is_array($profile['formats'] ?? null) ? $profile['formats'] : []) + self::defaultFormats();
        // I formati sanno in quale Paese sono: `LocaleFormats` ci mette il prefisso telefonico
        // e le regole di validazione senza dover ripassare il codice paese ad ogni chiamata.
        $formats['country_code'] = $code;

        return new self(
            code: $code,
            locales: self::stringList($profile['locales'] ?? null),
            entity: is_array($profile['entity'] ?? null) ? $profile['entity'] : [],
            formats: $formats,
            isFallback: $isFallback || $code === '',
            entityProfile: self::stringOr($profile['entity_profile'] ?? null) ?? 'generic',
        );
    }

    /**
     * Chiave di traduzione di un termine di terminologia (contratto
     * `i18n-entity-terminology`): `pub_theme::entity.profiles.<profilo>.<termine>`.
     * Il profilo e' sempre uno chiuso (`generic` in fallback, mai `comune` per
     * un Paese sconosciuto).
     */
    public function entityTermKey(string $term): string
    {
        return 'pub_theme::entity.profiles.'.$this->entityProfile.'.'.$term;
    }

    /** Nome dell'ente per la lingua data (es. "Comune", "Local Council"); stringa vuota se non configurato. */
    public function entityName(string $locale = 'en'): string
    {
        $names = $this->entity['names'] ?? null;
        if (is_array($names) && isset($names[$locale]) && is_string($names[$locale])) {
            return $names[$locale];
        }

        $singular = $this->entity['singular'] ?? null;

        return is_string($singular) ? $singular : '';
    }

    /** @return list<string> */
    public function locales(): array
    {
        return $this->locales;
    }

    /** Formati del profilo, con default neutrali per le chiavi mancanti. */
    public function formats(): array
    {
        return $this->formats + self::defaultFormats();
    }

    private static function normalize(?string $code): ?string
    {
        if ($code === null) {
            return null;
        }
        $code = strtoupper(trim($code));

        return $code === '' ? null : $code;
    }

    /** @param array<string, mixed> $countries */
    private static function firstCountry(array $countries): string
    {
        $first = array_key_first($countries);

        return is_string($first) ? $first : '';
    }

    /** @return list<string> */
    private static function stringList(mixed $value): array
    {
        if (! is_array($value)) {
            return [];
        }

        return array_values(array_filter($value, 'is_string'));
    }

    /** @return array<string, mixed> */
    private static function defaultFormats(): array
    {
        return [
            'date' => 'dd/MM/yyyy',
            'address_format' => '{street}, {locality} {postcode}, {country}',
            'address_order' => ['street', 'locality', 'postcode', 'country'],
            'postcode_pattern' => null,
            'postcode_normalize' => null,
            'phone_country_code' => null,
            'phone_pattern' => null,
            'phone_groups' => null,
        ];
    }

    private static function stringOr(mixed $value): ?string
    {
        return is_string($value) && $value !== '' ? $value : null;
    }
}
