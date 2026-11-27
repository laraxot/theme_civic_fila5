---
title: "ADR del tema Civic"
type: index
tags: [adr, decisioni, civic]
created: 2026-11-18
updated: 2026-11-26
---

# ADR del tema Civic

Il **perche'** delle scelte di questo pacchetto. Civic nasce come snapshot di Sixteen e dal 2026-11-26 ha identita' propria
(package `laraxot/theme_civic_fila5`, namespace `Themes\Civic\`; ADR 0004, 0006 e 0007): i primi due ADR nascono come copia di
quelli di Sixteen e qui sono stati riscritti su cio' che Civic fa davvero. Gli ADR di Sixteen
([indice](../../../Sixteen/docs/adr/README.md)) restano la fonte per `data-*`, parita' HTML e identita' digitale.

## Formato

Un file per decisione, nome `NNNN-argomento.md` (numero progressivo a quattro cifre, richiesto da
`Modules/Xot/tests/Unit/Docs/AdrFilenamesAreNumberedTest.php`; la data sta nel frontmatter, mai nel nome). Il modello e'
`0000-template.md`. Frontmatter: `title`, `type: decision`, `status` (`accepted` | `superseded` | `deprecated`, con
`superseded_by` se sostituito), `created`, `updated`, `theme`, `decision-makers`. Sei sezioni `##`, in quest'ordine:

```markdown
## Contesto                 fatti e vincoli, con file e riga
## Driver della decisione   le forze che pesano sulla scelta
## Alternative scartate     ogni alternativa seria, col motivo
## Decisione                cosa si fa e dove sta nel codice
## Conseguenze              pro, contro, debito
## Conferma                 un test esistente, un comando da `laravel/` o una regola di revisione
```

Se il codice contraddice l'ADR si aggiunge `## Stato attuale` con le prove (file e riga). Se la **Conferma** non e'
automatica si scrive «Nessuna conferma automatica oggi; proposta: ...»: non si cita mai un test che non esiste.

## Decisioni

- [Build asset con Vite, senza copie; pubblicazione non decisa](0001-build-assets-via-vite-and-symlink.md) — `npm run build` da `Themes/Civic`; nessun link `public_html/themes/Civic`; `vite.config.js:11` ha base `/themes/Sixteen/`.
- [Presentazione e shell Folio sottili](0002-front-office-theme-owns-presentation.md) — le quattro shell di Civic sono lineari, a differenza di quelle di Sixteen.
- [Versionare package-lock.json nel repo tema](0003-version-package-lock-in-theme-repo.md) — `npm ci` riproducibile (#21).
- [Inventario dei riferimenti Sixteen e confini tema/moduli](0004-inventario-riferimenti-sixteen.md) — eccezioni tracciate da `NoSixteenRuntimeReferencesTest` (#4, #1).
- [Attivazione di Civic e convivenza con Sixteen](0005-attivazione-civic-e-convivenza-con-sixteen.md) — selezione runtime via `xra.pub_theme`, rollback reversibile (#3, #1, #2).
- [Identità Civic: namespace, manifest e URL degli asset](0006-identita-civic-namespace-manifest-e-url-degli-asset.md) — `Themes\Civic`, `theme.json` name Civic, base Vite `/themes/Civic/` (#1).
- [Rinomina di variabili d'ambiente, rotte e config; correzione del provider](0007-rinomina-env-rotte-e-provider-del-tema.md) — `SIXTEEN_*` -> `CIVIC_*` senza ripiego, `civic/auth`, `register()` senza `parent::register()` (#1, #2, #3, #4).
- [Catalogo maltese `mt`: bozza con marcatore di revisione](0010-catalogo-maltese-bozza-e-revisione.md) — `lang/mt` esiste ma non e' una traduzione dichiarata (#8).
- [Profili Paese/ente e terminologia istituzionale](0011-profili-paese-ente-e-terminologia.md) — `lang/<locale>/entity.php`, 13 termini per profilo (#6).
- [Formati per Paese](0012-formati-per-paese.md) — date/numeri/indirizzi via PHP Intl e config per Paese (#9, #17).
- [Parita' dei cataloghi e fallback di localizzazione](0013-fallback-di-localizzazione-e-parita-dei-cataloghi.md) — parita' misurata sull'unione delle chiavi (#7).

## Decisioni precedenti (formato libero, non ancora ADR)

- [front-office-audit](../../archive/docs-legacy/bmad/decisions/front-office-audit.md)

## Stato di copertura

Misurato il 2026-11-26.

| Voce | Esito |
|:---|:---|
| ADR | 10 (0001-0006, 0010-0013; `index.md` operativo e' stato fuso in questo README il 2026-11-26) |
| Con le sei sezioni nel formato sopra | 2 su 2 (all'inizio mancavano `Driver` e `created`) |
| Con `## Stato attuale` | 2 su 2 |
| Con una Conferma che cita un test esistente | 2 su 2, ma in `0001` il test sul symlink **salta** per Civic |
| Con una conferma automatica completa | 0 |

Contraddizioni trovate:

- `0001`: il testo copiato da Sixteen presentava il symlink come parte del quadro; per Civic non c'e' nessun link
  (`public_html/themes/` ha solo `Sixteen`); dal 2026-11-26 la base della build e' `/themes/Civic/` e `deploy.sh` crea il link da solo.
- `0002`: `ResolveContainer0IndexAction` e' codice morto rispetto alle shell di Civic.
- Civic non era in `docs/package-docs-inventory.md` all'inizio della passata (oggi c'e', riga 40).

## Backlog

- Decisione umana: Civic sostituisce Sixteen, resta uno snapshot di riferimento o va rimosso. Da essa dipende il link in
  `public_html/themes` e la base Vite (`0001`).
- Un test che fallisca, invece di saltare, se un tema attivo con `public/` non ha il link (`0001`).
- Decidere se cablare `ResolveContainer0IndexAction` nelle shell di Civic o toglierla (`0002`).

## Harness minimo: ownership, evidenza e recupero (2026-11-27)

Questo indice appartiene a **theme_civic_fila5**: ogni decisione su codice, dominio o tema va nell'ADR del package owner; il root registra soltanto i vincoli di composizione. Un ADR richiede una scelta reale con alternative e conseguenze, più una **Conferma** ripetibile (oppure la dichiarazione esplicita che manca). Non creare ADR fittizi per riempire un indice.

- [Confine LaravelDay/harness Xot](https://github.com/laraxot/module_xot_fila5/blob/dev/docs/adr/0042-laravel-day-harness-adoption-boundary.md); [ownership root](https://github.com/laraxot/base_ptvx_fila5/blob/dev/docs/adr/0001-harness-minimo-e-ownership.md).
- **BMAD**: la story owner-local conserva `scope`, `must_not_change`, `evidence`, `approval_required` nei cambi rischiosi.
- **ECC**: nessun marker di merge; distinguere la prova eseguita dal semplice riferimento a un test; se la conferma non è disponibile segnare `non eseguita`.
- **Second Brain**: QMD/Graphify e `.harness/memory/{facts,lessons}.md` sono puntatori a evidenza datata, non copie degli ADR. [Runbook](https://github.com/laraxot/base_ptvx_fila5/blob/dev/docs/harness/README.md) · [Rollout #15](https://github.com/laraxot/base_ptvx_fila5/issues/15).
