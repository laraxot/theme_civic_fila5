---
title: "ADR 0013 — Parita' dei cataloghi misurata sull'unione delle chiavi; il fallback e' una rete di sicurezza, non un contenuto"
type: decision
status: accepted
theme: Civic
created: 2026-11-26
updated: 2026-11-26
decision-makers: [team front office, lead del progetto per il fallback per Paese nell'host]
issues:
  - "https://github.com/laraxot/theme_civic_fila5/issues/7"
related:
  - ../contracts/i18n-catalog-parity.md
  - 0010-catalogo-maltese-bozza-e-revisione.md
  - 0011-profili-paese-ente-e-terminologia.md
---

# ADR 0013: i cataloghi hanno le stesse chiavi (misurato) e non dipendono dal fallback

Cosa decide: come si definisce e si prova che `lang/it`, `en`, `de`, `es` (e `mt`) dicono le stesse cose; perche' il fallback non basta;
come si sceglie la lingua di ripiego per Paese; come si e' risolto il conflitto di forma di `auth.login`.

## Contesto

- Il traduttore di Laravel, se una chiave manca nella lingua corrente, prova la lingua di ripiego e, se la trova, non segnala nulla.
  Misura nell'ambiente di sviluppo: `php artisan config:show app.fallback_locale` → `it`, `app.locale` → `it` (`config/app.php` ha
  `env('APP_FALLBACK_LOCALE', 'it')`; `.env.example` dice `en`: il valore reale dipende dal `.env` del tenant). Quindi una chiave
  mancante in `en`, `de` o `es` mostra **italiano** a un utente di quella lingua, senza errore e senza chiave grezza.
- Audit iniziale (2026-11-26, confronto con l'unione delle chiavi): chiavi mancanti **it 24, en 83, de 569, es 566**; 25 file interi
  assenti da `de` e da `es`; `es/auth.php` costruito con `array_replace_recursive(en, ...)` (cioe' inglese dove lo spagnolo mancava) e
  `de|es/header.php` con `$base = require en` (12 stringhe inglesi rimaste). Nessun test rosso, nessun log.
- Conflitto di forma: in `it` `auth.login` era annidato (`login.label`, `login.heading`, ...), in `en/de/es` piatto (`login.email`, ...). Un
  confronto per chiave foglia non puo' dire «uguale» fra i due. Gli usi veri (`Modules/User/resources/views/livewire/auth/login.blade.php`,
  test di Cms) citano la forma **piatta**; con la forma annidata `it` restituiva un array o la chiave grezza.
- Il valore `civic.fallback_locale => 'en'` di `config/civic.php` non e' letto da nessun codice (nessun `config('civic.fallback_locale')`
  nel repository); il fallback effettivo e' `app.fallback_locale` (it). `Modules/Lang/config/lang.php` ha un suo `fallback_locale => 'en'`
  anch'esso non collegato al traduttore. La lingua dell'utente e' impostata da `Modules\Cms\Http\Middleware\SetFolioLocale` (`app()->setLocale`).
- Un tenant maltese con fallback `it` mostrerebbe italiano a un utente `mt` dove manca una chiave; con `en` mostrerebbe inglese: e' il
  motivo per cui il fallback dipende dal Paese e non e' globale.

## Driver della decisione

- La parita' deve essere una **misura**: un comando che dice quante chiavi mancano e quali, e un test che diventa rosso se un catalogo ne perde.
- Il fallback resta, ma non puo' nascondere un buco: la prova deve interrogare il traduttore **senza** fallback.
- Nessuna chiave inventata per far tornare un numero: mancanti = tradotte (se non ambigue) o elencate.
- Il confronto non puo' dipendere da quale lingua e' «piu' completa» oggi.

## Alternative scartate

- **Parita' contro `it`.** `it` e' la lingua di redazione ma non ha tutte le chiavi: aveva 24 mancanti presenti in `en`. Confrontare solo con `it` le
  lascerebbe fuori.
- **Parita' per numero di righe o per hash del file.** Falsa: due file diversi possono avere le stesse chiavi e lo stesso file puo' avere le
  chiavi sbagliate; il numero di righe non dice quali.
- **Affidarsi al fallback runtime.** E' esattamente il difetto: nessun errore, il testo e' di un'altra lingua.
- **Un solo test per file lang (un dataset da 91 file).** Il fallimento direbbe un file, non una chiave; il report CLI fa meglio e il test
  per lingua basta come cancello.
- **Generare i cataloghi mancanti con `require en`/`array_replace_recursive`.** Ogni chiave risulta presente per costruzione: e' la forma che ha
  prodotto i buchi invisibili (`es/auth.php`, `de|es/header.php`).
