<?php

declare(strict_types=1);

/**
 * Report riproducibile della parita' dei cataloghi `lang/<locale>/` del tema (issue #7).
 *
 * Uso, dalla cartella `laravel/` (nessuna applicazione, nessun database):
 *
 *   php Themes/Civic/tests/Unit/I18n/Support/lang-parity-report.php                  # riepilogo, esce 1 se c'e' un buco
 *   php Themes/Civic/tests/Unit/I18n/Support/lang-parity-report.php --details        # elenca le chiavi mancanti
 *   php Themes/Civic/tests/Unit/I18n/Support/lang-parity-report.php --locales=it,en,de,es,mt
 *   php Themes/Civic/tests/Unit/I18n/Support/lang-parity-report.php --reference=en   # lingua dei segnaposto (default it)
 *   php Themes/Civic/tests/Unit/I18n/Support/lang-parity-report.php --pending=mt     # testi mt marcati [[MT-REV]]
 *   php Themes/Civic/tests/Unit/I18n/Support/lang-parity-report.php --drafted=mt     # testi mt scritti ma NON marcati: da rivedere anche loro
 *   php Themes/Civic/tests/Unit/I18n/Support/lang-parity-report.php --json
 *
 * Per default confronta tutte le lingue presenti in `lang/`. Il confronto e' contro l'UNIONE delle chiavi: ogni lingua deve
 * avere ogni chiave che ha almeno un'altra lingua. Il fallback `it` nasconde le chiavi mancanti (compare italiano, non un
 * errore): questo report le rende visibili. Audit delle pagine renderizzate (testi uguali all'italiano nel browser):
 * `bashscripts/tools/i18n/audit-locales.py`, che e' un'altra misura e non si duplica qui.
 *
 * @see docs/contracts/i18n-catalog-parity.md
 */

require_once dirname(__DIR__, 6).'/vendor/autoload.php';
require_once __DIR__.'/LangCatalog.php';

use Themes\Civic\Tests\Unit\I18n\Support\LangCatalog;

use function Safe\fwrite;
use function Safe\json_encode;
use function Safe\preg_match;

$options = [];
foreach (array_slice($argv, 1) as $argument) {
    $match = [];
    if (preg_match('/^--([a-z-]+)(?:=(.*))?$/', $argument, $match) !== 1 || ! isset($match[1])) {
        fwrite(STDERR, "Argomento non valido: {$argument}\n");
        exit(2);
    }
    $options[$match[1]] = $match[2] ?? '1';
}

$catalog = LangCatalog::forTheme();
$locales = isset($options['locales']) ? array_values(array_filter(explode(',', $options['locales']))) : $catalog->locales();
$known = $catalog->locales();
$unknown = array_values(array_diff($locales, $known));
if ($unknown !== []) {
    fwrite(STDERR, 'Lingue senza cartella in lang/: '.implode(', ', $unknown)."\n");
    exit(2);
}

if (isset($options['drafted'])) {
    $drafted = $catalog->drafted($options['drafted']);
    if (isset($options['json'])) {
        echo json_encode(['locale' => $options['drafted'], 'drafted' => $drafted], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), "\n";
    } else {
        echo count($drafted).' testi '.$options['drafted']." scritti e non marcati (diversi da en, mai rivisti)\n";
        foreach ($drafted as $key) {
            echo '  '.$key."\n";
        }
    }
    exit(0);
}

if (isset($options['pending'])) {
    $pending = $catalog->pending($options['pending']);
    if (isset($options['json'])) {
        echo json_encode(['locale' => $options['pending'], 'pending' => $pending], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), "\n";
    } else {
        echo count($pending).' testi '.$options['pending']." marcati per la revisione\n";
        foreach ($pending as $key) {
            echo '  '.$key."\n";
        }
    }
    exit(0);
}

$reference = $options['reference'] ?? (in_array('it', $locales, true) ? 'it' : $locales[0]);
if (! in_array($reference, $locales, true)) {
    fwrite(STDERR, "La lingua di riferimento {$reference} non e' fra quelle confrontate\n");
    exit(2);
}
$union = $catalog->union($locales);
$rows = [];
$problems = 0;
foreach ($locales as $locale) {
    $missing = $catalog->missing($locale, $locales);
    $missingFiles = $catalog->missingFiles($locale, $locales);
    $empty = $catalog->emptyEntries($locale);
    $placeholders = $locale === $reference ? [] : $catalog->placeholderMismatches($locale, $reference);
    $problems += count($missing) + count($missingFiles) + count($empty) + count($placeholders);
    $rows[$locale] = [
        'keys' => count($catalog->catalog($locale)),
        'files' => count($catalog->files($locale)),
        'missing_keys' => $missing,
        'missing_files' => $missingFiles,
        'empty_entries' => $empty,
        'placeholder_mismatches' => $placeholders,
        'pending_review' => count($catalog->pending($locale)),
    ];
}

if (isset($options['json'])) {
    $report = ['locales' => $locales, 'placeholder_reference' => $reference, 'union_keys' => count($union), 'per_locale' => $rows];
    echo json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), "\n";
    exit($problems === 0 ? 0 : 1);
}

printf("Cataloghi confrontati: %s | segnaposto contro: %s | chiavi nell'unione: %d\n", implode(', ', $locales), $reference, count($union));
printf("%-6s %6s %6s %9s %9s %7s %12s %8s\n", 'lang', 'file', 'chiavi', 'mancanti', 'file_man', 'vuote', 'segnaposto', 'da_rivedere');
foreach ($rows as $locale => $row) {
    printf(
        "%-6s %6d %6d %9d %9d %7d %12d %8d\n",
        $locale,
        $row['files'],
        $row['keys'],
        count($row['missing_keys']),
        count($row['missing_files']),
        count($row['empty_entries']),
        count($row['placeholder_mismatches']),
        $row['pending_review'],
    );
}
if (isset($options['details'])) {
    foreach ($rows as $locale => $row) {
        foreach ($row['missing_keys'] as $key) {
            echo "  [{$locale}] MANCA {$key}\n";
        }
        foreach ($row['missing_files'] as $file) {
            echo "  [{$locale}] FILE MANCA {$file}\n";
        }
        foreach ($row['empty_entries'] as $key) {
            echo "  [{$locale}] VUOTA {$key}\n";
        }
        foreach ($row['placeholder_mismatches'] as $key => $diff) {
            echo "  [{$locale}] SEGNAPOSTO {$key}: ".implode(',', $diff['reference']).' vs '.implode(',', $diff['locale'])."\n";
        }
    }
}
echo $problems === 0 ? "OK: nessun buco\n" : "{$problems} problemi\n";
exit($problems === 0 ? 0 : 1);
