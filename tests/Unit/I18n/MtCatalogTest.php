<?php

declare(strict_types=1);

namespace Themes\Civic\Tests\Unit\I18n;

use Themes\Civic\Tests\Unit\I18n\Support\LangCatalog;

require_once __DIR__.'/Support/LangCatalog.php';

/**
 * Catalogo maltese `lang/mt` (issue #8): bozza completa con marcatura di revisione.
 *
 * `mt` non entra fra le lingue "guardate" di `LangParityTest` (CHIAVI-INV): e' una bozza
 * linguistica, non una traduzione approvata. Questo test fissa il CONTRATTO della bozza:
 *
 * - stesso insieme di file e chiavi di `en` (il fallback funziona per copertura, non per testo);
 * - nessuna chiave orfana (ogni chiave `mt` esiste in `en`);
 * - segnaposto `:nome` identici a `en`;
 * - ogni testo e' o marcato `[[MT-REV]] ` (in attesa di revisione) o e' una forma che non
 *   richiede traduzione (nome proprio, codice, valore identico in maltese);
 * - il marcatore resta nel catalogo: se sparisce tutto, o la bozza e' stata revisionata
 *   (aggiornare questo test e l'ADR) o qualcuno l'ha tolto per sbaglio.
 *
 * Elenco dei testi da rivedere: `php Themes/Civic/tests/Unit/I18n/Support/lang-parity-report.php --pending=mt`
 * (da `laravel/`).
 *
 * @see docs/i18n/mt-catalog.md
 */
it('covers every lang file and key of the English reference catalog', function (): void {
    $catalog = LangCatalog::forTheme();

    expect($catalog->missingFiles('mt', ['en']))->toBe([], 'file mancanti in lang/mt')
        ->and($catalog->missing('mt', ['en']))->toBe([], 'chiavi mancanti in lang/mt')
        ->and($catalog->missingFiles('en', ['mt']))->toBe([], 'file orfani in lang/mt');
});

it('has no orphan keys that English does not have', function (): void {
    $catalog = LangCatalog::forTheme();
    $orphan = $catalog->missing('en', ['mt']);

    expect($orphan)->toBe([], 'chiavi in lang/mt che non esistono in lang/en');
});

it('keeps the :placeholders of the English text', function (): void {
    $mismatches = LangCatalog::forTheme()->placeholderMismatches('mt', 'en');

    expect(array_keys($mismatches))->toBe([]);
});

it('marks every untranslated string for linguistic review', function (): void {
    $catalog = LangCatalog::forTheme();
    $english = $catalog->catalog('en');
    $malta = $catalog->catalog('mt');
    $pending = array_fill_keys($catalog->pending('mt'), true);

    $unmarked = [];
    foreach ($malta as $key => $text) {
        if (isset($pending[$key])) {
            continue;
        }
        $source = $english[$key] ?? null;
        // Sospetto: frase inglese (3+ parole con minuscole) identica all'originale e senza
        // marcatore. Esenti: stringhe vuote (specchio di `en`), URL/path, nomi propri
        // (`FixCity`, `Giulia Rossi`), sigle e prestiti (`OK`, `PDF`, `SPID`).
        $isEnglishSentence = is_string($source)
            && $source === $text
            && $source !== ''
            && str_contains($text, ' ')
            && count(explode(' ', trim($text))) >= 3
            && preg_match('/[a-z]{2,}/', $text) === 1;
        if ($isEnglishSentence) {
            $unmarked[] = $key.' => '.var_export($text, true);
        }
    }

    expect($unmarked)->toBe([], 'testi mt non marcati [[MT-REV]] che ripetono l\'inglese');
});

it('still has texts awaiting review, so the draft marker convention is alive', function (): void {
    expect(count(LangCatalog::forTheme()->pending('mt')))->toBeGreaterThan(0);
});
