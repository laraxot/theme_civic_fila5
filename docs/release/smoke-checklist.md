---
title: "Smoke checklist post-deploy — Civic"
type: note
tags: [documentation, release, civic, smoke-test]
created: 2026-11-26
issues: [35]
---

# Smoke checklist post-deploy — Civic

Da eseguire in **staging** dopo build+deploy e in produzione come primo
controllo dopo l'attivazione. Ogni voce va timbrata con esito
(`OK` / `FAIL` + evidenza: URL, screenshot, riga di log).

## 1. Infrastruttura e asset

- [ ] `public_html/themes/Civic` è symlink → `../../laravel/Themes/Civic/public`
- [ ] `public_html/themes/Civic/manifest.json` risponde (HTTP 200)
- [ ] Un asset Vite es. `/themes/Civic/assets/<file>.css` risponde 200
      e il contenuto non è vuoto
- [ ] `php artisan about` / `optimize` completati senza errori;
      `route:trans:cache` ha prodotto le cache per lingua
      (verificare `bootstrap/cache/` host-side)
- [ ] Nessun errore nuovo in `storage/logs/laravel.log` durante la navigazione

## 2. Pagine guest

- [ ] Homepage (`/`) renderizza header, hero/slider, sezioni CMS JSON
      (`config/local/fixcity/database/content/pages/home.json` → blocchi
      `pub_theme::components.blocks.*`)
- [ ] Pagina CMS dinamica: un `[container0]/[slug0]` qualsiasi → 200
- [ ] Pagina inesistente → 404 del tema (non errore 500)
- [ ] News/Blog: `/blog` (o la route equivalente del tenant) e un articolo
- [ ] FAQ e una pagina "servizi" se presenti nel CMS del tenant

## 3. Autenticazione

- [ ] `/login` (o route auth del tema) renderizza e accetta credenziali
- [ ] `/register` se abilitato; verifica email se richiesta
- [ ] Login con provider esterno (SPID/CIE) se configurato — almeno
      la pagina di redirect non va in errore
- [ ] Logout e accesso all'area personale (`/dashboard`, `/profile`)

## 4. Flusso segnalazioni (ticket wizard)

- [ ] Wizard "crea segnalazione" si apre, step navigabili, mappa Leaflet
      renderizzata
- [ ] Tile mappa caricate **via proxy** `/api/geo/tiles/osm/{z}/{x}/{y}.png`
      (verificare nella tab Network che non ci siano chiamate dirette a
      tile.openstreetmap.org dal browser)
- [ ] Geocoding/indirizzo via `/api/geo/nominatim` (dichiarato in
      `resources/views/components/layouts/main.blade.php`)
- [ ] Invio di una segnalazione di test in staging → ticket creato,
      compare in elenco
- [ ] Dettaglio ticket e "le mie segnalazioni" per utente autenticato

## 5. Contenuti e blocchi CMS

- [ ] Header e footer JSON (`sections/header.json`, `sections/footer.json`)
      con link corretti e menu attivo evidenziato
- [ ] Search modal (`sections/search-modal.json`) si apre e cerca
- [ ] Un blocco JSON per sezione (es. `blocks/ticket-detail`, `blocks/geo/mappa-static`)
      renderizza con dati reali

## 6. Localizzazione

Lingue presenti in `lang/`: `it`, `en`, `de`, `es` (namespace `pub_theme`).
`mt` NON è ancora supportata (#8 aperta) — non testarla come esito.

- [ ] `it` — homepage, wizard, errori: testi tradotti, nessuna chiave
      `pub_theme::...` visibile grezza
- [ ] `en`, `de`, `es` — passaggio lingua e almeno homepage + login
- [ ] Data/ora e formati coerenti con la locale attiva

## 7. Accessibilità e UI (rapido)

- [ ] Navigazione da tastiera su header/menu e wizard
- [ ] Contrasto testo base leggibile; focus visibile
- [ ] Viewport 375px / 768px / 1440px senza overflow orizzontale
      (regola del progetto per i markup front-office)
- [ ] Audit formale WCAG: issue #28 — questa checklist non lo sostituisce

## 8. Monitoraggio errori

- [ ] `tail -f storage/logs/laravel.log` durante la checklist: zero nuovi
      ERROR/CRITICAL riconducibili al tema
- [ ] Eventuali errori Filament/Livewire (`livewire.class_namespace` =
      `Themes\Civic\Http\Livewire`) verificati in console browser
- [ ] Se disponibile, dashboard error tracking (Sentry) senza spike
      dopo l'attivazione
- [ ] Queue worker riavviato (`php artisan queue:restart` eseguito nel deploy)

## 9. Criterio di superamento

Tutte le voci delle sezioni 1–6 e 8 `OK`; le sezioni 7 e le voci marcate
"approfondimento" delegate alle issue dedicate (#28 a11y, #32 sicurezza,
#33 performance). Qualsiasi `FAIL` blocca il go/no-go.
