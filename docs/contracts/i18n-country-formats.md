---
title: "Contratto — formati per Paese di Civic: date, numeri, indirizzi, telefoni, codici postali"
type: i18n-contract
theme: Civic
status: proposed
created: 2026-11-26
updated: 2026-11-26
issues:
  - "https://github.com/laraxot/theme_civic_fila5/issues/9"
  - "https://github.com/laraxot/theme_civic_fila5/issues/17"
related:
  - ../adr/0012-formati-per-paese.md
  - i18n-entity-terminology.md
---

# Formati per Paese

Contratto di **design** (`status: proposed`, `type: i18n-contract`, nessun `action`): dice che cosa si formatta, con quale strumento e con quali dati, e quali
promesse sono gia' misurate. Il perche' e le alternative scartate: [ADR 0012](../adr/0012-formati-per-paese.md). Il codice che lo realizza e' in `app/Support/`
(P1: `CountryProfile`, `LocaleFormats`): questo pacchetto non lo scrive, ma misura quello che dipende solo da PHP Intl e dalla configurazione.

## Input

- La **coppia lingua-Paese** servita, da `config/civic.php` `countries.<CC>.locales`: `it_IT`, `en_IT`, `de_IT`, `es_IT`, `en_MT`, `mt_MT`. Il locale ICU di formattazione e'
  `<lingua>_<PAESE>`; mai la lingua senza Paese (`en` da solo formatta la data all'americana).
- I **dati per Paese**, in `config/civic.php` `countries.<CC>.formats`: `date` (pattern CLDR, oggi `dd/MM/yyyy`), `address_order` o `address_format`,
  `postcode_pattern`, `phone_country_code`. Da aggiungere (richieste a P1): `phone_pattern`, `phone_groups`, `postcode_normalize`.
- PHP Intl (ICU 78.2 misurato): `IntlDateFormatter`, `NumberFormatter`. Nessuna libreria nuova.

## Output

- **Date:** `IntlDateFormatter` con il locale della coppia e il pattern di `formats.date`; stili ICU per le date discorsive (`26 novembre 2026`, `26 ta’ Novembru 2026`).
- **Numeri e valute:** `NumberFormatter` con il locale della coppia (`1.234.567,89` per `it_IT`, `1,234,567.89` per `mt_MT` e `en_MT`).
- **Indirizzo:** ordine da dato; segmenti vuoti omessi; provincia solo se il Paese la dichiara.
- **Codice postale:** stringa, validata con `postcode_pattern`; normalizzato solo se il Paese lo dichiara.
- **Telefono:** conservato normalizzato (cifre e `+`), mostrato con prefisso e raggruppamento del Paese; se non valido, l'input potato.

## Invarianti

| ID | Regola | Group Pest |
|:---|:---|:---|
| CIVIC-I18N-INV-13 | Le coppie lingua-Paese di `config/civic.php` sono esattamente le sei del contratto e ICU ha i dati della lingua di ognuna (`IntlDateFormatter` si crea, `NumberFormatter` risolve la lingua). Se una coppia sparisce o ne compare una nuova senza dati ICU il test fallisce. | `CIVIC-I18N-INV-13` |
| CIVIC-I18N-INV-14 | Il pattern numerico `dd/MM/yyyy` da' `26/11/2026` in ogni coppia e la data lunga contiene il mese nella lingua della coppia (novembre, November, noviembre, Novembru). | `CIVIC-I18N-INV-14` |
| CIVIC-I18N-INV-15 | Separatori decimale e delle migliaia dal Paese: `it_IT` virgola e punto, `mt_MT` e `en_MT` punto e virgola, e quelli italiani sono diversi dai maltesi. | `CIVIC-I18N-INV-15` |
| CIVIC-I18N-INV-16 | Il codice postale e' una stringa: il pattern italiano accetta `00100` e rifiuta `VLT 1117`, il maltese il contrario, e un cast a intero rovinerebbe entrambi (`(int) "00100"` = 100, `(int) "VLT 1117"` = 0). Un secondo test verifica che `AddressData::$postal_code` sia `string`: oggi salta perche' e' `?int` e si attiva da solo quando Geo lo cambia. | `CIVIC-I18N-INV-16` |
| CIVIC-I18N-INV-18 | `LocaleFormats::formatDate` formatta con IntlDateFormatter e il pattern CLDR del profilo: `d MMMM yyyy` da' il mese parlato nella lingua della coppia (oggi restituisce `26 1111 2026`). | — (non dimostrato: serve P1) |
| CIVIC-I18N-INV-19 | Nessuna classe condivisa contiene un ramo per Paese (`match ($country)`, `isMaltaPostcode`): le regole di IT e MT sono dati di config. | — (non dimostrato: serve P1) |
| CIVIC-I18N-INV-20 | Un numero di telefono non valido si mostra potato e mai corretto; uno valido si conserva normalizzato e si mostra con il raggruppamento del Paese, verificato contro una fonte. | — (non dimostrato: raggruppamento non verificato, serve P1 e una fonte) |
| CIVIC-I18N-INV-21 | Il codice postale non perde zeri iniziali ne' lettere dal geocoding alla vista; `vlt1117` si normalizza in `VLT 1117` solo per un Paese che dichiara `postcode_normalize`. | — (non dimostrato: serve Geo e P1; il primo test di INV-16 e' la sola parte misurata) |

Verifica, da `laravel/`: `APP_CONFIG_CACHE=/nonexistent/config.php bash ../bashscripts/tools/pest-scratch-db.sh
Themes/Civic/tests/Unit/I18n/CountryFormatsTest.php` (uno solo: `--group=CIVIC-I18N-INV-14`). Misure che stanno nell'ADR e non in un test: le chiamate dirette a
`LocaleFormats::formatDate` e `normalizePostcode` che mostrano i difetti elencati in INV-18, INV-19, INV-20.

## Effetti collaterali

Nessuno: i test leggono `config/civic.php` e chiamano Intl; non scrivono, non usano rete. La formattazione non cambia lo stato.

## Errori

- Locale che ICU non conosce (coppia nuova): ICU ricade sulla lingua (es. `es_IT` risolve su `es`); INV-13 fallisce solo se manca la lingua.
- Data, telefono o CAP non validi: si mostra l'input potato, mai un valore corretto o inventato.
- Pattern CLDR con un token non supportato dall'implementazione: oggi produce testo sbagliato senza errore (misurato, vedi INV-18); l'uso di ICU toglie il caso.

## Non fa

- Non installa dipendenze: `libphonenumber`, `commerceguys/addressing`, `symfony/intl` non ci sono ed e' una decisione umana (ADR 0012, «Conferma»).
- Non verifica che il raggruppamento dei numeri di telefono maltesi o italiani sia quello ufficiale: nessuna fonte e' stata consultata.
- Non converte valute ne' fusi orari: il fuso e' quello dell'applicazione.
- Non risolve il Paese di un utente: il Paese e' quello del tenant (`CountryProfile`).
- Non prova `LocaleFormats` (e' di P1): lo vincola solo con le invarianti marcate «non dimostrato».
