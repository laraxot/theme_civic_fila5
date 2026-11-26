# Baseline riproducibile — build, lint, test (Civic)

Issue: laraxot/theme_civic_fila5#5. Verificato su `dev` dopo la consolidazione
#21/#22/#23/#24 (una sola config Vite/Tailwind/PostCSS, `package-lock.json`
versionato, script in `scripts/`).

## Ambiente verificato

| Strumento | Versione |
|---|---|
| Node.js | v26.10.0 |
| npm | 11.19.1 |
| PHP | 8.4.27 (cli, NTS) |
| Composer | lock `composer.lock` presente; `composer install` OK (146 pacchetti, orchestra/testbench v9.17.0) |

## Comandi e risultati

Eseguiti dalla radice del tema (`laravel/Themes/Civic`):

| Comando | Esito | Note |
|---|---|---|
| `npm ci` | ✅ ~25 s | 564 pacchetti; `npm audit`: 24 vulnerabilità (23 moderate, 1 high) — segnalate, non bloccanti |
| `npm run build` | ✅ ~10 s | `prepare:static-assets` → `vite build` (8.8 s) → `prune:assets` (rimossi 6 file stale) |
| `npm run lint` | ✅ exit 0 | `eslint -c eslint.config.cjs resources/js/**/*.js`, nessun warning |
| `npm test` | ✅ exit 0 | `postcss/layer-button-preflight.test.cjs` PASS + `jest --passWithNoTests` (nessun test Jest presente) |

### Build

- `vite.config.js` è l'unica configurazione Vite; `base: '/themes/Civic/'`,
  `outDir: ./public`, `manifest: manifest.json`.
- `tailwind.config.js` è l'unica configurazione Tailwind (Tailwind v4 via
  `@tailwindcss/vite`; il file JS resta per le opzioni `darkMode`/`safelist`).
- `postcss.config.js` (ESM) è l'unica configurazione PostCSS; i plugin locali
  `postcss/layer-button-preflight.cjs` e `postcss/isolate-legacy-important.cjs`
  devono esistere in `postcss/` o la build fallisce.
- Modalità `vite build --mode analyze|production|filament` usano la stessa
  configurazione (nessun branch su `mode` nel file).

### Limiti noti

- **Pest/PHPUnit non eseguibili standalone**: i test in `tests/` usano la
  sintassi Pest (`uses(TestCase::class)`) ma il tema non dichiara
  `pestphp/pest` in `require-dev` e non ha `tests/Pest.php` né `phpunit.xml`:
  girano dall'app host (`laravel/` FixCity). In CI il job `php-tests` installa
  le dipendenze Composer e salta con messaggio documentato se `vendor/bin/pest`
  non è disponibile.
- **Test browser** (`scripts/verify/*.cjs`, `*.mjs`): richiedono un'app
  raggiungibile (default `http://127.0.0.1:8000/it/...`) e Playwright/puppeteer
  con browser installati (`npx playwright install`). Non sono nella catena
  `npm test`; sono strumenti manuali di verifica visiva.
- `npm audit` segnala 24 vulnerabilità nelle dipendenze di sviluppo
  (follow-up, non blocca la baseline).

## Cosa resta intenzionalmente "Sixteen"

- Namespace PHP `Themes\Sixteen\...` e alias di vista/config `'sixteen'` in
  `app/` (compatibilità transitoria, owner: migrazione namespace).
- Identificatori runtime: `window.FilamentSixteen` (resources/js/filament-4x.js),
  `#sixteen-primary-nav` (resources/css/app.css ↔ id Blade),
  `darkModeToggle._sixteenDarkBound` (resources/js/theme/dark-mode.js) —
  rinominarli richiede un cambiamento coordinato con le view.
- Riferimenti storici in commenti/docs (`theme_sixteen_fila5#NNN`,
  "replicated from Sixteen") — tracciano la provenienza, non l'identità.
- `config/civic.php` è la nuova configurazione tenant (in lavorazione).
