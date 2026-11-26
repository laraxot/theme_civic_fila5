---
title: "Versioning, compatibilità e politica del changelog — Civic"
type: note
tags: [documentation, release, civic, versioning]
created: 2026-11-26
issues: [35]
---

# Versioning, compatibilità e changelog — Civic

Documento di rilascio per la issue [#35](https://github.com/laraxot/theme_civic_fila5/issues/35) (CIV-M4).
Vale per il repository `laraxot/theme_civic_fila5`, branch `dev`.

## 1. Strategia di versioning

Civic è un **tema pubblicabile** (`theme.json` → `"type": "pub"`), non un modulo:
segue le convenzioni dei temi Laraxot esistenti (Sixteen usa tag `theme-sixteen-vX.Y.Z`).

- **Versione canonica** in `theme.json` → `version` e in `composer.json` → `version`/tag.
  Allineare le due fonti a ogni rilascio; `package.json` resta `0.0.0`/`private` (non è un pacchetto pubblicato su npm).
- **Fase di migrazione** (fino alla chiusura di #1–#4): le versioni restano `0.x`
  (`0.1.0` = primo build Civic installabile in staging). Le `1.x` si aprono solo dopo
  il gate M1 completo e una prova end-to-end sull'host.
- **Tag git**: `theme-civic-v<major>.<minor>.<patch>` (es. `theme-civic-v0.1.0`),
  stesso schema dei tag Sixteen, così i link `compare` del changelog restano coerenti.
- **SemVer** applicato al contratto tema↔host:
  - `MAJOR` — rottura del contratto `pub_theme::` (namespace viste/lang, convenzioni CMS,
    hook richiesti ai moduli) o cambio di stack (es. Vite 8 → altra major).
  - `MINOR` — nuove funzionalità retro-compatibili (nuovi blocchi CMS, nuove lingue,
    nuove varianti di layout).
  - `PATCH` — fix di bug, CSS, copy, traduzioni.
- **Pre-release**: suffisso `-dev.N` / `-rc.N` per le build di migrazione,
  mai pubblicate come tema attivo in produzione.

## 2. Matrice di compatibilità host

Fonte: `laravel/composer.json` (host), `Themes/Civic/composer.json`, `Themes/Civic/package.json`,
`laravel/Themes/Civic/vite.config.js`, `theme.json`.

| Componente | Requisito host verificato | Note |
| --- | --- | --- |
| PHP | `^8.4` (host `laravel/composer.json`) | PHP 8.4.27 verificato in locale |
| Laravel | `^13.0` | host `laravel/framework: ^13.0` |
| Filament | `^5.0` (`filament/filament`, `support`, `forms`, `tables`, `actions`, `widgets`, `notifications`, `infolists`) | coerente con `Themes/Civic/composer.json` |
| nwidart/laravel-modules | `^13.0` | moduli in `laravel/Modules/*` |
| Node.js | Vite `^8.3.4`, Tailwind `^4.3.3` | Node 26 verificato in locale; il tema non dichiara `engines` → **miglioramento candidato**: aggiungere `"engines": {"node": ">=20"}` (o la major supportata) |
| npm | `npm ci` supportato | `package-lock.json` è versionato nel repo del tema |
| DB | MariaDB (host) | il tema non tocca lo schema: nessuna migrazione propria |

> ⚠️ **`theme.json` → `compatibility` è obsoleto**: dichiara `laravel >=10.0`,
> `filament >=3.0`, `php >=8.1`. Va aggiornato a `laravel ^13`, `filament ^5`, `php ^8.4`
> quando la migrazione #1/#2 sarà completata (fuori dal perimetro di questa issue).

## 3. Matrice delle dipendenze tema → moduli

Civic è un tema di **presentazione**: non possiede logica di dominio. Le classi
`Modules\*` referenziate dalle view/app del tema (verificato con grep su
`resources/` e `app/`) indicano i moduli che **devono essere presenti e attivi**
sull'host perché le pagine non vadano in errore:

| Modulo host | Uso nel tema (evidenza) | Contratto di riferimento |
| --- | --- | --- |
| `Fixcity` | `Models\Ticket`, `Enums\TicketStatusEnum`, `TicketPriorityEnum`, `Datas\PublicTicketListFilters`, action wizard (`BuildTicketReviewSummaryAction`, `BuildAuthenticatedUserTicketsQueryAction`), Livewire `TicketNotificationPreferencesWidget`, `AccessibilityFeedbackForm`, `ListPublishedFaqsAction` | `laravel/Modules/Fixcity/docs/contracts/` |
| `Cms` | `Models\Page`, `Http\Middleware\PageSlugMiddleware`, `Actions\ResolvePageAction` — pagine CMS e sezioni JSON | `laravel/Modules/Cms/docs/contracts/` |
| `Blog` | `Models\Article`, `Models\Category`, `Actions\Article\ResolveArticleBodyAction`, `View\Composers\ThemeComposer` | `laravel/Modules/Blog/docs/contracts/` |
| `Geo` | tile e geocoding **solo via proxy** `/api/geo/...` (dichiarato in `resources/views/components/layouts/main.blade.php` righe 57: `data-geo-tile-url`, `data-geo-nominatim-url`); mai chiamate dirette dal browser — [ADR Geo 0003](../../../../Modules/Geo/docs/adr/0003-osm-proxy-tile-nominatim.md) | `laravel/Modules/Geo/docs/contracts/` |
| `Tenant` | `Actions\Ente\GetEnteDataAction` — dati ente per intestazioni/footer | `laravel/Modules/Tenant/docs/contracts/` |
| `User` | `Models\User`, action auth (`GetPostLoginUrlAction`, `UpsertUserFromDigitalIdentityAction`), widget Filament auth | `laravel/Modules/User/docs/contracts/` |
| `Xot` | `Contracts\UserContract`, `Actions\Cast\SafeStringCastAction`, `Traits\EnumTrait` | `laravel/Modules/Xot/docs/contracts/` |
| `Comment` | `Filament\Widgets\Commentable\CommentsWidget` (backoffice) | `laravel/Modules/Comment/docs/contracts/` |
| `Gdpr` | `Actions\Cookie\GetCookieInventoryAction` — cookie banner | `laravel/Modules/Gdpr/docs/contracts/` |
| `Lang` | `View\Composers\ThemeComposer` — composizione traduzioni tema | `laravel/Modules/Lang/docs/contracts/` |
| `Seo` | sitemap/lastmod lato host; il tema fornisce solo markup head | `laravel/Modules/Seo/docs/contracts/` |

**Regola**: una nuova dipendenza da un modulo va aggiunta a questa tabella e
verificata nel contratto del modulo prima del rilascio.

## 4. Localizzazione

`lang/` contiene `it`, `en`, `de`, `es` (namespace `pub_theme`).
Malta (`mt`) è pianificata in #8 e l'esperienza Local Councils in #9:
finché #8 non è chiusa, **`mt` non è una lingua supportata** e non va dichiarata
nella matrice di rilascio.

## 5. Politica del changelog

- `CHANGELOG.md` è in italiano per le note di progetto; le voci automatiche
  esistenti (generate dai commit) restano come sono.
- A ogni rilascio si aggiunge una sezione `## [X.Y.Z]` con data e link
  `compare` fra i tag `theme-civic-v*`, seguita da `### Features` / `### Bug Fixes`.
- Le voci devono citare l'issue (`#N`) e il commit, come da convenzione del repo.
- In fase di migrazione la sezione `Unreleased` riporta lo stato reale:
  gli item non completati sono marcati come tali, mai presentati come fatti.
