---
title: "ADR del tema Civic"
type: index
tags: [adr, decisioni, civic]
created: 2026-11-18
updated: 2026-11-26
---

# ADR del tema Civic

Il **perche'** delle scelte di questo pacchetto. Civic e' uno snapshot divergente di Sixteen (stesso package
`laraxot/theme_sixteen_fila5`, stesso namespace `Themes\Sixteen\`, non e' `pub_theme`): i due ADR nascono come copia di
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

## Decisioni precedenti (formato libero, non ancora ADR)

- [front-office-audit](../bmad/decisions/front-office-audit.md)

## Stato di copertura

Misurato il 2026-11-26.

| Voce | Esito |
|:---|:---|
| ADR | 2 |
| Con le sei sezioni nel formato sopra | 2 su 2 (all'inizio mancavano `Driver` e `created`) |
| Con `## Stato attuale` | 2 su 2 |
| Con una Conferma che cita un test esistente | 2 su 2, ma in `0001` il test sul symlink **salta** per Civic |
| Con una conferma automatica completa | 0 |

Contraddizioni trovate:

- `0001`: il testo copiato da Sixteen presentava il symlink come parte del quadro; per Civic non c'e' nessun link
  (`public_html/themes/` ha solo `Sixteen`) e l'output di una build avrebbe URL `/themes/Sixteen/...`.
- `0002`: `ResolveContainer0IndexAction` e' codice morto rispetto alle shell di Civic.
- Civic non era in `docs/package-docs-inventory.md` all'inizio della passata (oggi c'e', riga 40).

## Backlog

- Decisione umana: Civic sostituisce Sixteen, resta uno snapshot di riferimento o va rimosso. Da essa dipende il link in
  `public_html/themes` e la base Vite (`0001`).
- Un test che fallisca, invece di saltare, se un tema attivo con `public/` non ha il link (`0001`).
- Decidere se cablare `ResolveContainer0IndexAction` nelle shell di Civic o toglierla (`0002`).
