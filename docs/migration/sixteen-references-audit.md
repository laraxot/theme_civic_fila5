---
title: Audit dei riferimenti Sixteen e confini tema/moduli
status: draft
topic: civic-migration
issues: [1, 4]
updated: 2026-11-26
---

# Audit dei riferimenti «Sixteen» — tema Civic

Issue: `laraxot/theme_civic_fila5#4` (e `#1` per la parte runtime).

Scopo: inventario verificato di ciò che cita ancora `Sixteen`/`sixteen` nel repository
dopo la migrazione di namespace e manifest, con classificazione di ogni eccezione
e mappa dei confini tema ↔ moduli. Nessuna sostituzione cieca: ogni eccezione ha un
motivo.

## 1. Stato della migrazione PHP (issue #1)

Verificato il 2026-11-26:

- `composer.json`: `name = laraxot/theme_civic_fila5`, autoload e autoload-dev
  `Themes\Civic\`, provider `Themes\Civic\Providers\ThemeServiceProvider`. `composer validate` OK.
- Nessun file `*.php` contiene più `Themes\Sixteen` o `Themes/Sixteen`
  (ricerca `grep -rn "Themes.Sixteen" --include='*.php'`, esclusi `vendor/` e `node_modules/`).
- Classi rinominate: `SixteenInstallCommand` → `CivicInstallCommand`,
  `SixteenPublishCommand` → `CivicPublishCommand`, `SixteenComposer` → `CivicComposer`,
  `BuildingSixteenMenu` → `BuildingCivicMenu` (in `app/` e in `src/`),
  `SixteenEnumLabelsTest` → `CivicEnumLabelsTest`.
- `ThemeServiceProvider`: `name = 'Civic'`, `nameLower = 'civic'`; namespace viste
  canonici `pub_theme` (contratto CMS) + `civic` (nameLower); vista/traduzioni
  `sixteen` **non più registrate**; config `civic.php` sotto chiave `civic.*`;
  alias container `civic.menu`, `civic.theme`, `civic.spid`, `civic.cie`,
  tag `civic.menu.filters`; publish tag `civic-assets|civic-config|civic-views`
  verso `public/themes/civic`, `config/themes/civic`, `views/themes/civic`.
- File PHP rimasti con la stringa `sixteen`: solo eccezioni giustificate (sezione 2).

## 2. Eccezioni `sixteen` nel codice PHP (tutte giustificate)

| File | Occorrenza | Classificazione | Motivo |
|---|---|---|---|
| `app/Models/*.php`, `app/Models/Municipal/*.php` (10 file) | `protected $table = 'sixteen_*'`, tabelle pivota `sixteen_person_unit`, `sixteen_unit_locations`, `sixteen_service_locations`, `sixteen_event_participants`, `sixteen_document_people`, `sixteen_news_people`, `sixteen_news_services`, `sixteen_news_events` | **Dato legacy — eccezione bloccante** | Rinominare le tabelle è una migrazione dati (schema + contenuto tenant), non una sostituzione di testo. La guardia `tests/Unit/NoSixteenRuntimeReferencesTest.php` le mantiene bianche con la regex `\bsixteen_[a-z_]+`. Decisione: restano `sixteen_*` finché non esiste una migration di rename pianificata. |
| `app/Enums/AppointmentStatusEnum.php:13` | docblock `sixteen_appointments.status` | eccezione (token `sixteen_*`) | cita la tabella reale. |
| `app/Actions/SpidAuthAction.php`, `app/Actions/CieAuthAction.php` | commento «stesso FQCN di Sixteen» | compatibilità documentata | in `allowedFiles` della guardia: citano Sixteen come origine, non come identità corrente. |
| `app/Providers/ThemeServiceProvider.php:37,87` | `@see docs/adr/0005-attivazione-civic-e-convivenza-con-sixteen.md` | riferimento in avanti | l'ADR 0005 (convivenza Civic/Sixteen) è in scrittura da un altro agente; il file docs non esiste ancora in `docs/adr/`. Attenzione: la guardia scansiona `app/` e **non** copre questo pattern: servirà o l'ADR rinominato senza `sixteen` nel nome, o l'aggiunta del file a `allowedFiles`. Da risolvere dal lead. |
| `tests/Support/civic-autoload.php:13`, `tests/Unit/ThemeServiceProviderBootTest.php:19` | stesso `@see` 0005 | come sopra | idem. |
| `tests/Unit/NoSixteenRuntimeReferencesTest.php` | pattern della guardia stessa | strumento | in `allowedFiles`. |
| `tests/Unit/DataAttributeParityContractTest.php` | regex dei nomi di tema vietati | strumento | in `allowedFiles`: `sixteen` resta fra i nomi banditi per attributi `data-*`. |
| `tests/Feature/NoThirdPartyBeforeConsentTest.php`, `tests/Unit/PhpSourcesCompileTest.php`, `resources/views/components/pages/ticket-track.blade.php`, `resources/css/app/*.css` | `theme_sixteen_fila5#NNN`, `module_fixcity_fila5#NNN` | storico | citano issue del repository storico `theme_sixteen_fila5`: token mantenuto bianco dalla guardia. |

## 3. Riferimenti `Sixteen` fuori da PHP (non di competenza dell'agente migrazione)

| Percorso | Tipo | Note per il lead |
|---|---|---|
| `testbench.yaml:2` | **runtime (Testbench)** | `providers: Themes\Sixteen\Providers\ThemeServiceProvider` — classe inesistente dopo la migrazione: i test Testbench falliranno. Da correggere in `Themes\Civic\...` (non era nel file scope dell'agente migrazione). |
| `.releaserc.json:3` | release | `tagFormat: "theme-sixteen-v${version}"` — i tag di release continuerebbero col vecchio nome. |
| `index.html` | demo statica | titolo e path `/themes/Sixteen/...`. |
| `assets/css/comune-custom.css`, `assets/js/comune-functions.js` | sorgenti legacy `assets/` | commento «Tema Sixteen»; `comune-functions.js:136` chiama `tile.openstreetmap.org` **direttamente**, fuori dal proxy Geo `/api/geo/...` (vedi §5). |
| `resources/css/app/10-header-navigation-contracts.css`, `21-ticket-track.css` | CSS | solo commenti con issue `theme_sixteen_fila5#...` (token bianco). |
| `resources/views/components/pages/ticket-track.blade.php:42` | Blade | commento con `theme_sixteen_fila5#117` (token bianco). |
| `public/assets/app2.js`, `theme-map-*.js`, `fonts-manifest.json` | artefatti build | rigenerati da `npm run build`; non modificare a mano. |
| `lang/de/auth.php`, `lang/es/auth.php` | lang | commento `Caller: Themes/Sixteen/resources/views/...` — owner: agente i18n; `lang/` non è fra le directory scansionate dalla guardia. |
| `scripts/verify/*.cjs`, `scripts/regenerate-design-comuni-css.sh`, `build-advanced.sh` | script | owner: agente build/CI. |
| `docs/**` (~300 file), `CHANGELOG.md`, `README*.md`, `COMPILE-STATUS.md`, `CONTRIBUTING.md`, `.github/**`, `.supermemory/` | documentazione/storico | citazioni legittime del passato; da non toccare. |

## 4. Integrazioni tema ↔ moduli (dipendenze reali)

### 4.1 PHP runtime (`app/`, `src/`)

| Modulo | Uso | Note |
|---|---|---|
| `Modules\Xot` | `XotBaseThemeServiceProvider` (base del provider), `RegisterBladeComponentsAction`, `SafeStringCastAction`, `UserContract`, `XotData` | dipendenza dura: senza Xot il tema non bootstrappa. |
| `Modules\User` | `GetPostLoginUrlAction`, `UpsertUserFromDigitalIdentityAction` (SPID/CIE), `Models\User` negli eventi | auth del fronte. |
| `Modules\Cms` | `BlockData`, `Models\Page` (View Components, `ResolveContainer0IndexAction`) | il tema è consumatore dei blocchi CMS `pub_theme::`. |
| `Modules\Tenant` | `EnteData` in `ResolveContactGroupsAction` | dati ente per i contatti. |

### 4.2 Blade/Folio (`resources/views/**`)

Riferimenti `Modules\...` dentro le view (inclusi `@php`/`use`):

- **Fixcity** (dominante): `Models\Ticket`, `Enums\TicketStatusEnum|TicketPriorityEnum|TicketTypeEnum`, `Datas\PublicTicketListFilters`, `Actions\Search\SearchFrontOfficeAction`, `BuildTicketReviewSummaryAction`, `BuildAuthenticatedUserTicketsQueryAction`, `ListPublishedFaqsAction`, `AssessAccessibilityStatementAction`, widget Livewire `TicketNotificationPreferencesWidget`, `AccessibilityFeedbackForm`, `PersonalAreaNotificationsWidget`, `Filament\Widgets\*` — il tema renderizza segnalazioni, ticket, FAQ e area personale **del modulo Fixcity**.
- **Blog**: `Models\Article`, `Actions\Article\ResolveArticleBodyAction`, `View\Composers\ThemeComposer`.
- **Cms**: `Models\Page`, `Actions\ResolvePageAction`, `Http\Middleware\PageSlugMiddleware`.
- **User**: widget Filament auth (Login, ResetPassword, ForgotPassword, NotificationsCenter), Livewire `Auth\Login`, `ProcessCallbackAction`/`IsProviderConfiguredAction` (Socialite).
- **Comment**: `Filament\Widgets\Commentable\CommentsWidget`.
- **Gdpr**: `GetCookieInventoryAction`, `Enums\CookieCategory`, `Filament\Widgets\Auth\RegisterWidget`.
- **Tenant**: `GetEnteDataAction`, `ResolveTenantConfigValueAction`.

### 4.3 Test (`tests/`)

Usano `Modules\Fixcity\Tests\TestCase` e factory/azioni Fixcity (ricerca,
segnalazioni), `Modules\Blog`, `Modules\Comment`, `Modules\Xot\Tests\XotBaseTestCase`.
Il tema ha quindi una dipendenza di test su Fixcity: testare Civic senza
l'host Fixcity non è possibile con la suite attuale.

### 4.4 Geo

- Corretto: `resources/views/components/layouts/main.blade.php` espone
  `data-geo-tile-url="{{ url('api/geo/tiles/osm') }}` e `data-geo-nominatim-url`
  verso il proxy del modulo Geo (ADR Geo 0003).
- Da correggere (fuori scope, owner JS): `resources/js/pages/home.js:15` e
  `resources/assets/js/comune-functions.js:136` usano
  `https://{s}.tile.openstreetmap.org/...` **direttamente** — bypass del proxy.

### 4.5 Confinamento

- Il tema **non contiene** Action di dominio: modelli `app/Models/*` sono di
  presentazione/entity pubbliche (Municipal, Appointment, Office, Citizen, Service)
  e la logica di business resta nei moduli (`Modules\Fixcity\Actions`, ecc.).
- Le tabelle `sixteen_*` sono il confine dati ereditato: i modelli del tema le
  leggono/scrivono direttamente; la proprietà dello schema andrebbe verificata
  lato moduli (Fixcity?) prima di qualsiasi rename.

## 5. Eccezioni da portare all'attenzione del lead

1. `testbench.yaml` punta ancora a `Themes\Sixteen\Providers\ThemeServiceProvider`.
2. I `@see docs/adr/0005-...-con-sixteen.md` in 3 file PHP lasceranno la guardia
   rossa finché l'ADR non esiste o non viene gestita in `allowedFiles`.
3. `.releaserc.json`, `index.html`, `assets/`, `public/` generati, `lang/`,
   `scripts/`, `.github/` contengono ancora `Sixteen` — owner: altri agenti.
4. Tile OSM diretti in due file JS (violazione del proxy Geo).
