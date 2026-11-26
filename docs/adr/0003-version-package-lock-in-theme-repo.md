---
title: "Versionare package-lock.json nel repository del tema"
type: decision
status: accepted
created: 2026-11-26
updated: 2026-11-26
theme: Civic
issues: [21, 5, 25]
---

# ADR 0003 — Versionare `package-lock.json` nel repository del tema

## Contesto

`theme_civic_fila5` è un repository di package autonomo. `.gitignore` escludeva `package-lock.json` con la nota «managed at monorepo root», ma il monorepo non pubblica un lock per questo package e `npm ci` in CI fallisce senza lock (#21).

## Driver della decisione

Riproducibilità di `npm ci` su clone isolato e su GitHub Actions.

## Alternative scartate

- Lock solo alla radice FixCity: non copre clone/CI del repo tema isolato.
- Solo `npm install` in CI: non riproducibile.

## Decisione

Versionare `package-lock.json` in questo repository. Rimuovere l'ignore. La CI usa `npm ci` quando il lock è presente.

## Conseguenze

- `npm ci && npm run lint && npm test` diventano la baseline (#5/#25).
- Aggiornamenti dipendenze via Dependabot su `dev`.

## Conferma

`git check-ignore -v package-lock.json` non deve più matchare; `test -f package-lock.json`; workflow `.github/workflows/ci.yml` job `frontend`.
