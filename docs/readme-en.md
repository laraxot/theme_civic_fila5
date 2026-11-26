---
title: "Civic — English overview"
type: note
tags: [documentation, civic, english]
created: 2026-09-26
updated: 2026-11-26
qmd: "Civic Laraxot theme Italy Malta multilingual migration Sixteen"
issues: []
discussions: []
status: active
---

# Civic — public-facing theme for local services

**Civic** is the planned reusable frontend theme for Laraxot-powered civic services and local authorities. **FixCity** is one application that may use this theme; Civic is **not** a new name for the product.

The theme targets multiple local authorities and countries, beginning with **Italy and Malta**. Its goal is to provide a shared UI while letting each authority configure its content, languages, terminology and applicable requirements.

> [!IMPORTANT]
> **The rename is not complete.** The `theme_civic_fila5` repository currently contains code copied from **Sixteen**. The Composer package, PHP namespace, theme manifest, npm package and Vite asset base still use `Sixteen`. Do not assume `Themes\Civic` is available or enable Civic in a live application before migration and verification. See the [technical documentation](./README.md).

## Purpose and principles

- **Reusable by design:** one theme, multiple municipalities and local councils.
- **Localization at the boundaries:** institution names, forms, services, labels and navigation should be translated or configured, not hard-coded into reusable components.
- **Accessible interactions:** keyboard navigation, focus management, readable contrast and mobile behavior must be tested with evidence.
- **Clear module ownership:** the theme renders interfaces; Laraxot modules own authorization, persistence, business actions and notifications.
- **No assumed certification:** references to Italian design guidelines indicate design inspiration, not official compliance or approval.

## Italy and Malta

| Audience | Planned interface languages | Current source status |
| --- | --- | --- |
| Italian local authorities | Italian (`it`), optionally English (`en`) | Both translation directories exist |
| Maltese local councils | English (`en`), Maltese (`mt`) | English exists; **Maltese is not implemented** |
| Other deployments | Configurable | German (`de`) and Spanish (`es`) directories exist; completeness is unverified |

Language folders alone do not guarantee a complete localized experience. Country-specific terminology and legal, privacy or accessibility requirements require their own review.

## Current inherited technology

- **PHP / Laravel:** Filament 5 dependencies, Blade templates, Folio/Volt integration in the host application.
- **Frontend:** Tailwind CSS 4, Alpine.js, Lit, DaisyUI and Flowbite.
- **Assets:** Vite with generated output in the theme's `public/` directory.
- **Integration:** shared public layouts, CMS blocks and map-related integrations with owner modules.

See [`composer.json`](../composer.json) and [`package.json`](../package.json) for the actual package declarations. The host FixCity project uses Laravel 13 and PHP 8.4; those versions must not be treated as verified standalone compatibility solely from this theme repository.

## Development commands for the imported code

Run these commands inside a Laraxot host checkout with the required sibling modules:

```bash
npm install
npm run build
npm test
npm run lint
# Optional Vite development server: npm run dev
```

There is currently no committed `package-lock.json`, so `npm ci` is not supported until a lockfile is added. The build references host paths such as `Modules/` and `public_html/`; running from a standalone clone may fail. **No successful build, test or lint run is asserted here.**

## Civic migration checklist

1. Rename Composer identifiers, PSR-4 namespaces and service provider references.
2. Rename theme and npm metadata; update Vite paths, asset URLs and build integration.
3. Audit host `pub_theme` configuration, CMS view references, Blade components, translations and deployment links.
4. Implement and review Maltese (`mt`) translations and Malta-specific terminology.
5. Run automated checks, browser smoke tests, mobile/accessibility reviews and a safe rollout before enabling production traffic.

Historical docs that mention Sixteen may describe the previous implementation and should not be rewritten blindly.

## Documentation

- [Italian overview](../README.md)
- [Technical status and architecture](./README.md)
- [Inherited documentation index](./README.md)
- [Architecture](../archive/docs-legacy/architecture/README.md)
- [Design system](../archive/docs-legacy/design-system/README.md)
- [Technical wiki](../archive/docs-legacy/wiki/README.md)

## Repositories and references

- [Civic repository](https://github.com/laraxot/theme_civic_fila5) — work on the existing `dev` branch.
- [Original Sixteen repository](https://github.com/laraxot/theme_sixteen_fila5) — source to be migrated.
- [Designers Italia — Municipalities model](https://designers.italia.it/modelli/comuni/) — Italian design reference, **not** a compliance certificate for Civic.

**License:** MIT, as declared in the Composer manifest and repository license file.
