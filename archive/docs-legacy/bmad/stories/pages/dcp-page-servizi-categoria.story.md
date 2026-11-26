---
id: dcp-page-servizi-categoria
title: "DCP page: servizi-categoria"
type: story
epic: dc-parity-v2
status: ready-for-dev
priority: P0
owner: theme:Sixteen
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "dcp page   servizi-categoria sixteen"
---

# DCP page — servizi-categoria

## Story

Come cittadino voglio consultare **servizi-categoria** su `/it/tests/servizi-categoria`, così da ricevere la stessa struttura e gerarchia visiva della reference Design Comuni.

## Acceptance Criteria

1. Esiste `tests.servizi-categoria.json` con `id`, `slug`, titolo, layout e blocchi JSON-driven.
2. La route generica `tests/[slug].blade.php` rende HTTP 200 senza una Blade page-specific.
3. Ogni regione visibile della reference è mappata a un blocco Sixteen dichiarato e risolvibile.
4. Playwright verifica 375, 768 e 1440 px: console pulita, asset presenti, nessun overflow e screenshot salvati.
5. HTML body e visual parity sono misurati con il gate comune; lo stato resta non-done finché le soglie del catalogo non sono raggiunte.

## Owned scope

- `laravel/config/local/fixcity/database/content/pages/tests.servizi-categoria.json`
- `laravel/Themes/Sixteen/resources/views/components/blocks/servizi-categoria/` oppure blocco condiviso assegnato dal catalogo
- `laravel/Themes/Sixteen/docs/bmad/evidence/servizi-categoria/`
- questo story file

## Testing strategy

Confrontare la reference `sito/servizi-categoria.html` (o `servizi/index.html` per `servizi-index`) con la route locale usando Playwright e screenshot multi-viewport. Aggiungere controllo keyboard/focus e contrasto per i controlli interattivi.

## Dependencies

Blocked by: shared header/footer/search-modal gate where the page uses those sections.
Blocks: none.

## Dev Agent Record


