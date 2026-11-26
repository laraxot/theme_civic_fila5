---
title: "Rinomina di variabili d'ambiente, rotte e config; correzione del provider"
type: decision
status: accepted
created: 2026-11-26
updated: 2026-11-26
theme: Civic
decision-makers: [agente P1 (pacchetto Civic), coordinatore della wave C1]
issues: [1, 2, 3, 4]
related:
  - 0004-inventario-riferimenti-sixteen.md
  - 0005-attivazione-civic-e-convivenza-con-sixteen.md
  - ../contracts/theme-identity.md
  - ../migration/sixteen-references-audit.md
  - ../migration/host-integration.md
---

# ADR 0007 — Rinomina di variabili d'ambiente, rotte e config; correzione del provider

## Contesto

Gli [ADR 0004](0004-inventario-riferimenti-sixteen.md) e [0005](0005-attivazione-civic-e-convivenza-con-sixteen.md) dicono
quali riferimenti a Sixteen restano e come si attiva Civic. Non dicono **cosa e' stato riscritto nel codice e con quali effetti**.
Misurato prima della migrazione (censimento di `sixteen`, case-insensitive, nel tema): 933 righe in 272 file; 328 righe
di namespace PHP in 183 file, 131 righe di variabili `SIXTEEN_*` in 4 file, 80 di id/classi CSS e JS in 25 file, 52 di view
namespace in 31 file. Il censimento era la base dell'unica passata scriptata (`perl -pi` sul working tree, 272 file, piu' i `git mv`).

Due fatti emersi dalla prova di boot ([invariante `CIVIC-ID-INV-6`](../contracts/theme-identity.md)):

- `ThemeServiceProvider::register()` chiamava `parent::register()`, che registra `{module_ns}\Providers\RouteServiceProvider` ed
  `EventServiceProvider`. Nel tema non esistono e `module_ns` e' gia' il namespace del provider: errore
  `Class "Themes\Civic\Providers\Providers\RouteServiceProvider" not found`.
- `registerBladeComponents()` costruiva da `module_ns` il namespace e la cartella dei componenti di classe
  (`app/Providers/../..//../View/Components`, inesistente): `DirectoryNotFoundException` al boot.

## Driver della decisione

- Una rinomina che lascia convivere due nomi (`SIXTEEN_*` e `CIVIC_*`) non finisce mai.
- Un default sbagliato nel posto sbagliato non deve poter esporre SPID/CIE.
- Una correzione al provider deve essere dimostrata da un test, non dedotta dalla lettura.

## Alternative scartate

- **Ripiego `env('CIVIC_X', env('SIXTEEN_X'))`**: Civic leggerebbe per sempre la configurazione di un altro tema. Nessun host carica
  Civic oggi, quindi non c'e' un valore da preservare.
- **Tenere i prefissi di rotta `sixteen/auth`**: stessa rotta di Sixteen nello stesso host, e il nome indicherebbe il tema sbagliato.
- **Registrare `RouteServiceProvider` ed `EventServiceProvider` vuoti nel tema** per far passare `parent::register()`: due classi
  senza uso per tenere in piedi una chiamata ereditata; le rotte del tema stanno gia' in `routes/auth.php`.
- **Correggere `XotBaseThemeServiceProvider`** (fuori perimetro, modulo Xot, usato anche da altri temi): richiesta aperta, non
  condizione per Civic.

## Decisione

1. **Variabili d'ambiente**: `SIXTEEN_*` diventano `CIVIC_*` (97 nomi distinti, tutti letti da `config/civic.php`), senza ripiego.
   Il default di SPID/CIE e' spento (`CIVIC_SPID_ENABLED` = `false`): un host che non ha copiato i valori non espone
   l'identita' digitale per errore. Chi attivera' Civic copia i valori del tenant (ADR 0005, punto 4.2).
2. **Config**: `config/sixteen.php` e' tolto e il suo contenuto e' in `config/civic.php`, insieme al blocco profili paese di P2
   (`default_country`, `fallback_locale`, `supported_locales`, `countries`), inserito alla lettera subito dopo `return [`
   cosi' le loro modifiche successive si applicano ancora. Chiave `civic`; `config('civic.civic...')` normalizzato in `config('civic...')`.
3. **Rotte e nomi**: prefissi `civic/auth` e `civic/test-auth`, nomi `civic.auth.*` e `civic.test-auth.*`. Le rotte di prova sono
   registrate solo in local/development/testing; l'host deve aggiungere `civic/test-auth` a `BlockShowcasePages::PREFIXES`. Se SPID
   fosse gia' registrato presso un IdP, l'URL dell'ACS cambia e va ri-registrato.
4. **Provider**: `register()` non chiama `parent::register()` (commento nel codice e `@see` a questo ADR); `registerBladeComponents()`
   usa il namespace `Themes\Civic` e la cartella `app/View/Components` del tema. La prova e'
   `tests/Unit/ThemeServiceProviderBootTest.php`.
5. **Tabelle `sixteen_*`**: restano (20 tabelle, 19 file); sono nomi di dati, non identita' ([ADR 0004](0004-inventario-riferimenti-sixteen.md)).
6. **`src/`** (4 file legacy duplicati di `app/`, non autoloadati): riscritti con la stessa regola, **non cancellati**; la cancellazione e'
   una decisione di prodotto.
7. **Asset compilati** (`public/`, base `/themes/Sixteen/`): non riscritti a mano, si ricostruiscono con la build (wave Build/CI).
8. **Documenti**: un `@see` a `Themes/Sixteen/docs/<x>` si riscrive solo se `<x>` esiste in Civic; i documenti il cui nome
   contiene `sixteen` e che esistono restano citati col loro nome. Sei `@see` a `Themes/Civic/docs/bmad/...` puntano a file che non esistono
   nemmeno in Sixteen (rotti prima e dopo): non causati da questa passata, da correggere dal proprietario dei documenti.

## Conseguenze

- Positiva: ogni nome del tema e' di Civic; il provider parte e lo dimostra un test.
- Negativa: i valori `SIXTEEN_*` di un host non sono letti da Civic; la checklist di attivazione deve copiarli.
- Negativa: i test del tema che usano classi di Civic dipendono da `tests/Support/civic-autoload.php` finche' Xot non mappa `Themes\Civic\`.
- Debito: `XotBaseThemeServiceProvider::register()` resta fragile per ogni tema che non abbia `RouteServiceProvider` ed `EventServiceProvider`.

## Conferma

Dalla radice del monorepo: `APP_CONFIG_CACHE=/nonexistent/config.php bash bashscripts/tools/pest-scratch-db.sh Themes/Civic/tests/Unit/ThemeServiceProviderBootTest.php Themes/Civic/tests/Unit/NoSixteenRuntimeReferencesTest.php`
(`CIVIC-ID-INV-1`, `CIVIC-ID-INV-5`, `CIVIC-ID-INV-6` e `CIVIC-ID-INV-7`).
