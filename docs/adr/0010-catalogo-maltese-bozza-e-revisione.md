---
title: "ADR 0010 — Catalogo maltese `mt`: bozza con marcatore di revisione, non una traduzione dichiarata completa"
type: decision
status: accepted
theme: Civic
created: 2026-11-26
updated: 2026-11-26
decision-makers: [team front office, revisore madrelingua maltese (da designare)]
catalogue-status: draft
review: pending-native-speaker
issues:
  - "https://github.com/laraxot/theme_civic_fila5/issues/8"
related:
  - ../contracts/i18n-catalog-parity.md
  - 0013-fallback-di-localizzazione-e-parita-dei-cataloghi.md
  - 0011-profili-paese-ente-e-terminologia.md
---

# ADR 0010: catalogo maltese `mt` come bozza con revisione tracciata

Cosa decide: `lang/mt/` esiste, ha le stesse chiavi degli altri cataloghi ed e' sotto test di parita', ma **nessun testo e' stato
rivisto da un madrelingua** e la lingua **non e' abilitata** nel host. Cio' che non era sicuro non e' stato tradotto: porta un
marcatore e il testo inglese. La revisione linguistica richiesta da #8 **non e' stata fatta** e questo ADR non la dichiara fatta.

## Contesto

- #8 chiede «creare e integrare `lang/mt` mantenendo la parita' delle chiavi critiche» e di **non dichiararlo completo finche' i
  contenuti non sono verificati**; il criterio «Flussi guest e autenticati navigabili con locale maltese» richiede un host con `mt`
  abilitato e screenshot reali: ne' l'uno ne' gli altri sono in questo pacchetto.
- Prima del lavoro `lang/` conteneva solo `de en es it`. Durante il lavoro e' comparso `lang/mt/common.php`, un file di una riga
  `return require __DIR__.'/../en/common.php';` (altra sessione, 15:27:55): lo stesso schema per cui `es/auth.php` restava
  in inglese senza errori.
- Fatti verificati: `mcamara/laravel-localization` v2.4.2 con `mt` **commentato** in `config/laravellocalization.php` (riga 131,
  `'regional' => 'mt_MT'`); Carbon ha il locale `mt` (`vendor/nesbot/carbon/src/Carbon/Lang/mt.php`); ICU risponde a `mt_MT`
  (`26 ta’ Novembru 2026`); Laravel conosce la regola di plurale `mt` a quattro forme
  (`Illuminate\Translation\MessageSelector::getPluralIndex`, caso `mt`). `config/civic.php` dichiara gia' `mt` in `supported_locales`
  e `fallback_locale => 'en'`: dice cio' che il tema sa servire, non abilita nulla.
- Misura (`php Themes/Civic/tests/Unit/I18n/Support/lang-parity-report.php`, da `laravel/`): 91 file e 2727 chiavi, come it/en/de/es.

## Driver della decisione

- Non scrivere maltese di cui non si e' sicuri e non lasciarlo sembrare rivisto («contenuti non inventati»).
- La revisione deve avere una lista: un revisore deve poter chiedere «che cosa devo guardare» e avere un comando.
- La parita' delle chiavi deve essere verificabile (e quindi `mt` deve avere tutte le chiavi) senza che questo faccia sembrare
  il catalogo finito.
- Un errore di attivazione (abilitare `mt` troppo presto) deve far diventare rosso un test, non un utente.

## Alternative scartate

- **Non creare `lang/mt` fino a una traduzione completa.** Perde la parita' testabile e la lista di revisione; la traduzione
  completa la puo' fare solo un parlante, quindi il pacchetto resterebbe fermo senza dire che cosa manca.
- **File `mt` che ereditano `en` con `return require ../en/x.php` (lo stub trovato).** Ogni chiave risulta presente per costruzione:
  il test di parita' sarebbe verde su un catalogo vuoto, e non esiste un elenco di cio' che manca. E' il difetto gia' corretto in
  `es/auth.php` e `de|es/header.php`.
- **Traduzione automatica dell'intero catalogo senza marcatore.** Produce valori che sembrano rivisti e non lo sono; la
  correttezza del maltese istituzionale (uffici, atti, termini giuridici) non e' verificabile in questo ambiente.
- **Nessun file `mt` e ripiego `en` a runtime.** A runtime e' corretto, ma `mt` resta fuori dalla parita' e nessuno sa quali testi
  sono tradotti.
- **Registro di revisione in un documento a parte.** Si disallinea dal catalogo al primo commit. Un marcatore dentro il valore
  lo vedono il test, `grep` e il revisore nello stesso posto.

## Decisione

1. **Riferimento: `en`.** Le chiavi e la struttura di `lang/mt/<file>.php` sono quelle di `lang/en/<file>.php`, e il testo dopo il
   marcatore e' l'inglese. Motivi: il ripiego dichiarato per `mt` e' `en` (#8, `config/civic.php`), i traduttori maltesi lavorano
   da inglese, `en` e' completo e non e' italiano. Per i segnaposto `:nome` il riferimento resta `it` (CIVIC-I18N-INV-3).
