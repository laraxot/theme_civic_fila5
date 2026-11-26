<?php

declare(strict_types=1);

/*
 * Le icone di header, footer, ricerca e menu utente sono `<use href=".../sprites.svg#nome">`. Senza lo sprite la richiesta risponde 404
 * (sia sul percorso diretto `/themes/Civic/...` sia sulla rotta `/{lingua}/assets/...`, che serve dallo stesso `public/`) e le icone
 * spariscono senza alcun errore visibile.
 *
 * `deploy.sh` non esegue il build del tema: serve `Themes/Civic/public` cosi' com'e' nel repository. Quindi lo sprite deve stare
 * nell'output versionato (non in `.gitignore`) e il deploy deve rifiutare un tema che non lo ha, come gia' fa con `manifest.json`.
 * Test di soli file: non avvia l'app e non tocca il database.
 */
const CIVIC_ICON_SPRITE = 'design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';

it('ships the icon sprite in the versioned theme public output', function (): void {
    $sprite = dirname(__DIR__, 2).'/public/'.CIVIC_ICON_SPRITE;

    expect($sprite)->toBeFile();
    expect((string) file_get_contents($sprite))->toContain('<svg');
    expect((int) filesize($sprite))->toBeGreaterThan(1000);
});

it('does not git-ignore the sprite that production serves', function (): void {
    $theme = dirname(__DIR__, 2);

    if (! file_exists($theme.'/.git')) {
        $this->markTestSkipped('Il tema non e un checkout git: nessuna regola di ignore da interrogare.');
    }

    // Si chiede a git, non si legge una riga del .gitignore: `dist/` esclude la cartella e basta una sola regola dimenticata
    // (o una negazione mancante) perche' il file non finisca nel repository. Uscita 1 = non ignorato; 0 = ignorato; 128 = errore.
    exec('git -C '.escapeshellarg($theme).' check-ignore -q -- '.escapeshellarg('public/'.CIVIC_ICON_SPRITE).' 2>&1', $output, $exitCode);

    expect($exitCode)->toBe(1);
});

/*
 * `deploy.sh` controlla lo sprite del tema che il tenant serve davvero (`pub_theme`), non quello di ogni tema nell'albero. Oggi il
 * tenant serve un altro tema e il controllo e' sul suo percorso: la prova resta valida finche' `pub_theme` non diventa `Civic`. Quel
 * giorno, se `deploy.sh` non e' stato esteso a `themes/Civic/` (ADR 0005, punto 4.4), questo test diventa rosso e blocca il passaggio.
 *
 * @see docs/adr/0005-attivazione-civic-e-convivenza-con-sixteen.md
 */
it('makes deploy.sh refuse the active theme when it has no icon sprite', function (): void {
    $tenantConfig = dirname(__DIR__, 4).'/config/local/fixcity/xra.php';
    if (! is_file($tenantConfig)) {
        $this->markTestSkipped('Nessuna configurazione del tenant fixcity: il tema attivo non e determinabile.');
    }

    expect(preg_match("/'pub_theme'\s*=>\s*'([A-Za-z0-9]+)'/", (string) file_get_contents($tenantConfig), $active))->toBe(1);

    $commands = array_filter(
        array_map(trim(...), file(dirname(__DIR__, 5).'/deploy.sh') ?: []),
        static fn (string $line): bool => $line !== '' && ! str_starts_with($line, '#'),
    );
    $guards = array_filter($commands, static fn (string $line): bool => str_starts_with($line, 'test -f') && str_contains($line, 'themes/'.$active[1].'/'.CIVIC_ICON_SPRITE));

    expect($guards)->not->toBeEmpty();
});
