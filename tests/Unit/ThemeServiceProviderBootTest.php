<?php

declare(strict_types=1);

require_once dirname(__DIR__).'/Support/civic-autoload.php';

use Modules\Xot\Datas\XotData;
use Tests\TestCase;
use Themes\Civic\Adapters\ThemeAdapter;
use Themes\Civic\Providers\ThemeServiceProvider;

uses(TestCase::class);

/**
 * Prova del boot del provider di Civic senza attivare il tema: il provider si registra a mano dentro il test e la
 * configurazione del tenant (`pub_theme`) non viene toccata. Se l'host non lo carica ancora a runtime e' per la voce
 * mancante in `RegisterRuntimePsr4NamespacesAction` (ADR 0005), non per il provider.
 *
 * @see docs/adr/0005-attivazione-civic-e-convivenza-con-sixteen.md
 * @see docs/contracts/theme-identity.md
 */
test('il provider di Civic si registra e fa il boot senza cambiare il tema del tenant', function (): void {
    $activeThemeBefore = XotData::make()->pub_theme;

    app()->register(ThemeServiceProvider::class);

    expect(XotData::make()->pub_theme)->toBe($activeThemeBefore)
        ->and($activeThemeBefore)->not->toBe('Civic');
})->group('CIVIC-ID-INV-6');

test('dopo il boot Civic espone i propri view namespace, la propria config e i propri servizi', function (): void {
    app()->register(ThemeServiceProvider::class);

    expect(view()->exists('civic::layouts.app'))->toBeTrue()
        ->and(config('civic.app.version'))->toBeString()
        ->and(config('civic.auth.spid.enabled'))->toBeFalse()
        ->and(app('civic.theme'))->toBeInstanceOf(ThemeAdapter::class)
        ->and(ThemeServiceProvider::digitalIdentityRoutesEnabled())->toBeFalse();
})->group('CIVIC-ID-INV-7');
