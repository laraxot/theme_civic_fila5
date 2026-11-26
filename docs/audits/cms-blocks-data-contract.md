---
title: Censimento blocchi CMS — dati di ente hardcoded (#20)
issue: 20
verificato: 2026-11-26 — analisi statica (`grep` + lettura file) + Pest contract test
---

# Censimento blocchi CMS: niente testi/URL di un ente nei componenti

Issue: [#20](https://github.com/laraxot/theme_civic_fila5/issues/20).
Regola: dati dal JSON CMS, default sicuri da `config()`, relazioni nulle guardate, UI ripetuta in partial condivisi.

## Metodo

`grep` su `resources/views/{components/blocks,components/sections,components/footer,sections,pages}` per:
URL esterni (`http(s)://…gov/…it/…mt`), email/tel fissi (`mailto:`, `tel:`, `@…`), nomi di enti
(`Comune`, `Palermo`, `Malta`, `Valletta`, `Roma`, `Firenze`…), dati personali finti
(`Giulia Bianchi`, codice fiscale, gmail), e `href="#"`.

## Violazioni trovate e corrette in questa passata

| File | Violazione | Correzione |
|---|---|---|
| `components/blocks/faq/default.blade.php` | 4 domande FAQ hardcoded («Come posso contattare il Comune?», orari uffici) | domande solo da `data.questions` o `config('civic.faq.questions')`; sezione non renderizzata se vuota; `aria-expanded` ora legato ad Alpine (era fisso `false` — difetto WCAG 4.1.2 corretto) |
| `components/blocks/forms/login-card.blade.php` | `tel:+390123456789` «01 2345 6789», `mailto:supporto@fixcity.gov.it`, orari fissi; `@livewire` duplicato (form di login renderizzato due volte — difetto reale) | recapiti da `GetEnteDataAction`, voci nascoste se vuote, ore da `$ente->hours`; rimosso il `@livewire` doppio |
| `components/footer-comune.blade.php` | «Comune di Nome Comune», Via Roma 123, CF/P.IVA finti, 3 telefoni, 2 email finte, social `href="#"` fissi | tutto da `GetEnteDataAction`; ogni blocco `@if` su valore non vuoto; social da `$ente->social` |
| `components/footer/institutional.blade.php` | prop default `Piazza del Municipio, 1`, `+39 0123 456789`, `protocollo@comune.example.it`, `comune.example@pec.it` | default `null` (era già `@if`-guarded) |
| `sections/footer-full.blade.php` | «Comune di Example», Via Roma 1, `+39 0123 456789`, `info@comune.example.it`, `comune@pec.it`, social `#` | `$data['contact']` > `GetEnteDataAction` > vuoto; social da JSON o `$ente->social` |
| `design-comuni/pages/homepage.blade.php` | `tel:+390512345678` «05 12345678», `urp@comune.it` | sezione contatti da `GetEnteDataAction`, intera `@if` |
| `components/blocks/flow/segnalazione/02-dati.blade.php` | autore «Giulia Bianchi», ruolo finto | default `''`, righe `@if`-guarded |
| `components/blocks/flow/segnalazione/03-riepilogo.blade.php` | indirizzo «Via Solferino – 50100 Firenze», P.IVA finti, CF `GLABNC…`, telefono, email gmail | default `''`, ogni riga `@if`-guarded |
| `components/blocks/flow/segnalazione/{01-privacy,02-dati,03-riepilogo,04-conferma}` | `tel:050505` duplicato in 4 file | estratto in `partials/contacts-card.blade.php` (partial condiviso, #20) con numero da `GetEnteDataAction` |
| `components/blocks/geo/mappa-static.blade.php` | fallback coordinate Roma `41.89/12.49` | `config('theme.features.map.default_center')`; pin ora segue davvero `latInit/lngInit` (prima era statico) |
| `components/blocks/events/index.blade.php` | Colosseo Roma, castello normanno, Gipsoteca canoviana, Tomba Brion come default parity; `array_replace_recursive` non svuotava le liste | default `[]`/vuoti; i luoghi arrivano solo da JSON/config |
| `pages/index.blade.php` | title fallback `'FixCity'` | `config('app.name')` |

## Censimento — aree verificate OK

- `components/blocks/{ticket-*,report-*,personal-area-*,accessibility-statement,legal-document,content-page,…}`: testi da `fixcity::`/`pub_theme::` lang o da `$data` CMS; `GetEnteDataAction` già usato (accessibility-statement, personal-area-settings).
- `components/sections/footer/v1.blade.php` (footer live): già data-driven da JSON + ente.
- URL esterni nei blocchi: nessuno hardcoded (proxy Geo `/api/geo/...` solo via attributi `data-geo-*` nel layout).

## Residui / non corretti

| Residuo | Perché | Azione |
|---|---|---|
| `resources/views/pages_old/`, `pages_old1/` | pagine legacy non instradate (Fuori scope CMS) | candidato a rimozione; issue da valutare |
| `resources/views/mobile/`, `home.blade.php`, `templates/`, `style.blade.php`, `terms.blade.php`, `policy.blade.php` | viste legacy/di comodo | idem |
| `footer-comune` asset `themes/Sixteen/...` | path del tema vecchio | allineare al rename Civic (con Agent A/B) |
| `flow/segnalazione/*` route `container0=tests/*` | blocchi demo delle pagine `tests.*` del JSON CMS | OK per pagine demo; se un giorno usati in produzione vanno parametrizzati |
| `lang` key `call_the_toll_free_number_05` | testo «numero 05…» nel lang (scope Agent D) | segnalare: la etichetta non deve contenere cifre |
| `href="#"` residui in footer-comune (colonne admin/servizi) e `segnalazioni/layout.blade.php` | link morti | issue correttiva #28/#20 |

## Test

`tests/Unit/CmsBlocksEntityDataContractTest.php` — 4 test, statici, **verdi** (2026-11-26,
`vendor/bin/pest Themes/Civic/tests/Unit/CmsBlocksEntityDataContractTest.php`):
nessun recapito/ente nei componenti CMS, FAQ senza default, partial condiviso + ente nei
flow, nessun dato personale finto nel riepilogo.

«Ogni blocco si rende con dati minimi»: copertura parziale — `tests/Unit/BladeTemplatesCompileTest.php`
compila tutti i template (193 dataset verdi); il render con dati minimi runtime non è
verificato senza host (documentato in `visual-regression.md`).
