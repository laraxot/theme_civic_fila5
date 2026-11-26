---
title: "Copertura traduzioni it/en/de/es e mt — audit e fallback"
type: report
theme: Civic
created: 2026-11-26
updated: 2026-11-26
status: draft
tags: [docs, civic, i18n, audit]
---

# Copertura traduzioni — issue #7

Misura riproducibile dei cataloghi `lang/` del tema. Comando (da `laravel/`):

```bash
php Themes/Civic/tests/Unit/I18n/Support/lang-parity-report.php --details
```

## Stato misurato (2026-11-26)

| Lingua | File | Chiavi | Chiavi mancanti | File mancanti | Segnaposto errati | Da revisionare |
|---|---|---|---|---|---|---|
| it | 91 | 2728 | 0 | 0 | — (riferimento) | 0 |
| en | 91 | 2728 | 0 | 0 | 0 | 0 |
| de | 91 | 2728 | 0 | 0 | 0 | 0 |
| es | 91 | 2728 | 0 | 0 | 0 | 0 |
| mt | 91 | 2728 | 0 | 0 | 0 | 2098 (`[[MT-REV]]`) |

- **it/en/de/es: parita' totale** sulle 2728 chiavi. L'audit iniziale della sessione
  trovava 539 chiavi mancanti in de/es e 25 file assenti (enum `*_enum`, `segnalazione`,
  `ticket`, `ui`, `footer`): colmati nello stesso ciclo di lavoro.
- **mt: struttura completa, testo in bozza.** 2098 testi portano il marcatore
  `[[MT-REV]]` e ripetono l'inglese; 630 sono gia' in maltese o non richiedono
  traduzione. Nessun file o chiave mancante: il fallback `en` funziona per copertura.
- Le differenze di qualità linguistica (registro, terminologia) non sono misurate dai
  test: vedi `01-glossario.md` e la revisione professionale pendente per `mt`.

## Convenzioni delle chiavi

- File per area: `navigation`, `ui`, `common`, `auth*`, `flow_*` (wizard),
  `components_*`, `*_enum` (etichette enum), `entity` (terminologia ente — vedi
  `country-profiles.md`).
- Chiavi in italiano sorgente in `it` (es. `'Annulla' => 'Annulla'`): `en`/`de`/`es`/`mt`
  mantengono la STESSA chiave e traducono il valore. Non "correggere" la chiave: e' il
  contratto di parita'.
- `:segnaposto` e intervalli di plurale `{1}|[2,*]` devono restare identici fra lingue
  (verificato dai test INV-3/INV-4).

## Testi hardcoded nelle view (fuori dai file lang)

Trovati con grep su `resources/views/**/*.blade.php` (esclusi `pages_old*`, `templates`
demo e contenuto di esempio dei componenti). **Non modificati: le view sono di un altro
owner — elenco per il follow-up.**

| File | Testo | Note |
|---|---|---|
| `components/feedback/notifiche.blade.php:252-297` | "È disponibile una nuova versione…", "Il campo email è obbligatorio", "La password deve essere di almeno 8 caratteri", "I tuoi dati sono in fase di elaborazione…" | messaggi utente in italiano fisso |
| `components/data-display/callout.blade.php:219-272` | "Il servizio sarà temporaneamente non disponibile…", "Servizi Online", "Area Personale" | esempi/default del componente |
| `components/media/rating.blade.php:258-361` | "Invia valutazione", "Grazie per la tua valutazione!", "Mario Rossi" | etichette e dati demo |
| `components/footer-comune.blade.php:101-102` | "Comune di Nome Comune", "Via Roma 123, 00100 Nome Comune (RM)" | placeholder del footer: conteggia per Malta se non diventa dinamico |
| `templates/landing.blade.php` | "Informazioni sul Servizio", "Domande Frequenti", "Hai trovato utile questo servizio?" | template statico |
| `templates/home.blade.php:49` | "Servizi digitali per i cittadini" | tagline hardcoded |
| `components/ui/service-card.blade.php:469`, `components/layout/sections/hero.blade.php:162-163` | "Contenuto personalizzato…", "Azione custom" | testo demo slot |
| `pages_old*/`, `components/ui/hero.blade.php`, `components/ui/accordion.blade.php`, `components/utilities/ui/accordion.blade.php`, `livewire/toast.blade.php` | demo/template | da verificare se il file e' servito |

## Fallback: regole effettive

| Livello | Regola | Evidenza |
|---|---|---|
| Chiavi `__()`/`trans()` | `app.fallback_locale = it` (`laravel/config/app.php:137`, env `APP_FALLBACK_LOCALE`) | chiave mancante → italiano, mai errore |
| Catalogo tema | namespace `pub_theme` + `civic` (`ThemeServiceProvider.php:107-112`) | `loadTranslationsFrom` |
| URL/locale | prefisso `/it|en|de|es` obbligatorio (`hideDefaultLocaleInURL=false`); `mt` NON e' servito: manca in `supportedLocales` di `laravellocalization.php` | config host, fuori tema |
| Contenuti CMS | Spacy `getTranslation` ricade su `it` | `Modules/Cms HasBlocks` |
| Scelta tenant | `civic.fallback_locale = en` in `config/civic.php` e' un default del TEMA per i profili paese, non il fallback Laravel | vedi `country-profiles.md` |

**Conseguenza:** `mt` e' completo come catalogo ma non raggiungibile via URL finche'
l'host non abilita la lingua (attivazione = decisione umana, non del tema).

## Da fare (fuori scope file lang)

1. `[ATTESA-UMANO]` Abilitare `mt` in `laravellocalization.php` + revisione linguistica
   dei 2098 testi marcati.
2. Esternalizzare i testi hardcoded della tabella sopra in chiavi `pub_theme::`/`civic::`
   (owner: chi possiede le view — non fatto qui di proposito).
3. Verificare `pages_old*/` e `templates/` non serviti; se serviti, stessa regola.
