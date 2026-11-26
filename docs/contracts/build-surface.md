---
title: "Contratto — build asset Civic"
type: build-contract
theme: Civic
status: accepted
created: 2026-11-23
updated: 2026-11-26
issues:
  - "https://github.com/laraxot/theme_sixteen_fila5/issues/104"
related:
  - ../adr/0001-build-assets-via-vite-and-symlink.md
---

# Build asset Civic

Contratto di **build**, non di un'Action (`type: build-contract`, nessun `action`). Descrive cosa produce `npm run build`
eseguito da `laravel/Themes/Civic`, che e' identico (script e `vite.config.js`) a quello di Sixteen. La pubblicazione non e'
promessa: vedi l'[ADR](../adr/0001-build-assets-via-vite-and-symlink.md), «Stato attuale».

## Input

- Sorgenti Vite del tema, `package.json` e `vite.config.js`.
- `npm run build` = `npm run prepare:static-assets && vite build && npm run prune:assets`.
- Rete: al primo giro, `prepare:static-assets` puo' scaricare lo sprite icone Bootstrap Italia (vedi «Effetti collaterali»).

## Output

Asset compilati in `Themes/Civic/public/` (`outDir: './public'`), manifest Vite `public/manifest.json`, e i file di
`resources/static` copiati cosi' come sono (`publicDir`). Base URL degli asset nel codice generato: `/themes/Sixteen/`
(`vite.config.js:11`), non `/themes/Civic/`.

## Invarianti

| ID | Regola | Group Pest |
|:---|:---|:---|
| CIVIC-BUILD-INV-1 | La build usa `Themes/Civic/vite.config.js` e scrive in `./public` con `emptyOutDir: false`; non esiste una seconda configurazione Vite fuori dal tema che la sostituisca. Se viene violata, due pipeline producono bundle diversi per lo stesso tema. | — (non dimostrato) |
| CIVIC-BUILD-INV-2 | `package.json` non ha uno script `copy`. | — (non dimostrato) |
| CIVIC-BUILD-INV-3 | `prune:assets` rimuove da `public/assets` solo i file `<nome>-<hash di 8 caratteri>.<estensione>` non referenziati da `public/manifest.json`; tutto il resto resta. | — (non dimostrato) |
| CIVIC-BUILD-INV-4 | La build non modifica dati applicativi, routing o contratti di dominio. | — (non dimostrato) |

Nessuna ha un test Pest nel pacchetto. INV-2 e' coperta da `Modules/Xot/tests/Unit/ThemePublicSymlinkTest.php` (test «nessun
tema conserva lo script npm copy», righe 102-112, che include Civic), ma quel test e' di Xot e non porta un group di Civic.
Verifica manuale, da `laravel/`: INV-1 `grep -n "outDir\|emptyOutDir" Themes/Civic/vite.config.js`; INV-2
`grep -c '"copy"' Themes/Civic/package.json` (0); INV-3 lettura di `resources/scripts/prune-stale-assets.mjs` (regex
`/-[A-Za-z0-9_-]{8}\.[a-z0-9]+$/`, solo `public/assets`).

## Effetti collaterali

- `prepare:static-assets` (`resources/scripts/prepare-static-assets.mjs`): se
  `resources/static/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg` manca o e' piu' corto di 1000 caratteri,
  **scarica** `https://cdn.jsdelivr.net/npm/bootstrap-italia@2.8.8/dist/svg/sprites.svg` e lo scrive li'. Oggi il file esiste,
  quindi la build non fa la chiamata.
- `vite build` scrive in `public/` senza svuotarla.
- `prune:assets` cancella file da `public/assets` (INV-3) e stampa quanti.

## Errori

- Uno sprite non scaricabile (`!response.ok`) o non valido fa fallire `prepare:static-assets` con un'eccezione, e la build si
  ferma prima di Vite.
- Un fallimento di Vite o degli script preparatori rende l'output non verificato; non si dichiara una build riuscita dal solo
  manifest gia' presente (`public/.vite/manifest.json` e `public/manifest.json` esistono gia').

## Non fa

- Non pubblica: non crea ne' copia file in `public_html` (non esiste `public_html/themes/Civic`).
- Non possiede Action di dominio, policy o dati CMS.
- Non autorizza una pagina Folio aggiuntiva come workaround di build.
- Non decide se Civic sostituisce Sixteen: finche' non c'e' quella decisione, gli URL `/themes/Sixteen/...` sono serviti da
  `Themes/Sixteen/public`.
