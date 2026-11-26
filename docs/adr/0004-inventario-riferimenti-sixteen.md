---
title: "Inventario dei riferimenti Sixteen e confini tema/moduli"
type: decision
status: accepted
created: 2026-11-26
updated: 2026-11-26
theme: Civic
issues: [4, 1]
---

# ADR 0004 — Inventario dei riferimenti Sixteen e confini tema/moduli

## Contesto

Civic nasce come copia di Sixteen. La migrazione di namespace e manifest (#1, #2) non elimina ogni occorrenza della stringa «sixteen»: tabelle DB, repository storico, documenti di provenienza. Senza un inventario classificato, ogni sostituzione testuale rischia di rompere dati o documentazione storica (#4).

## Driver della decisione

Evitare la sostituzione cieca: ogni riferimento rimanente deve avere un motivo dichiarato.

## Alternative scartate

- Sostituire globalmente `sixteen` → `civic` in tutto il repo: romperebbe tabelle `sixteen_*` e riferimenti storici legittimi.
- Nessun inventario: le eccezioni resterebbero sparse e non verificabili.

## Decisione

L'inventario completo e classificato (runtime / compatibilità / documentazione / storico) è in
[`docs/migration/sixteen-references-audit.md`](../migration/sixteen-references-audit.md).
Le eccezioni ammesse sono quelle tracciate da
[`tests/Unit/NoSixteenRuntimeReferencesTest.php`](../../tests/Unit/NoSixteenRuntimeReferencesTest.php):

- tabelle database `sixteen_*` (rinominare = migrazione dati, non testo);
- `theme_sixteen_fila5` come riferimento al repository storico nelle issue;
- `@see` verso documenti storici che portano «sixteen» nel nome e che esistono;
- commenti che citano Sixteen come origine delle classi derivate.

La logica di dominio resta nei moduli Laraxot (Xot, User, Cms, Tenant, Fixcity, Blog, Comment,
Gdpr); il tema possiede solo la presentazione.

## Conseguenze

- La guardia `NoSixteenRuntimeReferencesTest` fallisce se compare un riferimento non elencato.
- I confini tema/modulo e le dipendenze effettive sono documentati nel report di audit.

## Conferma

`vendor/bin/pest tests/Unit/NoSixteenRuntimeReferencesTest.php` verde; audit report aggiornato
ogni volta che si toccano file che citano Sixteen.
