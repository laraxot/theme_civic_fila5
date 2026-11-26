<?php

declare(strict_types=1);

namespace Themes\Civic\Tests\Unit\Support;

use Themes\Civic\Support\CountryProfile;

require_once dirname(__DIR__, 2).'/Support/civic-autoload.php';

/**
 * Contratto dei profili Paese/ente (issue #6): fallback esplicito e nessun
 * hardcode del modello italiano. `resolve()` e' pura: la config e' un array
 * inline identico alla sezione `countries` di `config/civic.php`.
 *
 * @see docs/i18n/country-profiles.md
 */

/** Config minima dei profili, come config/civic.php. @return array<string, mixed> */
function civicTestCountryConfig(): array
{
    return [
        'default_country' => 'IT',
        'fallback_locale' => 'en',
        'countries' => [
            'IT' => [
                'locales' => ['it', 'en', 'de', 'es'],
                'entity' => ['singular' => 'Comune', 'plural' => 'Comuni'],
                'entity_profile' => 'comune',
                'formats' => [
                    'date' => 'dd/MM/yyyy',
                    'postcode_pattern' => '/^\d{5}$/',
                    'phone_country_code' => '+39',
                ],
            ],
            'MT' => [
                'locales' => ['en', 'mt'],
                'entity' => ['singular' => 'Local Council', 'plural' => 'Local Councils'],
                'entity_profile' => 'local_council',
                'formats' => [
                    'date' => 'dd/MM/yyyy',
                    'postcode_pattern' => '/^[A-Z]{3}\s\d{4}$/i',
                    'phone_country_code' => '+356',
                ],
            ],
        ],
    ];
}

it('resolves the requested country case-insensitively', function (): void {
    $profile = CountryProfile::resolve('mt', civicTestCountryConfig());

    expect($profile->code)->toBe('MT')
        ->and($profile->isFallback)->toBeFalse()
        ->and($profile->locales())->toBe(['en', 'mt'])
        ->and($profile->entityName())->toBe('Local Council')
        ->and($profile->entityProfile)->toBe('local_council')
        ->and($profile->entityTermKey('offices'))->toBe('pub_theme::entity.profiles.local_council.offices');
});

it('falls back to the default country for unknown codes', function (string $requested): void {
    $profile = CountryProfile::resolve($requested, civicTestCountryConfig());

    expect($profile->code)->toBe('IT')
        ->and($profile->isFallback)->toBeTrue()
        ->and($profile->entityName())->toBe('Comune');
})->with(['ZZ', 'fr']);

it('uses the default country when no country is requested', function (mixed $requested): void {
    $profile = CountryProfile::resolve(is_string($requested) ? $requested : null, civicTestCountryConfig());

    expect($profile->code)->toBe('IT')
        ->and($profile->isFallback)->toBeFalse();
})->with(['', null]);

it('defaults the entity profile to generic, never to comune, when undeclared', function (): void {
    $config = civicTestCountryConfig();
    unset($config['countries']['MT']['entity_profile']);

    $profile = CountryProfile::resolve('MT', $config);

    expect($profile->entityProfile)->toBe('generic')
        ->and($profile->entityTermKey('name'))->toBe('pub_theme::entity.profiles.generic.name');
});

it('keeps tenant profiles isolated: resolving MT never leaks IT formats', function (): void {
    $malta = CountryProfile::resolve('MT', civicTestCountryConfig());
    $italy = CountryProfile::resolve('IT', civicTestCountryConfig());

    expect($malta->formats()['phone_country_code'])->toBe('+356')
        ->and($malta->formats()['postcode_pattern'])->toBe('/^[A-Z]{3}\s\d{4}$/i')
        ->and($italy->formats()['phone_country_code'])->toBe('+39')
        ->and($italy->formats()['postcode_pattern'])->toBe('/^\d{5}$/');
});

it('injects the country code into formats for LocaleFormats', function (): void {
    $profile = CountryProfile::resolve('MT', civicTestCountryConfig());

    expect($profile->formats()['country_code'])->toBe('MT');
});

it('returns neutral defaults when a profile has no formats', function (): void {
    $config = civicTestCountryConfig();
    unset($config['countries']['MT']['formats']);

    $profile = CountryProfile::resolve('MT', $config);

    expect($profile->formats())->toHaveKeys(['date', 'address_format', 'address_order', 'postcode_pattern', 'phone_country_code']);
});
