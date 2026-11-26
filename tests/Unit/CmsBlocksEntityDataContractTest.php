<?php

declare(strict_types=1);

use PHPUnit\Framework\Assert;
use Symfony\Component\Finder\Finder;

/**
 * Contratto #20 — i blocchi CMS non possono contenere testi, recapiti o URL
 * di un ente specifico: i dati arrivano dal JSON CMS, i default sicuri da
 * `config()` o da `GetEnteDataAction` (config('ente')), le relazioni nulle
 * sono gestite e la UI ripetuta sta in partial condivisi.
 *
 * Il test e' statico (lettura file): gira senza database e senza bootstrap.
 */

/**
 * @return list<string>
 */
function cmsContractViewFiles(string $themeRoot): array
{
    $paths = [];
    foreach (['components/blocks', 'components/sections', 'components/footer', 'sections'] as $dir) {
        $base = $themeRoot.'/resources/views/'.$dir;
        if (! is_dir($base)) {
            continue;
        }
        foreach ((new Finder)->files()->name('*.blade.php')->in($base) as $file) {
            $paths[] = $file->getPathname();
        }
    }

    return $paths;
}

test('blocchi CMS non contengono recapiti o testi di un ente specifico', function (): void {
    $themeRoot = dirname(__DIR__, 2);
    // Dominio, email, telefono e indirizzo di entita' reali o esemplificative:
    // se servono, devono arrivare da config('ente') via GetEnteDataAction o dal JSON.
    $forbidden = [
        'fixcity.gov.it',
        'urp@comune.it',
        'comune@pec.it',
        'comune.example.it',
        'info@comune.example.it',
        'protocollo@pec.comune.esempio.it',
        'supporto@fixcity',
        'tel:050505',
        'tel:+390123456789',
        'tel:061234567',
        'tel:0612345678',
        '01 2345 6789',
        'Via Roma 123',
        'Via Solferino',
        '50100 Firenze',
        'Nome Comune',
        'Comune di Example',
        'Giulia Bianchi',
        'GLABNC72H25H501Y',
        'giulia.bianchi@gmail.com',
        '+39 331 1234567',
        'roma-colosseo',
        'Colosseo di Roma',
        'Gipsoteca canoviana',
        'Tomba Brion',
    ];

    $violations = [];
    foreach (cmsContractViewFiles($themeRoot) as $path) {
        $contents = (string) file_get_contents($path);
        foreach ($forbidden as $needle) {
            if (str_contains($contents, $needle)) {
                $violations[] = str_replace($themeRoot.'/', '', $path).' contiene «'.$needle.'»';
            }
        }
    }

    Assert::assertSame([], $violations, "Testi/recapiti di ente nei componenti CMS:\n".implode("\n", $violations));
});

test('il blocco FAQ non ha domande predefinite di un ente', function (): void {
    $path = dirname(__DIR__, 2).'/resources/views/components/blocks/faq/default.blade.php';
    $contents = (string) file_get_contents($path);

    Assert::assertStringNotContainsString('Come posso contattare il Comune', $contents);
    Assert::assertStringNotContainsString('Ufficio Relazioni con il Pubblico', $contents);
    // Default solo da config()/JSON: la lista predefinita non deve contenere array di domande hardcoded.
    Assert::assertStringContainsString("config('civic.faq.questions'", $contents);
    Assert::assertStringContainsString('@if ($questions !== [])', $contents);
});

test('i contatti dei blocchi flow segnalazione usano il partial condiviso e l ente', function (): void {
    $base = dirname(__DIR__, 2).'/resources/views/components/blocks/flow/segnalazione';
    $partial = $base.'/partials/contacts-card.blade.php';

    Assert::assertFileExists($partial);
    $partialContents = (string) file_get_contents($partial);
    Assert::assertStringContainsString('GetEnteDataAction', $partialContents);
    Assert::assertStringNotContainsString('tel:050505', $partialContents);

    foreach (['01-privacy', '02-dati', '03-riepilogo', '04-conferma'] as $step) {
        $contents = (string) file_get_contents($base.'/'.$step.'.blade.php');
        Assert::assertStringContainsString('partials.contacts-card', $contents, $step.' non include il partial condiviso');
        Assert::assertStringNotContainsString('tel:050505', $contents, $step.' contiene ancora un telefono finto');
    }
});

test('il riepilogo segnalazione non espone dati personali finti', function (): void {
    $contents = (string) file_get_contents(
        dirname(__DIR__, 2).'/resources/views/components/blocks/flow/segnalazione/03-riepilogo.blade.php'
    );

    foreach (['Giulia Bianchi', 'GLABNC', 'Solferino', 'gmail.com', '+39 331'] as $needle) {
        Assert::assertStringNotContainsString($needle, $contents);
    }
});
