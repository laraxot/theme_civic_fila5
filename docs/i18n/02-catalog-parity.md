---
title: "Contratto di parita' dei cataloghi lang/"
type: contract
theme: Civic
created: 2026-11-26
updated: 2026-11-26
status: draft
tags: [docs, civic, i18n, lang]
---

# Contratto di parita' dei cataloghi `lang/`

Issue #7. Vale per `lang/<locale>/*.php` del tema (namespace `pub_theme` e `civic`,
registrati in `app/Providers/ThemeServiceProvider.php`).

## Struttura

- Ogni lingua e' una directory `lang/<locale>/` con file `.php` che restituiscono array.
- Una chiave e' `<file>.<percorso.puntato>` (es. `ui.buttons.save`).
- Le foglie sono stringhe; un array vuoto `[]` e' un difetto (file corrotto).

## Regole

1. **Parita' di copertura** (`CIVIC-I18N-INV-1/2`): ogni lingua guarded (`it`, `en`, `de`, `es`)
   ha ogni file e ogni chiave che ha almeno un'altra guarded. Il confronto e' contro
   l'unione delle chiavi, non contro `it` solo: una chiave che esiste solo in `en` deve
   esistere comunque in `it`.
2. **Segnaposto** (`CIVIC-I18N-INV-3`): i `:nome` di una traduzione coincidono con quelli
   di `it`. Una traduzione che perde `:count` stampa il testo senza il dato.
3. **Plurali espliciti** (`CIVIC-I18N-INV-4`): gli intervalli `{1} ...|[2,*] ...` sono
   identici in ogni lingua; le forme semplici `uno|molti` dipendono dalla regola di
   plurale della lingua (mt ne ha quattro: `MessageSelector::getPluralIndex`).
4. **Nessuna directory orfana** (`CIVIC-I18N-INV-5`): ogni `lang/<locale>` e' o guarded
   o `mt` (bozza dichiarata). Una lingua nuova entra in `civicI18nGuardedLocales()`
   solo quando il catalogo e' completo.
5. **Risoluzione senza fallback** (`CIVIC-I18N-INV-6`): ogni chiave guarded si risolve
   nella propria lingua; il fallback `it` non deve mai essere il modo in cui una chiave
   "esiste".
6. **Nessun marcatore di revisione** (`CIVIC-I18N-INV-7`): `[[MT-REV]] ` non compare nei
   cataloghi guarded. `mt` e' l'unica eccezione dichiarata.

## `mt`: bozza con marcatore

`lang/mt` replica file e chiavi di `en`. Ogni testo non verificato da un parlante
competente comincia per `[[MT-REV]] ` ed e' seguito dal testo inglese. Il marcatore
sopravvive alla traduzione: chi revisiona toglie il prefisso, non riscrive la chiave.

- Conteggio: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/`).
- Test dedicato: `tests/Unit/I18n/MtCatalogTest.php` (copertura, orfani, segnaposto,
  marcatore). `mt` NON e' guarded finche' il conteggio `pending` non e' zero.
- Abilitazione host: `mt` non e' in `supportedLocales` di `laravellocalization.php`
  (config host, fuori dal tema). La bozza non si abilita finche' la revisione linguistica
  non e' fatta: vedi `mt-catalog.md`.

## Verifica

```bash
# da laravel/ — nessuna applicazione, nessun database
php Themes/Civic/tests/Unit/I18n/Support/lang-parity-report.php            # esce 1 se c'e' un buco
php Themes/Civic/tests/Unit/I18n/Support/lang-parity-report.php --details  # elenca le chiavi
vendor/bin/pest Themes/Civic/tests/Unit/I18n                               # i test Pest
```

Stato al 2026-11-26: unione 2728 chiavi / 91 file per lingua; it/en/de/es a parita'
totale; mt completo come struttura con 2098 testi marcati `[[MT-REV]]`.

## Fuori contratto

- Testi hardcoded nelle Blade: non coperti dai file lang. Elenco in
  `translation-coverage.md`; la wiring spetta ai proprietari delle view.
- Contenuti CMS/JSON del tenant: hanno la loro parita' (`ContentLocaleParityTest`
  nel modulo Fixcity).
