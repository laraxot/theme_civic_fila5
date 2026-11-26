---
title: Piano regressione visuale (screenshot reali)
issue: 31
verificato: 2026-11-26 — piano definito; NESSUN screenshot eseguito (nessun host)
---

# Regressione visuale Civic (da Sixteen)

Issue: [#31](https://github.com/laraxot/theme_civic_fila5/issues/31).
**Stato: bloccato — nessun host in esecuzione.** Questo documento fissa il piano
baseline; nessuno screenshot è stato prodotto o dichiarato.

## Blocco

- Il tema è un package: servire le pagine richiede l'app host (`laravel/` con moduli
  Fixcity/Cms/Tenant, DB `*_test`, `public_html` con symlink tema). In questa sessione
  non c'è un server in esecuzione e i bootstrap Testbench del tema non forniscono il
  CMS/JSON dei contenuti.
- Build asset (`npm run/build`) di pertinenza Agent B: i bundle in `public/assets`
  possono essere stale.

## Piano baseline (da eseguire quando l'host c'è)

### Pagine
| # | Pagina | Come ottenerla |
|---|---|---|
| P1 | Home | `/it/` (blocchi `home.json`) |
| P2 | Elenco segnalazioni | `/it/segnalazioni` |
| P3 | Dettaglio segnalazione | `/it/segnalazione-dettaglio` o slug CMS con ticket factory |
| P4 | Wizard creazione | `/it/tickets/create` (4 step) |
| P5 | Tracking | `/it/tickets/track?code=…` con `GetPublicTicketByCodeAction` fixture |
| P6 | Area personale | login factory user → `/it/area-personale/*` |
| P7 | Errori | URL inesistente (404), `offline` |
| P8 | Modali | search modal, report modal, terms modal aperti |

### Viewport
375px (mobile), 768px (tablet), 1440px (desktop). Lingue: it + almeno en (o de/es a campione). Tenant: config `ente` demo A/B.

### Dati sintetici
Factory/seeder **non distruttivi** su DB `*_test` (mai `migrate:fresh`): ticket via
`Modules\Fixcity` factories + `config/local/fixcity/database/content/pages/*.json`
già presenti. Per il «prima»: checkout read-only del tema Sixteen equivalente (il
repo `theme_sixteen_fila5`) servito sullo stesso host.

### Cosa confrontare
- Overflow orizzontale (`document.scrollWidth > innerWidth`) a 375px.
- Hero/home: immagine, titolo, CTA (FOUC guard `#head-section` nel layout).
- Wizard: stepper, navscroll, mappa step 2, anteprime foto step 3 (esiste
  `tests/browser/wizard-step2-map-center.spec.mjs`, `wizard-summary-photo-previews.spec.mjs`).
- Elenco: card, filtri, mappa statica.
- Modali: focus trap, chiusura Esc.
- Font: Titillium Web caricato (self-hosted), niente flash.

### Differenze intentionali attese
Rename Sixteen→Civic (namespace `Themes\Civic`, path `themes/Civic`), palette
inalterata, nessun contenuto ente hardcoded (#20).

## Esecuzione

`tests/browser/*.spec.mjs` esistenti (Playwright) coprono già: a11y-axe, cookie,
header menus, search modal, ticket detail marker, tracking privacy, wizard.
Li runnerà chi ha l'host: `cd Themes/Civic && npm run test:browser` (verificare script in package.json — scope Agent B).

**Screenshot reali**: da allegare a un commento su #31 quando l'ambiente c'è.
