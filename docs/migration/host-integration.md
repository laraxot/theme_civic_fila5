---
title: Integrazione del tema Civic nell'host FixCity
status: draft
topic: civic-migration
issues: [3]
updated: 2026-11-26
---

# Integrazione Civic nell'host FixCity

Issue: `laraxot/theme_civic_fila5#3`. Documento di ricognizione + sequenza di
cutover/rollback. **Nessuna attivazione è stata eseguita**: questo file descrive
i punti di contatto e la procedura sicura. Riferimento host:
`/mnt/nas07/var/www/_bases/base_fixcity_fila5/laravel` (letto in sola lettura).

## 1. Come l'host carica un tema (meccanismo reale, verificato)

Il tema **non è un pacchetto Composer** dell'host: `laravel/composer.json` non
richiede `laraxot/theme_*` e non ci sono `repositories` path. Il caricamento è
per convenzione di path `Themes/<Nome>`:

| Punto di contatto | File host | Comportamento |
|---|---|---|
| Selezione tema | `config/<env>/<tenant>/xra.php` → `'pub_theme' => 'Sixteen'` | `XotData::$pub_theme` (popolato da `XotConfigData`/`xra`). Tenant risolto da `Modules\Tenant\Actions\GetTenantNameAction` (dominio → `config/<path>/`). Config salvata da `Modules\Cms\Filament\Pages\Themes` via `SaveTenantConfigAction` in `xra.php`. |
| Namespace `pub_theme::` (view, lang, componenti anonimi) | `Modules/Cms/app/Providers/CmsServiceProvider.php:40-100` | se `xra.register_pub_theme`: `view.addNamespace('pub_theme', Themes/<T>/resources/views)`, `loadTranslationsFrom(Themes/<T>/lang)`, `view.paths` prepend, `livewire.view_path` e `livewire.class_namespace = Themes\<T>\Http\Livewire`, `Blade::anonymousComponentPath(..., 'pub_theme')`. |
| PSR-4 runtime | `Modules/Xot/app/Actions/Composer/RegisterRuntimePsr4NamespacesAction.php` | lista **hardcoded**: `Themes\TwentyOne`, `Themes\Sixteen`, `Themes\Two`, `Database\Seeders`. **`Themes\Civic` non c'è**: da aggiungere `Themes\Civic\` → `Themes/Civic/app` e `Themes\Civic\Tests\` → `Themes/Civic/tests`, altrimenti classi Livewire/Actions del tema non sono autoloadate. |
| Pagine Folio | `Modules/Cms/app/Providers/FolioVoltServiceProvider.php:139-160` | per ogni locale supportato monta `Themes/<pub_theme>/resources/views/pages` (quindi `Themes/Civic/resources/views/pages`). Verificato: esiste `pages/` in Civic. |
| Path filesystem | `Modules/Xot/app/Datas/XotData.php:350-376` | `getPubThemeViewPath()` → `Themes/<T>/resources/views`; `getPubThemePublicPath/Asset()` → `public/themes/<T>/…` (attenti: usano il valore **esatto** di `pub_theme`, oggi `Sixteen` maiuscolo). |
| Asset pubblici | `deploy.sh` (root repo, riga ~149-160) | symlink `public_html/themes/<Tema>` → `laravel/Themes/<Tema>/public`, cicla su `Themes/*/public`. **Controlli hardcoded su `themes/Sixteen`** (manifest.json + sprite bootstrap-italia): con `pub_theme=Civic` il symlink `themes/Civic` si crea da solo, ma i check di deploy vanno aggiornati o un deploy fallisce/falsa-sicurezza. |
| ThemeServiceProvider | `Themes/<T>/app/Providers/ThemeServiceProvider.php` + `composer.json extra.laravel.providers` | **non trovato alcun punto di registrazione nell'host**: probabilmente il provider gira solo quando il tema è installato come pacchetto Composer (altri progetti) o è legacy. Nel monorepo FixCity il tema vive di `pub_theme`/Cms. Verificare in test che il boot del provider non sia richiesto per `pub_theme::`. |
| View namespace secondari | `ThemeServiceProvider` | registra anche `civic::` (nameLower) e `pub_theme::`; `sixteen::` **non** più registrato → vedi §4. |

