---
title: "Contratto — Civic Folio page shell"
type: presentation-contract
theme: Civic
status: accepted
contract: Themes\\Civic\\resources\\views\\pages
tags: [contract, folio, shell, theme]
created: 2026-11-23
updated: 2026-11-26
issues:
  - "https://github.com/laraxot/theme_sixteen_fila5/issues/104"
related:
  - ../adr/0002-front-office-theme-owns-presentation.md
  - ../page-directory-structure.md
  - ../folio-page-pattern.md
  - ../../../Sixteen/docs/contracts/folio-page-shell.md
---

# Civic Folio page shell

Contratto di **presentazione**, non di un'Action (nessuna classe PHP da collegare con `@contract`): promette la forma delle
pagine Folio dinamiche di `Themes/Civic/resources/views/pages`. Le shell di Civic sono quelle sottili descritte dall'
[ADR](../adr/0002-front-office-theme-owns-presentation.md); quelle di Sixteen oggi sono piu' ricche
([contratto di Sixteen](../../../Sixteen/docs/contracts/folio-page-shell.md)).

## Input

- Parametri Folio ricevuti da `mount()`: `container0`, `slug0`, `container1`, `slug1` (quarto livello
  `[container0]/[slug0]/[container1]/[slug1]`); `token` per `[container1]/[token].blade.php`.
- `PageSlugMiddleware` (`Modules\Cms\Http\Middleware`) dichiarato con `middleware()` nelle shell CMS.
- Data bag opaco passato a `<x-page>`.

## Output

Una pagina Volt che monta `<x-layouts.app>` e, dentro `@volt('<nome>')`, un
`<div class="page-content content" data-dc data-slug=... data-side="content">` con `<x-page side="content" :slug="$this->pageSlug"
:data="$this->data" />`. Nomi Volt: `container0.index`, `container0.view`, `container1.index`, `container1.view`,
`container1.token`, `tests.view`.

## Invarianti

| ID | Regola | Group Pest |
|:---|:---|:---|
| CIVIC-FOLIO-INV-1 | `name()` e `@volt('<nome>')` sono letterali e coerenti; mai `@volt($variabile)` ne' `@volt('folio.…')`. Se viene violata, Livewire monta il frammento sbagliato o due pagine condividono il componente (nome Volt doppio). | `CIVIC-FOLIO-INV-1` |
| CIVIC-FOLIO-INV-2 | Il quarto livello usa `container1.view` e porta `slug1` nel data bag (con `container0`, `slug0`, `container1`). Prova parziale: il test verifica `'slug1' => $slug1`, non gli altri tre segmenti. | `CIVIC-FOLIO-INV-2` (prova parziale) |
| CIVIC-FOLIO-INV-3 | `mount()` riceve i parametri di rotta (mai `request()->route('container0')`) e, con la Blade delle shell, non esegue query, redirect, metadata, `@php`, `@include` condizionali ne' logica di dominio: niente `ResolvePageAction`, `Page::findUniqueBySlug`, `render(`, `RedirectResponse`, `specialPage`, `x-dynamic-component`. Vale per `container0.index`, `container0.view`, `container1.index` e il quarto livello; i test cercano queste stringhe, non ogni forma di logica. | `CIVIC-FOLIO-INV-3` |
| CIVIC-FOLIO-INV-4 | La risoluzione della pagina e la protezione appartengono a Cms e al middleware: le shell `container0.index`, `container0.view` e `container1.index` dichiarano `PageSlugMiddleware`. Prova parziale: non il quarto livello ne' `[token].blade.php`. | `CIVIC-FOLIO-INV-4` (prova parziale) |
| CIVIC-FOLIO-INV-5 | `resources/views/pages` ha come sole cartelle `[container0]`, `auth` e `tests` e come solo file `index.blade.php`; non esistono `domande-frequenti*` ne' `profile*`. Se viene violata, una cartella o un file Folio oscura il contenuto CMS o crea un alias morto che copre un 404 di un modulo. | `CIVIC-FOLIO-INV-5` |
| CIVIC-FOLIO-INV-6 | Le shell dinamiche montano `<x-layouts.app>` e non esiste `components/layouts/design-comuni.blade.php`. | `CIVIC-FOLIO-INV-6` |
| CIVIC-FOLIO-INV-7 | I blocchi editoriali e del wizard sono guidati dai dati: testo, URL, stato e configurazione arrivano dal CMS o da un payload dichiarato, e la stessa vista non si copia per pagine equivalenti. | — (non dimostrato) |

INV-1…INV-6 sono controlli sul sorgente, senza app: `tests/Unit/FolioPageMountContractTest.php` e
`tests/Unit/NoSemanticFolioPageDirectoriesTest.php`. Non eseguiti in questa passata. INV-7 e' una regola di revisione
(`AGENTS.md`), non un test.

## Effetti collaterali

- Applica `PageSlugMiddleware` dichiarato dalla pagina.
- `mount()` imposta `container0`, `slug0`, `container1`, `slug1`, `pageSlug` e `data`; nessuna scrittura, nessuna query.
- `pageSlug` e' `<container0>.index` per `container0.index` e `<container0>.view` per le altre tre shell CMS.
- Renderizza i blocchi CMS nel layout `layouts.app`.

## Errori

- Pagine o record non risolti vengono gestiti dal middleware, da Cms o dalle Action dei moduli owner; la shell non converte
  eccezioni di dominio in fallback visuali.

## Non fa

- Non contiene `render()` dinamico, ne' interroga `Page` o modelli di dominio.
- Non reindirizza gli alias di container ne' l'area personale: `app/Actions/Folio/ResolveContainer0IndexAction.php` esiste ma
  nessuna shell la usa.
- Non crea pagine semantiche parallele per ticket, profili, blog o eventi.
- Non incorpora testo editoriale, URL di pagina o stato del wizard nella vista condivisa quando possono appartenere al
  payload CMS.
- La parita' con Design Comuni e' una proprieta' verificabile del codice e dei dati presenti; non giustifica screenshot,
  pagine o fixture non tracciati.

## Limiti noti

- Limite noto: `ResolveContainer0IndexAction` e `tests/Unit/ResolveContainer0IndexActionTest.php` sono codice morto rispetto
  alle shell (`tests/Unit/FolioPageMountContractTest.php:148` afferma che la shell non la usa). Alias Design Comuni, redirect
  dell'area personale e 404 per shell senza pagina CMS dipendono interamente da `PageSlugMiddleware` e `<x-page>`; non ho
  verificato il loro comportamento.
- Limite noto: `[token].blade.php` (`container1.token`) non e' nell'elenco di INV-2 del primo test, e il quarto livello non e'
  nel test sul middleware (INV-4).
- Limite noto: `[slug1]` e `[container1]/index` impostano `pageSlug = $container0.'.view'` e passano `slug` = ultimo segmento;
  la risoluzione di quali segmenti il CMS usi e' di `PageSlugMiddleware`, non verificata qui.
