---
title: Audit sicurezza e privacy del layer UI (Civic)
issue: 32
verificato: 2026-11-26 — analisi statica blade/config/contratti FixCity; nessun host in esecuzione
---

# Audit sicurezza e privacy del layer UI

Issue: [#32](https://github.com/laraxot/theme_civic_fila5/issues/32).
**Stato: parziale.** Verifiche statiche su escaping, CSRF, dati personali e policy
coordinate. Test dinamici cross-tenant/ruoli: **unverified** (richiedono host FixCity
con dati sintetici — vedi §5).

## 1. Escaping Blade / output non sicuro

Grep `{!! !!}` su `resources/views` (esclusi `csrf`, `vite`, `json_encode`):

| Occorrenza | Valutazione |
|---|---|
| `terms.blade.php` / `policy.blade.php` `{!! $terms !!}` `{!! $policy !!}` | si fida della sanitizzazione a monte (Markdown → HTML). La view è legacy/guest-layout; il contenuto legale reale passa da `legal-document/design-comuni` → `BuildLegalDocumentAction` che fa `Str::markdown(html_input:'strip', allow_unsafe_links:false)` — **contratto verificato** (`Modules/Fixcity/docs/contracts/build-public-ticket-detail-action.md` non lo copre, ma il codice è `Modules/Fixcity/app/Actions/BuildLegalDocumentAction.php`). Da confermare chi popola `$terms`/`$policy` in `terms.show`. |
| `legal-document/design-comuni` `{!! $html !!}` | sicuro per contratto: `html_input strip` + link non sicuri rimossi (verificato nel sorgente dell'Action). |
| `ticket-detail` `nl2br(e($detail['description']))` | sicuro (escape + solo `<br>`). |
| `data-bs-autocomplete='{!! $suggestions !!}'` (`report-step/section-place`) | `json_encode` + `htmlspecialchars(ENT_NOQUOTES)` + `'`→`&#039;` — pattern corretto per attributo single-quoted. |
| `components/data-display/*`, `ui/icon`, `media/carousel`, `templates/landing` `{!! $content !!}` | componenti generici: l'HTML è una prop del chiamante (contratto implicito «il chiamante sanitizza»). Da documentare, non un leak. |
| `footer-comune` `nl2br(e($footerEnte->address))` (nuovo, #20) | escape + `<br>` — sicuro. |
| `layout/sections/header-slim`, `footer/institutional` `{!! $social['icon'] !!}` | icon HTML passata dal chiamante (JSON CMS/config) — input fidato ma da validare upstream. |
| `components/pages/ticket-track` `{!! __() !!}` con link | lang key con `<a>` pre-costruito con `e(route())` — sicuro. |

**Nessun echo di input utente non escapato trovato nei template live.**

## 2. CSRF / form

- Tutti i form POST live contengono `@csrf` o sono Livewire (`wire:submit`): verificato su `navigation`, `logout`, `user-dropdown`, `ticket-detail` (follow), `personal-area-settings`, `upload`, `switchable-team`, `profile/*`, `templates/landing`.
- `GET` search/filters: correttamente senza CSRF (condivisibili, no side-effect).
- **Eccezione**: `resources/views/mobile/tickets/create.blade.php` — `<form method="POST" action="#">` senza `@csrf`: è un prototipo legacy non instradato (`action="#"`, nessun endpoint). **Non è un leak attivo**, ma va rimosso o marcato dead (includere nella issue legacy).

## 3. Privacy: dati personali e coordinate pubbliche

### Policy coordinate (decisa dal modulo — il tema NON la ridefinisce)

Da `Modules/Fixcity/docs/contracts/build-public-ticket-detail-action.md` e story DCP-104:
- Le coordinate pubbliche sono quelle già esposte dal GeoJSON pubblico; **decisione aperta PP-02**: indirizzo con civico e coordinate non arrotondate nella lista/dettaglio pubblici.
- Il tema (`blocks/ticket-detail`, `blocks/segnalazioni/layout`, `geo/mappa-static`) **renderizza solo ciò che le Action restituiscono**: `BuildPublicTicketDetailAction` (lat/lng/address), `BuildPublicTicketsGeoJsonResponseAction`, `ResolveTicket*MarkerPropertiesAction`. Nessun arrotondamento o filtro applicato nel blade — corretto: la policy resta del modulo.
- Foto: `ticket-detail` mostra `$detail['images']` (URL firmati via `SignTicketMediaUrlAction`/`BuildTicketPublicImageUrlsAction`); `CanViewTicketMediaAction` decide la visibilità per ruolo — il blade non espone originali non firmati. Verificato staticamente; **test cross-ruolo da eseguire su host**.

### Dati personali
- `ticket-detail` commento nel file: «mai autore o email» — il payload `BuildPublicTicketDetailAction` non li include (contratto). Codice di tracciamento solo al proprietario.
- Rimosso in #20: dati personali **finti** hardcoded (Giulia Bianchi, CF, gmail) dai blocchi flow — non erano leak reale ma sporco pericoloso.
- `livewire/toast.blade.php`: template demo contiene URL immagine esterno `cdn.devdojo.com` (caricato solo se si usa `customToastHTML`) → richiesta a terzi senza base lecitle nel frontoffice; componente probabilmente non instradato → issue.
- Geo: tile/Nominatim via proxy `/api/geo/...` (ADR 0003), attributi `data-geo-*` su `<html>` — niente chiamate browser a OSM dirette ✅.
- Font: self-hosted, niente Google Fonts ✅ (DCP-137).
- Cookie/consenso: `components/utilities/ui/cookiebar`, `NoThirdPartyBeforeConsentTest` esistente ✅.

## 4. Cross-tenant

- Contenuto ente: `GetEnteDataAction` legge `config('ente')` del tenant corrente — nessun dato ente hardcoded residuo nei componenti live (test `CmsBlocksEntityDataContractTest`).
- Asset: `footer-comune` referenzia ancora `themes/Sixteen/...` — path condiviso tra installazioni? Da verificare in deploy (se `public_html/themes/<tema>` è symlink per installazione, ok; se condiviso, un tenant può vedere asset dell'altro — **da verificare**, issue).
- `config('comune.adsense.*')` in footer-comune: adsense disabilitato di default; se abilitato serve `ca-pub-` del tenant — configurazione per-tenant, ok in linea di principio.

## 5. Non verificato (richiede host)

- Resa dati per ruoli guest/owner/follower/operator (foto, codice, email) — serve `CanViewTicketMediaAction` + dataset sintetici.
- Test cross-tenant reali (due installazioni).
- `Throttle` API pubbliche (segnalato in audit Fixcity SEC-15: nessun throttle — è lato modulo, non tema).
- `TermsOfService`/PrivacyPolicy Livewire in `Modules/User` (markdown sanitize upstream da confermare).

## 6. Issue correttive da aprire

- Focus ring contrasto (anche #28): `#80c8ad` < 3:1.
- `href="#"` morti residui (footer-comune colonne, segnalazioni/layout).
- `livewire/toast` immagine devdojo esterna + componente legacy.
- `mobile/tickets/create` form POST senza CSRF (o rimozione viste legacy `mobile/`, `pages_old*/`).
- `footer-comune` path `themes/Sixteen` e adsense config namespace `comune.*` (verifica multi-tenant).
