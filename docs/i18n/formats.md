---
title: "Formati per Paese: date, indirizzi, telefoni, codici postali"
type: contract
theme: Civic
created: 2026-11-26
updated: 2026-11-26
status: draft
tags: [docs, civic, i18n, formats]
---

# Formati per Paese — issue #17

Implementazione di [ADR 0012](../adr/0012-formati-per-paese.md): le viste **non**
scrivono `d/m/Y`, non concatenano indirizzi, non validano il CAP con `\d{5}`: chiamano
`Themes\Civic\Support\LocaleFormats` con i `formats` del `CountryProfile` corrente.

```php
$profile = CountryProfile::current();            // o ::resolve('MT', config('civic'))
$f = $profile->formats();                        // include 'country_code'
$locale = app()->getLocale();                    // 'it', 'en', 'mt'...

LocaleFormats::formatDate($ticket->created_at, $f, $locale);   // '04/03/2026' (it_IT)
LocaleFormats::formatDateLong($d, $f, $locale);                 // '26 novembre 2026' / '26 ta’ Novembru 2026'
LocaleFormats::formatNumber(1234.5, $f, $locale);               // '1.234,50' / '1,234.50'
LocaleFormats::formatAddress($parts, $f);                       // '1 Main Street, Valletta VLT 1117, Malta'
LocaleFormats::formatPhone('+356 21 234 567', $f);              // '+356 21234567'
LocaleFormats::isValidPhone($input, $f);
LocaleFormats::isValidPostcode('VLT 1117', $f);
LocaleFormats::normalizePostcode('vlt1117', $f);               // 'VLT 1117' (se dichiarato)
```

## Regole (tutte in `config/civic.php`, nessun `match ($country)` nel codice)

| Chiave `formats.*` | IT | MT | Uso |
|---|---|---|---|
| `date` | `dd/MM/yyyy` | `dd/MM/yyyy` | pattern **CLDR** per `IntlDateFormatter` |
| `address_format` | `{street}, {postcode} {locality} ({province}), {country}` | `{street}, {locality} {postcode}, {country}` | template; segmenti vuoti omessi |
| `address_order` | `street,postcode,locality,province,country` | `street,postcode,locality,country` | documentazione dell'ordine |
| `postcode_pattern` | `/^\d{5}$/` | `/^[A-Z]{3}\s\d{4}$/i` | validazione; **CAP = stringa** (lo zero iniziale conta) |
| `postcode_normalize` | `null` | `uppercase_space` | `vlt1117` → `VLT 1117`; senza flag il testo resta potato |
| `phone_country_code` | `+39` | `+356` | prefisso per `normalizePhone`/`formatPhone` |
| `phone_pattern` | `/^(0\d{5,10}|3\d{9})$/` | `/^[2-9]\d{7}$/` | regex sul numero **nazionale** |
| `phone_groups` | `null` | `null` | dimensioni di raggruppamento visuale — **non dichiarate**: attende verifica dal piano di numerazione (ADR 0012, conseguenza d) |

## Date e numeri — PHP Intl, non `date()`

- Locale di formattazione = **`<lingua>_<PAESE>`** (`it_IT`, `en_IT`, `de_IT`, `es_IT`,
  `en_MT`, `mt_MT`): la lingua e' quella UI, il Paese quello del profilo.
  Mai `en` da solo (data americana); mai la sola lingua se il Paese e' noto.
- `formatDate` usa `IntlDateFormatter` col pattern CLDR di `formats.date`;
  `formatDateLong` gli stili ICU `LONG`/`MEDIUM`. Senza Intl (o se non formatta)
  ricade sul sottoinsieme numerico — degrado dichiarato, non sostituto.
- `formatNumber` usa `NumberFormatter` della stessa coppia: separatori e posizione
  del simbolo valuta sono dato ICU (la miscela `en_IT` e' voluta, non corretta).
- L'ora usa il fuso dell'applicazione.

## Telefoni

- `normalizePhone`: cifre + `+`; toglie `phone_country_code` se c'e'.
- `isValidPhone`: `phone_pattern` se dichiarata, altrimenti 4-15 cifre (E.164).
- `formatPhone`: `+<prefisso> <nazionale>`; `phone_groups` raggruppa se dichiarato,
  altrimenti il numero resta unico. Non valido → input potato, mai inventato.

## Indirizzi

`formatAddress` esplode `address_format` su `,`, sostituisce `{street}` `{housenumber}`
`{locality}` `{postcode}` `{province}` `{country}` e scarta segmenti vuoti (niente
`()`). Le etichette dei campi sono chiavi di catalogo.

## Punti di integrazione per le view (owner: view — NON editati)

| File | Oggi | Da fare |
|---|---|---|
| `resources/views/components/ticket-card.blade.php` ~21 | `d/m/Y` fisso | `LocaleFormats::formatDate($d, $f, app()->getLocale())` |
| `resources/views/components/data-display/table.blade.php` ~198-201 | `d/m/Y` + `number_format` | `formatDate` + `formatNumber` |
| `resources/views/components/forms/date-picker.blade.php` ~461-473 | formato fisso | idem |
| `components/blocks/ticket-list/results-header.blade.php` ~15 | `number_format` | `formatNumber` |
| footer/contatti | stringa HTML con CAP italiano | `formatAddress` da parti del tenant |
| validazione input CAP/telefono | `\d{5}` / assente | `isValidPostcode`/`isValidPhone` col profilo |

## Test

- `tests/Unit/Support/LocaleFormatsTest.php` (13 test, senza app): date ICU it/de,
  `formatDateLong` it/mt («Novembru»), `formatNumber` it/mt, indirizzi IT/MT,
  CAP `VLT 1117`/`vlt1117`/`00100`, telefoni `+356`/`+39`, `phone_groups` opzionale,
  regola maltese che NON corre col profilo italiano.
- `tests/Unit/I18n/CountryFormatsTest.php` (altro pacchetto, con TestCase):
  INV-13/14/15/16 — copertura coppie lingua-Paese, Intl, separatori, CAP stringa.

## Fuori scope / da fare

- `Modules/Geo` `AddressData::$postal_code` e `GetAddressFromPhotonAction`: devono
  diventare `string` (oggi `?int`/`SafeIntCast` corrompono `00100` e `VLT 1117`).
  Richiesta registrata nel test INV-16 (si attiva da solo quando Geo cambia).
- Raggruppamento telefoni IT/MT: da verificare su fonte ufficiale (MCA per Malta)
  o con `libphonenumber` se approvato — poi dichiarare `phone_groups` in config.
- `dd/MM/yyyy` per MT e' conservativo: confermare con il committente maltese.