- **Mantenere la forma annidata di `auth.login` in `it` e adattare le altre.** Contro gli usi reali (chiave piatta) e contro tre lingue su quattro.
- **Fallback globale `en` nel config del tema.** Giusto per Malta, sbagliato per l'Italia (dove l'italiano e' il ripiego naturale e l'inglese un
  salto di lingua per un lettore italiano).

## Decisione

1. **Parita' = ogni lingua ha ogni chiave presente in almeno una lingua del gruppo** (unione delle chiavi foglia, forma `file.chiave.sotto`).
   Misura: `php Themes/Civic/tests/Unit/I18n/Support/lang-parity-report.php [--details]` da `laravel/` (esce 1 se c'e' un buco) e il test
   `LangParityTest` (CIVIC-I18N-INV-1..9). Oggi: 91 file, 2728 chiavi per lingua, 0 mancanti, 0 segnaposto diversi.
2. **I segnaposto `:nome` si confrontano con `it`** (lingua di redazione dei messaggi); i plurali con intervallo esplicito (`{1} ...|[2,*] ...`)
   devono avere gli stessi intervalli in ogni lingua (il plurale a barra semplice dipende dalla lingua: `mt` ha quattro forme, le altre due).
3. **Prova senza fallback.** CIVIC-I18N-INV-6 costruisce un `Translator` con `FileLoader` sulla cartella `lang/` e fallback inesistente, e chiede
   `hasForLocale` per ogni chiave dell'unione in ogni lingua: nessun buco nascosto dal ripiego.
4. **Cataloghi espliciti.** Ogni `lang/<locale>/<file>.php` elenca le proprie chiavi. Vietati `require` di un'altra lingua e
   `array_replace_recursive` su un'altra lingua, nei file lang.
5. **`auth.login` ha la forma piatta** in tutte le lingue. Informazione tolta da `it`, dopo verifica che nessuna citazione la leggesse:
   i descrittori annidati (`.label`, `.description`, `.helper_text`, `.placeholder`) di campo, `heading`, `subtitle`
   («Portale digitale del Comune di Fixcity», un nome di tenant nel catalogo) e `register.*` annidato.
6. **Lingua di ripiego per Paese** (da introdurre; non e' in questo pacchetto): `countries.<CC>.fallback_locale` in `config/civic.php` (IT → `it`,
   MT → `en`) e il middleware che imposta la lingua applica `app()->setFallbackLocale()` dal Paese del `CountryProfile`. Il valore globale
   `civic.fallback_locale` si toglie o diventa il ripiego dei Paesi senza voce. `mt` non si abilita nell'host finche' non c'e' (ADR 0010, regola 7).
7. **Il debito che il test non puo' provare** (qualita' della traduzione, non esistenza): l'euristica «valore uguale a it/en» segna
   134 (de) e 118 (es) valori, quasi tutti cognati, marchi e percorsi URL; non e' un cancello, e' una lista di revisione.

## Conseguenze

- Pro: un catalogo che perde chiavi rompe un test con il nome della lingua e della chiave; il fallback non puo' piu' mascherarlo.
- Contro: l'unione implica che aggiungere una chiave in una lingua obbliga a aggiungerla nelle altre quattro (e in `mt` con il marcatore): lo
  scopo, ma anche un costo per chi scrive. `ui.php` ha ancora frasi italiane come chiavi (`'Accedi ai servizi' => ...`) e un orario inventato
  `'Orari: Lun-Ven 9:00-17:00 | Sab 9:00-13:00'`: la parita' non li giudica (sono nel catalogo di tutte le lingue) ma sono dati di tenant dentro un
  catalogo; li elenco nella story, non li tolgo senza conoscere i chiamanti.
- Dodici chiavi citate dalle viste non esistono in nessuna lingua (script di citazione, 846 chiavi `pub_theme::` lette): `accessibility.*` (sei) e
  `a11y.actions` (aggiunta ora in cinque lingue) sono dell'unica partial `partials/accessibility-bar.blade.php`, inutilizzata nel tema;
  `home.hero.eyebrow` e' un testo di tenant che il JSON della home fornisce; `navigation.homepage.rate_` e' un prefisso dinamico; `sitemap.groups`
  e `faq.feedback.*_options` sono array letti come array. Nessuna e' inventata qui.
- La forma piatta di `auth.login` toglie informazione da `it`: e' dichiarato sopra e recuperabile da git.

## Conferma

- `cd laravel/Themes/Civic && php tests/Unit/I18n/Support/lang-parity-report.php --details` → «OK: nessun buco».
- `cd laravel && APP_CONFIG_CACHE=/nonexistent/config.php bash ../bashscripts/tools/pest-scratch-db.sh Themes/Civic/tests/Unit/I18n/LangParityTest.php`.
- Contratto: [i18n-catalog-parity.md](../contracts/i18n-catalog-parity.md).
