---
title: "Go/No-Go checklist — rilascio Civic"
type: note
tags: [documentation, release, civic, go-no-go]
created: 2026-11-26
issues: [35]
---

# Go/No-Go checklist — rilascio Civic

Modello da compilare e **firmare con evidenze** prima di attivare Civic.
Ogni voce richiede un riferimento concreto: issue chiusa, commit SHA,
report, URL di staging o riga di log. "Fatto" senza evidenza = `NO-GO`.

> ## ⛔ Regola bloccante
>
> **Nessuna attivazione in produzione finché le dipendenze bloccanti
> restano aperte.** Al 2026-11-26 sono aperte:
>
> - **Migrazione M1**: #1 (Composer/namespace/provider), #2 (manifest/npm/Vite),
>   #3 (integrazione host FixCity), #4 (audit riferimenti Sixteen).
>   La story [`../stories/11-open-issues-parallel-completion.story.md`](../stories/11-open-issues-parallel-completion.story.md)
>   stabilisce: *"non attivare Civic in produzione prima dei gate C1 (#3)"*.
> - **i18n Malta**: #6–#9 (profili Paese, audit traduzioni, `mt`, Local Councils).
> - **Gate qualità M3**: #28 (WCAG), #32 (sicurezza/privacy), #33 (performance/SEO).
>
> Le dipendenze dichiarate della issue #35 sono M1, M2 e gate M3:
> finché non sono verdi, il tema resta in staging.

## 1. Funzionale

| Voce | Evidenza richiesta | Esito | Riferimento |
| --- | --- | --- | --- |
| Build `npm ci && npm run build` verde e ripetibile | log CI o locale | ☐ | |
| `public/manifest.json` generato, asset serviti via symlink | `readlink public_html/themes/Civic` | ☐ | |
| Smoke checklist completa superata in staging | `docs/release/smoke-checklist.md` timbrata | ☐ | |
| Wizard segnalazioni end-to-end (creazione, dettaglio, mappa via `/api/geo`) | ticket di test in staging | ☐ | |
| Integrazione host completata (#3): PSR-4 `Themes\Civic\`, meccanismo provider, `pub_theme` attivabile | commit host + verifica `php artisan about` | ☐ | |

## 2. UX e visual parity

| Voce | Evidenza richiesta | Esito | Riferimento |
| --- | --- | --- | --- |
| Parità homepage/blocchi con Sixteen o design di riferimento | report screenshot 375/768/1440 | ☐ | |
| Header/footer/menu e stati interattivi verificati | evidenza browser | ☐ | |
| Nessun riferimento residuo a Sixteen nel runtime (`tests/Unit/NoSixteenRuntimeReferencesTest.php` verde) | output Pest | ☐ | |

## 3. Accessibilità

| Voce | Evidenza richiesta | Esito | Riferimento |
| --- | --- | --- | --- |
| Audit WCAG completato e findings critici chiusi | issue #28 + report | ☐ | |
| Navigazione tastiera, focus, contrasto su pagine chiave | checklist a11y | ☐ | |

## 4. Localizzazione

| Voce | Evidenza richiesta | Esito | Riferimento |
| --- | --- | --- | --- |
| `it`/`en`/`de`/`es` senza chiavi `pub_theme::` grezze | passaggio lingue in staging | ☐ | |
| Fallback e profili Paese/ente configurabili | issue #6, #7 | ☐ | |
| Malta: decisione esplicita — `mt` supportata (#8) oppure esplicitamente fuori scope del rilascio | issue #8/#9 o nota | ☐ | |

## 5. Sicurezza e privacy

| Voce | Evidenza richiesta | Esito | Riferimento |
| --- | --- | --- | --- |
| Audit sicurezza UI completato (XSS, escaping Blade, upload, autorizzazioni) | issue #32 + report | ☐ | |
| Cookie banner/GDPR invariato e funzionante | smoke §5–§8 | ☐ | |
| Nessun dato ente hardcoded (es. privacy block usa `config(ente.name)` + lang) | grep + commit #20 | ☐ | |

## 6. Performance e SEO tecnico

| Voce | Evidenza richiesta | Esito | Riferimento |
| --- | --- | --- | --- |
| Budget asset rispettato, nessun bundle orfano | `npm run build` + prune | ☐ | |
| Audit performance/SEO completato | issue #33 + report | ☐ | |
| Meta/title/OG e sitemap coerenti col tema attivo | verifica head | ☐ | |

## 7. Release engineering

| Voce | Evidenza richiesta | Esito | Riferimento |
| --- | --- | --- | --- |
| Versione allineata (`theme.json`, `composer.json`, tag `theme-civic-v*`) | `git tag` + diff | ☐ | |
| `CHANGELOG.md` aggiornato con la sezione di rilascio | commit | ☐ | |
| Procedura rollback provata in staging (swap `pub_theme` → Sixteen senza perdita dati) | evidenza | ☐ | |
| Monitoring errori attivo e nessun picco post-attivazione | log/Sentry | ☐ | |

## 8. Decisione

- [ ] **GO** — tutte le voci OK, firmatario: ________  data: ________
- [ ] **NO-GO** — motivi: ______________________________________
      firmatario: ________  data: ________

Anche in caso di GO parziale (es. solo `mt` rinviata), la deroga va
registrata qui con issue e motivo: ______________________________.
