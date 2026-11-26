---
title: "Build, deploy e rollback di Civic sull'host FixCity"
type: note
tags: [documentation, release, civic, deploy, rollback]
created: 2026-11-26
issues: [35]
---

# Build, deploy e rollback — Civic

Procedura per portare Civic dall'host FixCity a staging e, solo dopo il go/no-go,
in produzione. Fonti verificate: `deploy.sh` alla root del progetto,
`AGENTS.md`, `laravel/Modules/Cms/app/Providers/CmsServiceProvider.php`,
`laravel/Modules/Xot/app/Actions/Composer/RegisterRuntimePsr4NamespacesAction.php`,
`laravel/config/local/fixcity/xra.php`.

> **Stato**: la procedura è documentata e verificata su file e script;
> l'esecuzione end-to-end in staging è in attesa della chiusura delle issue
> bloccanti #1–#4 (migrazione) — vedi [go-no-go](go-no-go.md).

## 1. Build degli asset

Dal repository del tema:

```bash
cd laravel/Themes/Civic
npm ci            # package-lock.json è versionato nel repo del tema
npm run build     # = prepare:static-assets && vite build && prune:assets
```

Note verificate su `package.json` / `vite.config.js`:

- `vite.config.js`: `base: '/themes/Civic/'`, `outDir: './public'`, `manifest: 'manifest.json'`
  → l'output è `laravel/Themes/Civic/public/` con `manifest.json` alla radice.
- `npm run build` esegue prima `resources/scripts/prepare-static-assets.mjs`
  (copia risorse statiche) e poi `resources/scripts/prune-stale-assets.mjs`
  (rimuove i bundle orfani in `public/assets`).
- **Mai** `npm run copy`: gli asset si servono per symlink (regola di progetto).

Verifica post-build:

```bash
test -f laravel/Themes/Civic/public/manifest.json && echo OK
ls laravel/Themes/Civic/public/assets | head
```

## 2. Pubblicazione degli asset (document root)

La document root è `public_html/`; il deploy la crea/aggiorna da solo.
`deploy.sh` (root del progetto) itera `Themes/*/public` e crea:

```
public_html/themes/Civic  ->  ../../laravel/Themes/Civic/public
```

La funzione `link_public_asset` in `deploy.sh` è idempotente: un symlink già
corretto non viene toccato, una cartella vera residua viene spostata in
`$DEPLOY_ASSETS_BACKUP_DIR` (default `$HOME/fixcity-backups/assets`) e sostituita.

Verifica host-side dopo un deploy (o manualmente in staging):

```bash
test -L public_html/themes/Civic && readlink public_html/themes/Civic
# atteso: ../../laravel/Themes/Civic/public
test -f public_html/themes/Civic/manifest.json && echo "tema servito"
```

> ⚠️ `deploy.sh` verifica esplicitamente solo `themes/Sixteen/manifest.json` e
> lo sprite Bootstrap Italia di Sixteen: aggiungere un check equivalente per
> Civic è un miglioramento host-side da proporre (fuori scope di questa issue).

## 3. Attivazione del tema per tenant

Meccanismo verificato (host, sola lettura):

- La config tenant sta in `config/<ambiente>/fixcity/xra.php` (es.
  `config/local/fixcity/xra.php` → `'pub_theme' => 'Sixteen'`,
  `'register_pub_theme' => true`).
- `Modules\Cms\Providers\CmsServiceProvider` (righe ~40-90) legge `xra.pub_theme`
  e registra namespace `pub_theme` su `Themes/<pub_theme>/resources/views` e
  `Themes/<pub_theme>/lang`, più `view.paths` e `livewire.class_namespace`
  = `Themes\<pub_theme>\Http\Livewire`.
- `Modules\Cms\Filament\Pages\Themes::changePubTheme()` salva `pub_theme`
  nella config tenant `xra` via `SaveTenantConfigAction` (pannello admin).
- `Modules\Xot\Actions\File\AssetAction` risolve gli asset come
  `asset('themes/'.$xot->pub_theme.'/'.$key)` → quindi **il nome cartella
  `Themes/Civic` e il `base` Vite `/themes/Civic/` devono combaciare**.

Prerequisiti host-side **ancora aperti** (issue #3, non di questo repo):

1. Registrare il PSR-4 `Themes\Civic\` → `laravel/Themes/Civic/app`
   in `Modules/Xot/app/Actions/Composer/RegisterRuntimePsr4NamespacesAction::namespaces()`
   (oggi contiene solo TwentyOne, Sixteen, Two).
2. Verificare se/come registrare `Themes\Civic\Providers\ThemeServiceProvider`
   a runtime (oggi nessun theme provider dei temi esistenti risulta caricato:
   il namespace `pub_theme` lo crea `CmsServiceProvider`, non il provider del tema).
3. Il `composer.json` di Civic dichiara `extra.laravel.providers` ma il root
   `laravel/composer.json` non referenzia i temi: confermare il meccanismo
   di scoperta prima dell'attivazione.

Sequenza di attivazione (solo dopo i prerequisiti e il go/no-go):

```bash
# 1) build asset (sezione 1)
# 2) deploy host (deploy.sh) → symlink public_html/themes/Civic
# 3) config tenant (staging): cambiare pub_theme
php artisan tinker --execute 'var_dump(config("xra.pub_theme"));'   # prima: Sixteen
#    poi via pannello admin (Cms → Themes) oppure config/<env>/fixcity/xra.php
#    'pub_theme' => 'Civic'
# 4) cache
php artisan optimize && php artisan route:trans:cache
php artisan queue:restart
# 5) smoke checklist → docs/release/smoke-checklist.md
```

## 4. Rollback

Il rollback di Civic **non tocca dati**: un tema è solo view + asset + config.

Procedura (perdere zero dati, Sixteen resta funzionante):

1. **Non** fare `git reset`, non toccare `public_html`, non cancellare
   `laravel/Themes/Sixteen` né `public_html/themes/Sixteen`
   (resta un symlink attivo per tutto il tempo).
2. Riportare `pub_theme` a `'Sixteen'` nella config tenant
   (`config/<env>/fixcity/xra.php` o pannello admin Cms → Themes).
3. `php artisan optimize && php artisan route:trans:cache && php artisan queue:restart`.
4. Verificare con la smoke checklist che Sixteen risponde (homepage, una
   segnalazione, login).
5. Facoltativo: tenere `public_html/themes/Civic` come symlink — non viene
   servito finché `pub_theme` non punta a Civic; se si vuole pulire:
   `rm public_html/themes/Civic` (solo il link, mai la cartella reale).

Rollback a livello di codice (se una release Civic è difettosa ma resta
attiva): si fa `git` in avanti (regola forward-only: niente revert come
scorciatoia) con un fix o con un nuovo tag stabile; il cambio `pub_theme`
resta il livello di rollback funzionale immediato.

## 5. Cosa NON fa questo deploy

- Nessuna migrazione database: Civic non porta schema.
- Nessun `deploy.sh` modificato: lo script già copre `Themes/*/public`
  genericamente; i check hardcoded su Sixteen vanno estesi a Civic
  come task separata.
- Nessuna attivazione automatica: `pub_theme` cambia solo per decisione
  esplicita (go/no-go firmato).
