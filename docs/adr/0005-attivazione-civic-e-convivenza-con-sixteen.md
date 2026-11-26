---
title: "Attivazione di Civic e convivenza con Sixteen"
type: decision
status: accepted
created: 2026-11-26
updated: 2026-11-26
theme: Civic
issues: [3, 1, 2]
---

# ADR 0005 — Attivazione di Civic e convivenza con Sixteen

## Contesto

Il tema non è un pacchetto Composer caricato dall'host: la selezione è runtime via
`xra.pub_theme` (`config/local/fixcity/xra.php`) e `CmsServiceProvider::registerNamespaces('pub_theme')`,
con Folio che monta `Themes/<Tema>/resources/views/pages`. Sixteen resta il tema attivo di produzione
fino al cutover esplicito (#3).

## Driver della decisione

Attivare Civic in test senza rompere Sixteen, senza perdita di contenuti CMS o impostazioni tenant,
e con rollback reversibile.

## Alternative scartate

- Tema come pacchetto Composer con provider auto-scoperto: l'host non lo prevede e Sixteen non lo usa.
- Attivazione globale immediata: nessuna convivenza per tenant, rollback impossibile.

## Decisione

- Selezione tema per tenant via `xra.pub_theme`; Civic e Sixteen convivono lato asset
  (`public_html/themes/<Tema>` symlink) e view namespace `pub_theme`.
- Prerequisito host: `Modules/Xot` `RegisterRuntimePsr4NamespacesAction` deve mappare
  `Themes\Civic\` → `Themes/Civic/app` e `Themes\Civic\Tests\` → `Themes/Civic/tests`
  ( oggi l'elenco è hardcoded: TwentyOne, Sixteen, Two ).
- Namespace view `sixteen::` non va usato nei moduli: i riferimenti view tema-dipendenti
  passano da `pub_theme::` o dal tema attivo.
- Cutover e rollback per tenant = cambio di `pub_theme` nel config tenant; gli asset restano
  pubblicati per entrambi i temi.

La procedura dettagliata, l'inventario dei punti di integrazione e la checklist smoke sono in
[`docs/migration/host-integration.md`](../migration/host-integration.md).

## Conseguenze

- `ThemeServiceProvider` di Civic resta registrato solo quando il tema è caricato
  (nessuna attivazione prematura in produzione).
- `deploy.sh` e i check su `Themes/Sixteen` andranno estesi a Civic prima del primo tenant reale.
- Ogni nuovo tema futuro va aggiunto all'elenco PSR-4 runtime di Xot.

## Conferma

Host di test carica Civic con `pub_theme=civic` senza errori di routing/provider;
`php artisan tinker` mostra `Themes\Civic\` autoloadabile; smoke guest/auth/admin verdi.
