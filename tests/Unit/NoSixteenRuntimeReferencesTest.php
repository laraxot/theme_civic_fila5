<?php

declare(strict_types=1);

/**
 * Civic non deve portare in giro l'identita' del tema da cui nasce: namespace PHP, view namespace, config, variabili
 * d'ambiente, URL degli asset e id CSS si chiamano Civic. Resta ammesso solo cio' che l'ADR 0004 giustifica:
 *
 * - i nomi delle tabelle del database `sixteen_*` (rinominarle e' una migrazione dei dati, non una sostituzione di testo);
 * - il nome del repository storico `theme_sixteen_fila5` nelle issue citate;
 * - un `@see` verso un documento che esiste solo nel repository Sixteen, o verso un documento di `docs/` che nel nome porta
 *   «sixteen» e che esiste (le story e gli ADR esistenti non si rinominano ne' si rinumerano);
 * - le poche righe che citano Sixteen come origine (`ALLOWED_FILES`).
 *
 * Nessuna sostituzione cieca: ogni eccezione ha il suo motivo qui e nell'ADR.
 *
 * @see docs/adr/0004-inventario-riferimenti-sixteen.md
 * @see docs/contracts/theme-identity.md
 */
test('nessun riferimento a Sixteen resta nel codice del tema salvo le eccezioni documentate', function (): void {
    $themeRoot = dirname(__DIR__, 2);
    $scanned = ['app', 'src', 'routes', 'config', 'resources', 'pages', 'tests', 'bootstrap'];
    $extensions = ['php', 'js', 'mjs', 'cjs', 'css', 'json', 'webmanifest', 'md', 'html', 'yml', 'yaml', 'sh', 'txt'];
    $allowedFiles = [
        // Citano Sixteen come origine delle classi, non come identita' corrente.
        'app/Actions/SpidAuthAction.php' => 'commento: l\'Action deriva da quella di Sixteen',
        'app/Actions/CieAuthAction.php' => 'commento: l\'Action deriva da quella di Sixteen',
        // Vieta gli attributi `data-<tema>`: il vecchio nome resta tra i vietati insieme a quello nuovo.
        'tests/Unit/DataAttributeParityContractTest.php' => 'regex dei nomi di tema vietati negli attributi data-*',
        // Questo file contiene il pattern da cercare.
        'tests/Unit/NoSixteenRuntimeReferencesTest.php' => 'pattern della guardia',
    ];
    $keptTokens = [
        '/\bsixteen_[a-z_]+/' => 'tabelle del database',
        '/theme_sixteen_fila5/' => 'repository storico nelle issue citate',
    ];

    $violations = [];
    foreach ($scanned as $directory) {
        $path = $themeRoot.'/'.$directory;
        if (! is_dir($path)) {
            continue;
        }

        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS));
        foreach ($files as $file) {
            if (! $file instanceof SplFileInfo || ! in_array($file->getExtension(), $extensions, true)) {
                continue;
            }

            $relative = ltrim(substr($file->getPathname(), strlen($themeRoot)), '/');
            if (array_key_exists($relative, $allowedFiles) || str_contains($relative, '/node_modules/')) {
                continue;
            }

            $lines = file($file->getPathname(), FILE_IGNORE_NEW_LINES);
            foreach ($lines === false ? [] : $lines as $index => $line) {
                $rest = preg_replace(array_keys($keptTokens), '', $line) ?? $line;
                // Un documento citato come `Themes/Sixteen/docs/<x>` e' storico solo se in Civic non esiste.
                $rest = preg_replace_callback(
                    '#Themes/Sixteen/docs/([^\s\'"`)<>,;:]*[^\s\'"`)<>,;:.])#',
                    static fn (array $match): string => is_file($themeRoot.'/docs/'.$match[1]) || is_dir($themeRoot.'/docs/'.$match[1])
                        ? $match[0]
                        : '',
                    $rest,
                ) ?? $rest;

                // Un documento di `docs/` che nel nome porta «sixteen» (story, ADR, analisi) non si rinomina: la riga che lo
                // cita resta valida finche' il file esiste. Se sparisce, il riferimento e' rotto e la guardia scatta.
                $rest = preg_replace_callback(
                    '#docs/([a-z0-9._/-]*sixteen[a-z0-9._/-]*\.md)#i',
                    static fn (array $match): string => is_file($themeRoot.'/docs/'.$match[1]) ? '' : $match[0],
                    $rest,
                ) ?? $rest;

                if (stripos($rest, 'sixteen') !== false) {
                    $violations[] = $relative.':'.($index + 1);
                }
            }
        }
    }

    sort($violations);

    expect(array_slice($violations, 0, 40))->toBe([], count($violations).' righe con riferimenti a Sixteen (prime 40 mostrate)');
})->group('CIVIC-ID-INV-1');

/**
 * L'identita' dichiarata dai file di manifest: nome del package, namespace PSR-4, provider, nome del tema e base di Vite.
 * `package.json` non e' qui: lo governa la wave Build/CI.
 *
 * @see docs/contracts/theme-identity.md
 */
test('composer, theme.json e vite dichiarano Civic e il provider esiste dove l\'autoload lo cerca', function (): void {
    $themeRoot = dirname(__DIR__, 2);

    /** @var array{name: string, autoload: array{psr-4: array<string, string>}, 'autoload-dev': array{psr-4: array<string, string>}, extra: array{laravel: array{providers: list<string>}}} $composer */
    $composer = json_decode((string) file_get_contents($themeRoot.'/composer.json'), true, flags: JSON_THROW_ON_ERROR);
    /** @var array{name: string} $theme */
    $theme = json_decode((string) file_get_contents($themeRoot.'/theme.json'), true, flags: JSON_THROW_ON_ERROR);

    expect($composer['name'])->toBe('laraxot/theme_civic_fila5')
        ->and($composer['autoload']['psr-4'])->toBe(['Themes\\Civic\\' => 'app/'])
        ->and($composer['autoload-dev']['psr-4'])->toBe(['Themes\\Civic\\Tests\\' => 'tests/'])
        ->and($composer['extra']['laravel']['providers'])->toBe(['Themes\\Civic\\Providers\\ThemeServiceProvider'])
        ->and($theme['name'])->toBe('Civic');

    $provider = (string) file_get_contents($themeRoot.'/app/Providers/ThemeServiceProvider.php');
    expect($provider)->toContain('namespace Themes\\Civic\\Providers;')
        ->and($provider)->toContain("public string \$name = 'Civic';");

    expect((string) file_get_contents($themeRoot.'/vite.config.js'))->toContain("base: '/themes/Civic/'");
})->group('CIVIC-ID-INV-5');
