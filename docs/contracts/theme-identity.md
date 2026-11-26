---
title: "Contratto — identità del tema Civic"
type: contract
theme: Civic
status: accepted
created: 2026-11-26
updated: 2026-11-26
related:
  - ../adr/0004-inventario-riferimenti-sixteen.md
  - ../adr/0005-attivazione-civic-e-convivenza-con-sixteen.md
---

# Contratto: identità del tema

Civic è l'identità corrente del tema in ogni superficie runtime: namespace PHP `Themes\Civic\`,
package Composer `laraxot/theme_civic_fila5`, package npm `civic`, `theme.json.name = "Civic"`,
config `civic.php`, alias view `civic::`/`pub_theme::`, path pubblici `/themes/Civic/`, tag release
`theme-civic-v*`.

## Invarianti

| ID | Regola | Verifica |
|:---|:---|:---|
| CIVIC-ID-INV-1 | Nessun file runtime (PHP, Blade, JS, CSS, config, test) usa `Themes\Sixteen`, `sixteen::`, `/themes/Sixteen/` o `theme_sixteen_fila5` come identità corrente. | `tests/Unit/NoSixteenRuntimeReferencesTest.php` |
| CIVIC-ID-INV-2 | I token `sixteen_*` delle tabelle DB e il nome del repository storico `theme_sixteen_fila5` restano invariati: sono dati e riferimenti storici, non identità. | ADR 0004 |
| CIVIC-ID-INV-3 | Il tema non è un pacchetto Composer dell'host: l'attivazione è via `xra.pub_theme` e la coesistenza con Sixteen segue ADR 0005. | ADR 0005 |
| CIVIC-ID-INV-4 | Ogni nuovo riferimento a un tema hardcoded in moduli host (PSR-4 runtime, view namespace, path asset) va registrato come eccezione esplicita, non assorbito in silenzio. | `docs/migration/host-integration.md` |

## Errori

- Un riferimento Sixteen non coperto dalle eccezioni fa fallire la guardia Pest.
- Un path `/themes/Sixteen/` hardcoded in un modulo host è un bug di convivenza: i path tema-dipendenti
  passano da `pub_theme` o dalla configurazione del tenant.
