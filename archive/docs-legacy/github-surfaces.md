---
title: "Civic — superfici GitHub"
type: reference
tags: [github, civic, triage, security, ci]
created: 2026-11-26
updated: 2026-11-26
qmd: "Civic GitHub issues milestones labels discussions actions security wiki projects"
issues: [37]
discussions: [38]
status: active
---

# Superfici GitHub di `theme_civic_fila5`

## Perché

Civic è un tema riusabile (Italia/Malta). Le superfici GitHub devono rendere il triage ovvio senza duplicare la documentazione viva in `docs/`.

## Mappa

| Superficie | Ruolo | Stato operativo |
| --- | --- | --- |
| [Issues](https://github.com/laraxot/theme_civic_fila5/issues) | Lavoro con criteri di accettazione | Milestone C1–C6, label area/tipo/priorità/paese/status |
| [Views / filtri](https://github.com/laraxot/theme_civic_fila5/issues/views) | Viste rapide | Link filtrati in [#37](https://github.com/laraxot/theme_civic_fila5/issues/37); viste UI salvate richiedono UI GitHub |
| [Milestones](https://github.com/laraxot/theme_civic_fila5/milestones) | Ordine di consegna | C1 migrazione → C6 rilascio |
| [Labels](https://github.com/laraxot/theme_civic_fila5/labels) | Triage | `area:*`, `tipo:*`, `priorità:P*`, `paese:*`, `status:*` |
| [Discussions](https://github.com/laraxot/theme_civic_fila5/discussions) | Domande e idee | Seed [#38](https://github.com/laraxot/theme_civic_fila5/discussions/38) [#39](https://github.com/laraxot/theme_civic_fila5/discussions/39) [#40](https://github.com/laraxot/theme_civic_fila5/discussions/40) |
| [Pull requests](https://github.com/laraxot/theme_civic_fila5/pulls) | Solo modifiche reali | Template in `.github/PULL_REQUEST_TEMPLATE.md`; niente PR decorative |
| [Actions](https://github.com/laraxot/theme_civic_fila5/actions) | CI manifest + frontend se lockfile | `.github/workflows/ci.yml` |
| [Security](https://github.com/laraxot/theme_civic_fila5/security) | Advisory + Dependabot + scanning | `SECURITY.md`, Dependabot, secret scanning |
| [Projects](https://github.com/laraxot/theme_civic_fila5/projects) | Board Kanban/tabella | Richiede scope token `project` / `read:project` |
| [Wiki](https://github.com/laraxot/theme_civic_fila5/wiki) | Note brevi | Abilitata; prima pagina Home va creata da UI (git wiki assente finché non esiste) |

## Filtri condivisibili (issue views)

Usare i label, non il titolo:

| Vista | Query |
| --- | --- |
| P0 aperti | `is:issue is:open label:priorità:P0` |
| Migrazione | `is:issue is:open label:area:migrazione` |
| Italia/Malta | `is:issue is:open label:area:i18n` |
| Accessibilità | `is:issue is:open label:area:a11y` |
| Build/CI | `is:issue is:open label:area:build` |
| Malta | `is:issue is:open label:paese:malta` |
| Bloccati | `is:issue is:open label:status:blocked` |
| Security | `is:issue is:open label:tipo:security` |

## Policy

- Branch di lavoro: `dev`.
- Documentazione canonica: `docs/` (questa pagina è solo la mappa delle superfici GitHub).
- Dominio nei moduli Laraxot; rendering nel tema.

## Collegamenti

- [Roadmap issue #37](https://github.com/laraxot/theme_civic_fila5/issues/37)
- [SECURITY.md](../SECURITY.md)
- [docs/README.md](./README.md)