## 2. Tenant attivi che usano Sixteen

`grep 'pub_theme' config/**/xra.php`:

- `config/local/fixcity/xra.php:10` → `'pub_theme' => 'Sixteen'`
- `config/localhost/xra.php:10` → `'pub_theme' => 'Sixteen'`
- `config/net/futurely/xra.php:10` → `'pub_theme' => 'Sixteen'`

Altri tenant usano `One`, `DirectoryBs5`, `KlekooPub` (non toccati).

## 3. Contenuti CMS e riferimenti Sixteen nel tenant

- `config/local/fixcity/database/content/**` usa **solo** `pub_theme::components.*`
  (verificato: `home.json`, `sections/*.json` ecc.) → il cutover è trasparente
  purché Civic mantenga gli stessi path di view (`components.blocks.*`,
  `components.sections.*`, `components.pages.*`).
- Id testuali legacy (solo etichette, non risoluzione): `"id": "sixteen-header"`
  (`sections/header.json`), `"id": "sixteen-search-modal"`
  (`sections/search-modal.json`), descrizioni «del tema Sixteen» nelle pagine
  `tests/*.json`. Sono dati tenant: rinominarli è una modifica CMS, non richiesta.
- `config/local/fixcity/head.php:10` e `comments.php:157` citano Sixteen in
  commenti/story — documentazione, innocua.

## 4. Breakage noto al cutover

