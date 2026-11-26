---
title: "ADR — Civic possiede la presentazione e le shell Folio sottili, non la risoluzione delle pagine"
type: decision
status: accepted
theme: Civic
created: 2026-11-23
updated: 2026-11-26
decision-makers: [team front office]
issues:
  - "https://github.com/laraxot/theme_sixteen_fila5/issues/104"
related:
  - ../contracts/folio-page-shell.md
  - ../page-directory-structure.md
  - ../folio-page-pattern.md
---

# ADR: Civic possiede presentazione e chrome; le pagine Folio sono shell lineari

L'originale parlava di «Sixteen» e della sua pagina dinamica. Per Civic il testo vale alla lettera: le shell di Civic sono
davvero lineari (vedi «Stato attuale»); quelle di Sixteen oggi non lo sono piu'.

## Contesto

Civic e' uno snapshot divergente di Sixteen (stesso package `laraxot/theme_sixteen_fila5`, stesso namespace `Themes\Sixteen\`;
dettagli nell'[ADR sulla build](0001-build-assets-via-vite-and-symlink.md)) e non e' il tema pubblico (`pub_theme` e'
`Sixteen`, `config/local/fixcity/xra.php:10`). Deve mantenere la coerenza con Design Comuni senza assorbire logica di dominio:
dati, routing e autorizzazioni stanno in CMS, User e nei moduli di dominio (`AGENTS.md`: il tema documenta presentazione e
confini).

## Driver della decisione

- Mantenere coerenza con Design Comuni e confini di ownership tra tema e moduli.
- Rendere sostituibile il tema: una pagina del tema non deve contenere regole che il prossimo tema dovrebbe riscrivere.
- Una pagina speciale (ticket, profilo, blog, eventi) si risolve con un blocco JSON CMS, un'Action o la rotta del modulo
  owner, mai con codice nella Blade.

## Alternative scartate

- **Implementare ruoli e query sensibili nelle Blade.** Le policy vivono nei moduli owner.
- **Creare pagine semantiche duplicate fuori dalla struttura Folio prevista.** Una cartella Folio in piu' oscura il contenuto
  CMS (caso reale: `pages/profile/edit.blade.php`, creato piu' volte).
- **Usare `render()`, query CMS, `@php` o `@include` condizionali nelle shell Folio per correggere una pagina speciale.**
  Sposta nel tema una responsabilita' che e' del proprietario del dato.

## Decisione

Civic possiede shell, navigazione, accessibilita' e viste dei blocchi. Le pagine Folio `[container0]`,
`[container0]/[slug0]`, `[container0]/[slug0]/[container1]` e `[container0]/[slug0]/[container1]/[slug1]` sono shell Volt
lineari: ricevono i parametri in `mount()`, costruiscono il data bag e delegano a `<x-page>`; `PageSlugMiddleware` e il CMS
risolvono la pagina. Non eseguono query, resolver, redirect, metadata o rami speciali nella Blade.

Per l'editorial Design Comuni il tema tiene una sola implementazione riusabile per ogni pattern visuale: i blocchi ricevono
dati dal CMS o da un contratto di presentazione; etichette, URL e stati specifici restano nei dati. Non si duplicano viste
equivalenti per ottenere una parita' apparente. La parita' con Design Comuni vale per pagine e stati presenti nel repository;
non introduce screenshot, fixture o pagine locali non tracciati.

## Conseguenze

- Il tema resta sostituibile; ogni modifica rispetta middleware di pagina, contenuti CMS e policy owner.
- Le funzionalita' speciali si esprimono come blocchi JSON CMS, Action o rotte del modulo owner. Una shell piu' corta non
  autorizza a perdere un comportamento: prima si trasferisce la responsabilita' al proprietario, poi si toglie la duplicazione.
- Per i dettagli dinamici il tema riceve dal data bag l'identificativo applicativo e rende il blocco generico; non lo
  interpreta come slug CMS e non decide la visibilita' del record (lo fa l'Action del modulo owner).
- Il costo e' reale: nelle shell di Civic nessun alias di container, nessun redirect dell'area personale e nessun 404 da
  «pagina CMS mancante» e' cablato (vedi «Stato attuale»).

## Stato attuale

Il codice di Civic rispetta l'ADR, e la sua forma e' misurabile:

- Le quattro shell hanno 43, 50, 53 e 60 righe, zero `@php`, e usano `name()`, `middleware(PageSlugMiddleware::class)`,
  `mount()` con i soli parametri e `<x-page side="content" :slug=... :data=...>`
  (`resources/views/pages/[container0]/index.blade.php`, `.../[slug0]/index.blade.php`, `.../[container1]/index.blade.php`,
  `.../[container1]/[slug1]/index.blade.php`).
- `app/Actions/Folio/ResolveContainer0IndexAction.php` esiste (alias Design Comuni, area personale, 404) ma **nessuna shell la
  chiama**: l'unico riferimento fuori da `docs/` e' un test che afferma che la shell non la usa
  (`tests/Unit/FolioPageMountContractTest.php:148`). In Sixteen la stessa Action e' cablata nella shell.
- Il resto delle responsabilita' (404, redirect, titolo della pagina) e' lasciato a `PageSlugMiddleware` e a `<x-page>`: non ho
  verificato qui cosa fanno quando manca la pagina CMS.
- Sixteen non segue piu' questo ADR alla lettera: la sua shell `container0.view` ha rami speciali nella Blade (vedi il
  [contratto di Sixteen](../../../Sixteen/docs/contracts/folio-page-shell.md), «Limiti noti»). Chi porta una modifica da un
  tema all'altro deve sapere quale dei due testi sta copiando.

## Conferma

Conferma automatica, senza app, in `Themes/Civic/tests/Unit/FolioPageMountContractTest.php` (group
`CIVIC-FOLIO-INV-1..6`, vedi il [contratto](../contracts/folio-page-shell.md)) e in
`tests/Unit/NoSemanticFolioPageDirectoriesTest.php` (group `CIVIC-FOLIO-INV-5`). Comando, dalla radice `laravel/`:

```bash
vendor/bin/pest Themes/Civic/tests/Unit/FolioPageMountContractTest.php Themes/Civic/tests/Unit/NoSemanticFolioPageDirectoriesTest.php
# oppure per invariante:  vendor/bin/pest --group=CIVIC-FOLIO-INV-3
```

Non eseguito in questa passata. I test non coprono la regola «i blocchi sono guidati dai dati e non duplicati»
(`CIVIC-FOLIO-INV-7`): resta una regola di revisione, vedi `AGENTS.md` («Standing rule: every `components/blocks/*` view»).
