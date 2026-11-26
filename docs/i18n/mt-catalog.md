---
title: "Catalogo maltese mt: stato, marcatore di revisione, abilitazione"
type: reference
theme: Civic
created: 2026-11-26
updated: 2026-11-26
status: draft
tags: [docs, civic, i18n, maltese]
---

# Catalogo maltese `mt` — issue #8

`lang/mt/` ha la stessa struttura di `lang/en` (91 file, 2728 chiavi): copertura
completa, testo in **bozza**. La convenzione e' nel contratto
`02-catalog-parity.md`.

## Marcatore `[[MT-REV]] `

Ogni testo non verificato comincia per `[[MT-REV]] ` seguito dal testo inglese:

```php
'new_report' => ['label' => '[[MT-REV]] New report'],
```

- Conteggio: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt`
  (da `laravel/`) → 2098 al 2026-11-26; 630 voci sono gia' maltese o non richiedono
  traduzione (nomi propri, sigle, URL, valori identici).
- La revisione **toglie il prefisso**, non riscrive la chiave.
- `tests/Unit/I18n/MtCatalogTest.php` fissa il contratto: file/chiavi = `en`, nessun
  orfano, segnaposto `:nome` identici, nessuna frase inglese senza marcatore.

## Cosa e' gia' tradotto (esempi)

`common.navigation` (Paġna ewlenija, Kuntatt, Informazzjoni), `navigation.main`
(Navigazzjoni ewlenija), `services`, `news` (Aħbarijiet), `footer`, `entity.php` —
la bozza contiene maltese reale, non solo inglese marcato. La qualita' non e'
verificata: serve un madrelingua ( Maltese ) per l'approvazione.

## Terminologia da confermare in revisione

- "Local Council" → `Kunsill Lokali` (uso consolidato, ma verificare il nome
  ufficiale per il singolo ente: "Kunsill Lokali ta' …").
- "report/segnalazione" → `rapport`/`segnalazzjoni`? bozza usa `rapport`; il flusso
  "segnalazione disservizio" va allineato al glossario.
- "personal area" → `area personali`; "services" → `servizzi` (ok).
- Marchi e istituti italiani (SPID, CIE, PEC, AGID, IPA) **non esistono a Malta**:
  le voci che li citano in `mt` vanno riscritte come equivalenti locali o rimosse
  dal profilo `local_council` — non tradotte alla lettera.

## Abilitazione (non fatta, decisione umana)

1. `mt` NON e' in `supportedLocales` di `laravel/config/laravellocalization.php`
   (config host): le rotte `/mt/...` non esistono ancora.
2. Il test `LangParityTest` include "does not enable mt in the host while mt texts
   are still marked for review": l'attivazione e' bloccata finche' `pending` > 0.
3. Da fare prima dell'enable: revisione linguistica completa, `pending` = 0,
   `mt` aggiunto a `supportedLocales` + `SetFolioLocale`/menu lingue del tenant,
   verifica font (ġ, ħ, ż, ħ̌) nel tema.
4. Plurali: maltese ha 4 forme (`MessageSelector`); gli intervalli espliciti
   `{1}|[2,*]` sono gia' garantiti dal test INV-4.

## Smoke test previsto (dopo revisione)

- `/mt` home, `/mt/tickets/create` (wizard), `/mt/tickets`, login — con dati
  sintetici di un Local Council maltese (vedi `malta-local-councils.md`).
