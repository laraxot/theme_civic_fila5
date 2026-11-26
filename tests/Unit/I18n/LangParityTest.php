<?php

declare(strict_types=1);

namespace Themes\Civic\Tests\Unit\I18n;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Themes\Civic\Tests\Unit\I18n\Support\LangCatalog;

require_once __DIR__.'/Support/LangCatalog.php';

/**
 * Parita' dei cataloghi `lang/<locale>/` del tema (issue #7, contratto `docs/contracts/i18n-catalog-parity.md`).
 *
 * Perche' serve: `fallback_locale` e' `it` (config/app.php). Una chiave che manca in en/de/es non da' errore ne' chiave
 * grezza, mostra italiano: audit 2026-11-26, 569 chiavi mancanti in de e 566 in es (25 file interi), 83 in en, 24 in it.
 * Il confronto e' contro l'UNIONE delle chiavi: ogni lingua deve avere ogni chiave che ha almeno un'altra lingua.
 *
 * Nessuna applicazione e nessun database: legge i file lang (come `NewsIndexLabelsAreTranslatedTest`), quindi gira anche
 * mentre il tema e' in migrazione. Per questo non lega `Tests\TestCase`: boot dell'app e connessione al database
 * non servono e renderebbero il test dipendente dal tenant.
 *
 * Report leggibile e riproducibile: `php Themes/Civic/tests/Unit/I18n/Support/lang-parity-report.php --details` da `laravel/`.
 *
 * @see docs/contracts/i18n-catalog-parity.md
 */

/**
 * Lingue il cui catalogo e' completo e quindi sotto parita' stretta. `mt` si aggiunge qui solo quando e' completo
 * (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 *
 * @return list<string>
 */
function civicI18nGuardedLocales(): array
{
    return ['it', 'en', 'de', 'es'];
}

/**
 * Prime righe del problema: il messaggio di Pest deve dire quali chiavi, non solo quante.
 *
 * @param  list<string>  $items
 * @return list<string>
 */
function civicI18nFirst(array $items, int $limit = 25): array
{
    return count($items) <= $limit ? $items : [...array_slice($items, 0, $limit), '... e altre '.(count($items) - $limit)];
}

dataset('civic i18n guarded locales', fn (): array => civicI18nGuardedLocales());

it('has in every guarded locale every key that any guarded locale has', function (string $locale): void {
    $missing = LangCatalog::forTheme()->missing($locale, civicI18nGuardedLocales());

    expect(civicI18nFirst($missing))->toBe([], "lang/{$locale} perde ".count($missing).' chiavi presenti in altre lingue');
})->with('civic i18n guarded locales')->group('CIVIC-I18N-INV-1');

it('has the same lang files in every guarded locale and none of them is empty', function (string $locale): void {
    $catalog = LangCatalog::forTheme();

    expect($catalog->missingFiles($locale, civicI18nGuardedLocales()))->toBe([], "file mancanti in lang/{$locale}")
        ->and($catalog->emptyEntries($locale))->toBe([], "file o chiavi vuote (`return [];`) in lang/{$locale}");
})->with('civic i18n guarded locales')->group('CIVIC-I18N-INV-2');

it('keeps the :placeholders of the Italian text in every other guarded locale', function (string $locale): void {
    $mismatches = LangCatalog::forTheme()->placeholderMismatches($locale, 'it');

    expect(civicI18nFirst(array_keys($mismatches)))->toBe([], "segnaposto diversi da it in lang/{$locale}");
})->with(array_values(array_diff(civicI18nGuardedLocales(), ['it'])))->group('CIVIC-I18N-INV-3');

it('writes the same explicit plural intervals in every guarded locale', function (string $locale): void {
    $catalog = LangCatalog::forTheme();

    expect($catalog->explicitPluralKeys($locale))->toBe($catalog->explicitPluralKeys('it'));
})->with('civic i18n guarded locales')->group('CIVIC-I18N-INV-4');

it('leaves no lang directory outside the parity check', function (): void {
    $unguarded = array_values(array_diff(LangCatalog::forTheme()->locales(), civicI18nGuardedLocales()));

    // `mt` e' una bozza dichiarata (ADR 0010): puo' esistere senza essere ancora sotto parita' stretta.
    expect($unguarded)->toBeIn([[], ['mt']]);
})->group('CIVIC-I18N-INV-5');

it('resolves every key in its own locale through the Laravel translator, without fallback', function (string $locale): void {
    $langPath = LangCatalog::forTheme()->langPath();
    $loader = new FileLoader(new Filesystem, $langPath);
    $loader->addNamespace('pub_theme', $langPath);
    $translator = new Translator($loader, $locale);
    $translator->setFallback('xx');

    $unresolved = array_values(array_filter(
        LangCatalog::forTheme()->union(civicI18nGuardedLocales()),
        static fn (string $key): bool => ! $translator->hasForLocale('pub_theme::'.$key, $locale),
    ));

    expect(civicI18nFirst($unresolved))->toBe([], "chiavi che lang/{$locale} non risolve da sola (il fallback it le nasconderebbe)");
})->with('civic i18n guarded locales')->group('CIVIC-I18N-INV-6');

it('keeps the review marker out of every guarded locale', function (string $locale): void {
    expect(LangCatalog::forTheme()->pending($locale))->toBe([]);
})->with('civic i18n guarded locales')->group('CIVIC-I18N-INV-7');
