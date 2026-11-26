---
title: Design token e branding multi-tenant (Civic)
issue: 11
status: parziale — catalogo verificato staticamente; consumo runtime dei colori brand non ancora cablato (vedi §5)
verificato: 2026-11-26 (analisi statica del working tree; nessun host in esecuzione)
---

# Design token e branding multi-tenant

Issue: [#11](https://github.com/laraxot/theme_civic_fila5/issues/11) — «Consolidare token, branding e componenti multi-tenant».

## 1. Catalogo token (stato attuale, verificato nei sorgenti)

### 1.1 Colori — palette Design Comuni / AGID (fonte: `resources/css/design-comuni/components.css`, scope `body:has(.page-content[data-dc])`)

| Token CSS | Valore | Uso | Frequenza nel bundle |
|---|---|---|---|
| `--bs-primary` | `#007a52` | azione primaria, link, focus ring base | ~106 occorrenze `#007a52` |
| `--bs-secondary` / `--bs-info` | `#5d7083` | testo secondario, bordi | ~70 |
| `--bs-body-color` | `#1a1a1a` | testo corpo | ~48 |
| `--bs-border-color` | `#c5c7c9` | bordi | ~34 |
| `--bs-dark` | `#17334f` | titoli, testo forte | ~14 |
| `--bs-warning` | `#995c00` | avvisi | ~28 |
| `--bs-danger` | `#cc334d` | errori | ~12 |
| `--bs-success` | `#008055` | successo | ~11 |
| `--bs-light` / `--bs-100` | `#e9e6f2` / `#f5f5f5` | fondi chiari | — |
| grigio testuale secondario | `#5c6f82`, `#455a64`, `#30475f` | varianti secondarie | — |
| focus ring | `#80c8ad` (usato nei blade come `focus:ring-[#80c8ad]`) | indicatore focus | — |
| superfici custom | `#e6f3ee` (callout), `#f5f7f9` (sezione contatti) | hardcoded nei blade flow/* | — |

Nota: esistono **due palette parallele**: `design-comuni` (`#007a52` verde) e `agid`/bootstrap-italia (`--bs-primary:#06c` blu, `components.css:11` vs `:13`). Il tema attivo per le pagine reali è la prima; la seconda resta per le pagine legacy. Da consolidare (gap, §6).

### 1.2 Tipografia (font self-hosted, `resources/css/design-comuni/fonts.css`, `font-display: swap`)

| Ruolo | Famiglia | Pesi serviti |
|---|---|---|
| Testo/UI | Titillium Web | 300, 400, 600, 700, 900 (+italic) |
| Titoli lunghi / contenuti | Lora | 400, 700 (+italic) |
| Codice / dati | Roboto Mono | 400, 700 (+italic) |

File: `public/design-comuni/assets/fonts/*` e `public/fonts-manifest.json`. Nessun `@import` verso `fonts.googleapis.com` (verificato: `resources/css/app.css:9` lo vieta esplicitamente, DCP-137).

### 1.3 Spaziature e componenti

- Spaziatura: scala Bootstrap/Design Comuni (`p-3`, `mb-40`, `gap-*`…) e classi custom `cmp-*` (card, heading, navscroll, info-summary, breadcrumb, steppers).
- Header: `components/sections/header/v1.blade.php` + partials (`slim`, `center`, `navbar`, `user-dropdown`); footer: `components/sections/footer/v1.blade.php` (data-driven da JSON CMS + `GetEnteDataAction`).
- Componenti riusabili: `components/blocks/*` (CMS), `components/bootstrap-italia/*` (pattern AGID), `components/ui/*`.

## 2. Meccanismo di override esistente

| Livello | Config | Consumo verificato |
|---|---|---|
| Logo ente | `config('civic.brand.logo.*')` (env `CIVIC_LOGO_*`), JSON CMS `brand.logo` | **sì** — `sections/partials/brand-mark.blade.php` |
| Colori brand | `config('civic.brand.colors.{primary,secondary,success,warning,danger}')` (env `CIVIC_*_COLOR`, default `#0066CC`…) | **NO** — nessuna vista/CSS legge queste chiavi (grep: solo `app/Console/Commands/CivicInstallCommand.php`) |
| Colori legacy | `config('theme.customization.colors.*')` | parziale |
| Contatti/social | `config('ente')` → `Modules\Tenant\Actions\Ente\GetEnteDataAction` | **sì** — footer v1, blocchi fixcity, footer-full, login-card |

**Attenzione**: i default di `civic.brand.colors` (`#0066CC` blu) **non coincidono** con la palette attiva del tema (`#007a52` verde). Applicarli così com'è cambierebbe l'aspetto attuale: il cablaggio deve allineare prima i default (§5).

## 3. Come due tenant mostrano brand diversi con gli stessi componenti (contratto proposto)

1. **Contenuto** (nome, recapiti, social, logo): già multi-tenant via `GetEnteDataAction` + JSON CMS. Verificato nei blade toccati in #20.
2. **Colore**: la palette vive in CSS custom property (`--bs-*`). Override **senza duplicare CSS**: emettere in `<head>` (layout `components/layouts/main.blade.php`, `@push('styles')`) un blocco scoped
   `body:has(.page-content[data-dc]) { --bs-primary: …; --bs-link-color: …; --bs-link-hover-color: …; }`
   alimentato da `config('civic.brand.colors.*')`. Stessa specificità del bundle → vince per ordine di cascata; nessun file CSS nuovo, nessun bundle duplicato. Le classi `focus:ring-[#80c8ad]` hardcoded nei blade va sostituite da token (`focus-visible:ring-…` su variabile) per coprire il focus ring del brand.
3. **Font**: self-hosted; un tenant che vuole un font diverso carica il woff2 nel proprio tema/`public` e imposta `--bs-font-sans-serif` con lo stesso meccanismo.
4. **Limiti**: colori custom devono rispettare contrasto WCAG AA (test §5); il tema non deve mai servire asset di un tenant all'altro (ogni tenant ha la propria installazione/config — verificare in deploy).

## 4. Verifiche di contrasto/focus per brand (da eseguire, non ancora fatte)

Per ogni brand (Italia `#007a52`, Malta da definire):
- `--bs-primary` su bianco ≥ 4.5:1 per testo, ≥ 3:1 per componenti UI (WCAG 1.4.3/1.4.11). `#007a52` su `#fff` ≈ 5.0:1 (calcolo statico, da riverificare in browser).
- `--bs-secondary #5d7083` su bianco ≈ 5.0:1.
- Focus ring `#80c8ad` su bianco ≈ 1.9:1 → **sotto la soglia 3:1 di WCAG 1.4.11** per indicatori di focus non testuali: candidato a correzione (scurire o ispessire). Verificare sul pulsante reale: il bordo `#007a52` della call-to-action può compensare parzialmente; misurare in browser.
- `prefers-reduced-motion`: già supportato (`components.css`, `app/20-dc-components.css:250`, `agid.css:225`).

## 5. Gap e azioni

| # | Gap | Stato |
|---|---|---|
| G1 | `civic.brand.colors` non consumato da nessuna vista | issue correttiva da aprire |
| G2 | default `civic.brand.colors` (`#0066CC`) incoerenti con la palette attiva (`#007a52`) | allineare prima del cablaggio |
| G3 | `focus:ring-[#80c8ad]` hardcoded in ~dozzine di blade flow/report | sostituire con token CSS |
| G4 | doppia palette agid (`#06c`) vs design-comuni (`#007a52`) | consolidare o isolare per pagina |
| G5 | colori superfici `#e6f3ee`, `#f5f7f9` hardcoded nei blade | tokenizzare |

## 6. Criteri di accettazione #11 — stato

- [ ] Due tenant demo con brand differenti, stessi componenti — **non verificato** (nessun host; dipende da G1–G2).
- [x] Nessun asset/contenuto di un tenant visibile nell'altro — parziale: i contenuti ente passano da `config('ente')` per-tenant; da riverificare in deploy multi-tenant.
- [x] Token e override documentati — questo documento; regressione responsive **non verificata**.
