<?php

declare(strict_types=1);

namespace Themes\Civic\Tests\Unit\Support;

use Themes\Civic\Support\LocaleFormats;

require_once dirname(__DIR__, 2).'/Support/civic-autoload.php';

/**
 * Formati per Paese (issue #17, ADR 0012): date via PHP Intl sulla coppia
 * `<lingua>_<PAESE>`, indirizzi da template, telefoni e CAP con regole in dati.
 * Niente applicazione: i `formats` sono array inline identici a `config/civic.php`.
 *
 * @see docs/i18n/formats.md
 * @see docs/adr/0012-formati-per-paese.md
 */

/** Formati IT come in config/civic.php. @return array<string, mixed> */
function civicTestFormatsIt(): array
{
    return [
        'country_code' => 'IT',
        'date' => 'dd/MM/yyyy',
        'address_format' => '{street}, {postcode} {locality} ({province}), {country}',
        'address_order' => ['street', 'postcode', 'locality', 'province', 'country'],
        'postcode_pattern' => '/^\d{5}$/',
        'postcode_normalize' => null,
        'phone_country_code' => '+39',
        'phone_pattern' => '/^(0\d{5,10}|3\d{9})$/',
        'phone_groups' => null,
    ];
}

/** Formati MT come in config/civic.php. @return array<string, mixed> */
function civicTestFormatsMt(): array
{
    return [
        'country_code' => 'MT',
        'date' => 'dd/MM/yyyy',
        'address_format' => '{street}, {locality} {postcode}, {country}',
        'address_order' => ['street', 'postcode', 'locality', 'country'],
        'postcode_pattern' => '/^[A-Z]{3}\s\d{4}$/i',
        'postcode_normalize' => 'uppercase_space',
        'phone_country_code' => '+356',
        'phone_pattern' => '/^[2-9]\d{7}$/',
        'phone_groups' => null,
    ];
}

it('formats a numeric date with the profile pattern through ICU', function (): void {
    expect(LocaleFormats::formatDate('2026-03-04', civicTestFormatsIt(), 'it'))->toBe('04/03/2026')
        ->and(LocaleFormats::formatDate('2026-03-04', ['date' => 'dd.MM.yyyy'], 'de'))->toBe('04.03.2026')
        ->and(LocaleFormats::formatDate(null, civicTestFormatsIt()))->toBe('');
});

it('localizes the long date in the language-country pair, Maltese included', function (): void {
    $longIt = LocaleFormats::formatDateLong('2026-11-26', civicTestFormatsIt(), 'it');
    $longMt = LocaleFormats::formatDateLong('2026-11-26', civicTestFormatsMt(), 'mt');

    expect($longIt)->toContain('novembre')
        ->and($longMt)->toContain('Novembru');
});

it('formats numbers with the separators of the pair, not a fixed one', function (): void {
    expect(LocaleFormats::formatNumber(1234.5, civicTestFormatsIt(), 'it'))->toBe('1.234,50')
        ->and(LocaleFormats::formatNumber(1234.5, civicTestFormatsMt(), 'mt'))->toBe('1,234.50');
});

it('formats an Italian address with CAP, locality, province and country', function (): void {
    $address = LocaleFormats::formatAddress([
        'street' => 'Via Roma 1',
        'postcode' => '00100',
        'locality' => 'Roma',
        'province' => 'RM',
        'country' => 'Italia',
    ], civicTestFormatsIt());

    expect($address)->toBe('Via Roma 1, 00100 Roma (RM), Italia');
});

it('formats a Maltese address with locality before the postal code', function (): void {
    $address = LocaleFormats::formatAddress([
        'street' => '1 Main Street',
        'locality' => 'Valletta',
        'postcode' => 'VLT 1117',
        'country' => 'Malta',
    ], civicTestFormatsMt());

    expect($address)->toBe('1 Main Street, Valletta VLT 1117, Malta');
});

it('drops empty address parts without leaving double separators', function (): void {
    $address = LocaleFormats::formatAddress([
        'street' => 'Triq id-De/order',
        'locality' => 'Gzira',
        'postcode' => 'GZR 1234',
        'country' => null,
    ], civicTestFormatsMt());

    expect($address)->toBe('Triq id-De/order, Gzira GZR 1234');
});

it('validates and normalizes Maltese postal codes only when the profile declares it', function (): void {
    $formats = civicTestFormatsMt();

    expect(LocaleFormats::isValidPostcode('VLT 1117', $formats))->toBeTrue()
        ->and(LocaleFormats::isValidPostcode('vlt1117', $formats))->toBeTrue()
        ->and(LocaleFormats::normalizePostcode('vlt  1117', $formats))->toBe('VLT 1117')
        ->and(LocaleFormats::isValidPostcode('00100', $formats))->toBeFalse();

    // Con il profilo italiano la regola maltese NON corre (difetto misurato in ADR 0012).
    $italian = civicTestFormatsIt();
    expect(LocaleFormats::normalizePostcode('vlt1117', $italian))->toBe('vlt1117')
        ->and(LocaleFormats::isValidPostcode('vlt1117', $italian))->toBeFalse();
});

it('validates Italian CAPs with five digits', function (): void {
    $formats = civicTestFormatsIt();

    expect(LocaleFormats::isValidPostcode('00100', $formats))->toBeTrue()
        ->and(LocaleFormats::isValidPostcode('0010', $formats))->toBeFalse()
        ->and(LocaleFormats::isValidPostcode('VLT 1117', $formats))->toBeFalse();
});

it('validates Maltese phones with the profile pattern and keeps them ungrouped', function (): void {
    $formats = civicTestFormatsMt();

    expect(LocaleFormats::isValidPhone('21234567', $formats))->toBeTrue()
        ->and(LocaleFormats::isValidPhone('+356 21 234 567', $formats))->toBeTrue()
        ->and(LocaleFormats::isValidPhone('7921 2345', $formats))->toBeTrue()
        ->and(LocaleFormats::isValidPhone('12345', $formats))->toBeFalse()
        // Raggruppamento non dichiarato in config: si mostra `+356` + nazionale.
        ->and(LocaleFormats::formatPhone('+356 21 234 567', $formats))->toBe('+356 21234567');
});

it('validates Italian phones with the profile pattern', function (): void {
    $formats = civicTestFormatsIt();

    expect(LocaleFormats::isValidPhone('0612345678', $formats))->toBeTrue()
        ->and(LocaleFormats::isValidPhone('+39 333 1234567', $formats))->toBeTrue()
        ->and(LocaleFormats::isValidPhone('123', $formats))->toBeFalse()
        ->and(LocaleFormats::formatPhone('+39 06 12345678', $formats))->toBe('+39 0612345678');
});

it('honours a declared phone_groups when the profile provides one', function (): void {
    $formats = civicTestFormatsIt();
    $formats['phone_groups'] = [2];

    expect(LocaleFormats::formatPhone('06 12345678', $formats))->toBe('+39 06 12345678');
});
