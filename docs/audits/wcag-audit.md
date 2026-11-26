---
title: Audit WCAG — frontend Civic
issue: 28
verificato: 2026-11-26 — analisi statica blade/CSS + test esistenti; NESSUN host/browser disponibile: nessuna conformità dichiarata
---

# Audit accessibilità WCAG (Civic frontoffice)

Issue: [#28](https://github.com/laraxot/theme_civic_fila5/issues/28).
**Stato: parziale.** Analisi statica solo-blade/CSS. Le misure runtime (axe, tastiera,
screen reader, contrasto reale, zoom 200 %) sono **unverified**: non c'è un host
Laravel+FixCity in esecuzione in questa sessione. La matrice sotto indica cosa è
coperto staticamente e cosa resta da verificare in browser.

## 1. Matrice pagine/stati

| Pagina/stato | Route/view | Guest | Auth | Note statiche |
|---|---|---|---|---|
| Home CMS | `pages/index` → blocchi home | ✅ | ✅ | header/footer data-driven |
| Elenco segnalazioni | `segnalazioni.index` → `blocks/segnalazioni/layout` | ✅ | ✅ | mappa + filtri GET |
| Dettaglio segnalazione | `segnalazione-dettaglio` → `blocks/ticket-detail/design-comuni` | ✅ | ✅ | map preview, follow, immagini |
| Wizard creazione | `tickets/create` → `blocks/report-step/*`, `flow/segnalazione/*` | ✅ | ✅ | stepper, navscroll, form |
| Tracking | `components/pages/ticket-track` | ✅ | — | form GET con codice |
| Area personale | `personal-area-*` | — | ✅ | `middleware: auth` nel JSON |
| Login/register | `pages/auth/*` | ✅ | — | Livewire |
| FAQ/legali/accessibilità | `content-page`, `legal-document`, `accessibility-statement` | ✅ | ✅ | accordion Bootstrap |
| Errori | `404.blade.php`, `offline`, `disclaimer` | ✅ | ✅ | da verificare in browser |
| Modali | `report-list/modal`, `modal-terms`, `modal-message`, `search-modal` | ✅ | ✅ | esistono spec browser keyboard |

## 2. Controlli statici eseguiti

### Corretto in questa passata
- `faq/default.blade.php`: `aria-expanded` era fisso `"false"` mentre Alpine apriva il pannello → ora `:aria-expanded` legato allo stato (**WCAG 4.1.2**, verificato staticamente).
- `login-card`: `@livewire` duplicato (login renderizzato 2 volte = lettori di schermo avrebbero annunciato due form) → rimosso (**difetto reale**).

### Esito dei grep statici
- `<img>` senza `alt`: **nessuno** nei template live (i casi trovati sono `pages_old*`/`livewire/toast` legacy o hanno `alt=""` decorativo / alt da dati). `alt=""` su `personal-area-practices/section` icon-folder = decorativo OK.
- Input senza label/`id`: nessun caso bloccante nei blocchi; `feedback/rating` input testo ha `id`+`aria-describedby`; `blog/index` search input ha `id` **e** `<label class="visually-hidden">` associata (verificato) ✅.
- Accordion: pattern corretto — `aria-expanded` gestito da Bootstrap collapse o binding Alpine (`:aria-expanded="open"` in `02-dati`, accordion content-page con commento WCAG 4.1.2).
- Skip link: presenti (`visually-hidden-focusable` in homepage/design-comuni, `components/accessibility/skiplinks`).
- `role="status"`/`aria-live`: presenti su risultati e stepper (`steppers-content aria-live="polite"`).
- Touch target: bottoni flow usano `min-h-12` (48px) ✅; da misurare i target più piccoli (icone header, social).
- Zoom 200 % / reflow: **non verificato** (serve browser).
- `prefers-reduced-motion`: supportato nei CSS (`components.css`, `app/20-dc-components.css:250`, `agid.css:225`, `components/cookiebar-tokens.css:50`) ✅ statico.
- Contrasto: `--bs-secondary #5d7083`/bianco e `--bs-primary #007a52`/bianco stimati ≥4.5:1 (calcolo statico); **focus ring `#80c8ad` ≈1.9:1 → sotto 3:1 (WCAG 1.4.11)** — finding, da confermare in browser.

## 3. Finding (graduati)

| ID | Grado | Evidenza | Stato |
|---|---|---|---|
| WCAG-01 | Alta (corretto) | `aria-expanded` statico FAQ | ✅ fixato |
| WCAG-02 | Alta (corretto) | `@livewire` duplicato login-card | ✅ fixato |
| WCAG-03 | Media | focus ring `#80c8ad` contrasto <3:1 | issue correttiva da aprire |
| WCAG-04 | — | `blog/index` search: ha label `visually-hidden` associata | ✅ verificato, non è un difetto |
| WCAG-05 | Media | `href="#"` residui (footer-comune colonne, `segnalazioni/layout` link vuoto `d-none`) | issue correttiva |
| WCAG-06 | Bassa | target touch <24px possibili su icone social/header | da misurare |
| WCAG-07 | — | axe core, tastiera full-flow, SR, zoom 200 %, 375/768/1440 | **unverified** — richiede host |
| WCAG-08 | Bassa | `pages_old*`/`mobile/` legacy con difetti noti (img senza alt, form POST senza CSRF) | non instradati; segnalare per rimozione |

## 4. Cosa manca per chiudere #28

1. Host FixCity in esecuzione (M1) + `tests/browser/a11y-axe.spec.mjs` (esiste già!) eseguito su home/elenco/dettaglio/wizard/errori.
2. Misura reale contrasto/focus per i brand Italia e Malta (dipende da #11 G1).
3. Sessione tastiera + screen reader sui flussi critici (segnnalazione, login, tracking).
4. Risultati registrati per viewport 375/768/1440, lingue it/en/de/es, tenant.

**Nessun badge di conformità dichiarato**: il tema non è certificato WCAG; quanto sopra è il punto di partenza verificato.
