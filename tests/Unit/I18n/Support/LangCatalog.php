<?php

declare(strict_types=1);

namespace Themes\Civic\Tests\Unit\I18n\Support;

use InvalidArgumentException;
use LogicException;

/**
 * Lettura dei cataloghi `lang/<locale>/*.php` del tema, senza applicazione ne' database: serve al test di parita'
 * e allo script `lang-parity-report.php`, che devono dare lo stesso risultato.
 *
 * Una chiave e' `<file>.<percorso.puntato>` (per esempio `ui.buttons.save`): e' la stessa chiave che `trans()` risolve
 * come `pub_theme::ui.buttons.save`. Le foglie sono stringhe; un array vuoto e' una foglia a se' (segnala un file corrotto).
 *
 * Perche' esiste: `fallback_locale` e' `it` (config/app.php), quindi una chiave mancante in en/de/es non produce errori
 * ne' chiavi grezze, mostra italiano. Il confronto dei cataloghi e' l'unico modo di vedere il buco.
 *
 * @see docs/contracts/i18n-catalog-parity.md
 * @see docs/adr/0013-fallback-di-localizzazione-e-parita-dei-cataloghi.md
 */
final readonly class LangCatalog
{
    /** Prefisso con cui `lang/mt` marca un testo non ancora rivisto da un parlante (vedi ADR 0010). */
    public const string PENDING_MARKER = '[[MT-REV]] ';

    public function __construct(private string $langPath) {}

    public static function forTheme(): self
    {
        return new self(dirname(__DIR__, 4).'/lang');
    }

    public function langPath(): string
    {
        return $this->langPath;
    }

    /** @return list<string> lingue con almeno un file .php, ordinate */
    public function locales(): array
    {
        $locales = [];
        foreach (glob($this->langPath.'/*', GLOB_ONLYDIR) ?: [] as $directory) {
            if (glob($directory.'/*.php') !== []) {
                $locales[] = basename($directory);
            }
        }
        sort($locales);

        return $locales;
    }

    /** @return list<string> nomi dei file senza estensione, ordinati */
    public function files(string $locale): array
    {
        $files = array_map(
            static fn (string $path): string => basename($path, '.php'),
            glob($this->langPath.'/'.$this->safeLocale($locale).'/*.php') ?: [],
        );
        sort($files);

        return $files;
    }

    /**
     * Chiavi (`<file>.<percorso>`) => testo, per tutti i file della lingua.
     *
     * @return array<string, string>
     */
    public function catalog(string $locale): array
    {
        $catalog = [];
        foreach ($this->files($locale) as $file) {
            foreach ($this->flatten($this->load($locale, $file)) as $path => $value) {
                $catalog[$file.'.'.$path] = $value;
            }
        }

        return $catalog;
    }

    /**
     * Chiavi presenti in almeno una delle lingue date.
     *
     * @param  list<string>  $locales
     * @return list<string>
     */
    public function union(array $locales): array
    {
        $keys = [];
        foreach ($locales as $locale) {
            foreach (array_keys($this->catalog($locale)) as $key) {
                $keys[$key] = true;
            }
        }
        $union = array_keys($keys);
        sort($union);

        return $union;
    }

    /**
     * Chiavi che la lingua non ha ma almeno un'altra delle lingue date ha.
     *
     * @param  list<string>  $against
     * @return list<string>
     */
    public function missing(string $locale, array $against): array
    {
        $own = $this->catalog($locale);

        return array_values(array_filter(
            $this->union($against),
            static fn (string $key): bool => ! array_key_exists($key, $own),
        ));
    }

    /**
     * File che esistono in una delle lingue date e non in questa.
     *
     * @param  list<string>  $against
     * @return list<string>
     */
    public function missingFiles(string $locale, array $against): array
    {
        $files = [];
        foreach ($against as $other) {
            $files = [...$files, ...$this->files($other)];
        }

        return array_values(array_diff(array_unique($files), $this->files($locale)));
    }

    /**
     * File della lingua che restituiscono un array vuoto, o chiavi il cui valore e' un array vuoto: il segno del writer
     * automatico che appende righe dopo `return [];` e del file lasciato a meta'. Una stringa vuota NON e' un difetto
     * (`placeholder` e `help` dell'header sono vuoti di proposito).
     *
     * @return list<string> `<file>` oppure `<file>.<chiave>`
     */
    public function emptyEntries(string $locale): array
    {
        $empty = [];
        foreach ($this->files($locale) as $file) {
            $data = $this->load($locale, $file);
            if ($data === []) {
                $empty[] = $file;

                continue;
            }
            foreach ($this->flatten($data) as $path => $value) {
                if ($value === '[]') {
                    $empty[] = $file.'.'.$path;
                }
            }
        }

        return $empty;
    }

    /**
     * Chiavi presenti in entrambe le lingue il cui insieme di segnaposto `:nome` differisce: una traduzione che perde
     * `:count` o `:date` stampa il testo senza il dato, senza alcun errore.
     *
     * @return array<string, array{reference: list<string>, locale: list<string>}>
     */
    public function placeholderMismatches(string $locale, string $reference): array
    {
        $own = $this->catalog($locale);
        $mismatches = [];
        foreach ($this->catalog($reference) as $key => $text) {
            if (! array_key_exists($key, $own)) {
                continue;
            }
            $expected = $this->placeholders($text);
            $actual = $this->placeholders($own[$key]);
            if ($expected !== $actual) {
                $mismatches[$key] = ['reference' => $expected, 'locale' => $actual];
            }
        }

        return $mismatches;
    }

    /**
     * Chiavi il cui testo e' ancora marcato per la revisione (`[[MT-REV]] `).
     *
     * @return list<string>
     */
    public function pending(string $locale): array
    {
        return array_keys(array_filter(
            $this->catalog($locale),
            static fn (string $text): bool => str_starts_with($text, self::PENDING_MARKER),
        ));
    }

    /**
     * Segnaposto `:nome` di un testo, senza duplicati, ordinati. Il marcatore di revisione non ne contiene.
     *
     * @return list<string>
     */
    public function placeholders(string $text): array
    {
        preg_match_all('/(?<![\w:]):([A-Za-z_][A-Za-z0-9_]*)/', $text, $matches);
        $names = array_values(array_unique($matches[1]));
        sort($names);

        return $names;
    }

    /**
     * Le chiavi il cui testo usa l'intervallo esplicito di Laravel (`{1} un errore|[2,*] :count errori`): valgono per
     * ogni lingua, mentre le forme semplici (`uno|molti`) dipendono dalla regola di plurale della lingua (`mt` ne ha
     * quattro, vedi `MessageSelector::getPluralIndex`). Una lingua che perde l'intervallo conta male.
     *
     * @return list<string>
     */
    public function explicitPluralKeys(string $locale): array
    {
        return array_keys(array_filter(
            $this->catalog($locale),
            static fn (string $text): bool => str_contains($text, '|')
                && preg_match('/(^|\|)\s*(\{[0-9,\s]+\}|\[[0-9,\s*]+\])/', $text) === 1,
        ));
    }

    /**
     * Struttura del file lang, caricata in uno scope isolato: un file puo' definire variabili (`$base = require ...`)
     * che non devono toccare quelle del chiamante.
     *
     * @return array<array-key, mixed>
     */
    private function load(string $locale, string $file): array
    {
        $path = $this->langPath.'/'.$this->safeLocale($locale).'/'.$file.'.php';
        $data = (static fn (string $__path): mixed => require $__path)($path);
        if (! is_array($data)) {
            throw new LogicException($path.' non restituisce un array');
        }

        return $data;
    }

    /**
     * @param  array<array-key, mixed>  $data
     * @return array<string, string>
     */
    private function flatten(array $data, string $prefix = ''): array
    {
        $flat = [];
        foreach ($data as $key => $value) {
            $path = $prefix === '' ? (string) $key : $prefix.'.'.$key;
            if (is_array($value)) {
                $flat = $value === [] ? [...$flat, $path => '[]'] : [...$flat, ...$this->flatten($value, $path)];

                continue;
            }
            $flat[$path] = is_scalar($value) || $value === null ? (string) $value : throw new LogicException($path.': foglia non testuale');
        }

        return $flat;
    }

    private function safeLocale(string $locale): string
    {
        return preg_match('/^[a-z]{2,3}(_[A-Z]{2})?$/', $locale) === 1
            ? $locale
            : throw new InvalidArgumentException('Lingua non valida: '.$locale);
    }
}
