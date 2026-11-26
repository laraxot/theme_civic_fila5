---
title: "Civic — completamento parallelo issue aperte"
status: in-progress
owner: Themes/Civic
issues: [5, 1, 36, 35, 34, 37, 6, 33, 7, 27, 25, 32, 21, 9, 26, 20, 22, 4, 31, 8, 29, 17, 11, 3, 30, 28, 2, 23, 24]
random_order: [5, 1, 36, 35, 34, 37, 6, 33, 7, 27, 25, 32, 21, 9, 26, 20, 22, 4, 31, 8, 29, 17, 11, 3, 30, 28, 2, 23, 24]
created: 2026-11-26
updated: 2026-11-26
---

# Story: completamento parallelo issue aperte

## Perché

L'utente ha chiesto di completare tutte le issue aperte di `theme_civic_fila5` in ordine random, in parallelo, con BMAD + ECC + Second Brain. Civic resta tema di presentazione; FixCity è un prodotto che lo usa. Dominio nei moduli.

## Waves (un writer per file)

| Wave | Issue | Scope file |
| --- | --- | --- |
| Build/CI | #5 #21 #22 #23 #24 #25 | `package*`, `postcss*`, `vite*`, `tailwind*`, `.github/`, script root |
| Docs | #26 #27 #29 #30 #36 | `docs/**` (niente codice runtime) |
| Migrazione C1 | #1 #2 #4 (+ nota #3) | `composer.json`, `theme.json`, PHP/Blade namespace, Vite base |
| i18n | #7 #8 #17 #9 | `lang/**`, config terminologia |
| Design/a11y | #11 #20 #28 #31 #32 #33 #34 #35 | componenti, audit, release docs |

## Gate

- Chiudere issue solo con evidenza ripetibile (commit SHA, test, commento).
- `#6` resta `status:blocked` finché non c'è decisione umana sui profili Paese.
- `#37` resta aperta come indice vivo, aggiornata.
- Nessun branch nuovo; lavoro su `dev`.
- Host FixCity: non attivare Civic in produzione prima dei gate C1 (#3).

## Progresso

_Aggiornato dagli agenti swarm._
- Lead: #20 privacy block — rimosso hardcoded «Comune di Firenze»; usa `config(ente.name)` + lang it/en/de/es.


## Riconciliazione con il registro dei claim (sessione zorin, 15:15)

La stessa richiesta è arrivata a due sessioni: `roadmap-execution-c1-c5-parallel-claims.story.md` (già committata, `0581b1c`)
descrive lo stesso lavoro. Per non scrivere due volte negli stessi file la divisione vale così, finché una delle due non la
corregge **qui dentro** (non cancellando):

| Wave di questa story | Chi la esegue | Stato |
| --- | --- | --- |
| Migrazione C1 (#1 #2 #3 #4) | agente A del registro | **già in corso: non rilanciare** |
| i18n (#6 #7 #8 #9 #17) | agente B del registro | **già in corso: non rilanciare** |
| Docs (#26 #27 #29 #30 e la parte `docs/` di #36) | agente C del registro | **già in corso: non rilanciare** |
| Build/CI (#5 #21 #22 #23 #24 #25) | questa story | libera. `#22` e `#23` passano qui da P1 |
| Design/a11y/release (#11 #20 #28 #31 #32 #33 #34 #35) | questa story, **dopo** il via di A | A riscrive `app/**`, `tests/**` e `resources/**` per il nuovo namespace in un solo passaggio: scrivere lì prima significa perdere il lavoro. Il via è nella tabella «Evidenze» del registro |

Il registro ha anche le regole di commit: percorsi espliciti (`git commit -- <percorsi>`), niente `git add -A`, ogni commit cita
`#N`, prima di un push `git fetch laraxot dev && git merge --ff-only laraxot/dev` e in caso di non fast-forward si fonde, mai `--force`.
Nota su `#21`: `package-lock.json` è ignorato di proposito dal `.gitignore` («managed at monorepo root»): è una decisione, non
solo un debito, e va presa con evidenza prima di forzare un lockfile.
