<?php

declare(strict_types=1);

require_once dirname(__DIR__, 2).'/Support/civic-autoload.php';

use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Assert;
use Tests\TestCase;
use Themes\Civic\Providers\ThemeServiceProvider;

uses(TestCase::class);

/*
 * SEC-02: il callback SPID accettava una SAMLResponse senza verificarne la firma, quindi chiunque poteva autenticarsi
 * con un codice fiscale arbitrario. Le rotte SPID/CIE si registrano solo con CIVIC_SPID_ENABLED=true.
 */
it('keeps SPID and CIE routes switched off unless explicitly enabled', function (): void {
    if (ThemeServiceProvider::digitalIdentityRoutesEnabled()) {
        $this->markTestSkipped('CIVIC_SPID_ENABLED=true in questo ambiente.');
    }

    foreach (['spid.login', 'spid.callback', 'spid.slo', 'cie.login', 'cie.callback', 'cie.debug', 'civic.test-auth.spid.simulate'] as $name) {
        Assert::assertFalse(Route::has($name), "La rotta {$name} non deve esistere con l'identità digitale disattivata.");
    }
});

it('reads the switch from the civic.auth.spid.enabled config key', function (): void {
    config(['civic.auth.spid.enabled' => false]);
    Assert::assertFalse(ThemeServiceProvider::digitalIdentityRoutesEnabled());

    config(['civic.auth.spid.enabled' => 'true']);
    Assert::assertFalse(ThemeServiceProvider::digitalIdentityRoutesEnabled(), 'Solo il booleano true abilita le rotte.');

    config(['civic.auth.spid.enabled' => true]);
    Assert::assertTrue(ThemeServiceProvider::digitalIdentityRoutesEnabled());
});
