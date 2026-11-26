---
title: "ADR 0011 — Profili Paese/ente e terminologia istituzionale in `lang/<locale>/entity.php`"
type: decision
status: accepted
theme: Civic
created: 2026-11-26
updated: 2026-11-26
decision-makers: [team front office, referente dell'ente per il nome in de/es del Local Council]
issues:
  - "https://github.com/laraxot/theme_civic_fila5/issues/6"
related:
  - ../contracts/i18n-entity-terminology.md
  - 0010-catalogo-maltese-bozza-e-revisione.md
  - 0013-fallback-di-localizzazione-e-parita-dei-cataloghi.md
---

# ADR 0011: la terminologia dell'ente e' un profilo per Paese, in `lang/`, non un testo in config

Cosa decide: come il tema chiama «il Comune» in Italia e «il Local Council» a Malta senza scrivere l'una o l'altra parola nei
componenti. Un profilo e' un insieme chiuso di 13 termini gia' composti (con articolo e preposizione), uguale in ogni lingua;
il profilo si sceglie dal Paese del tenant; il **nome** dell'ente resta un dato del tenant.

## Contesto

- Misura (2026-11-26, dopo la parita' di #7): fuori da `entity.php` i cataloghi hanno **57** testi `it` che dicono «comune/Comuni»,
  **57** `en`, **69** `de`, **57** `es` con municipality/council/Gemeinde/Ayuntamiento (conteggio fissato come debito da
  CIVIC-I18N-INV-12). Esempi: `footer_blocks` «© :year Comune di Example», `flow_report` «Contatta il comune»,
  `components_tickets_list`. Un tenant maltese li mostrerebbe cosi' com'e'.
- `config/civic.php` (P1) dichiara per Paese `entity.singular/plural` come **testi letterali** («Comune»/«Comuni»,
  «Local Council»/«Local Councils»). `Themes\Civic\Support\CountryProfile::entityName()` li restituisce, o `names[<locale>]` se esiste.
  Sono in lingua unica (inglese per Malta), senza `del/al/il tuo`, senza genere, senza plurale grammaticale.
- Le forme cambiano con lingua e genere: it «del Comune» / «al Comune» (maschile), «della Citta'» (femminile); mt «tal-Kunsill Lokali»
  / «lill-Kunsill Lokali» (articolo assimilato); de «der Gemeinde» (dativo); es «del Ayuntamiento». Concatenare `'del '.$nome` e' sbagliato
  in almeno tre delle cinque lingue.
- Il nome proprio dell'ente («Comune di Fixcity», «Birkirkara Local Council») e' gia' dato del tenant: `config/local/<tenant>/ente.php`,
  chiave `name` (nel tenant attuale tutte le chiavi sono vuote: nessun dato inventato).
- Il capo di un Local Council maltese e' un Mayor (in maltese Sindku): «Sindaco», «Bürgermeister», «Alcalde» ne sono rese corrette e non
  sono un'infiltrazione del lessico italiano (il test CIVIC-I18N-INV-11 lo ammette per `local_council`).

## Driver della decisione

- Un componente non contiene mai la parola «Comune» ne' «Local Council»: aggiungere un terzo Paese non tocca viste ne' blocchi.
- Le forme grammaticali stanno nel catalogo, dove le rivede un traduttore, non in PHP.
- Ogni lingua ha gli stessi termini in ogni profilo, e il test lo prova.
- Il debito esistente (57 testi scritti a mano) non deve crescere mentre si migra.
- Nessuna dipendenza nuova.

## Alternative scartate

- **Testi letterali in `config/civic.php` (`entity.singular/plural`), com'e' ora.** Una lingua sola, nessuna forma grammaticale,
  non rivedibile da un traduttore, e il config e' per tenant mentre la lingua e' per utente.
- **Concatenazione nelle viste (`'del '.$ente`, `__('di').' '.$ente`).** Rompe it (femminile, preposizioni articolate), mt (articolo
  assimilato), de (casi) e es (`del`/`de la`). Il tentativo si e' gia' visto: 57 testi con «Comune» dentro la frase.
- **Segnaposto `:entity` dentro ogni frase.** Risolve il nome ma non articolo, preposizione e genere (`:entity` = «Comune» o «Citta'
  metropolitana» cambia l'accordo), e obbliga a riscrivere ogni chiamata e ogni testo insieme.
- **Un catalogo per Paese (`lang/it-IT/`, `lang/mt-MT/`).** Moltiplica le cartelle per combinazione lingua-Paese (it-IT, en-IT,
  de-IT, es-IT, en-MT, mt-MT), mentre Laravel e mcamara caricano per lingua. Il Paese cambia 13 termini, non 2.728 chiavi.
- **Terminologia nei dati del tenant (`ente.php`).** Tutta in lingua unica e fuori dalla revisione linguistica; va bene per il nome,
  non per «Uffici comunali» che deve esistere in quattro lingue.
- **Profilo per ogni Paese possibile (UE, 27).** Speculativo: i profili esistenti sono quelli dei Paesi serviti dalla roadmap; `generic`
  copre il resto finche' un nuovo Paese non e' deciso.

## Decisione

1. **Profili.** `lang/<locale>/entity.php` contiene `profiles.<id>.<termine>` per `generic` (ripiego neutro), `comune` (Italia),
   `local_council` (Malta). Chiamata: `__('pub_theme::entity.profiles.<id>.<termine>')`.
2. **Tredici termini, chiusi, uguali in ogni profilo e lingua:** `name`, `name_plural`, `of`, `to`, `your`, `offices`, `services`,
   `administration`, `head`, `contact_cta`, `reports_of`, `portal`, `territory`. Ogni termine e' una forma gia' composta; i
   componenti non concatenano mai articolo e nome. Un termine nuovo si aggiunge a tutti i profili e a tutte le lingue nello stesso
   commit (INV-10).
3. **Selezione dal Paese.** Il profilo si ricava da `countries.<CC>.entity_profile` (chiave da introdurre in `config/civic.php`, vedi
   «Richieste ai pacchetti» della story) risolta dal Paese corrente di `CountryProfile`. Profilo mancante o sconosciuto: `generic`, mai
   `comune`. Un Paese sconosciuto ricade sul Paese predefinito del tenant (comportamento gia' in `CountryProfile::resolve`).
4. **Il nome dell'ente non e' terminologia.** «Comune di Fixcity» / «Birkirkara Local Council» e' `config/local/<tenant>/ente.php`.
5. **I termini non mescolano Paesi.** Il profilo `generic` e `comune` non contengono «Local Council/Kunsill»; `generic` non contiene
   comune/provincia/municipality; `local_council` non contiene comune/provincia/Gemeinde/Ayuntamiento (INV-11).
6. **Debito dei testi scritti a mano.** I 57/57/69/57 testi non si riscrivono in questo pacchetto: ogni testo nuovo usa il profilo e il
   numero non puo' salire (INV-12). La riscrittura riguarda anche le viste che chiamano quelle chiavi ed e' una storia a parte.
7. **Voci non applicabili a un Paese** (es. `province` a Malta) si tolgono dal profilo solo insieme alle altre lingue; non si inventa una
   resa.
8. **Maltese.** I termini `local_council` in `mt` sono tra i pochi testi `mt` scritti senza marcatore: restano bozza non rivista
   (ADR 0010, `--drafted=mt`).

## Conseguenze

- Pro: un terzo Paese = un profilo + una riga di config; la grammatica e' rivedibile per lingua; il debito e' fermo.
- Contro: finche' P1 non introduce `entity_profile` e un accessore, il catalogo e' pronto e **non e' ancora letto da nessun
  componente**: oggi il tema usa i letterali di config e i testi scritti a mano. Il criterio di #6 «terminologia istituzionale
  non hardcoded» e' quindi **NOT MET** nei componenti e **MET** nel catalogo.
- `de` ed `es` usano «Local Council» (nome ufficiale inglese) per il profilo maltese: non esiste una resa de/es ufficiale che io
  possa verificare; e' una decisione dell'ente o del traduttore, non mia.
- Aggiungere un Paese non traduce il suo profilo: l'`generic` copre l'interim ma e' piu' vago («Ente locale»).

## Conferma

- Test, da `laravel/` con `APP_CONFIG_CACHE=/nonexistent/config.php bash ../bashscripts/tools/pest-scratch-db.sh
  Themes/Civic/tests/Unit/I18n/LangParityTest.php`: CIVIC-I18N-INV-10 (stessi profili e stessi 13 termini in 5 lingue), INV-11 (nessun
  lessico di un altro Paese), INV-12 (debito che non cresce).
- Il debito corrente: `php Themes/Civic/tests/Unit/I18n/Support/lang-parity-report.php --details` non lo conta; lo conta INV-12 (baseline
  nel test).
- Contratto: [i18n-entity-terminology.md](../contracts/i18n-entity-terminology.md).
