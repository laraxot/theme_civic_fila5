---
title: "Identità Civic: namespace `Themes\Civic`, manifest `theme.json` e base Vite `/themes/Civic/`"
type: decision
status: accepted
created: 2026-11-26
updated: 2026-11-26
theme: Civic
issues: [1]
---

# ADR 0006 — Identità Civic: namespace, manifest e URL degli asset

## Contesto

Civic è un repo separato (`laraxot/theme_civic_fila5`) copiato da Sixteen. Senza una
identità propria, il nuovo tema continuerebbe a dichiararsi `laraxot/theme_sixteen_fila5`,
a caricare classi `Themes\Sixteen\` e a costruire asset con URL `/themes/Sixteen/`:
instestabile da Sixteen in produzione e non selezionabile come `pub_theme=Civic`
dall'host (issue #1, CIV-M1).

## Driver della decisione

- Il package Composer, l'autoload PSR-4, il provider e `theme.json` devono dire «Civic»
  perché l'host e la build registrino il tema con il nome giusto.
- La base Vite e il path `public_html/themes/` devono coincidere con il nome del tema,
  altrimenti i manifest dei bundle puntano a URL inesistenti.
- Sixteen deve restare attivo e invariato fino al cutover: nessuna modifica può
  rompere il tema corrente (convivenza, ADR 0005).

## Alternative scartate

- **Mantenere namespace `Themes\Sixteen`**: il codice non si distinguerebbe da Sixteen
  e i test di convivenza non avrebbero un segnale chiaro.
- **Rinomina globale della stringa `sixteen`**: romperebbe tabelle `sixteen_*`,
  riferimenti storici e documenti di provenienza — vedi ADR 0004.
- **Cambiare solo `theme.json`**: l'autoload e il provider continuerebbero a
  dichiarare il package vecchio; `composer validate` e l'host non sarebbero coerenti.

## Decisione

Identità dichiarata in tre punti, verificata insieme:

- **Composer**: `name: laraxot/theme_civic_fila5`, autoload `Themes\Civic\ => app/`,
  `autoload-dev` `Themes\Civic\Tests\ => tests/`, provider
  `Themes\Civic\Providers\ThemeServiceProvider`.
- **Manifest**: `theme.json` dichiara `name: Civic` (nessun alias o URL legacy).
- **Build/host**: `vite.config.js` usa `base: '/themes/Civic/'` e `outDir: ./public`;
  il deploy crea `public_html/themes/Civic` come symlink a `Themes/Civic/public`
  (stessa regola dei moduli, ADR 0001); la selezione runtime resta via `xra.pub_theme`.

Le eccezioni «sixteen» ammesse sono solo quelle classificate da ADR 0004 e presidiate
da `tests/Unit/NoSixteenRuntimeReferencesTest.php`.

## Conseguenze

- Positiva: package, classi, manifest e URL degli asset raccontano la stessa identità;
  la guardia sui riferimenti residui impedisce derive silenziose.
- Negativa/debito: ogni documente o test che cita ancora `Themes\Sixteen` va
  ricontrollato caso per caso; il cutover in produzione resta una decisione umana
  separata (ADR 0005, backlog).

## Conferma

- `composer validate` senza errori; `php artisan package:discover`/boot del provider
  nell'host Laraxot.
- `vendor/bin/pest tests/Unit/NoSixteenRuntimeReferencesTest.php` verde.
- Build Vite con manifest che punta a `/themes/Civic/`.
