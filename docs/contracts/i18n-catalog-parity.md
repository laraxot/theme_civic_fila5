---
title: "Contratto — parita' dei cataloghi `lang/` di Civic (it, en, de, es, mt)"
type: i18n-contract
theme: Civic
status: accepted
created: 2026-11-26
updated: 2026-11-26
issues:
  - "https://github.com/laraxot/theme_civic_fila5/issues/7"
  - "https://github.com/laraxot/theme_civic_fila5/issues/8"
related:
  - ../adr/0010-catalogo-maltese-bozza-e-revisione.md
  - ../adr/0013-fallback-di-localizzazione-e-parita-dei-cataloghi.md
  - i18n-entity-terminology.md
---

# Parita' dei cataloghi `lang/`

Contratto di **dati**, non di un'Action (`type: i18n-contract`, nessun `action`). Promette che i cataloghi del tema dicono le stesse
cose in ogni lingua servita e che un catalogo che ne perde un pezzo fa fallire un test. Il perche': [ADR 0013](../adr/0013-fallback-di-localizzazione-e-parita-dei-cataloghi.md);
il maltese: [ADR 0010](../adr/0010-catalogo-maltese-bozza-e-revisione.md).

## Input

- Le cartelle `laravel/Themes/Civic/lang/<locale>/*.php` (oggi `it en de es mt`, 91 file l'una). Ogni file ritorna un array; le chiavi foglia sono
  indicate `file.chiave.sotto`.
- Lingue sotto parita' stretta: `civicI18nGuardedLocales()` in `tests/Unit/I18n/LangParityTest.php` (`it en de es mt`). Lingue con testi
  rivisti, dove il marcatore e' vietato: `civicI18nReviewedLocales()` (`it en de es`).
- Marcatore di revisione maltese: `[[MT-REV]] ` (costante `LangCatalog::PENDING_MARKER`).

## Output

- Il report riproducibile, da `laravel/Themes/Civic`: `php tests/Unit/I18n/Support/lang-parity-report.php [--details] [--locales=it,en,de,es,mt]
  [--reference=it] [--pending=mt] [--drafted=mt] [--json]`. Tabella per lingua (file, chiavi, mancanti, file mancanti, vuote, segnaposto, da rivedere);
  esce 1 se c'e' un buco. Con `--pending=mt` elenca i testi marcati, con `--drafted=mt` le bozze scritte e non marcate.
- Il test `LangParityTest` (Pest, nessuna applicazione, nessun database). Stato misurato il 2026-11-26: 91 file e 2728 chiavi per lingua, 0 mancanti,
  0 segnaposto diversi; `mt` ha 2098 testi ancora marcati.

## Invarianti

| ID | Regola | Group Pest |
|:---|:---|:---|
| CIVIC-I18N-INV-1 | Ogni lingua sotto parita' ha ogni chiave foglia che ha almeno un'altra lingua del gruppo (unione). Se viene violata un utente di quella lingua legge il testo del fallback senza errore. | `CIVIC-I18N-INV-1` |
| CIVIC-I18N-INV-2 | Ogni lingua ha gli stessi file e nessun file e' vuoto (`return [];`) ne' ha un array vuoto come foglia; una stringa vuota ammessa (`placeholder`, `help`) non e' un difetto. | `CIVIC-I18N-INV-2` |
| CIVIC-I18N-INV-3 | I segnaposto `:nome` di ogni testo sono gli stessi di `it`, nello stesso insieme. | `CIVIC-I18N-INV-3` |
| CIVIC-I18N-INV-4 | Le chiavi con plurale a intervallo esplicito hanno gli stessi intervalli in ogni lingua (quelle a barra semplice dipendono dalla lingua e non si confrontano). | `CIVIC-I18N-INV-4` |
| CIVIC-I18N-INV-5 | Ogni cartella `lang/<locale>/` e' sotto il test: nessuna lingua esiste fuori da `civicI18nGuardedLocales()`. | `CIVIC-I18N-INV-5` |
| CIVIC-I18N-INV-6 | Il traduttore di Laravel, senza fallback, risolve ogni chiave dell'unione nella propria lingua (`hasForLocale`). Se viene violata il fallback nasconderebbe un buco. | `CIVIC-I18N-INV-6` |
| CIVIC-I18N-INV-7 | Nessun testo di `it`, `en`, `de`, `es` contiene il marcatore `[[MT-REV]] `. | `CIVIC-I18N-INV-7` |
| CIVIC-I18N-INV-8 | Ogni testo `mt` marcato e' il marcatore seguito dal testo inglese identico a `en` (mai una traduzione a meta' o un testo inventato dietro il marcatore). | `CIVIC-I18N-INV-8` |
| CIVIC-I18N-INV-9 | Il host non abilita `mt` in `config/laravellocalization.php` finche' `lang/mt` ha testi marcati. Il test si salta se il file del host non esiste (tema usato da solo). | `CIVIC-I18N-INV-9` |

Verifica, da `laravel/` (monorepo): `APP_CONFIG_CACHE=/nonexistent/config.php bash ../bashscripts/tools/pest-scratch-db.sh
Themes/Civic/tests/Unit/I18n/LangParityTest.php`. Un solo invariante: `... --group=CIVIC-I18N-INV-6`. Il runner e' obbligatorio: Pest lanciato direttamente
scrive sul database di sviluppo.

## Effetti collaterali

Nessuno. Il test e il report leggono i file lang; non scrivono, non aprono connessioni, non chiamano servizi.

## Errori

- Un buco: il test fallisce con il nome della lingua e le prime venticinque chiavi (poi «... e altre N»); il report esce con codice 1 e, con
  `--details`, le elenca tutte.
- Un file lang con errore di sintassi (`ParseError` di PHP, che riporta file e riga) o che ritorna altro da un array (`LogicException` di
  `LangCatalog` con il percorso): il test fallisce, il report si ferma.
- `config/laravellocalization.php` assente: INV-9 salta, non passa; lo stato «saltato» non e' una prova.
- Un file lang vuoto lasciato da uno scrittore automatico di chiavi (`return [];` seguito da altre righe) e' un errore di sintassi: `php -l` dopo ogni
  scrittura.

## Non fa

- Non giudica la **qualita'** della traduzione, solo la sua esistenza e la forma: «uguale a `it`» non e' un errore (cognati, marchi).
- Non prova che le viste citino chiavi che esistono (lo fa `tests/Unit/FixcityTranslationKeysCitedByViewsExistTest.php` per `fixcity::`; per `pub_theme::`
  la misura e' nell'ADR 0013).
- Non dichiara rivista nessuna traduzione `mt`: la revisione di un madrelingua non e' misurabile da un test.
- Non decide quale lingua e' il ripiego di un Paese (ADR 0013, richiesta a P1).