| Dipendenza | Dove | Effetto | Azione |
|---|---|---|---|
| `Modules/Notify/app/Actions/DetermineSeasonalContentViewPathAction.php:34` | `return 'sixteen::emails.'.$viewName` | il namespace vista `sixteen` non esiste più in Civic → le email stagionali (Natale) darebbero `View not found` | cambiare in `pub_theme::emails.` (o `civic::`) **prima** del cutover, oppure mantenere un alias `sixteen` temporaneo nel provider (da valutare: la guardia `NoSixteenRuntimeReferencesTest` lo vieta). |
| `Modules/Geo/app/Providers/GeoServiceProvider.php:71,88` | `public_path('themes/Sixteen/manifest.json')`, `asset('themes/Sixteen/'.$entry)` | bundle JS Vite del tema risolto sul nome vecchio | aggiornare a `Civic`/`civic` (attenzione: `pub_theme` produce `themes/Civic` con la C maiuscola) oppure rendere dinamico da `XotData::pub_theme`. |
| `config/nativephp.php:32-33` | `Themes/Sixteen/node_modules`, `Themes/Sixteen/resources/views/bootstrap-italia/...` | build NativePHP | aggiornare i path a `Themes/Civic`. |
| `Modules/Xot/.../RegisterRuntimePsr4NamespacesAction.php` | lista PSR-4 | `Themes\Civic\*` non autoloadato | aggiungere le due voci (vedi §1). |
| `deploy.sh:159-160` | check `themes/Sixteen/*` | deploy esige file del tema vecchio | estendere i check al tema attivo o renderli generici. |
| `testbench.yaml` (tema) | `Themes\Sixteen\Providers\ThemeServiceProvider` | test del tema rossi | correggere in `Themes\Civic\...` (segnalato all'agente migrazione). |
| Config `sixteen.*` / env `SIXTEEN_*` | tema | la config canonica è ora `civic.*` con env `CIVIC_*` | se qualche tenant ha override pubblicati (`config/themes/sixteen`, `config/local/**/sixteen.php`) vanno migrati; verificato: nessun file `sixteen.php` under `config/local|it|eu|net` nell'host attuale. |
| `Modules/Fixcity/config/database/content/sections/{header,search-modal}.json` | `"id": "sixteen-*"` | solo id leggibili da umani | opzionale, non bloccante. |

## 5. Sequenza di cutover (per tenant)

Prerequisiti (una tantum, lato host — **non fatto in questa issue**):

1. `RegisterRuntimePsr4NamespacesAction`: aggiungere `Themes\Civic\` e
   `Themes\Civic\Tests\`.
2. `Modules/Notify`: `sixteen::emails.*` → `pub_theme::emails.*`.
3. `Modules/Geo`: path `themes/Sixteen` → tema attivo.
4. `config/nativephp.php` e `deploy.sh`: path `Themes/Sixteen` → `Themes/Civic`.
5. Build asset del tema (`Themes/Civic`: `npm run build`) e verifica che
   `Themes/Civic/public/manifest.json` esista (serve al check deploy e a Vite).

Cutover per tenant (es. FixCity):

1. **Pre-check**: `php artisan config:clear && php artisan optimize:clear`;
   verificare `XotData::make()->pub_theme` risolto da `xra.php`.
2. Backup: `cp config/<tenant>/xra.php config/<tenant>/xra.php.bak-pre-civic`.
3. Modificare `config/<tenant>/xra.php`: `'pub_theme' => 'Civic'`
   (o da admin: `Modules\Cms\Filament\Pages\Themes` → salva `xra.pub_theme`).
4. `php artisan optimize:clear && php artisan config:cache` (se in uso).
5. **Smoke test** (sotto).
6. Se OK: deploy con `deploy.sh` (crea `public_html/themes/Civic` symlink,
   `filament:upgrade`, `route:trans:cache`).

Rollback:

1. Ripristinare `xra.php` (`'pub_theme' => 'Sixteen'`) dal backup.
2. `optimize:clear`/`config:cache` di nuovo.
3. Il tema `Themes/Sixteen` resta nel repository: nessun dato è stato toccato
   (i contenuti CMS usano `pub_theme::` e le tabelle `sixteen_*` non cambiano).

## 6. Smoke-test checklist

**Guest**
- [ ] Homepage `/it` renderizza (blocchi CMS `pub_theme::` risolti).
- [ ] Header/footer/menù da `config/civic.php` (`civic.menu.*`).
- [ ] Ricerca globale `/it/...` (SearchFrontOfficeAction Fixcity).
- [ ] Mappa: tile da `/api/geo/tiles/osm` (non da OSM diretto), geocoding `/api/geo/nominatim`.
- [ ] Login/registrazione page, consent cookie banner.
- [ ] `sitemap`, `robots`.

**Autenticato**
- [ ] Login con utente di test; redirect post-login (`xra.post_login_path`).
- [ ] Area personale: segnalazioni (`ticket-list`, `ticket-track`, `ticket-detail`).
- [ ] Preferenze notifiche ticket (widget Fixcity).
- [ ] SPID/CIE: solo se `civic.auth.spid.enabled` (rotta auth registrata da `routes/auth.php`).

**Amministrazione**
- [ ] Filament backoffice si apre (tema non interferisce: `register_adm_theme=false`).
- [ ] `Themes` page mostra `Civic` come tema pubblicato.
- [ ] Queue/eventi: `BuildingCivicMenu` (era `BuildingSixteenMenu`) dispatcha correttamente.
- [ ] Email stagionali Notify (`pub_theme::emails.christmas-content`).
- [ ] `route:list` senza errori; `view:cache` compila (le view `pub_theme::` esistono).

## 7. Stato

- [x] Ricognizione meccanismi (questa sezione).
- [ ] Fix host elencati in §4 (owner: lead/agenti host — **non modificato nulla fuori da `Themes/Civic`**).
- [ ] Cutover reale su un tenant di test: **non eseguito** (attende i fix §4 e l'issue #1 chiusa).
