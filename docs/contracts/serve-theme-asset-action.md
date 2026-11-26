---
title: "Contratto — ServeThemeAssetAction (Civic)"
type: contract
action: "Themes\\Sixteen\\Actions\\Assets\\ServeThemeAssetAction"
theme: Civic
status: accepted
created: 2026-11-26
updated: 2026-11-26
related:
  - ../adr/0001-build-assets-via-vite-and-symlink.md
  - ../../../Sixteen/docs/contracts/serve-theme-asset-action.md
  - ../../app/Actions/Assets/ServeDesignComuniAssetAction.php
---

# Contratto: ServeThemeAssetAction (copia di Civic)

`Themes/Civic/app/Actions/Assets/ServeThemeAssetAction.php` dichiara la stessa classe di Sixteen e ha lo stesso codice
(`diff`: solo il docblock). **Serve file di `Themes/Sixteen/public`, non di `Themes/Civic/public`**: il percorso e'
scritto a mano (`ServeThemeAssetAction.php:27`). Le rotte che la usano sono in `laravel/routes/web.php:15,20`
(`/themes/Sixteen/{path}` e `/{lang}/assets/{path}` via `ServeDesignComuniAssetAction`), che importano la classe
`Themes\Sixteen\Actions\Assets\ServeThemeAssetAction`: quale dei due file venga caricato non e' stato verificato.

## Input

- `execute(string $path)`: percorso relativo a `Themes/Sixteen/public`; `\` diventa `/`, gli `/` iniziali si tolgono.
- Da `/{lang}/assets/{path}` arriva gia' anteposto `design-comuni/assets/` (`ServeDesignComuniAssetAction`).

## Output

- `BinaryFileResponse` del file con `Cache-Control: public, max-age=31536000, immutable`.
- Caso speciale: `design-comuni/assets/images/logo-comune.svg` assente in `public/` si serve da
  `Themes/Sixteen/Main_files/five/assets/images/logo-comune.svg`.

## Invarianti

| ID | Regola | Group Pest |
|:---|:---|:---|
| CIVIC-ASSET-INV-1 | Un percorso vuoto o che contiene `..` (anche con `\`) e' 404 prima di qualunque accesso al filesystem (`ServeThemeAssetAction.php:23`). Se viene violata, `../.env` raggiunge `base_path()` fuori da `public/`. | — (non dimostrato) |
| CIVIC-ASSET-INV-2 | Si servono solo file sotto `Themes/Sixteen/public` (piu' il ripiego del logo): mai `resources/`, `config/`, sorgenti. | — (non dimostrato) |

Civic non ha un test per questa Action (Sixteen si': `AuthAndAssetActionContractsTest`, con il group della sua prima invariante sugli asset).
Backlog test nel [README](README.md).

## Effetti collaterali

- Nessuna scrittura, nessuna sessione, nessuna chiamata esterna; lettura del file dal disco (`is_file`, `response()->file`).
- Risposta HTTP con cache di un anno: i file devono avere nome con hash o non cambiare mai.

## Errori

- `NotFoundHttpException` per percorso vuoto o con `..` (INV-1), o per file inesistente.

## Non fa

- Non serve gli asset di Civic: per quelli non esiste ne' un link in `public_html/themes` ne' un'Action
  ([ADR](../adr/0001-build-assets-via-vite-and-symlink.md), «Stato attuale»).
- Non e' il modo normale di servire gli asset: il web server li serve dal symlink senza passare da PHP.
- Non verifica i symlink dentro `public/`: `is_file` li segue.
- Non distingue file con hash da file senza hash: la cache `immutable` vale per entrambi.

## Limiti noti

- Limite noto: il percorso `Themes/Sixteen/public` e' fisso (`ServeThemeAssetAction.php:27`); se Civic sostituisse Sixteen,
  l'Action servirebbe ancora i file di Sixteen.
- Limite noto: `str_contains($relativePath, '..')` (`ServeThemeAssetAction.php:23`) rifiuta anche nomi legittimi come
  `foo..bar.css`.
