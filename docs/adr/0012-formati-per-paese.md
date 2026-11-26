---
title: "ADR 0012 — Formati per Paese: date, numeri, indirizzi, telefoni e codici postali"
type: decision
status: proposed
theme: Civic
created: 2026-11-26
updated: 2026-11-26
decision-makers: [team front office, referente tecnico per le dipendenze]
issues:
  - "https://github.com/laraxot/theme_civic_fila5/issues/9"
  - "https://github.com/laraxot/theme_civic_fila5/issues/17"
related:
  - ../contracts/i18n-country-formats.md
  - 0011-profili-paese-ente-e-terminologia.md
---

# ADR 0012: i formati dipendono dalla coppia lingua-Paese e si calcolano con PHP Intl; telefoni e indirizzi con dati in config

Stato: **proposta** (design di #9 e #17, nessun codice in `app/` scritto da questo pacchetto). Cosa decide: con quale strumento si formatta
cosa, e quali regole stanno in dati e non in codice. Contiene tre fatti misurati che correggono l'implementazione che P1 sta scrivendo
in `app/Support/LocaleFormats.php`: li elenco in «Conseguenze» e nella story (richieste a P1).

## Contesto

- `config/civic.php` (P1) fissa per Paese (IT, MT) `formats.date` (`dd/MM/yyyy`), `address_order`, `postcode_pattern`,
  `phone_country_code`. `Themes\Civic\Support\CountryProfile` li espone; `Themes\Civic\Support\LocaleFormats` (stesso pacchetto) li applica.
- **PHP Intl e' installato** (ICU 78.2): `IntlDateFormatter` e `NumberFormatter` rispondono per tutte le coppie del tema. Misura
  (data 26 novembre 2026, 1234567.89, 12,5 EUR; `php -r` con `IntlDateFormatter` e `NumberFormatter`):

  | locale ICU | data lunga | data `dd/MM/yyyy` | numero | valuta |
  | :--- | :--- | :--- | :--- | :--- |
  | `it_IT` | 26 novembre 2026 | 26/11/2026 | 1.234.567,89 | 12,50 € |
  | `en_IT` | 26 November 2026 | 26/11/2026 | 1.234.567,89 | €12.50 |
  | `de_IT` | 26. November 2026 | 26/11/2026 | 1.234.567,89 | 12,50 € |
  | `es_IT` | 26 de noviembre de 2026 | 26/11/2026 | 1.234.567,89 | 12,50 € |
  | `mt_MT` | 26 ta’ Novembru 2026 | 26/11/2026 | 1,234,567.89 | €12.50 |
  | `en_MT` | 26 November 2026 | 26/11/2026 | 1,234,567.89 | €12.50 |
  | `en` (senza Paese) | November 26, 2026 | 26/11/2026 | 1,234,567.89 | €12.50 |

  Con `en` senza Paese la data lunga e' all'americana; `en_IT` mescola separatori italiani nel numero e simbolo inglese nella valuta.
- **Non installati** (`composer.lock`, 0 occorrenze): `giggsey/libphonenumber-for-php`, `propaganistas/laravel-phone`, `brick/phonenumber`,
  `commerceguys/addressing`, `symfony/intl`, `league/iso3166`. Una dipendenza nuova e' una decisione umana.
- Il codice postale oggi e' un intero nel dominio indirizzi: `Modules/Geo/app/Actions/Photon/GetAddressFromPhotonAction.php:61`
  (`SafeIntCastAction::cast($photonData->postcode ?: 0)`) e `Modules/Geo/app/Datas/Geocoding/AddressData.php:20` (`?int $postal_code`).
  In PHP `(int) "VLT 1117"` e' `0` e `(int) "00100"` e' `100`: un CAP italiano con zero iniziale e ogni codice maltese diventano un numero
  sbagliato. Il campo del database e' `string(20)`.
- Carbon 3.15.1 ha il locale `mt`, ma formatta con lettere di `date()` e file di traduzione propri; non applica regole ICU e non
  conosce il genitivo maltese `ta’`.
- Misura di `LocaleFormats` (chiamate dirette, 2026-11-26): `formatDate('2026-11-26', ['date' => 'd MMMM yyyy'])` restituisce
  `26 1111 2026`; con `dd MMM yyyy` restituisce `26 11Nov 2026`. `phpDateFormat()` traduce solo `yyyy yy MM dd HH mm`; il resto dei token
  CLDR passa a `date()` con altro significato, e `date()` non e' localizzata. `normalizePostcode('vlt1117', <profilo IT>)` restituisce
  `VLT 1117`: la regola maltese gira anche con il profilo italiano. `formatPhone('+356 7921 2345', <profilo MT>)` restituisce
  `+356 79 212 345` mentre il commento nel codice promette `+356 7921 2345`.

## Driver della decisione

- Un formato e' funzione di **lingua dell'utente** e **Paese del tenant**, non di uno solo (un lettore inglese a Malta e uno a Roma).
- Usare cio' che e' installato e testato (Intl) prima di scrivere una libreria.
- Le regole specifiche di un Paese stanno in dati (config), non in `match ($country)` dentro una classe condivisa.
- Un dato non valido non si «corregge» con un'invenzione: si mostra l'input potato.
- Nessuna dipendenza senza decisione umana.

## Alternative scartate

- **`date('d/m/Y')` e concatenazioni nelle viste.** E' il difetto che #17 vuole togliere; e' anche quello che `LocaleFormats::formatDate` riproduce
  oltre il formato numerico.
- **Carbon `translatedFormat`.** Funziona per it/en/de/es ma non per `ta’` maltese ne' per ordine e separatori per Paese; e' il motore del
  locale dell'applicazione, non del Paese del tenant.
- **Tabella `strtr` da CLDR a `date()` (l'implementazione attuale).** Copre due pattern: i nomi dei mesi diventano numeri o inglese. Va
  estesa a ogni token o, meglio, sostituita da ICU che gia' li conosce.
- **`libphonenumber-for-php` subito.** Dato completo e aggiornato per ogni numerazione, ma e' una dipendenza nuova di dimensione non
  trascurabile e di manutenzione continua, per due Paesi serviti. Resta l'opzione consigliata se i Paesi crescono o la precisione serve
  (vedi «Conferma»).
- **`commerceguys/addressing`.** Formati di indirizzo per ogni Paese, ma stessa obiezione; per IT e MT bastano ordine e CAP.
- **CAP come intero.** Perde lo zero iniziale e le lettere; il database lo ha gia' stringa.
- **Un solo formato per tutti (quello italiano).** E' lo stato attuale implicito delle viste.

## Decisione

1. **Locale di formattazione = `<lingua>_<PAESE>`.** Lingua dell'interfaccia, Paese del `CountryProfile` corrente: `it_IT`, `en_IT`, `de_IT`, `es_IT`,
   `en_MT`, `mt_MT`. Mai `en` da solo (data americana); mai la sola lingua se il Paese e' noto. Se ICU non conosce la coppia usa la lingua
   (`es_IT` di fatto risolve su `es`: accettato).
2. **Date e orari: `IntlDateFormatter`** con il pattern CLDR di `formats.date` (numerico, `dd/MM/yyyy` per IT e MT) e gli stili ICU
   (`LONG`, `MEDIUM`) per le date discorsive. Fuso: quello dell'applicazione. `LocaleFormats::formatDate` si riscrive sopra Intl.
3. **Numeri e valute: `NumberFormatter`** con il locale della coppia. La posizione del simbolo e i separatori sono quelli ICU, non si
   sovrascrivono (cioe' `en_IT` mantiene la sua miscela: e' dato ICU, non scelta del tema).
4. **Indirizzi: l'ordine e' un dato** (`formats.address_order` e/o `address_format`), le etichette dei campi sono chiavi di catalogo; i segmenti
   vuoti si omettono. La provincia compare solo nei profili che la dichiarano (a Malta no).
5. **Codice postale: stringa ovunque**, dal geocoding al database alla vista. Validazione con `formats.postcode_pattern`; normalizzazione
   (maiuscole e spazio, es. `vlt1117` → `VLT 1117`) **solo se il profilo la dichiara** (`formats.postcode_normalize`), non per un Paese cablato.
6. **Telefoni: dato per Paese in config** (`phone_country_code`, `phone_pattern` per il numero nazionale, `phone_groups` per la
   visualizzazione). Il numero si conserva in forma normalizzata (cifre e `+`); la visualizzazione e' di `LocaleFormats::formatPhone`; un
   numero non valido si mostra potato, mai corretto. Nessuna libreria finche' non decisa.
7. **Niente `match ($country)` in classi condivise.** Le regole di IT e MT oggi dentro `LocaleFormats` (`isValidPhone`, `formatPhone`,
   `normalizePostcode`, `isMaltaPostcode`) si spostano in `config/civic.php` alla chiave del Paese.
8. **Nessuna dipendenza aggiunta da questo ADR.** Se si decide `libphonenumber`, la sostituzione e' interna a `LocaleFormats` e ai contratti dei
   suoi metodi.

## Conseguenze

- Pro: date discorsive corrette in maltese e nelle altre lingue senza tabelle scritte a mano; un terzo Paese e' dato, non codice; il CAP
  non si corrompe.
- Contro: ICU e i suoi dati sono la fonte (una versione diversa di ICU puo' cambiare una virgola o un apostrofo: i test controllano solo parole e
  separatori, non la stringa intera).
- Cosa serve **dopo P1** (richieste a P1 e Geo, elencate nella story): (a) `LocaleFormats::formatDate` su Intl; (b) regole IT/MT in config e
  fuori dalle classi; (c) `AddressData::$postal_code` e `GetAddressFromPhotonAction` a stringa, con migrazione dei test Geo; (d) correggere
  il raggruppamento `formatPhone` di Malta o toglierlo (non e' verificato quale sia quello giusto: serve il piano di numerazione dell'autorita'
  maltese o `libphonenumber`); (e) test dei contratti sui nuovi metodi.
- Debito: raggruppamento dei numeri maltesi e italiani non verificato contro una fonte; `es_IT` ricade su `es`.
- I criteri di #9 e #17 che chiedono codice (helper usati dalle viste, test su CAP/telefoni) sono **NOT MET** da questo pacchetto per costruzione
  (design-only) e dipendono da P1.

## Conferma

- `cd laravel && APP_CONFIG_CACHE=/nonexistent/config.php bash ../bashscripts/tools/pest-scratch-db.sh
  Themes/Civic/tests/Unit/I18n/CountryFormatsTest.php`: CIVIC-I18N-INV-13 (Intl conosce ogni coppia), INV-14 (stessa data numerica per
  tutte le coppie, mese parlato corretto), INV-15 (separatori per Paese), INV-16 (CAP come stringa: dove l'intero lo rompe).
- Contratto: [i18n-country-formats.md](../contracts/i18n-country-formats.md).
