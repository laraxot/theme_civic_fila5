<?php

declare(strict_types=1);

namespace Themes\Civic\Tests\Unit\I18n;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Themes\Civic\Tests\Unit\I18n\Support\LangCatalog;

use function Safe\file_get_contents;
use function Safe\preg_match;

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
 * Lingue sotto parita' stretta. `mt` e' entrata quando il catalogo ha raggiunto le stesse chiavi delle altre quattro,
 * con la maggior parte dei testi ancora marcati `[[MT-REV]]`: chiavi complete non vuol dire testi rivisti, vedi INV-7,
 * INV-8 e INV-9 e docs/adr/0010-catalogo-maltese-bozza-e-revisione.md.
 *
 * @return list<string>
 */
function civicI18nGuardedLocales(): array
{
    return ['it', 'en', 'de', 'es', 'mt'];
}

/**
 * Lingue con testi rivisti: nessun marcatore ammesso.
 *
 * @return list<string>
 */
function civicI18nReviewedLocales(): array
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

    expect($unguarded)->toBe([], 'cartelle in lang/ fuori da civicI18nGuardedLocales()');
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

it('keeps the review marker out of every reviewed locale', function (string $locale): void {
    expect(LangCatalog::forTheme()->pending($locale))->toBe([]);
})->with(civicI18nReviewedLocales())->group('CIVIC-I18N-INV-7');

it('marks every untranslated mt text with the review marker and the English source after it', function (): void {
    $catalog = LangCatalog::forTheme();
    $english = $catalog->catalog('en');
    $maltese = $catalog->catalog('mt');
    $broken = [];
    foreach ($catalog->pending('mt') as $key) {
        if (str_replace(LangCatalog::PENDING_MARKER, '', $maltese[$key]) !== $english[$key]) {
            $broken[] = $key;
        }
    }

    // Il testo dopo il marcatore e' l'inglese di riferimento, mai una traduzione a meta' o un testo inventato.
    expect(civicI18nFirst($broken))->toBe([]);
})->group('CIVIC-I18N-INV-8');

it('does not enable mt in the host while mt texts are still marked for review', function (): void {
    $hostConfig = file_get_contents(dirname(__DIR__, 5).'/config/laravellocalization.php');
    $enabled = preg_match("/^\s*'mt'\s*=>/m", (string) $hostConfig) === 1;

    // Una riga `'mt' => [...]` non commentata in supportedLocales abilita la lingua: con testi `[[MT-REV]]` l'utente li vedrebbe.
    expect($enabled && LangCatalog::forTheme()->pending('mt') !== [])->toBeFalse(
        'mt e\' abilitata nel host ma lang/mt ha ancora testi marcati: php Themes/Civic/tests/Unit/I18n/Support/lang-parity-report.php --pending=mt',
    );
})->skip(fn (): bool => ! is_file(dirname(__DIR__, 5).'/config/laravellocalization.php'), 'config del host non presente (tema usato da solo)')
    ->group('CIVIC-I18N-INV-9');

/**
 * Termini di `entity.php` raggruppati per profilo: `['generic' => ['name' => '...', ...], ...]`.
 *
 * @return array<string, array<string, string>>
 */
function civicI18nEntityProfiles(string $locale): array
{
    $profiles = [];
    $match = [];
    foreach (LangCatalog::forTheme()->catalog($locale) as $key => $text) {
        if (preg_match('/^entity\.profiles\.([a-z_]+)\.([a-z_]+)$/', $key, $match) === 1 && isset($match[1], $match[2])) {
            $profiles[$match[1]][$match[2]] = $text;
        }
    }

    return $profiles;
}

it('declares the same entity profiles and the same thirteen terms in every profile and locale', function (string $locale): void {
    $profiles = civicI18nEntityProfiles($locale);
    $reference = array_keys(civicI18nEntityProfiles('it')['generic'] ?? []);

    expect(array_keys($profiles))->toBe(['generic', 'comune', 'local_council'])
        ->and($reference)->toHaveCount(13);
    foreach ($profiles as $profile => $terms) {
        expect(array_keys($terms))->toBe($reference, "termini di entity.profiles.{$profile} in lang/{$locale}");
    }
})->with('civic i18n guarded locales')->group('CIVIC-I18N-INV-10');

it('keeps the institutional vocabulary of one country out of the generic profile and the other profiles', function (string $locale): void {
    $foreign = [
        'generic' => '/comun|provinc|municipal|munici[pċ]|gemeinde|ayuntamiento|sindaco|mayor|b[uü]rgermeister|alcalde|consiglio|council|kunsill/iu',
        'comune' => '/consiglio locale|local council|kunsill|lokaler rat|consejo local/iu',
        // Il capo di un Local Council maltese e' un Mayor (Sindku): sindaco/Bürgermeister/alcalde ne sono la resa corretta.
        'local_council' => '/comun|provinc|gemeinde|ayuntamiento/iu',
    ];
    $leaks = [];
    foreach (civicI18nEntityProfiles($locale) as $profile => $terms) {
        foreach ($terms as $term => $text) {
            if (preg_match($foreign[$profile], $text) === 1) {
                $leaks[] = "{$profile}.{$term}: {$text}";
            }
        }
    }

    expect($leaks)->toBe([], "lang/{$locale}/entity.php mescola il lessico istituzionale di due Paesi");
})->with(civicI18nReviewedLocales())->group('CIVIC-I18N-INV-11');

it('does not grow the number of catalog texts that hardcode the institution name outside entity.php', function (): void {
    // Debito misurato il 2026-11-26 (valori che citano comune/Comuni, municipality, Gemeinde, ayuntamiento fuori da entity.*):
    // ogni testo nuovo usa il profilo (docs/contracts/i18n-entity-terminology.md); il numero puo' solo scendere.
    $baseline = ['it' => 57, 'en' => 57, 'de' => 69, 'es' => 57];
    $patterns = [
        'it' => '/\bcomun[ei]\b/iu',
        'en' => '/municipalit|\bcouncil\b|\bcity hall\b|\btown hall\b/i',
        'de' => '/\bGemeinde|\bStadtverwaltung|\bKommune/u',
        'es' => '/ayuntamiento|municipi/iu',
    ];
    $over = [];
    foreach ($patterns as $locale => $pattern) {
        $count = count(array_filter(
            LangCatalog::forTheme()->catalog($locale),
            static fn (string $text, string $key): bool => ! str_starts_with($key, 'entity.') && preg_match($pattern, $text) === 1,
            ARRAY_FILTER_USE_BOTH,
        ));
        if ($count > $baseline[$locale]) {
            $over[$locale] = "{$count} contro {$baseline[$locale]}";
        }
    }

    expect($over)->toBe([], 'testi con il nome istituzionale scritto a mano oltre il debito noto');
})->group('CIVIC-I18N-INV-12');
