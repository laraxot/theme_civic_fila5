---
title: Audit performance, SEO tecnico e budget asset
issue: 33
verificato: 2026-11-26 — analisi statica; nessun build host in esecuzione, metriche runtime UNVERIFIED
---

# Performance, SEO tecnico e budget asset

Issue: [#33](https://github.com/laraxot/theme_civic_fila5/issues/33).
**Stato: parziale.** Sorgenti analizzate; `npm run build` non eseguito (Agent B
possiede la toolchain e poteva essere a metà lavoro). Nessuna misura LCP/CLS/INP:
**unverified** senza host.

## 1. Asset (analisi statica)

| Aspetto | Esito | Evidenza |
|---|---|---|
| Font | ✅ self-hosted woff2, `font-display: swap`, niente Google Fonts | `resources/css/design-comuni/fonts.css`, `public/design-comuni/assets/fonts/*`, `app.css:9` |
| Immagini lazy | ⚠️ parziale | `loading="lazy"` su avatar/foto ticket; molte `<img>` dei blocchi (event-detail, grid-overlay, news) **senza** `loading="lazy"` → sotto la piega caricano subito |
| `decoding="async"` | ⚠️ parziale | presente su foto ticket/avatar, assente altrove |
| Dimensioni responsive | ⚠️ | `img-fluid`/`w-100` OK; `width/height` attributi solo su avatar/ticket-track (CLS parziale) |
| Mappe | ✅ proxy Geo self-hosted | `data-geo-tile-url="/api/geo/tiles/osm"` su `<html>` |
| Terze parti | ✅ | cookiebar + `NoThirdPartyBeforeConsentTest`; eccezione `livewire/toast` devdojo (issue) |
| Bundle | ? | `public/assets/app-*.css` esiste (build precedente); peso reale da misurare post-build Agent B |

## 2. SEO tecnico (layout)

| Voce | Esito | Evidenza |
|---|---|---|
| `<html lang>` | ✅ | `components/layouts/main.blade.php:57` `str_replace('_','-',locale)` |
| canonical | ✅ | `components/layouts/seo-links.blade.php` — path-based, niente query (privacy: `?code=` tracking non va in indice), `?page=N` solo dalla 2 |
| hreflang | ✅ | stesso partial: alternates per locale + `x-default` |
| meta title/description | ✅ | `<x-cms::head>` centralizzato (modulo Cms) + `PageDescription::resolve` in `pages/index` |
| landmark | ✅ | `main-landmark` con `#main-container`, skip link |
| JSON-LD/OG/Twitter | ✅ | delegato a `<x-cms::head>` |
| Semantica | ⚠️ | `h1`/`h2` gerarchia ok nei blocchi principali; da verificare per pagina in HTML reale |
| sitemap | ✅ | `pages/sitemap` + test `SitemapPageTest` |

## 3. Baseline e budget proposti

Nessuna baseline misurata (no host). Budget iniziali proposti (da confermare con
i primi Lighthouse reali):

| Metrica | Budget proposta | Note |
|---|---|---|
| Peso CSS iniziale (gzip) | ≤ 250 KB | Vite `app-*.css` attuale da misurare; commento nel layout parla di ~1.4 MB non compresso → attendere build Agent B |
| Peso JS iniziale (gzip) | ≤ 150 KB | Alpine + Livewire inevitabili; niente dipendenze nuove |
| LCP | ≤ 2.5 s | hero CMS; font swap già ok |
| CLS | ≤ 0.1 | attribuire `width/height` a hero/img CMS |
| INP | ≤ 200 ms | mappe lazy via proxy |
| Immagini below-fold | `loading="lazy"` obbligatorio | gap attuale |

**Soglia di regressione**: +10% peso CSS/JS o LCP peggiore di 0.5s vs baseline → bloccare.

## 4. Da fare

1. Eseguire `npm run build` (dopo Agent B) e registrare pesi reali gzip in questo doc.
2. Aggiungere `loading="lazy" decoding="async"` alle `<img>` sotto la piega dei blocchi (modifica vista, scope mio) — **prossima azione**.
3. Lighthouse su home/elenco/dettaglio/wizard a 375/768/1440 una volta che il build è verde.
4. Verificare `width/height` (o aspect-ratio) su immagini hero CMS per CLS.
