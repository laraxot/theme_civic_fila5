<?php

declare(strict_types=1);

use Tests\TestCase;

uses(TestCase::class);

function civicLocalizationConfig(): array
{
    /** @var array<string, mixed> $config */
    $config = require dirname(__DIR__, 2).'/config/civic.php';

    return $config;
}

test('Civic exposes the supported locales and an explicit English fallback', function (): void {
    $config = civicLocalizationConfig();

    expect($config['supported_locales'])
        ->toContain('it', 'en', 'de', 'es', 'mt')
        ->and($config['fallback_locale'])->toBe('en');
});

test('country profiles keep Italian and Maltese entity terminology separate', function (): void {
    $countries = civicLocalizationConfig()['countries'];

    expect($countries['IT']['entity']['singular'])->toBe('Comune')
        ->and($countries['MT']['entity']['singular'])->toBe('Local Council')
        ->and($countries['MT']['locales'])->toBe(['en', 'mt']);
});

test('country profiles provide reusable date, address, phone and postcode formats', function (): void {
    $malta = civicLocalizationConfig()['countries']['MT'];

    expect($malta['formats'])
        ->toMatchArray([
            'date' => 'dd/MM/yyyy',
            'address_order' => ['street', 'postcode', 'locality', 'country'],
            'phone_country_code' => '+356',
        ])
        ->and(preg_match($malta['formats']['postcode_pattern'], 'VLT 1117'))->toBe(1)
        ->and(preg_match($malta['formats']['postcode_pattern'], '00100'))->toBe(0);
});