2. **Cinque regole per foglia, in quest'ordine.** (a) valore vuoto: vuoto; (b) non traducibile (percorso `/...`, URL, icona
   `heroicon-*`, `color`/`icon`, marchi come FixCity o WhatsApp): invariato; (c) testo che compare nel piccolo vocabolario
   d'interfaccia di cui si e' sicuri (Home, Lura, Fittex, Idħol, Servizzi, ...) o nella terminologia `local_council` (`Kunsill Lokali`):
   scritto in maltese; (d) plurale con intervallo (`{1} ...|[2,*] ...`): marcatore in testa a **ogni** forma, per non rompere la
   sintassi di Laravel; (e) tutto il resto: `[[MT-REV]] <testo inglese>`.
3. **Il marcatore e' `[[MT-REV]] ` (costante `LangCatalog::PENDING_MARKER`).** Un testo con il marcatore non e' tradotto o non e'
   sicuro. Un testo **senza** marcatore e diverso da `en` e' una bozza scritta ma non rivista: va rivista anch'essa (comando sotto).
4. **Stato: bozza.** Il frontmatter di questo ADR porta `catalogue-status: draft` e `review: pending-native-speaker`. Cambiano solo
   quando un revisore firma nella story owner di #8; non si cambiano per aver raggiunto la parita' delle chiavi.
5. **Come si revisiona.** Da `laravel/Themes/Civic`: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` elenca i testi da
   tradurre; `--drafted=mt` elenca le bozze non marcate da verificare. Il revisore sostituisce `[[MT-REV]] <inglese>` con il
   maltese rivisto e **toglie il marcatore**; correzioni a una bozza non marcata si fanno sul posto. Plurali: `mt` ha quattro forme
   semplici (1; 0 e 2-10; 11-19; altro); dove il catalogo usa l'intervallo esplicito il revisore adatta le fasce.
6. **Chi decide.** Il revisore madrelingua designato dal progetto o dall'ente (nome ancora da indicare: decisione umana) per
   i testi; il team front office per la procedura. La terminologia istituzionale (nome del Local Council, uffici, atti) e' una
   scelta dell'ente e vive in `lang/*/entity.php` e in `config/local/<tenant>/ente.php`, non nei componenti.
7. **Come si abilita `mt` nel host.** Tutte, nell'ordine: (i) `--pending=mt` elenca 0 testi e il revisore ha firmato anche le bozze
   di `--drafted=mt`; (ii) il ripiego per Paese e' attivo (ADR 0013), altrimenti un tenant maltese ricadrebbe su `it`;
   (iii) il host decommenta `'mt'` in `config/laravellocalization.php`; (iv) screenshot reali con caratteri `ċ ġ ħ ż` e `għ` su
   guest e area personale. Il punto (iii) con (i) non soddisfatto fa fallire CIVIC-I18N-INV-9.
8. **`mt` entra nella parita' stretta** (`civicI18nGuardedLocales()`), perche' ha tutte le chiavi; non entra nella lista delle lingue
   «riviste» (CIVIC-I18N-INV-7), che vieta il marcatore.

## Conseguenze

- Pro: chiavi complete e testate; elenco di revisione generato dal codice; nessun testo inventato presentato come rivisto; un
  host che abilita `mt` troppo presto lo vede subito in un test.
- Contro: oggi la gran parte dei testi `mt` e' inglese dietro un marcatore (misura: `--pending=mt`). Se `mt` venisse abilitato
  prima della revisione, l'utente leggerebbe `[[MT-REV]] ...`: per questo esiste INV-9 e la regola 7.
- Debito: nessun madrelingua ha visto una riga; i criteri di #8 «flussi navigabili in `mt`» e «revisione linguistica» restano
  **NOT MET / NON VERIFICATO**. Il vocabolario scritto a mano (le bozze non marcate, `--drafted=mt`) puo' contenere errori di
  genere, di articolo assimilato (`il-`/`l-`/`ir-`...) o di scelta lessicale.
- Il dato dell'ente (nome del Local Council, indirizzi, contatti, testi legali) resta fuori dal catalogo del tema.

## Conferma

- `cd laravel && bash ../bashscripts/tools/pest-scratch-db.sh Themes/Civic/tests/Unit/I18n/LangParityTest.php` con
  `APP_CONFIG_CACHE=/nonexistent/config.php`: INV-1..6 (parita' di `mt` con le altre quattro), INV-8 (dopo il marcatore c'e'
  l'inglese di `en`), INV-9 (porta di attivazione).
- `php Themes/Civic/tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` e `--drafted=mt`: le due liste del revisore.
- Contratto: [i18n-catalog-parity.md](../contracts/i18n-catalog-parity.md).
