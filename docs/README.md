---
title: "Civic — stato tecnico e guida alla documentazione"
type: readme
tags: [documentation, civic, migration, architecture]
created: 2026-09-26
updated: 2026-11-26
qmd: "Civic theme Italy Malta Sixteen migration current state architecture build localization"
issues: []
discussions: []
status: active
---

# Civic — guida tecnica

Questa è la **porta d'ingresso tecnica** di `laraxot/theme_civic_fila5`. Il [README principale](../README.md) presenta obiettivi e funzionalità; la [presentazione inglese](./readme-en.md) descrive l'ambito internazionale. Questo file è anche l'**indice unico** della documentazione: la sezione «Catalogo completo» in fondo elenca ogni documento di `docs/`. I percorsi e le verifiche ereditati da Sixteen non devono essere considerati automaticamente aggiornati per Civic.

## Stato del repository al 26 novembre 2026

| Area | Situazione osservata | Azione necessaria |
| --- | --- | --- |
| Repository | `laraxot/theme_civic_fila5`, branch `dev` | Mantenere il lavoro su `dev` |
| Composer | Nome `laraxot/theme_sixteen_fila5`, autoload `Themes\Sixteen`, provider `Themes\Sixteen\Providers\ThemeServiceProvider` | Migrare metadati, namespace e provider, controllando i riferimenti PHP |
| Manifest tema | `theme.json` dichiara `name: Sixteen`, alias e URL legacy | Definire e verificare gli identificatori Civic |
| Frontend | `package.json` dichiara `name: sixteen` | Rinominare il package e aggiornare i contratti dipendenti |
| Asset | `vite.config.js` usa `base: /themes/Sixteen/` e `outDir: ./public` | Coordinare nuovi URL, webroot e manifest con l'host |
| Localizzazione | Directory `lang/it`, `lang/en`, `lang/de`, `lang/es` | Verificare copertura; aggiungere `lang/mt` per Malta |
| Suite di test | Script npm presenti, cartella `tests/` presente | Eseguire la suite in ambiente completo e registrare gli esiti |
| Design e accessibilità | Materiali Design Comuni e documenti di audit storici | Validare per Civic; non dichiarare automaticamente conformità |

Questo è un **audit statico del repository**, non una prova di installazione, test passati o attivazione del tema. La documentazione preesistente si riferisce spesso al runtime di Sixteen nel vecchio progetto e può indicare conteggi, route o configurazioni datati.

## Architettura di riferimento

### 1. Rendering pubblico

- Blade, Folio/Volt e componenti riutilizzabili compongono le pagine.
- Il layout ereditato è in [`resources/views/components/layouts/app.blade.php`](../resources/views/components/layouts/app.blade.php).
- Le view del CMS consumano contenuti e contratti dei moduli; non devono duplicare la logica applicativa.
- L'applicazione ospitante sceglie il tema pubblico e gestisce routing, tenant, CMS e deployment.

### 2. Confine con i moduli Laraxot

- **Nel tema:** layout, viste, UI, stato presentazionale, formattazione, asset e componenti grafici.
- **Nei moduli owner:** modelli, validazione di dominio, persistenza, autorizzazioni, notifiche e Queueable Actions.
- Gli eventuali controller e le rotte presenti nel codice importato devono essere inventariati prima di modifiche: non assumere che siano registrati a runtime.

### 3. Italia / Malta

Un unico tema Civic deve supportare terminologie e percorsi localizzati:

| Aspetto | Italia | Malta |
| --- | --- | --- |
| Ente locale | Comune | Local Council |
| Lingue principali del prodotto | `it`, `en` | `en`, `mt` (**mancante oggi**) |
| Riferimenti UI | Designers Italia / Modello Comuni, dove pertinente | Requisiti e terminologia maltesi da analizzare |
| Configurazioni | Branding, servizi, uffici, privacy dell'ente | Branding, servizi, uffici, privacy dell'ente |

Non imporre il modello del Comune italiano ai Local Councils maltesi. Evitare testi fissi nelle Blade: preferire chiavi di lingua e configurazioni dell'ente. L'eventuale conformità a standard nazionali o di accessibilità richiede verifica per ciascun contesto.

## Build e qualità

Gli script dichiarati in [`package.json`](../package.json) sono:

```bash
npm install
npm run build
npm test
npm run lint
# In sviluppo, separatamente: npm run dev
```

`npm run build` richiama preparazione degli asset statici, Vite e rimozione di asset obsoleti. `npm test` invoca Jest; il lint usa ESLint. Alcuni smoke test browser sono previsti dagli script `test:map-picker-smoke`, `test:map-lit-smoke`, `test:map-lit-stress` e `test:auth-register-smoke`.

**Prerequisito importante:** questo checkout non include `package-lock.json`; una prima `npm install` crea o aggiorna il lockfile. Poiché Vite riferisce percorsi relativi a `Modules/` e `public_html/`, verificare asset e build nell'applicazione Laraxot ospitante, non soltanto nella copia isolata. Non eseguire modifiche distruttive a database o dati reali per un controllo del tema.

## Piano di migrazione, senza nuovi branch

1. **Identità del package:** allineare Composer, PSR-4, provider, manifest, package npm e namespace `Themes\Civic`.
2. **Asset e rendering:** aggiornare base Vite, manifest, collegamento `public_html/themes/Civic`, view namespace e riferimenti `pub_theme` nell'host, mantenendo disponibile Sixteen durante il passaggio.
3. **Componenti e moduli:** verificare import PHP, Blade, Lit/Geo, JSON CMS e riferimenti assoluti al tema originale; non sostituire stringhe storiche senza analisi.
4. **Localizzazione Malta:** aggiungere `mt`, verificare fallback verso `en`, termini istituzionali, messaggi di validazione e pagine principali.
5. **Qualità:** build, Jest, smoke test, screenshot reali responsive, verifiche WCAG, regressioni su pagine pubbliche e flussi autenticati.
6. **Adozione:** modificare la configurazione dell'host solo dopo verifica e pianificazione del rollback. Conservare i dati degli enti e delle segnalazioni.

## Mappa della documentazione

| Area | Punto di ingresso | Nota |
| --- | --- | --- |
| Architettura | [architecture/README.md](./architecture/README.md) | Raccolta ereditata: contiene riferimenti Sixteen da riconciliare |
| Design system | [design-system/README.md](./design-system/README.md) | Contratto visivo storico; target da rendere indipendente dal Paese |
| Superfici GitHub | [github-surfaces.md](./github-surfaces.md) | Issues, milestone, label, Actions, Security, Discussions |
| Wiki | [wiki/README.md](./wiki/README.md) | Indice locale delle conoscenze importate |
| Test | [testing-convention.md](./testing-convention.md) | Convenzioni per il tema |
| Folio / pagine | [folio-page-pattern.md](./folio-page-pattern.md) | Struttura pagina dell'implementazione precedente |
| Linee guida italiane | [design-comuni/README.md](./design-comuni/README.md) | Riferimento specifico per l'Italia, non base universale |
| ADR | [adr/README.md](./adr/README.md) | Decisioni da riesaminare nel contesto Civic |
| Ricerca e rilievi | [analysis/README.md](./analysis/README.md) | Evidenze e analisi storiche |
| Contratti | [contracts/README.md](./contracts/README.md) | Cosa promettono le Action e le interfacce del tema |
| Storie BMAD | [stories/](./stories/) | Lavoro in corso e criteri di accettazione |
| Archivio | [archive/README.md](./archive/README.md) | Documenti storici dichiarati immutabili |
| Controlli sui docs | `scripts/docs-audit.py`, `scripts/docs-index.py`, `scripts/docs-apply-map.py` | Link, nomi, avanzi, raggiungibilità, catalogo, mappa di migrazione |

## Come leggere la documentazione

_Fuso dalla mappa della conoscenza di Sixteen, ora in `docs/archive/knowledge-map.md`._

### Scopo

Questa mappa evita che QMD, Graphify, BMAD e gli agenti leggano report storici
come se fossero decisioni correnti. Il codice del tema resta la fonte del
comportamento; questa documentazione è la fonte del perché, dei contratti e
delle verifiche.

### Percorsi canonici

| Area | Percorso | Contiene | Autorità |
|---|---|---|---|
| indice | `README.md` | ingresso unico | canonica |
| regole | `wiki/rules/` | vincoli on-demand | canonica |
| architettura | `architecture/`, `bmad/` | decisioni e contratti | canonica |
| design | `design-comuni/`, `design-system/` | token e struttura visuale | canonica |
| pagine | `pages/` | contratto per pagina | canonica |
| storie | `stories/` | BMAD, AC e scope | canonica |
| parity | `visual-parity/`, `html-parity-reports/` | risultati verificati | evidence |
| analisi | `investigation/`, `analysis/` | ipotesi e diagnosi | evidence |
| sorgenti | `sources/`, `raw/`, `Main_files/` | materiale importato | non canonica |
| screenshot | `screenshots/`, `visual-parity-screenshots/` | output binario | non indicizzata semanticamente |

### Regola di lettura

1. Leggere questo file.
2. Cercare in QMD per concetto, non per nome file.
3. Recuperare il documento completo con `qmd get`, non usare lo snippet come verità.
4. Se una regola è coinvolta, leggere la regola wiki pertinente.
5. Per una modifica, leggere la story BMAD e il documento parity della pagina.
6. In caso di conflitto prevalgono: codice verificato, regola wiki corrente,
   architecture/BMAD, parity più recente, evidence grezza.

### QMD, Graphify, Second Brain e BMAD

- QMD recupera il contesto locale dalla collezione `sixteen-theme`.
- Graphify indicizza i Markdown e rende visibili collegamenti e duplicati.
- Second Brain conserva il perché e le correzioni durevoli.
- BMAD conserva brief, PRD, architettura, stories e decision log.

I documenti nuovi devono avere front matter YAML con `title`, `type`, `tags` e
`qmd`. I tipi ammessi sono `index`, `rule`, `architecture`, `decision`,
`story`, `parity`, `investigation`, `source` e `archive`.

Non si rinominano in massa i file storici: si aggiungono indici e mappe di
migrazione per non rompere riferimenti già usati dagli agenti.

## Indice operativo ereditato da Sixteen

_Fuso dall'indice operativo di Sixteen, ora in `docs/archive/00-index-sixteen.md`. I conteggi delle cartelle sono quelli del 2026-10-14: per quelli attuali vale il catalogo in fondo._

Sixteen è il tema web/PWA pubblico di FixCity: è il proprietario della resa
Design Comuni, del markup e dei componenti visuali. Le pagine sono Folio +
Blade/Volt e le Actions di dominio appartengono al modulo owner. Per regola non
deve avere controller o rotte proprie, ma il codice le contiene ancora: 5
controller in `app/Http/Controllers/`, `routes/web.php` e `routes/auth.php`
(verificato 2026-10-14). A runtime non risultano registrate: `php artisan
route:list` non ha `comune/*`, `auth/spid` ne' `auth/cie`. Stato e conteggi nella
sezione «Stato del repository» di questo file.


### Riorganizzazione docs 2026-10-13

- `build/` — tutti i 14 documenti Vite/build (erano sparsi alla root come
  `vite-*.md`/`VITE_*.md`); `build/INDEX.md` non esiste: ordine di lettura da
  [vite-configuration-guide.md](build/vite-configuration-guide.md);
- `visual-parity/` — struttura consolidata: `reports/`, `screenshots/pages/`
  (evidenza per pagina), `screenshots/legacy-2026-04/` (evidenza storica),
  `scripts/` (bug del path annidato `scripts/docs/visual-parity/scripts/`
  eliminato);
- `visual-parity-screenshots/` accorpato in `visual-parity/screenshots/pages/`;
- `visual-comparison/` resta evidence storica cross-referenziata.

### Classificazione delle cartelle (file presenti il 2026-10-14)

| Ruolo | Cartelle (n. file) |
|---|---|
| Canoniche | `bmad/` (410, story in `bmad/stories/`, decisioni in `bmad/decisions/`), `stories/` (37), `decision-log/` (14), `wiki/` (278), `architecture/` (19), `rules/` (3), `i18n/` (3), `compliance/` (1), `build/` (15), `design-system/` (6), `components/` (8), `pages/` (334, contratti per pagina), `design-comuni/` (643, vincoli visuali; i suoi `*/raw` sono evidence) |
| Supporto | `prompts/` (338, coordinamento tra agenti, es. `prompts/homepage/`), `scripts/` (16), `llm-wiki/` (9) |
| Evidence (immutabili o storiche) | `screenshots/` (260), `visual-parity/` (280), `visual-comparison/` (224), `body-structure-comparison/` (156), `analysis/` (142), `comparisons/` (83), `visual-analysis/` (53), `html-parity-reports/` (29), `html-structure-comparison/` (21), `html-compare/` (12), `Main_files/` (47), `raw/` (16), `design-comuni/*/raw` |
| Generate | `graphify-out/` e `qmd-index/`: non presenti in `docs/` al 2026-10-28 |
| Legacy o da triare (DOC-004, DOC-006) | i `.md` di radice (405, con 25 collisioni di maiuscole nel perimetro), `ui-fixes/` (14), i report di batch in `design-comuni/` (`batch-structure-audit*.md`: 108 link non risolti ciascuno, `batch-pages-analysis.md`: 98) |
| Mappa delle cartelle | questa tabella; l'elenco di ogni documento è il catalogo in fondo a questo file |

### Percorsi di lettura

1. [Stato e architettura](#stato-del-repository-al-26-novembre-2026) — identità, ownership e stack;
2. [Come leggere la documentazione](#come-leggere-la-documentazione) — mappa per QMD/Graphify/Second Brain;
3. nomi e frontmatter dei .md (`../../../../bashscripts/ai/wiki/rules/markdown-file-naming-and-frontmatter.md`, non presente in Civic) — regole cross-project;
4. docs knowledge architecture (`bmad/docs-knowledge-architecture.md`, non presente in Civic) — regole BMAD;
5. header/footer contract (`bmad/header-footer-sections-contract.md`, non presente in Civic) — dati e renderer;
6. header/footer parity (`bmad/header-footer-parity-report.md`, non presente in Civic) — gate Playwright;
7. header/footer data model (`bmad/header-footer-data-model.md`, non presente in Civic) — elementi, forma JSON e AC;
8. [header/footer rationale](second-brain/header-footer-rationale.md) — decisione e perché;
9. [front-office readiness plan](bmad/front-office-production-readiness-plan.md) — copertura guest/auth e gate;
10. [front-office readiness brainstorming](bmad/front-office-readiness-brainstorming.md) — otto tecniche BMAD;
11. [Cms Head adoption plan](../../../Modules/Cms/docs/bmad/head-component-adoption-plan.md) — ownership, decisioni e parita';
12. [wiki](wiki/README.md) — conoscenza consolidata e regole on-demand;
13. [design-comuni](design-comuni/design-comuni-canonical.md) — vincoli visuali;
14. [design-system](design-system/README.md) — token e componenti del tema;
15. [pages](pages/) — contratti delle pagine e parity;
16. [stories](stories/) — storie BMAD e acceptance criteria;
17. [visual-parity](visual-parity/) — verifiche, screenshot per pagina e report;
18. [investigation](investigation/) — analisi riproducibili, non decisioni canoniche.

Per le pagine CMS di primo livello, leggere anche il contratto
FAQ route ownership (`bmad/faq-route-ownership.md`, non presente in Civic): una pagina come
`domande-frequenti` usa lo shell Folio generico e il JSON del tenant; non si
crea `resources/views/pages/domande-frequenti/index.blade.php`.
Il perché: why-domande-frequenti-blade-php-must-not-exist.md (`bmad/knowledge/why-domande-frequenti-blade-php-must-not-exist.md`, non presente in Civic).

### SSoT per area

| Area | Canonico | Non usare come SSoT |
|---|---|---|
| Layout/Folio | `layout-runtime-contract.md` + `docs/wiki/rules/no-parallel-design-comuni-layout.md` | `design-comuni` come nome di layout runtime; i valori CMS storici vengono risolti da `x-layouts.app`, mentre `-authenticated` e `-bare` restano template specializzati di test |
| Accessibilità | `accessibility.md` + contratto mobile | claim “100%” senza audit |
| Design Comuni | `design-comuni/` + documenti parity + `design-system/` | screenshot raw o report duplicati |
| Componenti | `components/` | copie in `blocks/` non indicizzate |
| Build asset | `build/vite-configuration-guide.md` + `vite.config.js` | log di singole sessioni |
| FixCity journeys | `Modules/Fixcity/docs/actor-flows.md` | duplicati nel tema |

### Regola di consolidamento

Le cartelle `analysis/`, `comparisons/`, `html-*`, `body-structure-comparison/` e
`design-comuni/*/raw` sono evidence storica o generated output. Non creare nuovi report
paralleli: aggiornare il canonico con finding, data, viewport e link al codice. Prima di
eliminare o spostare file, verificare i riferimenti con `rg` e registrare la sostituzione
nel log Second Brain.

I nuovi `.md` usano nomi lowercase senza date/timestamp e senza suffissi numerici
sequenziali (`-1`, `-2`, `-3`). I file storici restano tali finché una mappa di rinomina
verificata non garantisce tutti i riferimenti.

### Definition of done visuale

Ogni modifica deve avere: mobile/tablet/desktop evidence, zero overflow, focus visibile,
target touch adeguato, contrasto e reduced-motion verificati. Un screenshot isolato non
chiude il gate.

### Studio docs e ingressi (2026-10-14)

- Studio del tema reale e correzione degli ingressi (`bmad/stories/docs-studio-stato-e-ingressi.story.md`, non presente in Civic): stato vivo provato, conteggi, rotte dormienti, layout `design-comuni*`, indici storici.

### Head Cms e production readiness

- [Audit guest e autenticati](stories/front-office-production-readiness-audit.story.md)
- [Brainstorming BMAD a otto tecniche](bmad/front-office-readiness-brainstorming.md)
- [Piano di readiness](bmad/front-office-production-readiness-plan.md)
- [Decisioni Head e parita'](../../../Modules/Cms/docs/bmad/head-component-adoption-plan.md)
- [Discussion #93](https://github.com/laraxot/theme_sixteen_fila5/discussions/93)

### Story BMAD recenti (standard di codice)

- [Parity degli attributi data-* (2026-10-29)](stories/data-attribute-parity.story.md) — via `data-sixteen-*` dal markup; regola in [data-attribute-rule.md](data-attribute-rule.md) (scala di scelta, inventario del riferimento: 12 nomi, nessuno col nome del tema); 6 varianti legacy di header, una sola con un consumatore.
- [Passata UX mobile (2026-10-28)](stories/mobile-ux-pass.story.md) — **in revisione**: il tema servito e' Two, non Sixteen; `loading="lazy"` annullato; viewport senza blocco zoom, campi a 16 px, mappa a schermo intero in `dvh` da confermare contro il riferimento.
- [Services -> Actions e const -> enum (2026-10-08)](stories/services-to-actions-sixteen.story.md) — il tema non ha piu' `app/Services/`; 31 const in enum con lang it/en.
- [Niente testi fissi nelle Blade (2026-10-30)](stories/blade-i18n-no-hardcoded-text.story.md) — chiavi `pub_theme::` in it, en, de, es; numeri, residui e regola dei link.

### Parity Design Comuni v2 (2026-10-13)
- Epic DCP-00 e storie per la ripresa (`bmad/stories/dcp-00-epic-design-comuni-parity-v2.story.md`, non presente in Civic)
- Perche' la parity non e' stata completata e guardrail (`bmad/decisions/parity-root-cause-and-guardrails.md`, non presente in Civic)
- [Dossier dei 14 difetti della homepage](bmad/homepage-visual-parity-defects/defects-d01-d14.md)
- [Coordinamento tra agenti](prompts/homepage/00-COORDINATION.md)
- Zen del wizard segnalazione (logica/perche'/filosofia/religione/politica) (`bmad/decisions/segnalazione-flow-parity-zen.md`, non presente in Civic)
- DCP-32 wizard step 1 privacy (`bmad/stories/dcp-32-wizard-step1-privacy.story.md`, non presente in Civic) · DCP-33 step 2 dati + mappa (`bmad/stories/dcp-33-wizard-step2-dati.story.md`, non presente in Civic) · DCP-34 step 3 riepilogo + mappa (`bmad/stories/dcp-34-wizard-step3-riepilogo.story.md`, non presente in Civic) · DCP-35 conferma (`bmad/stories/dcp-35-conferma-parity.story.md`, non presente in Civic)
- Strumenti: `bashscripts/docs/visual-comparison/INDEX.md`

### Wizard /it/tickets/create: DCP-35 (Fixcity) e D15
- [DCP-35 (modulo Fixcity): passi 1 e 2 del wizard e coordinamento tra agenti](../../../Modules/Fixcity/docs/stories/dcp-35-tickets-create-privacy-dati-coordinamento.story.md): attenzione, la numerazione DCP-32..35 esiste anche nelle story del tema (voci sopra), con significato diverso (qui DCP-35 = conferma)
- [D15: il Volt della pagina generica ha una radice propria](decision-log/d15-volt-fragment-explicit-root.md): causa di `MethodNotFoundException` su «Avanti»; esiste un secondo D15, [conferma post-save](decision-log/d15-conferma-post-save.md)

### Story tickets/create lato tema (2026-10-13)
- DCP-40 radice del Volt nella pagina generica (`bmad/stories/dcp-40-volt-radice-widget-livewire.story.md`, non presente in Civic)
- DCP-50 guardia di compilazione dei template Blade (`bmad/stories/dcp-50-guardia-compilazione-template-blade.story.md`, non presente in Civic)
- [D15 radice del Volt (decisione)](decision-log/d15-volt-fragment-explicit-root.md)

### Multilingua it, en, de, es (DCP-120)
- [i18n/INDEX.md](i18n/index.md): comportamento multilingua (lingua, fallback, selettore, link, formati) e glossario di traduzione
- DCP-120 copertura de/es (`bmad/stories/dcp-120-multilingua-comportamenti-e-copertura.story.md`, non presente in Civic) · DCP-123 lingua dichiarata e link localizzati (`bmad/stories/dcp-123-lingua-dichiarata-e-link-localizzati.story.md`, non presente in Civic)
- [Multilingua e dispositivi: comportamenti osservati](wiki/concepts/multilingua-e-dispositivi-comportamenti.md): misure su lingua, selettore, wizard, formati, menu e bersagli tattili a 375, 768, 1024, 1440 (studio in DCP-55 (`bmad/stories/dcp-55-multilingua-e-dispositivi.story.md`, non presente in Civic))

### Area personale (DCP-106, DCP-110)
- DCP-110 area personale: Le mie segnalazioni e Segnalazioni che seguo (`bmad/stories/dcp-110-area-personale-pratiche-e-seguite.story.md`, non presente in Civic)

### Registro story e dettaglio ticket (2026-10-14)
- [Registro completo delle story](bmad/stories/00-registro-completo.md): le story di `stories/` e `bmad/stories/` che prima non avevano un indice (stato e titolo dichiarati nei file)
- DCP-148 dettaglio pubblico e Segui (`bmad/stories/dcp-148-dettaglio-pubblico-segnalazione-e-segui.story.md`, non presente in Civic): blocco `components/blocks/ticket-detail/design-comuni.blade.php`
- [DCP-152 (modulo Geo): marker del dettaglio e pulsanti della mappa](../../../Modules/Geo/docs/stories/dcp-152-marker-dettaglio-ticket-e-pulsanti-mappa-su-pagine-dc.story.md): il blocco passa `marker-icon-url`, `marker-color`, `marker-label` al `coordinate-picker-lit` (vedi [coordinate-picker](wiki/coordinate-picker.md))

### Audit front office anonimo (2026-11-12)

- [Sprite delle icone: deve arrivare in produzione (F-01/F-02)](stories/icon-sprite-deployability.story.md): `.gitignore` a due livelli, `test -f` in `deploy.sh`, guardia che interroga git
- [Home «Novita'»: 3 card per riga (F-06)](stories/home-news-grid-specificity.story.md): specificita' dello scope contro il `<style>` dei blocchi
- [Sweep del front office anonimo e diff dell'head](how-to/front-office-anonymous-sweep.md): metodo, soglie, trappole
- [Piano di hardening: guardie e strumenti](plans/front-office-hardening-plan.md): onde per non ripetere i difetti muti
- [Brainstorming, sessione 85](bmad-brainstorming.md): 5 Perche', reverse brainstorming, matrice delle guardie
- Discussione con decisioni e alternative scartate: [#95](https://github.com/laraxot/theme_sixteen_fila5/discussions/95)

### Decisione wizard privacy — 2026-11-12

- [DCP-456-Sixteen: informativa a due livelli](stories/ticket-create-privacy-design-comuni-decision.story.md)
- [Discussion #96](https://github.com/laraxot/theme_sixteen_fila5/discussions/96): differenze tra informativa integrale duplicata e avviso breve con approfondimento.

#### Note del second brain (aggiornamento di un agente AI, 2026-10-14)

- [second brain: kp-174d15a58ff94901b2b0df0d86b8907a] Design Comuni parity
- [BMAD] Design Comuni scope, no Bootstrap Italia
- [AGENTS.md m00088] Prompt 98-daily-report: ruoli chiari AI

## Regole ereditate dagli indici ritirati

Raccolte dai vecchi indici di Sixteen (aprile 2026) prima di archiviarli. Non sono state riverificate per Civic: ognuna va controllata contro il codice prima di farla valere.

- **Parity HTML e CSS/JS:** raggiunto il 90% di parity HTML si modificano solo CSS e JS; l'HTML è congelato.
- **Markup:** la parity richiede gli stessi tag semantici, gli stessi `id` e gli stessi nomi di classe Bootstrap; Bootstrap Italia (CSS e JS) non si carica, il comportamento visivo resta TailwindCSS + Alpine.js.
- **Dove stanno i report:** i risultati specifici di una pagina vanno nei docs del tema, non in `bashscripts`.
- **Vite:** per risolvere gli import di `lit` e `leaflet/dist/leaflet.css` servono `@rollup/plugin-node-resolve` e `optimizeDeps` (nota del 2026-04-15; la configurazione vera è `vite.config.js`).
- **Superato, non seguire:** `npm run build && npm run copy`. Lo step di copia non esiste più; vedi [build-workflow.md](./build-workflow.md).
- **Nomi dei file `.md`:** niente date nel nome, la data va nel frontmatter.
- **Template e-mail:** [resources/mail-layouts](../resources/mail-layouts/README.md); documenti: [christmas-email-template-implementation.md](./christmas-email-template-implementation.md), [christmas-email-layout.md](./christmas-email-layout.md), [mail-layouts-natale.md](./mail-layouts-natale.md). Widget di login: [login-widget-form-binding.md](./auth/login-widget-form-binding.md).
- **Risorse esterne:** [Laravel](https://laravel.com/docs), [Vite](https://vitejs.dev/), [Tailwind CSS](https://tailwindcss.com/docs), [Design Comuni](https://italia.github.io/design-comuni-pagine-statiche/), [Bootstrap Italia](https://italia.github.io/bootstrap-italia/), [linee guida AGID](https://www.agid.gov.it/it/argomenti/linee-guida-design-pa), [Filament v5](https://filamentphp.com/docs/5.x).

## Regole per gli aggiornamenti

- Lavorare sul branch **`dev`** esistente del repository Civic; nessun branch nuovo.
- Preservare evidenze e report di Sixteen come **storici**, esplicitando il contesto quando li si cita.
- Aggiornare i README e i contratti prima di dichiarare implementate funzionalità non verificate.
- Non creare un secondo tema per Malta: usare componenti condivisi e adattatori/configurazioni per Paese.
- Associare a ogni dichiarazione di conformità una verifica ripetibile e datata; non utilizzare badge di certificazione non dimostrati.

- Dopo aver aggiunto, spostato o rinominato un `.md`: `python3 -I docs/scripts/docs-index.py` rigenera il catalogo e `python3 -I docs/scripts/docs-audit.py all` controlla link relativi, nomi, avanzi e raggiungibilità.
- Nomi dei `.md`: minuscolo con trattini, senza date né suffissi numerici (la data va nel frontmatter); fanno eccezione `README.md` e simili e gli archivi dichiarati (`archive/`, `raw/`).
- Un documento superato non si cancella: se il suo contenuto è tutto in un altro documento vivo si ritira, altrimenti si sposta in `archive/` (immutabile). Si usa `docs/scripts/docs-apply-map.py`, che riscrive i riferimenti al documento canonico.

## Catalogo completo (generato)

L'elenco di ogni documento di `docs/`, compresi `adr/`, `contracts/`, `stories/` e l'archivio (qui solo elencati, non modificati).

<!-- docs-index:begin (generato da docs/scripts/docs-index.py: non modificare a mano) -->

Documenti catalogati: 1286 (questo file escluso), in 65 aree.

<details>
<summary><strong>radice di `docs/`</strong>: 342 documenti</summary>

- [00 CSS JS VISUAL FIX PLAN](00-css-js-visual-fix-plan.md)
- [00 HOMEPAGE REPLICATION INDEX](00-homepage-replication-index.md)
- [00 IMPLEMENTATION STATUS](00-implementation-status.md)
- [00 PROJECT SETUP SUMMARY](00-project-setup-summary.md)
- [accessibility](accessibility.md)
- [address item enum frontend](address-item-enum-frontend.md)
- [advanced email templates](advanced-email-templates.md)
- [agid checklist](agid-checklist.md)
- [agid compliance summary](agid-compliance-summary.md)
- [agid components reorganization](agid-components-reorganization.md)
- [agid filament 4x implementation complete](agid-filament-4x-implementation-complete.md)
- [agid filament 4x integration](agid-filament-4x-integration.md)
- [agid gap analysis](agid-gap-analysis.md)
- [agid implementation complete](agid-implementation-complete.md)
- [agid implementation summary](agid-implementation-summary.md)
- [agid layout usage rules](agid-layout-usage-rules.md)
- [agid login battle plan](agid-login-battle-plan.md)
- [agid login compliance analysis](agid-login-compliance-analysis.md)
- [agid login implementation complete](agid-login-implementation-complete.md)
- [agid login implementation plan](agid-login-implementation-plan.md)
- [agid login implementation](agid-login-implementation.md)
- [agid login problems analysis](agid-login-problems-analysis.md)
- [agid login refactoring plan](agid-login-refactoring-plan.md)
- [agid naming cleanup complete](agid-naming-cleanup-complete.md)
- [agid naming correction complete](agid-naming-correction-complete.md)
- [AI-assisted coding style guide for Sixteen theme (R13-R20)](ai-assisted-coding-style-guide.md)
- [ai handoff — Theme Sixteen](ai-handoff.md)
- [ALPINE JS COMPONENTS](alpine-js-components.md)
- [AMMINISTRAZIONE HTML COMPARISON](amministrazione-html-comparison.md)
- [analysis and improvement plan](analysis-and-improvement-plan.md)
- [Appointment enums (Sixteen)](appointment-enums.md)
- [ARCHITECTURE QUEUEABLE ACTION](architecture-queueable-action.md)
- [architecture testing env](architecture-testing-env.md)
- [assets](assets.md)
- [auth agid component fix](auth-agid-component-fix.md)
- [auth best practices](auth-best-practices.md)
- [auth pages analysis](auth-pages-analysis.md)
- [BLOCK IMPLEMENTATION GUIDE](block-implementation-guide.md)
- [block view bridge missing pages](block-view-bridge-missing-pages.md)
- [BLOCKS IMPLEMENTATION](blocks-implementation.md)
- [BLOCKS NAMING CONVENTION](blocks-naming-convention.md)
- [blocks system](blocks-system.md)
- [BMAD Brainstorming — Sixteen](bmad-brainstorming.md)
- [BMAD + Second Brain + Filament Blueprint Hyperlink Guide](bmad-hyperlink-guide.md)
- [BMAD LAYOUT CORRECTION](bmad-layout-correction.md)
- [bmad method](bmad-method.md)
- [BMAD Planning — Sixteen](bmad-planning.md)
- [Sixteen Theme — BMAD Stories & Remaining Work](bmad-remaining-work.md)
- [Sixteen Theme — BMAD + Second Brain](bmad-second-brain.md)
- [BODY CLASS RULE](body-class-rule.md)
- [bootstrap english compliance analysis updated](bootstrap-english-compliance-analysis-updated.md)
- [bootstrap english compliance analysis](bootstrap-english-compliance-analysis.md)
- [bootstrap english compliance final report](bootstrap-english-compliance-final-report.md)
- [bootstrap english examples](bootstrap-english-examples.md)
- [bootstrap english implementation](bootstrap-english-implementation.md)
- [bootstrap english to tailwind](bootstrap-english-to-tailwind.md)
- [bootstrap italia to tailwind](bootstrap-italia-to-tailwind.md)
- [build commands guide](build-commands-guide.md)
- [build issues resolution](build-issues-resolution.md)
- [build system best practices](build-system-best-practices.md)
- [BUILD TROUBLESHOOTING](build-troubleshooting.md)
- [BUILD WORKFLOW](build-workflow.md)
- [cache troubleshooting](cache-troubleshooting.md)
- [christmas email layout](christmas-email-layout.md)
- [christmas email template implementation](christmas-email-template-implementation.md)
- [code quality analysis](code-quality-analysis.md)
- [code quality tools](code-quality-tools.md)
- [complete component categorization](complete-component-categorization.md)
- [complete theme analysis](complete-theme-analysis.md)
- [COMPLETE VISUAL PARITY REPORT](complete-visual-parity-report.md)
- [Theme Sixteen — completion backlog](completion-backlog.md)
- [component page alias rule](component-page-alias-rule.md)
- [component page runtime](component-page-runtime.md)
- [component reorganization plan](component-reorganization-plan.md)
- [component structure reorganization](component-structure-reorganization.md)
- [component usage guide](component-usage-guide.md)
- [components directory structure](components-directory-structure.md)
- [components status](components-status.md)
- [components update](components-update.md)
- [components](components.md)
- [comprehensive components reorganization](comprehensive-components-reorganization.md)
- [conflict resolution](conflict-resolution.md)
- [context compression plugin runtime](context-compression-plugin-runtime.md)
- [context compression plugin](context-compression-plugin.md)
- [Contracts Naming & Placement](contracts-naming.md)
- [copilot redundancy audit](copilot-redundancy-audit.md)
- [critical rules](critical-rules.md)
- [CSS FIXES PHASE2](css-fixes-phase2.md)
- [CSS FIXES PROGRESS](css-fixes-progress.md)
- [css js parity](css-js-parity.md)
- [css js phase report](css-js-phase-report.md)
- [css js phase status](css-js-phase-status.md)
- [CSS MAPPING ANALYSIS REPORT](css-mapping-analysis-report.md)
- [daisyui summary](daisyui-summary.md)
- [DAISYUI](daisyui.md)
- [Data Attribute Rule - nessun data- col nome del tema](data-attribute-rule.md)
- [Decision log — Front Office redesign with DesignComuni](decision-log.md)
- [design common static pages analysis](design-common-static-pages-analysis.md)
- [DESIGN COMUNI AMMINISTRAZIONE ANALYSIS](design-comuni-amministrazione-analysis.md)
- [design comuni census blocks](design-comuni-census-blocks.md)
- [design comuni compliance](design-comuni-compliance.md)
- [design comuni html match css js plan](design-comuni-html-match-css-js-plan.md)
- [design comuni html parity plan](design-comuni-html-parity-plan.md)
- [DESIGN COMUNI HTML REPLICATION ACTION PLAN](design-comuni-html-replication-action-plan.md)
- [DESIGN COMUNI HTML REPLICATION](design-comuni-html-replication.md)
- [design comuni implementation complete](design-comuni-implementation-complete.md)
- [design comuni implementation](design-comuni-implementation.md)
- [design comuni integration](design-comuni-integration.md)
- [Design Comuni — contratto FO novità ed eventi](design-comuni-novita-eventi-fo.md)
- [design comuni page census](design-comuni-page-census.md)
- [Design Comuni Pages - HTML Comparison Report](design-comuni-pages-comparison.md)
- [DESIGN COMUNI PROJECT SUMMARY](design-comuni-project-summary.md)
- [DESIGN COMUNI REPLICATION INDEX](design-comuni-replication-index.md)
- [DESIGN COMUNI REPLICATION PLAN](design-comuni-replication-plan.md)
- [DESIGN COMUNI TEAM GUIDE](design-comuni-team-guide.md)
- [design system conversion](design-system-conversion.md)
- [designers english resources](designers-english-resources.md)
- [Device DB — Sorgente errore fixcitydata vs user](device-db.md)
- [dry kiss analysis](dry-kiss-analysis.md)
- [Email delivery and mail UI boundaries](email-delivery-and-mail-ui.md)
- [Email: requisiti UX del tema Sixteen](email-infrastructure-ux.md)
- [email templates improvement plan](email-templates-improvement-plan.md)
- [examples](examples.md)
- [faq comparison 2026 04 03](faq-comparison-riferimento-vs.md)
- [FAQ PARITY](faq-parity.md)
- [FAQ REPLICATION STATUS](faq-replication-status.md)
- [filament 4 login widget implementation](filament-4-login-widget-implementation.md)
- [filament 4x integration complete](filament-4x-integration-complete.md)
- [filament 4x styles configuration](filament-4x-styles-configuration.md)
- [filament 4x upgrade report](filament-4x-upgrade-report.md)
- [filament icon guide](filament-icon-guide.md)
- [filament integration](filament-integration.md)
- [filament summary infolist guidance](filament-summary-infolist-guidance.md)
- [filament widget styling fix](filament-widget-styling-fix.md)
- [FINAL VISUAL PARITY REPORT](final-visual-parity-report.md)
- [FIX TESTS PAGES ARCHITECTURE](fix-tests-pages-architecture.md)
- [FOLIO HELPERS RULE](folio-helpers-rule.md)
- [FOLIO MOUNT ERROR FIX](folio-mount-error-fix.md)
- [Sixteen Folio Page Pattern - mount() + x-page](folio-page-pattern.md)
- [FOLIO PAGES ARCHITECTURE](folio-pages-architecture.md)
- [FOOTER CSS FIX](footer-css-fix.md)
- [FOOTER FIXES REPORT](footer-fixes-report.md)
- [git conflicts report](git-conflicts-report.md)
- [Civic — superfici GitHub](github-surfaces.md)
- [GSD PHASE 1 EXECUTION](gsd-phase-1-execution.md)
- [HEADER BOOT BUILD INTEGRATION](header-boot-build-integration.md)
- [Header Sixteen: componenti Design Comuni](header-components.md)
- [header mobile overlay](header-mobile-overlay.md)
- [HOMEPAGE 404 FIX](homepage-404-fix.md)
- [HOMEPAGE CSS JS FIXES COMPLETE](homepage-css-js-fixes-complete.md)
- [HOMEPAGE FIX ANALYSIS](homepage-fix-analysis.md)
- [HOMEPAGE HTML BODY COMPARISON FINAL](homepage-html-body-comparison-final.md)
- [HOMEPAGE HTML COMPARISON](homepage-html-comparison.md)
- [homepage parity 2026 04 02](homepage-parity-scope.md)
- [HOMEPAGE VISUAL ANALYSIS](homepage-visual-analysis.md)
- [HTML BODY COMPARISON](html-body-comparison.md)
- [HTML BODY IDENTITY FIX](html-body-identity-fix.md)
- [HTML COMPARISON REPORT](html-comparison-report.md)
- [HTML COMPARISON URGENT FIXES](html-comparison-urgent-fixes.md)
- [html parity body policy](html-parity-body-policy.md)
- [HTML PARITY WORKFLOW](html-parity-workflow.md)
- [HYBRID EXECUTION TRACK A B](hybrid-execution-track-a-b.md)
- [icon error correction](icon-error-correction.md)
- [impeccable audit fixes 2026 07 13](impeccable-audit-fixes.md)
- [implementation guide](implementation-guide.md)
- [IMPLEMENTATION MASTER PLAN](implementation-master-plan.md)
- [implementation plan missing components](implementation-plan-missing-components.md)
- [IMPLEMENTATION REPORT](implementation-report.md)
- [implementation roadmap from official analysis](implementation-roadmap-from-official-analysis.md)
- [implemented components update](implemented-components-update.md)
- [Inbound — blog ed eventi nel FO Sixteen](inbound-marketing-blog-eventi.md)
- [INLINE JS REMOVAL MAIN](inline-js-removal-main.md)
- [it homepage agid alignment](it-homepage-agid-alignment.md)
- [json content blocks rule](json-content-blocks-rule.md)
- [laraxot panel provider rules](laraxot-panel-provider-rules.md)
- [launch](launch.md)
- [LAYOUT ARCHITECTURE AND NAMESPACE](layout-architecture-and-namespace.md)
- [LAYOUT ARCHITECTURE MAP](layout-architecture-map.md)
- [layout architecture](layout-architecture.md)
- [LAYOUT CENTERING FIX](layout-centering-fix.md)
- [LAYOUT CORRECTION COMPLETE](layout-correction-complete.md)
- [LAYOUT FIX COMPLETE BMAD](layout-fix-complete-bmad.md)
- [layout fix summary](layout-fix-summary.md)
- [layout hierarchy](layout-hierarchy.md)
- [LAYOUT ISSUES ANALYSIS](layout-issues-analysis.md)
- [layout namespace correction](layout-namespace-correction.md)
- [layout runtime contract](layout-runtime-contract.md)
- [layout usage correction](layout-usage-correction.md)
- [layout usage patterns](layout-usage-patterns.md)
- [layout usage rules](layout-usage-rules.md)
- [layout variants cleanup complete](layout-variants-cleanup-complete.md)
- [llm wiki](llm-wiki.md)
- [Risoluzione errori Vite e Blade registrati nei log](log-error-resolution.md)
- [login analysis summary](login-analysis-summary.md)
- [login card component analysis](login-card-component-analysis.md)
- [login correction implementation](login-correction-implementation.md)
- [login implementation analysis](login-implementation-analysis.md)
- [login implementation complete](login-implementation-complete.md)
- [login implementation plan](login-implementation-plan.md)
- [login page analysis](login-page-analysis.md)
- [login page implementation plan](login-page-implementation-plan.md)
- [login refactoring implementation](login-refactoring-implementation.md)
- [login refactoring plan](login-refactoring-plan.md)
- [login4 analysis and improvements](login4-analysis-and-improvements.md)
- [login4 component verification](login4-component-verification.md)
- [login4 improvements analysis](login4-improvements-analysis.md)
- [login4 translations fix](login4-translations-fix.md)
- [luxury email design masterclass](luxury-email-design-masterclass.md)
- [mail layouts natale](mail-layouts-natale.md)
- [mappa implementazione](mappa-implementazione.md)
- [MASTER DOCUMENTATION](master-documentation.md)
- [MCP SERVERS](mcp-servers.md)
- [MCP TOOLS FOR THEME](mcp-tools-for-theme.md)
- [merge conflict marker cleanup](merge-conflict-marker-cleanup.md)
- [MERGE CONFLICT RESOLUTION LOG](merge-conflict-resolution-log.md)
- [merge conflicts resolution](merge-conflicts-resolution.md)
- [migration guide](migration-guide.md)
- [missing components roadmap](missing-components-roadmap.md)
- [missing municipality components implementation plan](missing-municipality-components-implementation-plan.md)
- [Fix — Ticket Detail UI/UX (Photo + Map Layout)](mobile-camera-upload-fix.md)
- [Mobile demo accessibility contract](mobile-demo-accessibility-contract.md)
- [Audit mobile misurato (390px) e correzioni dei target tattili](mobile-live-audit.md)
- [Mobile/Tablet Improvements — BMAD + Second Brain + Filament Blueprint](mobile-tablet-improvements.md)
- [MULTI AGENT COORDINATION](multi-agent-coordination.md)
- [municipality components implementation complete](municipality-components-implementation-complete.md)
- [mustache variables](mustache-variables.md)
- [new components implementation summary](new-components-implementation-summary.md)
- [NO BOOTSTRAP ITALIA](no-bootstrap-italia.md)
- [official laravel design theme analysis](official-laravel-design-theme-analysis.md)
- [On-Demand Pattern — Theme Sixteen](on-demand-pattern.md)
- [page component conflict](page-component-conflict.md)
- [page directory structure](page-directory-structure.md)
- [pages directory structure](pages-directory-structure.md)
- [pages directory verified](pages-directory-verified.md)
- [PARITY ASSESSMENT FINDINGS](parity-assessment-findings.md)
- [Performance Optimization — Theme Sixteen](performance-optimization.md)
- [PHASE 1 CHECKPOINT](phase-1-checkpoint.md)
- [PHASE 1 COMPLETE](phase-1-complete.md)
- [PHASE 1 DECISION BLOCKERS](phase-1-decision-blockers.md)
- [PHASE 1 EXECUTION STATUS](phase-1-execution-status.md)
- [PHASE 1 STRATEGY](phase-1-strategy.md)
- [PHASE 10 ACCESSIBILITY AUDIT](phase-10-accessibility-audit.md)
- [PHASE 10 PERFORMANCE REPORT](phase-10-performance-report.md)
- [PHASE 10 VERIFICATION REPORT](phase-10-verification-report.md)
- [Phase 12 Implementation Strategy - Test Pages CSS/JS Fixes](phase-12-implementation-strategy.md)
- [PHASE 2 COMPREHENSIVE STRATEGY](phase-2-comprehensive-strategy.md)
- [PHASE 2 STRATEGY FRAMEWORK](phase-2-strategy-framework.md)
- [PHASE 2 VISUAL ENHANCEMENT](phase-2-visual-enhancement.md)
- [PHASE 7 COMPLETION REPORT](phase-7-completion-report.md)
- [PHASE 8 ALPINE INVESTIGATION](phase-8-alpine-investigation.md)
- [PHASE 8 ALPINE ROOT CAUSE](phase-8-alpine-root-cause.md)
- [PHASE 8 PLAN](phase-8-plan.md)
- [PHASE 9 IMPLEMENTATION REPORT](phase-9-implementation-report.md)
- [PHASE 9 ROOT CAUSE FOUND](phase-9-root-cause-found.md)
- [PHASE 9 SCREENSHOT ANALYSIS](phase-9-screenshot-analysis.md)
- [PHASE2 CSS FIXES COMPLETE](phase2-css-fixes-complete.md)
- [PHASE3 ALPINE PLAN](phase3-alpine-plan.md)
- [PHASE6 ALPINE IMPLEMENTATION](phase6-alpine-implementation.md)
- [PHASE6 ALPINE STATUS](phase6-alpine-status.md)
- [phpstan compliance status](phpstan-compliance-status.md)
- [PHPSTAN LAYOUT FIX COMPLETE](phpstan-layout-fix-complete.md)
- [Playwright MCP + Pest — Login test](playwright-mcp.md)
- [ponytail audit over engineering](ponytail-audit-over-engineering.md)
- [prd](prd.md)
- [product launch plan](product-launch-plan.md)
- [product roadmap](product-roadmap.md)
- [product strategy](product-strategy.md)
- [Project Structure — Theme Sixteen](project-structure.md)
- [Sostenibilità — front office Sixteen](project-sustainability-front-office.md)
- [QMD Setup — Theme Sixteen](qmd-setup.md)
- [quality tools](quality-tools.md)
- [QUICK REFERENCE](quick-reference.md)
- [R2 UX religion — register form password stacked + WCAG 2.1 AA (Sixteen theme)](r2-ux-register-form-stacked-password.md)
- [Civic — English overview](readme-en.md)
- [Sixteen redundancy audit 2026-05-21](redundancy-audit.md)
- [REMOVED PRIORITY FIELD](removed-priority-field.md)
- [REMOVING INLINE JS](removing-inline-js.md)
- [REPLIKATE MASTER INDEX](replikate-master-index.md)
- [repositories](repositories.md)
- [research](research.md)
- [roadmap](roadmap.md)
- [root file policy](root-file-policy.md)
- [root files hygiene](root-files-hygiene.md)
- [route correction summary](route-correction-summary.md)
- [route pattern correction](route-pattern-correction.md)
- [route patterns](route-patterns.md)
- [route structure rules](route-structure-rules.md)
- [routing patterns correction](routing-patterns-correction.md)
- [SCRIPTS INDEX](scripts-index.md)
- [scripts](scripts.md)
- [second brain communidesign typography failure correction](second-brain-communidesign-typography-failure-correction.md)
- [second brain vite public output](second-brain-vite-public-output.md)
- [seo frontend optimization guide](seo-frontend-optimization-guide.md)
- [service provider enhancement implementation](service-provider-enhancement-implementation.md)
- [SET BODY TAG SIMPLE](set-body-tag-simple.md)
- [sixteen theme completion](sixteen-theme-completion.md)
- [sixteen theme naming conventions](sixteen-theme-naming-conventions.md)
- [BMAD + Second Brain: Folio Architecture Analysis (index vs auth/login)](social-login-bmad.md)
- [Social Login — Folio + Volt + Filament Blueprint](social-login-docs.md)
- [solution summary](solution-summary.md)
- [sprint planning](sprint-planning.md)
- [sprint](sprint.md)
- [standardization summary](standardization-summary.md)
- [START HERE](start-here.md)
- [STEPPER MOBILE FIRST RULE](stepper-mobile-first-rule.md)
- [strategy](strategy.md)
- [supermemory](supermemory.md)
- [svg icon convention](svg-icon-convention.md)
- [Sixteen testing and documentation boundary](testing-convention.md)
- [tests placement policy](tests-placement-policy.md)
- [text paragraph font fix](text-paragraph-font-fix.md)
- [theme completion plan](theme-completion-plan.md)
- [theme improvements analysis](theme-improvements-analysis.md)
- [THEME INTEGRATION PATTERNS](theme-integration-patterns.md)
- [theme namespace issue](theme-namespace-issue.md)
- [theme namespace rules](theme-namespace-rules.md)
- [themes](themes.md)
- [ticket 01 privacy css js parity](ticket-01-privacy-css-js-parity.md)
- [ticket comparison analysis](ticket-comparison-analysis.md)
- [ticket crea header stepper responsive](ticket-crea-header-stepper-responsive.md)
- [ticket css diff 2026 04 07](ticket-css-diff-pagine-segnalazione.md)
- [ticket flow html parity complete](ticket-flow-html-parity-complete.md)
- [ticket visual parity](ticket-visual-parity.md)
- [ticket wizard filament refactor](ticket-wizard-filament-refactor.md)
- [Convenzione 5 elementi aggiornata BMAD](translation-convention.md)
- [translation plan](translation-plan.md)
- [translation system rules](translation-system-rules.md)
- [translations implementation](translations-implementation.md)
- [translations](translations.md)
- [UCFIRST ARRAY ERROR FIX](ucfirst-array-error-fix.md)
- [ui components reorganization](ui-components-reorganization.md)
- [ui kit english integration plan](ui-kit-english-integration-plan.md)
- [UI LAYOUT VISIBILITY ISSUES ANALYSIS](ui-layout-visibility-issues-analysis.md)
- [user research](user-research.md)
- [Visual Parity Improvement Plan — Sixteen Redesign](visual-parity-improvement-plan.md)
- [visual parity plan](visual-parity-plan.md)
- [Visual Parity Verification - Sixteen Redesign](visual-parity-verified.md)
- [VISUAL VERIFICATION GUIDE](visual-verification-guide.md)
- [WEB COMPONENTS AND BUILD SYSTEM](web-components-and-build-system.md)
- [wizard component](wizard-component.md)
- [wizard refactor explanation](wizard-refactor-explanation.md)
- [wordpress theme analysis](wordpress-theme-analysis.md)

</details>

<details>
<summary><strong>`adr/`</strong>: 12 documenti</summary>

- [ADR — (decisione in una riga)](adr/0000-template.md)
- [ADR — Civic compila gli asset con Vite, senza copie, e oggi non li pubblica](adr/0001-build-assets-via-vite-and-symlink.md)
- [ADR — Civic possiede la presentazione e le shell Folio sottili, non la risoluzione delle pagine](adr/0002-front-office-theme-owns-presentation.md)
- [Versionare package-lock.json nel repository del tema](adr/0003-version-package-lock-in-theme-repo.md)
- [Inventario dei riferimenti Sixteen e confini tema/moduli](adr/0004-inventario-riferimenti-sixteen.md)
- [Attivazione di Civic e convivenza con Sixteen](adr/0005-attivazione-civic-e-convivenza-con-sixteen.md)
- [Identità Civic: namespace Themes/Civic, manifest theme.json e base Vite /themes/Civic/](adr/0006-identita-civic-namespace-manifest-e-url-degli-asset.md)
- [ADR 0010 — Catalogo maltese mt: bozza con marcatore di revisione, non una traduzione dichiarata com…](adr/0010-catalogo-maltese-bozza-e-revisione.md)
- [ADR 0011 — Profili Paese/ente e terminologia istituzionale in lang/(locale)/entity.php](adr/0011-profili-paese-ente-e-terminologia.md)
- [ADR 0012 — Formati per Paese: date, numeri, indirizzi, telefoni e codici postali](adr/0012-formati-per-paese.md)
- [ADR 0013 — Parita' dei cataloghi misurata sull'unione delle chiavi; il fallback e' una rete di sicu…](adr/0013-fallback-di-localizzazione-e-parita-dei-cataloghi.md)
- [ADR del tema Civic](adr/README.md)

</details>

<details>
<summary><strong>`agid/`</strong>: 6 documenti</summary>

- [agid compliance analysis](agid/agid-compliance-analysis.md)
- [agid municipal gap analysis](agid/agid-municipal-gap-analysis.md)
- [agid static pages analysis](agid/agid-static-pages-analysis.md)
- [complete agid compliance analysis](agid/complete-agid-compliance-analysis.md)
- [gap analysis sixteen vs agid](agid/gap-analysis-sixteen-vs-agid.md)
- [migliori siti comunali agid](agid/migliori-siti-comunali-agid.md)

</details>

<details>
<summary><strong>`analysis/`</strong>: 16 documenti</summary>

- [ANALYSIS SUMMARY](analysis/analysis-summary.md)
- [Batch Analysis Report - 59 Pages Comprehensive Audit](analysis/batch-analysis-diagnostic-report.md)
- [CSS IMPLEMENTATION CHECKLIST](analysis/css-implementation-checklist.md)
- [CURRENT CSS ANALYSIS](analysis/current-css-analysis.md)
- [FAQ Page Structure Analysis](analysis/faq-structure-analysis.md)
- [FAQ Page Visual Comparison Analysis](analysis/faq-visual-analysis.md)
- [Audit di completezza del front office Sixteen](analysis/front-office-completeness-audit.md)
- [INDEX PHASE 12](analysis/index-phase.md)
- [INDEX VISUAL FIXES](analysis/index-visual-fixes.md)
- [PRIORITY 1 VISUAL ANALYSIS](analysis/priority-1-visual-analysis.md)
- [QUICK START](analysis/quick-start.md)
- [README VISUAL ANALYSIS](analysis/readme-visual-analysis.md)
- [README](analysis/README.md)
- [REFERENCE DESIGN ANALYSIS](analysis/reference-design-analysis.md)
- [segnalazioni elenco structure analysis](analysis/segnalazioni-elenco-structure-analysis.md)
- [TAILWIND MAPPING](analysis/tailwind-mapping.md)

</details>

<details>
<summary><strong>`architecture/`</strong>: 16 documenti</summary>

- [CMS DRIVEN BLOCKS](architecture/cms-driven-blocks.md)
- [component namespace](architecture/component-namespace.md)
- [css filename english naming](architecture/css-filename-english-naming.md)
- [CSS SCOPING RULE](architecture/css-scoping-rule.md)
- [fo pa tokens uniformity](architecture/fo-pa-tokens-uniformity.md)
- [layout architecture](architecture/layout-architecture.md)
- [Layout body page contract](architecture/layout-body-page-contract.md)
- [page component architecture](architecture/page-component-architecture.md)
- [PAGE ROUTING ARCHITECTURE](architecture/page-routing-architecture.md)
- [Public privacy policy route ownership](architecture/privacy-policy-folio-route.md)
- [Civic — indice architettura](architecture/README.md)
- [STEPPER RESPONSIVE RULE](architecture/stepper-responsive-rule.md)
- [tailwind alpine philosophy](architecture/tailwind-alpine-philosophy.md)
- [wizard parity](architecture/wizard-parity.md)
- [wizard philosophy analysis](architecture/wizard-philosophy-analysis.md)
- [wizard step visibility](architecture/wizard-step-visibility.md)

</details>

<details>
<summary><strong>`archive/`</strong>: 48 documenti</summary>

- [Sixteen Theme - Documentation Index](archive/00-INDEX-legacy.md)
- [Sixteen theme documentation index](archive/00-index-sixteen.md)
- [00 index](archive/00-index.old.md)
- [copilot redundancy audit 2026 05 25](archive/copilot-redundancy-audit-2026-05-25.md)
- [DOCUMENTATION INDEX](archive/documentation-index.old.md)
- [FOOTER CSS FIX 2026 04 02](archive/FOOTER-CSS-FIX-2026-04-02.md)
- [Sixteen Theme Documentation Index (BMAD + Second Brain + QMD + Graphify)](archive/index-bmad-qmd-router.md)
- [Sixteen Theme — BMAD + Second Brain Index](archive/index.historical-bmad.old.md)
- [Sixteen documentation knowledge map](archive/knowledge-map.md)
- [README old](archive/readme-old.md)
- [Archivio documenti storici — Civic](archive/README.md)

**`archive/auth/`**

- [login ux fixes 2026 06 04](archive/auth/login-ux-fixes-2026-06-04.md)
- [register ux audit 2026 06 04](archive/auth/register-ux-audit-2026-06-04.md)

**`archive/bmad/stories/`**

- [Footer sponsor / sostenitore — studio marketing](archive/bmad/stories/footer-sponsor-marketing.story.md)

**`archive/css/`**

- [batch parity 2026 04 09](archive/css/batch-parity-2026-04-09.md)
- [file upload fix 2026 04 09](archive/css/file-upload-fix-2026-04-09.md)
- [font fix 2026 04 09](archive/css/font-fix-2026-04-09.md)
- [parity session 2026 04 09](archive/css/parity-session-2026-04-09.md)
- [session report 2026 04 09](archive/css/session-report-2026-04-09.md)

**`archive/design-comuni/`**

- [argomenti parity 2026 04 02](archive/design-comuni/argomenti-parity-2026-04-02.md)
- [argomento parity 2026 04 02](archive/design-comuni/argomento-parity-2026-04-02.md)
- [batch body parity 2026 04 03](archive/design-comuni/batch-body-parity-2026-04-03.md)
- [batch structure audit 2026 04 03](archive/design-comuni/batch-structure-audit-2026-04-03.md)
- [bmad gsd status 2026 04 03](archive/design-comuni/bmad-gsd-status-2026-04-03.md)
- [css fix plan 2026 04 02](archive/design-comuni/css-fix-plan-2026-04-02.md)
- [css js parity 2026 04 04](archive/design-comuni/css-js-parity-2026-04-04.md)
- [css js pass 2026 04 04](archive/design-comuni/css-js-pass-2026-04-04.md)
- [domande frequenti parity 2026 04 03](archive/design-comuni/domande-frequenti-parity-2026-04-03.md)
- [homepage structure diff 2026 04 02](archive/design-comuni/homepage-structure-diff-2026-04-02.md)
- [html structure comparison 2026 04 02](archive/design-comuni/html-structure-comparison-2026-04-02.md)
- [live parity 2026 04 04](archive/design-comuni/live-parity-2026-04-04.md)
- [risultati ricerca parity 2026 04 03](archive/design-comuni/risultati-ricerca-parity-2026-04-03.md)
- [SEGNALAZIONE FIX SESSION 2026 04 07](archive/design-comuni/SEGNALAZIONE-FIX-SESSION-2026-04-07.md)
- [SESSION REPORT 2026 04 04](archive/design-comuni/SESSION-REPORT-2026-04-04.md)
- [session summary 2026 03 30](archive/design-comuni/session-summary-2026-03-30.md)
- [SESSIONE FINALE 2026 04 07](archive/design-comuni/SESSIONE-FINALE-2026-04-07.md)
- [structural plan 2026 04 06](archive/design-comuni/structural-plan-2026-04-06.md)
- [visual comparison analysis 2026 04 02](archive/design-comuni/visual-comparison-analysis-2026-04-02.md)
- [visual comparison report 2026 04 02](archive/design-comuni/visual-comparison-report-2026-04-02.md)
- [visual fix report 2026 04 02](archive/design-comuni/visual-fix-report-2026-04-02.md)
- [visual parity report 2026 04 02](archive/design-comuni/visual-parity-report-2026-04-02.md)
- [VISUAL PARITY STATUS 2026 04 03](archive/design-comuni/VISUAL-PARITY-STATUS-2026-04-03.md)
- [wizard summary infolist runtime fix 2026 04 22](archive/design-comuni/wizard-summary-infolist-runtime-fix-2026-04-22.md)

**`archive/design-comuni/html-structure-analysis/`**

- [segnalazioni flow 2026 04 06](archive/design-comuni/html-structure-analysis/segnalazioni-flow-2026-04-06.md)

**`archive/visual-analysis/`**

- [HOMEPAGE VISUAL DIFF ANALYSIS 2026 04 07](archive/visual-analysis/HOMEPAGE-VISUAL-DIFF-ANALYSIS-2026-04-07.md)

**`archive/wiki/comparisons/`**

- [header visual parity audit 2026 05 04](archive/wiki/comparisons/header-visual-parity-audit-2026-05-04.md)
- [Segnalazione Crea Step Dati Screenshot Audit 2026-04-28](archive/wiki/comparisons/segnalazione-crea-step-dati-screenshot-audit-2026-04-28.md)

**`archive/wiki/troubleshooting/`**

- [git merge conflict inventory 2026 04 28](archive/wiki/troubleshooting/git-merge-conflict-inventory-2026-04-28.md)

</details>

<details>
<summary><strong>`assets/`</strong>: 1 documenti</summary>

- [BMAD: Vite Assets + Theme Build](assets/bmad-vite-assets.md)

</details>

<details>
<summary><strong>`audits/`</strong>: 4 documenti</summary>

- [Censimento blocchi CMS — dati di ente hardcoded (#20)](audits/cms-blocks-data-contract.md)
- [Audit performance, SEO tecnico e budget asset](audits/performance-seo.md)
- [Audit sicurezza e privacy del layer UI (Civic)](audits/security-privacy-ui.md)
- [Audit WCAG — frontend Civic](audits/wcag-audit.md)

</details>

<details>
<summary><strong>`auth/`</strong>: 18 documenti</summary>

- [login agid analysis](auth/login-agid-analysis.md)
- [login agid correct implementation](auth/login-agid-correct-implementation.md)
- [login agid fix complete](auth/login-agid-fix-complete.md)
- [login agid problems analysis](auth/login-agid-problems-analysis.md)
- [login agid refactoring plan](auth/login-agid-refactoring-plan.md)
- [login implementation guide](auth/login-implementation-guide.md)
- [Login loading feedback](auth/login-loading-feedback.md)
- [login ux fixes](auth/login-ux-fixes.md)
- [login widget form binding](auth/login-widget-form-binding.md)
- [login1 agid implementation complete](auth/login1-agid-implementation-complete.md)
- [login2 agid optimal implementation](auth/login2-agid-optimal-implementation.md)
- [login3 agid implementation complete](auth/login3-agid-implementation-complete.md)
- [login4 agid implementation](auth/login4-agid-implementation.md)
- [register ux audit](auth/register-ux-audit.md)
- [Register FO — UX design handoff](auth/register-ux-design-handoff.md)
- [sixteen agid naming fundamental rule](auth/sixteen-agid-naming-fundamental-rule.md)
- [sixteen agid naming rules](auth/sixteen-agid-naming-rules.md)
- [Sixteen auth: UserContract boundary](auth/user-contract-boundary.md)

</details>

<details>
<summary><strong>`auth-provider/`</strong>: 1 documenti</summary>

- [Folio Auth Login — Design Comuni + Volt + Filament Blueprint](auth-provider/provider-route.md)

</details>

<details>
<summary><strong>`best-practices/`</strong>: 1 documenti</summary>

- [filament wizard patterns](best-practices/filament-wizard-patterns.md)

</details>

<details>
<summary><strong>`blocks/`</strong>: 5 documenti</summary>

- [block taxonomy](blocks/block-taxonomy.md)
- [blocks implementation](blocks/blocks-implementation.md)
- [blocks structure convention](blocks/blocks-structure-convention.md)
- [Blocks folder vocabulary — Flowbite / Tailwind UI](blocks/folder-vocabulary.md)

**`blocks/confirmation/`**

- [README](blocks/confirmation/README.md)

</details>

<details>
<summary><strong>`bmad/`</strong>: 2 documenti</summary>

- [Sixteen front-office production readiness plan](bmad/front-office-production-readiness-plan.md)
- [Front-office readiness and Cms Head brainstorming](bmad/front-office-readiness-brainstorming.md)

</details>

<details>
<summary><strong>`bmd/`</strong>: 2 documenti</summary>

- [Final Compliance Verification: GDPR + PA Registration & Unsubscribe](bmd/registration-unsubscribe-compliance.story.md)
- [Step 1: Privacy Page Creation](bmd/step1-privacy-page.md)

</details>

<details>
<summary><strong>`body-structure-comparison/`</strong>: 47 documenti</summary>

- [INDEX](body-structure-comparison/index.md)
- [README](body-structure-comparison/README.md)

**`body-structure-comparison/segnalazione-01-privacy/`**

- [local structure](body-structure-comparison/segnalazione-01-privacy/local-structure.md)
- [ref structure](body-structure-comparison/segnalazione-01-privacy/ref-structure.md)
- [report](body-structure-comparison/segnalazione-01-privacy/report.md)

**`body-structure-comparison/segnalazione-02-dati/`**

- [diff 20260413 092309](body-structure-comparison/segnalazione-02-dati/diff-svg-class-icon.md)
- [diff 20260412 181446](body-structure-comparison/segnalazione-02-dati/diff-svg-class.md)
- [local structure](body-structure-comparison/segnalazione-02-dati/local-structure.md)
- [ref structure](body-structure-comparison/segnalazione-02-dati/ref-structure.md)
- [report 20260413 092309](body-structure-comparison/segnalazione-02-dati/report-confronto-struttura-html.md)
- [report 20260412 181446](body-structure-comparison/segnalazione-02-dati/report-confronto-struttura.md)
- [report header](body-structure-comparison/segnalazione-02-dati/report-header.md)
- [struct1 20260413 092309](body-structure-comparison/segnalazione-02-dati/struct1-shared-components.md)
- [struct1 20260412 181446](body-structure-comparison/segnalazione-02-dati/struct1.md)
- [struct2 20260413 092309](body-structure-comparison/segnalazione-02-dati/struct2-nav-aria.md)
- [struct2 20260412 181446](body-structure-comparison/segnalazione-02-dati/struct2.md)

**`body-structure-comparison/segnalazione-02-dati-run2/`**

- [report](body-structure-comparison/segnalazione-02-dati-run2/report.md)

**`body-structure-comparison/segnalazione-02-dati-run3/`**

- [report](body-structure-comparison/segnalazione-02-dati-run3/report.md)

**`body-structure-comparison/segnalazione-02-dati-run4/`**

- [report](body-structure-comparison/segnalazione-02-dati-run4/report.md)

**`body-structure-comparison/segnalazione-02-dati-run5/`**

- [report](body-structure-comparison/segnalazione-02-dati-run5/report.md)

**`body-structure-comparison/segnalazione-02-dati-run6/`**

- [report](body-structure-comparison/segnalazione-02-dati-run6/report.md)

**`body-structure-comparison/segnalazione-03-riepilogo/`**

- [local structure](body-structure-comparison/segnalazione-03-riepilogo/local-structure.md)
- [ref structure](body-structure-comparison/segnalazione-03-riepilogo/ref-structure.md)
- [report](body-structure-comparison/segnalazione-03-riepilogo/report.md)

**`body-structure-comparison/segnalazione-04-conferma/`**

- [local structure](body-structure-comparison/segnalazione-04-conferma/local-structure.md)
- [ref structure](body-structure-comparison/segnalazione-04-conferma/ref-structure.md)
- [report](body-structure-comparison/segnalazione-04-conferma/report.md)

**`body-structure-comparison/segnalazione-area-personale/`**

- [diff 20260420 220359](body-structure-comparison/segnalazione-area-personale/diff-div-class.md)
- [diff 20260420 220453](body-structure-comparison/segnalazione-area-personale/diff-shared-components.md)
- [local structure](body-structure-comparison/segnalazione-area-personale/local-structure.md)
- [ref structure](body-structure-comparison/segnalazione-area-personale/ref-structure.md)
- [report 20260420 220453](body-structure-comparison/segnalazione-area-personale/report-confronto-struttura-html.md)
- [report 20260420 220359](body-structure-comparison/segnalazione-area-personale/report-confronto-struttura.md)
- [report](body-structure-comparison/segnalazione-area-personale/report.md)
- [struct1 20260420 220453](body-structure-comparison/segnalazione-area-personale/struct1-shared-components.md)
- [struct1 20260420 220359](body-structure-comparison/segnalazione-area-personale/struct1.md)
- [struct2 20260420 220453](body-structure-comparison/segnalazione-area-personale/struct2-shared-components.md)
- [struct2 20260420 220359](body-structure-comparison/segnalazione-area-personale/struct2.md)

**`body-structure-comparison/segnalazione-dettaglio/`**

- [README](body-structure-comparison/segnalazione-dettaglio/README.md)
- [report](body-structure-comparison/segnalazione-dettaglio/report.md)
- [segnalazione dettaglio comparison summary](body-structure-comparison/segnalazione-dettaglio/segnalazione-dettaglio-comparison-summary.md)

**`body-structure-comparison/segnalazioni-elenco/`**

- [README](body-structure-comparison/segnalazioni-elenco/README.md)
- [report](body-structure-comparison/segnalazioni-elenco/report.md)

**`body-structure-comparison/segnalazioni-elenco-run-devstory/`**

- [diff 20260420 223808](body-structure-comparison/segnalazioni-elenco-run-devstory/diff.md)
- [report 20260420 223808](body-structure-comparison/segnalazioni-elenco-run-devstory/report.md)
- [struct1 20260420 223808](body-structure-comparison/segnalazioni-elenco-run-devstory/struct1.md)
- [struct2 20260420 223808](body-structure-comparison/segnalazioni-elenco-run-devstory/struct2.md)

</details>

<details>
<summary><strong>`build/`</strong>: 1 documenti</summary>

- [Baseline riproducibile — build, lint, test (Civic)](build/reproducible-baseline.md)

</details>

<details>
<summary><strong>`clean-code/`</strong>: 1 documenti</summary>

- [schema clean code rule](clean-code/schema-clean-code-rule.md)

</details>

<details>
<summary><strong>`comparisons/`</strong>: 1 documenti</summary>

- [comparison summary](comparisons/comparison-summary.md)

</details>

<details>
<summary><strong>`compliance/`</strong>: 5 documenti</summary>

- [Sixteen: matrice di conformita' dell'interfaccia (accessibilita', lingue, design, cookie e privacy…](compliance/01-matrice-conformita-interfaccia.md)
- [Matrice di conformita' alle Linee guida di design della PA, capitolo 4 «Requisiti»](compliance/02-matrice-linee-guida-design-cap4.md)
- [Front office: scheda per pagina (scopo, funzione, politica, coerenza)](compliance/03-front-office-scheda-per-pagina.md)
- [Audit UI/UX del front office e coerenza con Design Comuni](compliance/04-audit-ui-ux-design-comuni.md)
- [Dichiarazione di accessibilità e cookie policy: fonti, evidenze e scelte](compliance/dichiarazione-accessibilita-e-cookie-fonti-e-scelte.md)

</details>

<details>
<summary><strong>`components/`</strong>: 1 documenti</summary>

- [tab system](components/tab-system.md)

</details>

<details>
<summary><strong>`computing/`</strong>: 1 documenti</summary>

- [php enum string conversion error](computing/php-enum-string-conversion-error.md)

</details>

<details>
<summary><strong>`concepts/`</strong>: 1 documenti</summary>

- [map-lit — API ticket Folio](concepts/map-lit-ticket-api.md)

</details>

<details>
<summary><strong>`contracts/`</strong>: 12 documenti</summary>

- [(operazione) — contratto comportamentale](contracts/_template.md)
- [Contratto — build asset Civic](contracts/build-surface.md)
- [Contratto — CieAuthAction (Civic)](contracts/cie-auth-action.md)
- [Contratto — Civic Folio page shell](contracts/folio-page-shell.md)
- [Contratto — parita' dei cataloghi lang/ di Civic (it, en, de, es, mt)](contracts/i18n-catalog-parity.md)
- [Contratto — formati per Paese di Civic: date, numeri, indirizzi, telefoni, codici postali](contracts/i18n-country-formats.md)
- [Contratto — terminologia dell'ente per profilo Paese (entity.php)](contracts/i18n-entity-terminology.md)
- [Contratti del tema Civic](contracts/README.md)
- [Contratto — SanitizeReturnUrlAction (Civic)](contracts/sanitize-return-url-action.md)
- [Contratto — ServeThemeAssetAction (Civic)](contracts/serve-theme-asset-action.md)
- [Contratto — SpidAuthAction (Civic)](contracts/spid-auth-action.md)
- [Contratto — identita' del tema Civic](contracts/theme-identity.md)

</details>

<details>
<summary><strong>`css/`</strong>: 5 documenti</summary>

- [batch parity](css/batch-parity.md)
- [file upload fix](css/file-upload-fix.md)
- [font fix](css/font-fix.md)
- [parity session](css/parity-session.md)
- [session report](css/session-report.md)

</details>

<details>
<summary><strong>`css-js-parity/`</strong>: 1 documenti</summary>

- [ticket 01 privacy css fix](css-js-parity/ticket-01-privacy-css-fix.md)

</details>

<details>
<summary><strong>`decision-log/`</strong>: 15 documenti</summary>

- [D11 — Filament Wizard per tickets/create (parità con segnalazione-01-privacy)](decision-log/d11-filament-wizard-tickets-create.md)
- [D12 — Correzione percorso JSON tickets/create (errore agente)](decision-log/d12-correction-json-path-tickets.md)
- [D13 — Filosofia/Zen/Politica della mappa nel wizard tickets/create (step dati-di-segnalazione)](decision-log/d13-map-zen-philosophy.md)
- [D14 — Riepilogo wizard (step 3/3) con mappa — logica/zen/politica](decision-log/d14-riepilogo-map-zen.md)
- [D15 — Conferma post-save (segnalazione-04-conferma, 10 sezioni, 1.7KB)](decision-log/d15-conferma-post-save.md)
- [D15: il Volt della pagina generica ha una radice propria](decision-log/d15-volt-fragment-explicit-root.md)
- [D16 — Middleware guest per /it/tickets/create (filosofia della trasparenza)](decision-log/d16-middleware-guest.md)
- [D16: il look Design Comuni si accende con un attributo, deciso dal JSON della pagina](decision-log/d16-scope-data-dc-pagine-reali.md)
- [D17 — Header 'Accedi all'area personale': logica, normativa, scopo, professionale](decision-log/d17-header-login-area-personale.md)
- [D17: /it/tickets/create richiede l'autenticazione](decision-log/d17-tickets-create-richiede-auth.md)
- [Login e registrazione tornano alla pagina richiesta (url.intended)](decision-log/d18-login-e-registrazione-tornano-alla-pagina-richiesta.md)
- [D18 — UserContract over BaseUser in theme boundaries](decision-log/d18-user-contract-over-base-user.md)
- [D19 — CoordinatePicker dinamiche (luogo reale dell'utente, NON fisso)](decision-log/d19-coordinate-dynamic.md)
- [D19 — Feedback immediato sul submit del login](decision-log/d19-login-submit-feedback.md)
- [homepage audit taste skill bmad](decision-log/homepage-audit-taste-skill-bmad.md)

</details>

<details>
<summary><strong>`design/`</strong>: 1 documenti</summary>

- [Design token e branding multi-tenant (Civic)](design/design-tokens.md)

</details>

<details>
<summary><strong>`design-comuni/`</strong>: 174 documenti</summary>

- [00 index](design-comuni/00-index.md)
- [100 percent completion report](design-comuni/100-percent-completion-report.md)
- [Accesso servizio — implementazione Sixteen](design-comuni/accesso-servizio.md)
- [ALL PAGES ANALYSIS](design-comuni/all-pages-analysis.md)
- [ALPINE JS ACCORDION IMPLEMENTAZIONE](design-comuni/alpine-js-accordion-implementazione.md)
- [ANALISI STRUTTURA HTML FAQ](design-comuni/analisi-struttura-html-faq.md)
- [ARCHITECTURAL DECISIONS](design-comuni/architectural-decisions.md)
- [ARGOMENTI ANALISI](design-comuni/argomenti-analisi.md)
- [ARGOMENTI HTML ANALYSIS](design-comuni/argomenti-html-analysis.md)
- [argomenti parity](design-comuni/argomenti-parity.md)
- [ARGOMENTI REPORT AGGIORNATO](design-comuni/argomenti-report-aggiornato.md)
- [ARGOMENTI REPORT FINALE](design-comuni/argomenti-report-finale.md)
- [argomento parity](design-comuni/argomento-parity.md)
- [argomento structure report](design-comuni/argomento-structure-report.md)
- [BATCH BODY PARITY REPORT](design-comuni/batch-body-parity-report.md)
- [batch body parity](design-comuni/batch-body-parity.md)
- [BATCH PAGES ANALYSIS](design-comuni/batch-pages-analysis.md)
- [BATCH PROGRESS REPORT](design-comuni/batch-progress-report.md)
- [batch structure audit](design-comuni/batch-structure-audit.md)
- [BLOCK DEVELOPMENT RULES](design-comuni/block-development-rules.md)
- [bmad gsd status 2026 04 02](design-comuni/bmad-gsd-status-analyze.md)
- [bmad gsd status](design-comuni/bmad-gsd-status.md)
- [BMAD LAYOUT FIX](design-comuni/bmad-layout-fix.md)
- [BMAD SUMMARY](design-comuni/bmad-summary.md)
- [body plain rule](design-comuni/body-plain-rule.md)
- [bootstrap italia classes tailwind apply](design-comuni/bootstrap-italia-classes-tailwind-apply.md)
- [BOOTSTRAP ITALIA JS FIX](design-comuni/bootstrap-italia-js-fix.md)
- [BOOTSTRAP ITALIA REIMPLEMENTATION](design-comuni/bootstrap-italia-reimplementation.md)
- [bootstrap italia tailwind apply](design-comuni/bootstrap-italia-tailwind-apply.md)
- [BOOTSTRAP ITALIA TAILWIND ONLY](design-comuni/bootstrap-italia-tailwind-only.md)
- [color palette](design-comuni/color-palette.md)
- [css fix plan](design-comuni/css-fix-plan.md)
- [css js alignment plan](design-comuni/css-js-alignment-plan.md)
- [css js parity](design-comuni/css-js-parity.md)
- [css js pass](design-comuni/css-js-pass.md)
- [CSS JS PHASE BLOCKER](design-comuni/css-js-phase-blocker.md)
- [CSS JS PHASE FINAL STATUS](design-comuni/css-js-phase-final-status.md)
- [CSS JS PHASE STATUS](design-comuni/css-js-phase-status.md)
- [CSS VISUAL ALIGNMENT](design-comuni/css-visual-alignment.md)
- [CURRENT PASS 2026 04 04](design-comuni/current-pass.md)
- [DAILY PROGRESS 2026 04 01](design-comuni/daily-progress.md)
- [DESIGN COMUNI BASELINE ANALYSIS](design-comuni/design-comuni-baseline-analysis.md)
- [design comuni batch audit](design-comuni/design-comuni-batch-audit.md)
- [DESIGN-COMUNI-CANONICAL](design-comuni/design-comuni-canonical.md)
- [DESIGN COMUNI COMPARISON TOOLS](design-comuni/design-comuni-comparison-tools.md)
- [DOMANDE FREQUENTI ANALISI VISIVA](design-comuni/domande-frequenti-analisi-visiva.md)
- [DOMANDE FREQUENTI HTML ANALYSIS](design-comuni/domande-frequenti-html-analysis.md)
- [DOMANDE FREQUENTI IMPLEMENTAZIONE](design-comuni/domande-frequenti-implementazione.md)
- [domande frequenti parity](design-comuni/domande-frequenti-parity.md)
- [DOMANDE FREQUENTI REPORT FINALE](design-comuni/domande-frequenti-report-finale.md)
- [dynamic route correction](design-comuni/dynamic-route-correction.md)
- [FAIL PAGES ANALYSIS](design-comuni/fail-pages-analysis.md)
- [FAIL PAGES DETAIL REPORT](design-comuni/fail-pages-detail-report.md)
- [FAIL PAGES FIX REPORT](design-comuni/fail-pages-fix-report.md)
- [final correction folio volt](design-comuni/final-correction-folio-volt.md)
- [final progress report](design-comuni/final-progress-report.md)
- [final session report](design-comuni/final-session-report.md)
- [FINAL VISUAL PARITY REPORT](design-comuni/final-visual-parity-report.md)
- [FIX ACCORDION FINALE](design-comuni/fix-accordion-finale.md)
- [FIX ACCORDION PARITY JS](design-comuni/fix-accordion-parity-js.md)
- [GOVERNANCE CARDS ISSUE ANALYSIS](design-comuni/governance-cards-issue-analysis.md)
- [GSD HTML PARITY PLAN](design-comuni/gsd-html-parity-plan.md)
- [heroicons fix complete](design-comuni/heroicons-fix-complete.md)
- [heroicons removal fix](design-comuni/heroicons-removal-fix.md)
- [homepage complete](design-comuni/homepage-complete.md)
- [homepage fix complete](design-comuni/homepage-fix-complete.md)
- [homepage gap analysis](design-comuni/homepage-gap-analysis.md)
- [HOMEPAGE HTML ANALYSIS](design-comuni/homepage-html-analysis.md)
- [homepage html comparison](design-comuni/homepage-html-comparison.md)
- [HOMEPAGE HTML STRUCTURE COMPARISON](design-comuni/homepage-html-structure-comparison.md)
- [homepage parity report](design-comuni/homepage-parity-report.md)
- [HOMEPAGE PARITY SUMMARY](design-comuni/homepage-parity-summary.md)
- [HOMEPAGE STRUCTURAL ANALYSIS FINAL](design-comuni/homepage-structural-analysis-final.md)
- [homepage structure analysis](design-comuni/homepage-structure-analysis.md)
- [homepage structure diff](design-comuni/homepage-structure-diff.md)
- [HOMEPAGE VISUAL PARITY SESSION](design-comuni/homepage-visual-parity-session.md)
- [HTML BODY COMPARISON REPORT](design-comuni/html-body-comparison-report.md)
- [HTML GAP ANALYSIS BELOW 80](design-comuni/html-gap-analysis-below.md)
- [HTML PARITY COMPLETE](design-comuni/html-parity-complete.md)
- [HTML PARITY VERIFICATION REPORT](design-comuni/html-parity-verification-report.md)
- [html structure comparison](design-comuni/html-structure-comparison.md)
- [JSON DRIVEN PHILOSOPHY](design-comuni/json-driven-philosophy.md)
- [LIVE BODY PARITY REPORT](design-comuni/live-body-parity-report.md)
- [live parity](design-comuni/live-parity.md)
- [MASTER IMPLEMENTATION PLAN](design-comuni/master-implementation-plan.md)
- [multi agent final report](design-comuni/multi-agent-final-report.md)
- [multi agent homepage fix](design-comuni/multi-agent-homepage-fix.md)
- [multi agent pages creation guide](design-comuni/multi-agent-pages-creation-guide.md)
- [multi agent setup](design-comuni/multi-agent-setup.md)
- [multi agent status](design-comuni/multi-agent-status.md)
- [pages analysis](design-comuni/pages-analysis.md)
- [pages census](design-comuni/pages-census.md)
- [pages complete final](design-comuni/pages-complete-final.md)
- [pages complete guide](design-comuni/pages-complete-guide.md)
- [pages creation progress](design-comuni/pages-creation-progress.md)
- [pages final complete](design-comuni/pages-final-complete.md)
- [PARITY SESSION SUMMARY](design-comuni/parity-session-summary.md)
- [product brief](design-comuni/product-brief.md)
- [PROGRESS REPORT](design-comuni/progress-report.md)
- [QUICK START](design-comuni/quick-start.md)
- [README](design-comuni/README.md)
- [REPLICATION MASTER PLAN](design-comuni/replication-master-plan.md)
- [REPORT FIX COMPLETO FAQ](design-comuni/report-fix-completo-faq.md)
- [RISULTATI RICERCA ANALISI](design-comuni/risultati-ricerca-analisi.md)
- [risultati ricerca parity](design-comuni/risultati-ricerca-parity.md)
- [RISULTATI RICERCA REPORT FINALE](design-comuni/risultati-ricerca-report-finale.md)
- [RISULTATI RICERCA REPORT](design-comuni/risultati-ricerca-report.md)
- [SEGNALAZIONE FIX SESSION](design-comuni/segnalazione-fix-session.md)
- [SEGNALAZIONE HTML PARITY GAP ANALYSIS](design-comuni/segnalazione-html-parity-gap-analysis.md)
- [SEGNALAZIONE PAGES ANALYSIS](design-comuni/segnalazione-pages-analysis.md)
- [SEGNALAZIONI ELENCO ANALISI](design-comuni/segnalazioni-elenco-analisi.md)
- [SEGNALAZIONI ELENCO CSS REPORT](design-comuni/segnalazioni-elenco-css-report.md)
- [SEGNALAZIONI ELENCO ELEMENTI ANALISI](design-comuni/segnalazioni-elenco-elementi-analisi.md)
- [SEGNALAZIONI ELENCO FIX COMPLETI](design-comuni/segnalazioni-elenco-fix-completi.md)
- [SEGNALAZIONI ELENCO LAYOUT FIX](design-comuni/segnalazioni-elenco-layout-fix.md)
- [SEGNALAZIONI ELENCO RATING FIX](design-comuni/segnalazioni-elenco-rating-fix.md)
- [SEGNALAZIONI ELENCO REPORT](design-comuni/segnalazioni-elenco-report.md)
- [segnalazioni elenco structure](design-comuni/segnalazioni-elenco-structure.md)
- [SEGNALAZIONI ELENCO TABS ANALYSIS](design-comuni/segnalazioni-elenco-tabs-analysis.md)
- [SEGNALAZIONI ELENCO VISUAL ANALYSIS](design-comuni/segnalazioni-elenco-visual-analysis.md)
- [SESSION REPORT 2026 04 07](design-comuni/session-report-completo-sessione.md)
- [SESSION REPORT](design-comuni/session-report.md)
- [session summary](design-comuni/session-summary.md)
- [SESSIONE FINALE](design-comuni/sessione-finale.md)
- [SKILLS RULES](design-comuni/skills-rules.md)
- [STATO ATTUALE FAQ](design-comuni/stato-attuale-faq.md)
- [STATUS](design-comuni/status.md)
- [stepper component](design-comuni/stepper-component.md)
- [structural plan](design-comuni/structural-plan.md)
- [superpowers integration guide](design-comuni/superpowers-integration-guide.md)
- [superpowers integration](design-comuni/superpowers-integration.md)
- [TAILWIND ALPINE RULES](design-comuni/tailwind-alpine-rules.md)
- [TAILWIND DESIGN COMUNI COMPLETE](design-comuni/tailwind-design-comuni-complete.md)
- [TAILWIND IMPLEMENTATION](design-comuni/tailwind-implementation.md)
- [TAILWIND ONLY BUILD COMPLETE](design-comuni/tailwind-only-build-complete.md)
- [test results](design-comuni/test-results.md)
- [tests pages recovery](design-comuni/tests-pages-recovery.md)
- [TICKET CREATION WIZARD](design-comuni/TICKET-CREATION-WIZARD.md)
- [VALIDAZIONE ARGOMENTI SERVIZI](design-comuni/validazione-argomenti-servizi.md)
- [VALIDAZIONE POST FIX](design-comuni/validazione-post-fix.md)
- [VIEW PATH FIX REPORT](design-comuni/view-path-fix-report.md)
- [visual comparison analysis](design-comuni/visual-comparison-analysis.md)
- [visual comparison report](design-comuni/visual-comparison-report.md)
- [visual fix report](design-comuni/visual-fix-report.md)
- [VISUAL PARITY ACTION PLAN](design-comuni/visual-parity-action-plan.md)
- [VISUAL PARITY BATCH REPORT](design-comuni/visual-parity-batch-report.md)
- [visual parity report](design-comuni/visual-parity-report.md)
- [VISUAL PARITY STATUS](design-comuni/visual-parity-status.md)
- [wizard governance bridge](design-comuni/wizard-governance-bridge.md)
- [wizard summary infolist runtime fix](design-comuni/wizard-summary-infolist-runtime-fix.md)
- [work plan](design-comuni/work-plan.md)

**`design-comuni/analysis/`**

- [HEADER ANALYSIS](design-comuni/analysis/header-analysis.md)
- [header html parity](design-comuni/analysis/header-html-parity.md)
- [HTML STRUCTURE COMPARISON](design-comuni/analysis/html-structure-comparison.md)
- [INDEX](design-comuni/analysis/index.md)
- [PAGES GROUP 1](design-comuni/analysis/PAGES_GROUP_1.md)
- [PAGES GROUP 2](design-comuni/analysis/PAGES_GROUP_2.md)
- [PAGES GROUP 3](design-comuni/analysis/PAGES_GROUP_3.md)
- [PAGES GROUP 4](design-comuni/analysis/PAGES_GROUP_4.md)
- [PAGES GROUP 5](design-comuni/analysis/PAGES_GROUP_5.md)
- [PAGES GROUP 6](design-comuni/analysis/PAGES_GROUP_6.md)
- [PAGES GROUP 7](design-comuni/analysis/PAGES_GROUP_7.md)

**`design-comuni/batch-body-parity/`**

- [README](design-comuni/batch-body-parity/README.md)

**`design-comuni/blocks/`**

- [00 index](design-comuni/blocks/00-index.md)

**`design-comuni/html-comparisons/`**

- [HTML STRUCTURE COMPARISON](design-comuni/html-comparisons/html-structure-comparison.md)

**`design-comuni/html-structure-analysis/`**

- [segnalazioni flow](design-comuni/html-structure-analysis/segnalazioni-flow.md)

**`design-comuni/segnalazione-dettaglio/`**

- [README](design-comuni/segnalazione-dettaglio/README.md)

**`design-comuni/segnalazione-flow/`**

- [README](design-comuni/segnalazione-flow/README.md)

**`design-comuni/segnalazione-parity/`**

- [CSS JS PARITY COMPLETE](design-comuni/segnalazione-parity/css-js-parity-complete.md)
- [HTML STRUCTURE ANALYSIS](design-comuni/segnalazione-parity/html-structure-analysis.md)
- [README](design-comuni/segnalazione-parity/README.md)
- [STATUS REPORT 2026 04 07](design-comuni/segnalazione-parity/status-report.md)

**`design-comuni/segnalazioni-elenco/`**

- [analisi struttura](design-comuni/segnalazioni-elenco/analisi-struttura.md)
- [README](design-comuni/segnalazioni-elenco/README.md)

</details>

<details>
<summary><strong>`design-system/`</strong>: 5 documenti</summary>

- [tests.argomenti.json — Struttura dinamica per pagina Argomenti (Design Comuni v2.4.0)](design-system/argomenti.md)
- [Component Catalog — Tema Sixteen](design-system/components.md)
- [Design System Master File](design-system/master.md)
- [Civic design system — inherited Sixteen reference](design-system/README.md)
- [Design Tokens — Tema Sixteen / Design Comuni](design-system/tokens.md)

</details>

<details>
<summary><strong>`email/`</strong>: 2 documenti</summary>

- [📧 Email Deliverability Best Practices – Sixteen Theme](email/best-practices.md)
- [Email Infrastructure Setup — FixCity / Laraxot (Sixteen Theme)](email/email-setup.md)

</details>

<details>
<summary><strong>`homepage/`</strong>: 1 documenti</summary>

- [homepage implementation](homepage/homepage-implementation.md)

</details>

<details>
<summary><strong>`how-to/`</strong>: 1 documenti</summary>

- [Sweep del front office anonimo e diff dell'head: metodo, soglie, trappole](how-to/front-office-anonymous-sweep.md)

</details>

<details>
<summary><strong>`html-compare/`</strong>: 2 documenti</summary>


**`html-compare/segnalazioni-elenco/`**

- [parity score](html-compare/segnalazioni-elenco/parity-score.md)
- [report](html-compare/segnalazioni-elenco/report.md)

</details>

<details>
<summary><strong>`html-parity-reports/`</strong>: 8 documenti</summary>

- [summary](html-parity-reports/summary.md)

**`html-parity-reports/segnalazione-01-privacy/`**

- [report](html-parity-reports/segnalazione-01-privacy/report.md)

**`html-parity-reports/segnalazione-02-dati/`**

- [report](html-parity-reports/segnalazione-02-dati/report.md)

**`html-parity-reports/segnalazione-03-riepilogo/`**

- [report](html-parity-reports/segnalazione-03-riepilogo/report.md)

**`html-parity-reports/segnalazione-04-conferma/`**

- [report](html-parity-reports/segnalazione-04-conferma/report.md)

**`html-parity-reports/segnalazione-area-personale/`**

- [report](html-parity-reports/segnalazione-area-personale/report.md)

**`html-parity-reports/segnalazione-dettaglio/`**

- [report](html-parity-reports/segnalazione-dettaglio/report.md)

**`html-parity-reports/segnalazioni-elenco/`**

- [report](html-parity-reports/segnalazioni-elenco/report.md)

</details>

<details>
<summary><strong>`html-structure-analysis/`</strong>: 4 documenti</summary>

- [CSS FIX IMPLEMENTATION REPORT](html-structure-analysis/css-fix-implementation-report.md)
- [CSS FIX STRATEGY](html-structure-analysis/css-fix-strategy.md)
- [INDEX](html-structure-analysis/index.md)
- [STRUCTURE COMPARISON](html-structure-analysis/structure-comparison.md)

</details>

<details>
<summary><strong>`html-structure-comparison/`</strong>: 2 documenti</summary>

- [README](html-structure-comparison/README.md)

**`html-structure-comparison/segnalazioni-elenco/`**

- [segnalazioni elenco comparison summary](html-structure-comparison/segnalazioni-elenco/segnalazioni-elenco-comparison-summary.md)

</details>

<details>
<summary><strong>`i18n/`</strong>: 9 documenti</summary>

- [Comportamento multilingua del sito](i18n/00-comportamento-multilingua.md)
- [Glossario e scelte di traduzione it, en, de, es](i18n/01-glossario.md)
- [Contratto di parita' dei cataloghi lang/](i18n/02-catalog-parity.md)
- [Profili Paese/ente e terminologia configurabile — contratto](i18n/country-profiles.md)
- [Formati per Paese: date, indirizzi, telefoni, codici postali](i18n/formats.md)
- [i18n del tema Civic: indice](i18n/index.md)
- [Esperienza Malta per Local Councils — analisi e checklist](i18n/malta-local-councils.md)
- [Catalogo maltese mt: stato, marcatore di revisione, abilitazione](i18n/mt-catalog.md)
- [Copertura traduzioni it/en/de/es e mt — audit e fallback](i18n/translation-coverage.md)

</details>

<details>
<summary><strong>`implementation/`</strong>: 2 documenti</summary>

- [STRATEGY](implementation/strategy.md)
- [TEAM COORDINATION](implementation/team-coordination.md)

</details>

<details>
<summary><strong>`investigation/`</strong>: 10 documenti</summary>

- [Investigation — Design Comuni Homepage Template Analysis for Sixteen Theme](investigation/design-comuni-homepage-investigation.md)
- [Design Comuni Source Analysis — front-office pages + UI kit](investigation/design-comuni-source-analysis.md)
- [Investigazione — Redesign FO con DesignComuni](investigation/front-office-design-comuni.md)
- [Pianificazione redesign front office con DesignComuni](investigation/front-office-redesign-planning.md)
- [Header and Footer Element Inventory and Duplication Analysis](investigation/header-footer-consolidation.md)
- [Indagine homepage DesignComuni — Sixteen Theme](investigation/homepage-design-comuni-investigation.md)
- [Homepage audit + taste-skill + BMAD — Sixteen Design Comuni](investigation/homepage-taste-skill-bmad.md)
- [Investigation — Sixteen JSON Data-Driven Home](investigation/investigation-sixteen-json-alignment.md)
- [Investigation — Front Office Pages for Redesign with Design Comuni](investigation/redesign-front-office-pages-investigation.md)
- [Sixteen — Architettura Folio + JSON content blocks + PageSlugMiddleware](investigation/sixteen-architecture-analysis.md)

</details>

<details>
<summary><strong>`knowledge-pages/`</strong>: 1 documenti</summary>

- [Sixteen Theme — Home JSON Errors and Missing Components](knowledge-pages/sixteen-theme-home-json-errors.md)

</details>

<details>
<summary><strong>`llm-wiki/`</strong>: 7 documenti</summary>

- [Agent instructions](llm-wiki/agents.md)
- [index](llm-wiki/index.md)
- [log](llm-wiki/log.md)

**`llm-wiki/_templates/`**

- [Untitled Concept](llm-wiki/_templates/concept.md)
- [Entity Name](llm-wiki/_templates/entity.md)
- [Source Title](llm-wiki/_templates/source.md)

**`llm-wiki/concepts/`**

- [Wiki Sacred Structure Rule](llm-wiki/concepts/wiki-sacred-structure-rule.md)

</details>

<details>
<summary><strong>`logo/`</strong>: 1 documenti</summary>

- [Logo Fixcity — Heroicons Outline](logo/heroicons-outline.md)

</details>

<details>
<summary><strong>`manuals/`</strong>: 2 documenti</summary>

- [Manuale utente — tema Sixteen](manuals/manuale-utente.md)
- [Manuale utente tema Sixteen](manuals/user-manual.md)

</details>

<details>
<summary><strong>`mappings/`</strong>: 1 documenti</summary>

- [README](mappings/README.md)

</details>

<details>
<summary><strong>`marketing/`</strong>: 3 documenti</summary>

- [civic homepage conversion playbook](marketing/civic-homepage-conversion-playbook.md)
- [gtm agent tooling](marketing/gtm-agent-tooling.md)
- [Homepage marketing contract](marketing/homepage-conversion-contract.md)

</details>

<details>
<summary><strong>`mcp/`</strong>: 1 documenti</summary>

- [MCP THEME SETUP](mcp/mcp-theme-setup.md)

</details>

<details>
<summary><strong>`migration/`</strong>: 2 documenti</summary>

- [Integrazione del tema Civic nell'host FixCity](migration/host-integration.md)
- [Audit dei riferimenti Sixteen e confini tema/moduli](migration/sixteen-references-audit.md)

</details>

<details>
<summary><strong>`phases/`</strong>: 2 documenti</summary>

- [01 PHASE A DISCOVERY](phases/01-phase-a-discovery.md)
- [README](phases/README.md)

</details>

<details>
<summary><strong>`plans/`</strong>: 4 documenti</summary>

- [BMAD — Riordino docs Sixteen (auth + categoria + second brain)](plans/docs-cleanup-story.md)
- [Piano: guardie e strumenti perche' i difetti dell'audit del front office non si ripetano](plans/front-office-hardening-plan.md)
- [Piano BMAD: backlog UX, prestazioni e consenso del front office (onde, dipendenze, criteri di chius…](plans/front-office-ux-performance-backlog-plan.md)
- [PDF e screenshot reali del front office](plans/pdf-real-screenshot-capture.md)

</details>

<details>
<summary><strong>`product/`</strong>: 6 documenti</summary>


**`product/launch-plan/`**

- [README](product/launch-plan/README.md)

**`product/prd/`**

- [README](product/prd/README.md)

**`product/roadmap/`**

- [README](product/roadmap/README.md)

**`product/spring-planning/`**

- [README](product/spring-planning/README.md)

**`product/strategy/`**

- [README](product/strategy/README.md)

**`product/user-research/`**

- [README](product/user-research/README.md)

</details>

<details>
<summary><strong>`prompts/`</strong>: 98 documenti</summary>

- [01](prompts/01.md)
- [Workflow BMAD Design Comuni Sixteen](prompts/02.md)
- [03](prompts/03.md)
- [04 Sixteen — front-office civico (shell, inbound, auth, ticket)](prompts/04.md)
- [05](prompts/05.md)
- [06](prompts/06.md)
- [Ricetta per replicare una pagina Design Comuni in /it/tests (guidata da JSON, Tailwind + Alpine)](prompts/design-comuni-page-recipe.md)
- [segnalazioni html parity summary](prompts/segnalazioni-html-parity-summary.md)

**`prompts/homepage/`**

- [Coordinamento tra agenti sulle pagine /it/tests](prompts/homepage/00-COORDINATION.md)
- [HTML SIMILARITY 90 PERCENT PLAN](prompts/homepage/html-similarity-90-percent-plan.md)
- [HTML SIMILARITY 90 PERCENT SESSION](prompts/homepage/html-similarity-90-percent-session.md)
- [increment 90](prompts/homepage/increment.md)
- [Homepage Design Prompt — Sixteen / Design Comuni](prompts/homepage/index.md)

**`prompts/homepage/blocks/`**

- [00 index](prompts/homepage/blocks/00-index.md)
- [00 skiplink](prompts/homepage/blocks/00-skiplink.md)
- [01 header slim](prompts/homepage/blocks/01-header-slim.md)
- [02 header center](prompts/homepage/blocks/02-header-center.md)
- [Block 03: Header Navbar](prompts/homepage/blocks/03-header-navbar.md)
- [04 hero section](prompts/homepage/blocks/04-hero-section.md)
- [05 governance calendar](prompts/homepage/blocks/05-governance-calendar.md)
- [06 evidence section](prompts/homepage/blocks/06-evidence-section.md)
- [07 useful links](prompts/homepage/blocks/07-useful-links.md)
- [08 rating feedback](prompts/homepage/blocks/08-rating-feedback.md)
- [09 contacts section](prompts/homepage/blocks/09-contacts-section.md)
- [10 footer](prompts/homepage/blocks/10-footer.md)
- [block 00 header nav](prompts/homepage/blocks/block-00-header-nav.md)
- [block 01 hero evidence](prompts/homepage/blocks/block-01-hero-evidence.md)
- [block 02 calendario eventi](prompts/homepage/blocks/block-02-calendario-eventi.md)
- [block 03 argomenti evidenza](prompts/homepage/blocks/block-03-argomenti-evidenza.md)
- [block 04 search useful links](prompts/homepage/blocks/block-04-search-useful-links.md)
- [block 05 feedback rating](prompts/homepage/blocks/block-05-feedback-rating.md)
- [block 06 footer](prompts/homepage/blocks/block-06-footer.md)
- [INDEX](prompts/homepage/blocks/index.md)

**`prompts/risultati-ricerca/`**

- [Search Results Page Prompt — Sixteen / Design Comuni](prompts/risultati-ricerca/index.md)

**`prompts/segnalazione-01-privacy/`**

- [7 6 segnalazione 01 privacy html parity](prompts/segnalazione-01-privacy/7-6-segnalazione-01-privacy-html-parity.md)
- [README](prompts/segnalazione-01-privacy/README.md)

**`prompts/segnalazione-01-privacy/body-structure-comparison/`**

- [report](prompts/segnalazione-01-privacy/body-structure-comparison/report.md)
- [segnalazione 01 privacy comparison report](prompts/segnalazione-01-privacy/body-structure-comparison/segnalazione-01-privacy-comparison-report.md)

**`prompts/segnalazione-01-privacy/css-js-phase/`**

- [CSS JS PHASE REPORT](prompts/segnalazione-01-privacy/css-js-phase/css-js-phase-report.md)

**`prompts/segnalazione-02-dati/`**

- [7 3 segnalazione 02 dati html visual parity](prompts/segnalazione-02-dati/7-3-segnalazione-02-dati-html-visual-parity.md)
- [html parity analysis](prompts/segnalazione-02-dati/html-parity-analysis.md)
- [README](prompts/segnalazione-02-dati/README.md)

**`prompts/segnalazione-02-dati/body-structure-comparison/`**

- [segnalazione 02 dati comparison report](prompts/segnalazione-02-dati/body-structure-comparison/segnalazione-02-dati-comparison-report.md)

**`prompts/segnalazione-03-riepilogo/`**

- [7 11 segnalazione 03 riepilogo html parity](prompts/segnalazione-03-riepilogo/7-11-segnalazione-03-riepilogo-html-parity.md)
- [html parity analysis](prompts/segnalazione-03-riepilogo/html-parity-analysis.md)

**`prompts/segnalazione-03-riepilogo/body-structure-comparison/`**

- [segnalazione 03 riepilogo comparison report](prompts/segnalazione-03-riepilogo/body-structure-comparison/segnalazione-03-riepilogo-comparison-report.md)

**`prompts/segnalazione-04-conferma/`**

- [7 12 segnalazione 04 confirma html parity](prompts/segnalazione-04-conferma/7-12-segnalazione-04-confirma-html-parity.md)

**`prompts/segnalazione-04-conferma/body-structure-comparison/`**

- [local structure](prompts/segnalazione-04-conferma/body-structure-comparison/local-structure.md)
- [ref structure](prompts/segnalazione-04-conferma/body-structure-comparison/ref-structure.md)
- [report](prompts/segnalazione-04-conferma/body-structure-comparison/report.md)
- [segnalazione 04 conferma comparison report](prompts/segnalazione-04-conferma/body-structure-comparison/segnalazione-04-conferma-comparison-report.md)

**`prompts/segnalazione-area-personale/`**

- [7 3 segnalazione area personale html parity](prompts/segnalazione-area-personale/7-3-segnalazione-area-personale-html-parity.md)
- [README](prompts/segnalazione-area-personale/README.md)

**`prompts/segnalazione-area-personale/body-structure-comparison/`**

- [diff 20260408 162854](prompts/segnalazione-area-personale/body-structure-comparison/diff.md)
- [report 20260408 162854](prompts/segnalazione-area-personale/body-structure-comparison/report.md)
- [segnalazione area personale comparison report](prompts/segnalazione-area-personale/body-structure-comparison/segnalazione-area-personale-comparison-report.md)
- [struct1 20260408 162854](prompts/segnalazione-area-personale/body-structure-comparison/struct1.md)
- [struct2 20260408 162854](prompts/segnalazione-area-personale/body-structure-comparison/struct2.md)

**`prompts/segnalazione-area-personale/body-structure-comparison-pass11/`**

- [report 20260408 172952](prompts/segnalazione-area-personale/body-structure-comparison-pass11/report.md)

**`prompts/segnalazione-area-personale/body-structure-comparison-pass2/`**

- [diff 20260408 163126](prompts/segnalazione-area-personale/body-structure-comparison-pass2/diff.md)
- [report 20260408 163126](prompts/segnalazione-area-personale/body-structure-comparison-pass2/report.md)
- [struct1 20260408 163126](prompts/segnalazione-area-personale/body-structure-comparison-pass2/struct1.md)
- [struct2 20260408 163126](prompts/segnalazione-area-personale/body-structure-comparison-pass2/struct2.md)

**`prompts/segnalazione-area-personale/body-structure-comparison-pass3/`**

- [local structure](prompts/segnalazione-area-personale/body-structure-comparison-pass3/local-structure.md)
- [ref structure](prompts/segnalazione-area-personale/body-structure-comparison-pass3/ref-structure.md)

**`prompts/segnalazione-area-personale/body-structure-comparison-pass4/`**

- [report 20260408 164200](prompts/segnalazione-area-personale/body-structure-comparison-pass4/report.md)

**`prompts/segnalazione-area-personale/body-structure-comparison-pass5/`**

- [report 20260408 164500](prompts/segnalazione-area-personale/body-structure-comparison-pass5/report.md)

**`prompts/segnalazione-area-personale/body-structure-comparison-pass6/`**

- [segnalazione area personale comparison report](prompts/segnalazione-area-personale/body-structure-comparison-pass6/segnalazione-area-personale-comparison-report.md)

**`prompts/segnalazione-crea/`**

- [README](prompts/segnalazione-crea/README.md)

**`prompts/segnalazione-dettaglio/`**

- [7 5 segnalazione dettaglio html parity](prompts/segnalazione-dettaglio/7-5-segnalazione-dettaglio-html-parity.md)
- [ANALYSIS](prompts/segnalazione-dettaglio/analysis.md)
- [diff 20260408 161458](prompts/segnalazione-dettaglio/diff.md)
- [html parity analysis](prompts/segnalazione-dettaglio/html-parity-analysis.md)
- [index](prompts/segnalazione-dettaglio/index.md)
- [PARITY ANALYSIS](prompts/segnalazione-dettaglio/parity-analysis.md)
- [README](prompts/segnalazione-dettaglio/README.md)
- [report 20260408 161458](prompts/segnalazione-dettaglio/report.md)
- [struct1 20260408 161458](prompts/segnalazione-dettaglio/struct1.md)
- [struct2 20260408 161458](prompts/segnalazione-dettaglio/struct2.md)

**`prompts/segnalazione-dettaglio/body-structure-comparison/`**

- [comparison report](prompts/segnalazione-dettaglio/body-structure-comparison/comparison-report.md)
- [diff 20260408 162846](prompts/segnalazione-dettaglio/body-structure-comparison/diff.md)
- [report 20260408 162846](prompts/segnalazione-dettaglio/body-structure-comparison/report.md)
- [segnalazione dettaglio comparison report](prompts/segnalazione-dettaglio/body-structure-comparison/segnalazione-dettaglio-comparison-report.md)

**`prompts/segnalazione_disservizio/`**

- [design system target](prompts/segnalazione_disservizio/design-system-target.md)
- [EXECUTOR 2 SUBTASKS 3 4](prompts/segnalazione_disservizio/executor-2-subtasks.md)
- [FASE1 ANALISI DIFFERENZE](prompts/segnalazione_disservizio/fase1-analisi-differenze.md)
- [FASE1 HTML BODY PARITY](prompts/segnalazione_disservizio/fase1-html-body-parity.md)
- [FASE2 RISULTATO](prompts/segnalazione_disservizio/fase2-risultato.md)
- [PHASE 1 FINDINGS TEMPLATE](prompts/segnalazione_disservizio/phase-1-findings-template.md)
- [README](prompts/segnalazione_disservizio/README.md)
- [report](prompts/segnalazione_disservizio/report.md)
- [segnalazioni elenco html parity analysis](prompts/segnalazione_disservizio/segnalazioni-elenco-html-parity-analysis.md)
- [SPEC](prompts/segnalazione_disservizio/spec.md)
- [SUBTASK 2 ANALYSIS WORKFLOW](prompts/segnalazione_disservizio/subtask-2-analysis-workflow.md)

**`prompts/segnalazioni-elenco/`**

- [7 4 segnalazioni elenco html parity](prompts/segnalazioni-elenco/7-4-segnalazioni-elenco-html-parity.md)

**`prompts/segnalazioni-elenco/body-structure-comparison/`**

- [segnalazioni elenco comparison report](prompts/segnalazioni-elenco/body-structure-comparison/segnalazioni-elenco-comparison-report.md)

**`prompts/tests/`**

- [tests pages architecture](prompts/tests/tests-pages-architecture.md)

**`prompts/tests/homepage/`**

- [organi di governo](prompts/tests/homepage/organi-di-governo.md)

</details>

<details>
<summary><strong>`raw/`</strong>: 3 documenti</summary>

- [index](raw/index.md)
- [README](raw/README.md)

**`raw/sources/`**

- [Design Comuni Header Structure Reference](raw/sources/design-comuni-header-reference.md)

</details>

<details>
<summary><strong>`release/`</strong>: 4 documenti</summary>

- [Build, deploy e rollback di Civic sull'host FixCity](release/deploy-and-rollback.md)
- [Go/No-Go checklist — rilascio Civic](release/go-no-go.md)
- [Smoke checklist post-deploy — Civic](release/smoke-checklist.md)
- [Versioning, compatibilità e politica del changelog — Civic](release/versioning-and-compatibility.md)

</details>

<details>
<summary><strong>`roadmap/`</strong>: 2 documenti</summary>

- [README](roadmap/README.md)
- [2025 q4 roadmap](roadmap/roadmap.md)

</details>

<details>
<summary><strong>`root-md-files/`</strong>: 2 documenti</summary>

- [CHANGELOG](root-md-files/CHANGELOG.md)
- [README HOMEPAGE REPLICATION](root-md-files/readme-homepage-replication.md)

</details>

<details>
<summary><strong>`root-txt-files/`</strong>: 1 documenti</summary>

- [phpstan result](root-txt-files/phpstan-result.md)

</details>

<details>
<summary><strong>`rules/`</strong>: 4 documenti</summary>

- [BODY NO CLASSES](rules/body-no-classes.md)
- [NO INLINE JS](rules/no-inline-js.md)
- [Regola: componenti riutilizzabili](rules/reusable-components.md)
- [tests pages architecture](rules/tests-pages-architecture.md)

</details>

<details>
<summary><strong>`second-brain/`</strong>: 6 documenti</summary>

- [Second Brain: DB Connection Fix](second-brain/db-connection.md)
- [Second Brain: DesignComuni Auth + Blog/Eventi](second-brain/designcomuni-auth-blog.md)
- [Second Brain — Studio DesignComuni profondo](second-brain/designcomuni-deep-study.md)
- [Geo map + ticket wizard fixes — 2026-10-14](second-brain/geo-map-tickets.md)
- [Header/footer rationale](second-brain/header-footer-rationale.md)
- [Second Brain — Sixteen Theme Knowledge Base](second-brain/knowledge.md)

</details>

<details>
<summary><strong>`sources/`</strong>: 1 documenti</summary>

- [README](sources/README.md)

</details>

<details>
<summary><strong>`stories/`</strong>: 90 documenti</summary>

- [Homepage redesign with Design Comuni](stories/01-homepage-design-comuni-redesign.story.md)
- [Tickets list page redesign with Design Comuni](stories/02-tickets-list-design-comuni-redesign.story.md)
- [Ticket create flow (segnalazione 4 steps) redesign with Design Comuni](stories/03-tickets-create-segnalazione-flow.story.md)
- [Ticket detail page redesign with Design Comuni](stories/04-ticket-detail-design-comuni-redesign.story.md)
- [Ticket track page redesign with Design Comuni](stories/05-tickets-track-design-comuni-redesign.story.md)
- [Categories list page redesign with Design Comuni](stories/06-categories-list-design-comuni-redesign.story.md)
- [Header component redesign with Design Comuni](stories/07-header-component-design-comuni.story.md)
- [Footer component redesign with Design Comuni](stories/08-footer-component-design-comuni.story.md)
- [Universal components (cmp-) library for Design Comuni](stories/09-universal-components-cmp-library.story.md)
- [Map marker visibility fix for ticket create flow (DesignComuni compliant)](stories/10-map-marker-visibility-fix.story.md)
- [Authentication pages redesign with Design Comuni](stories/11-auth-pages-design-comuni-redesign.story.md)
- [Civic — completamento parallelo issue aperte](stories/11-open-issues-parallel-completion.story.md)
- [User profile / dashboard redesign with Design Comuni](stories/12-profile-dashboard-design-comuni-redesign.story.md)
- [Search pages redesign with Design Comuni](stories/13-search-pages-design-comuni-redesign.story.md)
- [Tests DesignComuni: complete segnalazione wizard parity (4 steps + elenco + area personale)](stories/701-tests-segnalazione-wizard-parity.story.md)
- [Sixteen front-office: tests page + DesignComuni argomenti parity](stories/702-tests-page-design-comuni-parity.story.md)
- [Tests DesignComuni: risultati-ricerca (search results) parity](stories/702-tests-risultati-ricerca-parity.story.md)
- [Tests DesignComuni: remaining segnalazione wizard + elenco + area-personale parity](stories/703-tests-segnalazione-remaining-parity.story.md)
- [Tests DesignComuni: /it/tests/ index parity](stories/704-tests-index-parity.story.md)
- [Tests DesignComuni: /it/tests/domande-frequenti (FAQ) parity](stories/705-tests-domande-frequenti-parity.story.md)
- [Restore auth Blade components deleted in 6cb55f0d (login 500)](stories/auth-components-regression-restore.story.md)
- [Niente testi fissi nelle Blade del tema Sixteen (multilingua it/en/de/es)](stories/blade-i18n-no-hardcoded-text.story.md)
- [(DEV) Costanti -) enum: Appointment (tema Sixteen)](stories/const-to-enum-sixteen-appointment.dev.md)
- [(STORY) Costanti -) enum: Appointment (tema Sixteen)](stories/const-to-enum-sixteen-appointment.story.md)
- [Rimozione include cookiebar duplicate dai footer (Sixteen)](stories/cookiebar-duplicate-footer-removal.story.md)
- [BootstrapItaliaComponentsTest: cookiebar punta a cookie-consent::index](stories/cookiebar-test-redirect.story.md)
- [Parity degli attributi data-: via il nome del tema dal markup di Sixteen](stories/data-attribute-parity.story.md)
- [Sixteen - Parita' responsive di testata, piede e titoli con Design Comuni](stories/dc-chrome-responsive-parity.story.md)
- [Pagine legali complete (disclaimer, privacy, cookie-policy, note-legali, accessibilita)](stories/dcp-156-pagine-legali-complete-a-norma.story.md)
- [Cookie policy link nel footer (tutti i layout)](stories/dcp-157-cookie-policy-footer-link.story.md)
- [Cookiebar duplicate cleanup (feedback vs ui)](stories/dcp-158-cookiebar-duplicate-cleanup.story.md)
- [Linee guida di design (Designers Italia) — riferimento e audit aderenza](stories/dcp-159-linee-guida-design-audit.story.md)
- [Audit visivo aderenza Linee guida di design (DCP-160)](stories/dcp-160-audit-visivo-linee-guida-design.story.md)
- [Verifica disclaimer a norma (TermsFeed, SOS-WP, Servizi Industria)](stories/dcp-161-verifica-disclaimer-a-norma.story.md)
- [Build Vite e asset pubblici per la produzione](stories/dcp-162-vite-build-production-assets.story.md)
- [Standardizzazione agenti/skills ispirata Claude Cowork Plugins](stories/dcp-163-agenti-skills-standard-cowork.story.md)
- [Filament Blueprint — principi di planning e security audit applicati](stories/dcp-166-filament-blueprint-principi.story.md)
- [DCP-288: ricerca del sito, intestazione accessibile e metadati SEO del front office](stories/dcp-288-ricerca-del-sito-intestazione-accessibile-e-metadati.story.md)
- [DCP-291: accessibilita e responsive piccoli ma bloccanti, traccia, FAQ, banner cookie, valutazione…](stories/dcp-291-accessibilita-traccia-faq-banner-valutazione-e-main-unico.story.md)
- [DCP-430: lista-categorie con le classi Design Comuni al posto di Tailwind](stories/dcp-430-lista-categorie-classi-design-comuni-al-posto-di-tailwind.story.md)
- [DCP-439: il piano docs di Sixteen dice il falso su chi serve lista-categorie](stories/dcp-439-piano-docs-sixteen-dice-il-falso-su-chi-serve-lista-categorie.story.md)
- [DCP-447: il tema torna ricostruibile e ogni difetto portato dai mirror ha la sua guardia (13 PHP ro…](stories/dcp-447-tema-ricostruibile-e-guardie-contro-i-mirror.story.md)
- [DCP-448: accessibilità del front office (menu #nav4, FAQ aria-expanded, focus delle stelle, aria-la…](stories/dcp-448-accessibilita-del-front-office-aria-faq-focus-e-menu.story.md)
- [DCP-449: salto di layout del wizard /tickets/create (CLS 0,44 desktop, 0,49 mobile): barra cookie i…](stories/dcp-449-salto-di-layout-del-wizard-tickets-create.story.md)
- [DCP-450: peso e cache degli asset del tema (CSS 3,34 MB, JS 1,47 MB anche sul login, max-age 3600)](stories/dcp-450-peso-e-cache-degli-asset-del-tema.story.md)
- [DCP-451: guardia sui riferimenti a viste cancellate (632 viste tolte da 483080dcac, 26 nomi ancora…](stories/dcp-451-guardia-sui-riferimenti-a-viste-cancellate.story.md)
- [DCP-452: residui di UX, accessibilità e messa in produzione del tema («Demo», favicon, forced-color…](stories/dcp-452-residui-di-ux-accessibilita-e-messa-in-produzione-del-tema.story.md)
- [DCP-453: ritiro del codice morto del tema (ComuneControllerTest, pagesold, header-comune, Frontoffi…](stories/dcp-453-ritiro-del-codice-morto-del-tema-decisione.story.md)
- [Sixteen: parity dello step privacy con copy di sistema e link legali](stories/dcp-458-ticket-privacy-system-copy-and-legal-links.story.md)
- [Homepage improvement using Design Comuni as reference](stories/design-comuni-homepage-improvement.story.md)
- [Integrate Design Italia Guidelines into Sixteen Theme](stories/design-italia-guidelines-integration.story.md)
- [Integrate Disclaimer and Cookie Preferences into Sixteen Theme](stories/disclaimer-integration.story.md)
- [FO: HTTPS di sviluppo, registrazione, inglese, contrasto](stories/fo-hardening-https-register-i18n.story.md)
- [Redesign front office completo con DesignComuni v2.4.0](stories/front-office-complete-redesign.story.md)
- [Front office completeness audit and fixes](stories/front-office-completeness-audit.story.md)
- [Redesign tutte le pagine front office con DesignComuni v2.4.0](stories/front-office-design-comuni-rebuild.story.md)
- [Front office detail 404 and site map page](stories/front-office-detail-not-found-and-sitemap-page.story.md)
- [Sixteen - Controllo completo del front office (anonimo e cittadino)](stories/front-office-full-review.story.md)
- [(STORY) Audit del front office per la messa in produzione (anonimo e loggato)](stories/front-office-production-audit.story.md)
- [Front office production readiness audit (anonymous and logged in)](stories/front-office-production-readiness-audit.story.md)
- [Header and footer: Design Comuni markup inside the v1 contract](stories/header-footer-design-comuni-markup.story.md)
- [Homepage: sezioni Novità ed Eventi dai dati Blog](stories/home-news-events-sections.story.md)
- [(STORY) Home «Novità»: le card stanno 3 per riga (specificità del CSS dei blocchi)](stories/home-news-grid-specificity.story.md)
- [Redesign homepage con DesignComuni italia/design-comuni-pagine-statiche](stories/homepage-design-comuni-rebuild.story.md)
- [Homepage audit — taste-skill + BMAD v6 + second brain](stories/homepage-taste-skill-bmad.story.md)
- [(STORY) Lo sprite delle icone di Sixteen deve arrivare in produzione](stories/icon-sprite-deployability.story.md)
- [Liste e dettaglio blog/eventi nel tema Sixteen](stories/inbound-blog-event-listing.story.md)
- [Issue #104 — Design Comuni, editorial DRY e wizard parity](stories/issue-104-design-comuni-editorial-dry-wizard-parity.story.md)
- [Build Sixteen: Leaflet risolvibile in CI](stories/issue-82-sixteen-leaflet-build.story.md)
- [Popup marker: testo bianco su bianco nella home](stories/map-popup-white-on-white-home.story.md)
- [Sixteen - PHP non valido dopo il mirror: recupero](stories/mirror-merge-corruption-php-recovery.story.md)
- [Passata UX mobile del tema Sixteen (viewport, prototipo mobile, mappa a schermo intero)](stories/mobile-ux-pass.story.md)
- [php artisan optimize verde e pagine Volt con proprieta' bloccate](stories/optimize-view-cache-and-locked-volt-pages.story.md)
- [Sixteen - Niente pubblicità di default sul sito PA (PRD-13)](stories/pa-no-advertising.story.md)
- [PDF e screenshot reali del front office](stories/pdf-real-screenshot-capture.story.md)
- [Fix duplicate HTML in profile delete-user-form (Sixteen)](stories/profile-delete-form-duplication-fix.story.md)
- [Sixteen: chiavi pubtheme bloccate dal rekey e nomi di rotta che non esistono](stories/pub-theme-keys-and-route-names-residuals.story.md)
- [Redesign all front office pages using Design Comuni design system](stories/redesign-front-office-pages-with-design-comuni.story.md)
- [Esecuzione parallela della roadmap Civic (C1–C6): claim, perimetri e prove](stories/roadmap-execution-c1-c5-parallel-claims.story.md)
- [Segnalazioni elenco — Filament 5 tabs Mappa/Elenco](stories/segnalazioni-elenco-filament-tabs.story.md)
- [(STORY) Head SEO centralizzato per il tema Sixteen](stories/seo-head-component-sixteen.story.md)
- [(STORY) Services -) Actions e const -) enum, tema Sixteen](stories/services-to-actions-sixteen.story.md)
- [Sixteen test suite: stale contracts and real bugs](stories/sixteen-suite-stale-contracts.story.md)
- [STORY-BLOG003 — Componenti Riutilizzabili (Reusability)](stories/STORY-BLOG003-reusable-components.md)
- [Audit harness dei documenti Sixteen](stories/theme-docs-harness-contracts-audit.story.md)
- [Sixteen Theme: Homepage JSON Structure Alignment](stories/theme-sixteen-nine11-homepage-json-alignment.story.md)
- [theme-sixteen-twentyone-json-alignment.story](stories/theme-sixteen-twentyone-json-alignment.story.md)
- [Sixteen: passo privacy tickets/create con informativa a due livelli](stories/ticket-create-privacy-design-comuni-decision.story.md)
- [Tickets FO: asset tema persi, bottone filtri, posizione](stories/tickets-ux-theme-symlink-geolocation.story.md)
- [Visual parity 95%+ — Design Comuni test pages](stories/visual-parity-95-design-comuni.story.md)

</details>

<details>
<summary><strong>`ui-fixes/`</strong>: 9 documenti</summary>

- [BMAD STRATEGIC DECISIONS](ui-fixes/bmad-strategic-decisions.md)
- [CONTAINER CENTERING ISSUE](ui-fixes/container-centering-issue.md)
- [GSD PLAN IMPLEMENTATION](ui-fixes/gsd-plan-implementation.md)
- [INDEX](ui-fixes/index.md)
- [PHASE1 VERIFICATION REPORT](ui-fixes/phase1-verification-report.md)
- [PHASE2 VERIFICATION REPORT](ui-fixes/phase2-verification-report.md)
- [SEARCH MODAL VISIBILITY ISSUE](ui-fixes/search-modal-visibility-issue.md)
- [SOCIAL ICONS VISIBILITY ISSUE](ui-fixes/social-icons-visibility-issue.md)
- [UI FIXES MASTER PLAN](ui-fixes/ui-fixes-master-plan.md)

</details>

<details>
<summary><strong>`visual-analysis/`</strong>: 17 documenti</summary>

- [BMAD STRATEGIC UPDATE WAVE2](visual-analysis/bmad-strategic-update-wave2.md)
- [BMAD VISUAL ALIGNMENT DISCUSSION](visual-analysis/bmad-visual-alignment-discussion.md)
- [CONTAINER WIDTH DEBUG](visual-analysis/container-width-debug.md)
- [CONTAINER WIDTH RESOLUTION](visual-analysis/container-width-resolution.md)
- [FEATURED TOPICS GRADIENT ANALYSIS](visual-analysis/featured-topics-gradient-analysis.md)
- [GSD IMPLEMENTATION PLAN](visual-analysis/gsd-implementation-plan.md)
- [HOMEPAGE VISUAL DIFF ANALYSIS](visual-analysis/homepage-visual-diff-analysis.md)
- [HTML STRUCTURAL ANALYSIS](visual-analysis/html-structural-analysis.md)
- [INDEX](visual-analysis/index.md)
- [QUICK REFERENCE](visual-analysis/quick-reference.md)
- [SECTION STRUCTURE DIFF](visual-analysis/section-structure-diff.md)
- [STRUCTURAL VALIDATION PERFECT](visual-analysis/structural-validation-perfect.md)
- [VISUAL DIFF ANALYSIS](visual-analysis/visual-diff-analysis.md)
- [VISUAL DIFFERENCES ANALYSIS](visual-analysis/visual-differences-analysis.md)
- [WAVE 2 IMPLEMENTATION REPORT](visual-analysis/wave-2-implementation-report.md)
- [WAVE 2 PROGRESS](visual-analysis/wave-2-progress.md)

**`visual-analysis/segnalazione-01-privacy/`**

- [VISUAL PARITY REPORT](visual-analysis/segnalazione-01-privacy/visual-parity-report.md)

</details>

<details>
<summary><strong>`visual-parity/`</strong>: 6 documenti</summary>

- [Visual Parity Index](visual-parity/index.md)

**`visual-parity/reports/`**

- [COMPLETE REPORT](visual-parity/reports/complete-report.md)
- [FIX ACTION PLAN](visual-parity/reports/fix-action-plan.md)
- [LISTA CATEGORIE ANALYSIS](visual-parity/reports/lista-categorie-analysis.md)
- [PROGRESS](visual-parity/reports/progress.md)
- [VISUAL INSPECTION](visual-parity/reports/visual-inspection.md)

</details>

<details>
<summary><strong>`wiki/`</strong>: 226 documenti</summary>

- [Agent instructions](wiki/agents.md)
- [coordinate picker](wiki/coordinate-picker.md)
- [Frontoffice — blog / events / tickets — stato attuale](wiki/frontoffice-blog-events-tickets.md)
- [Miglioramenti](wiki/improvements.md)
- [Sixteen Theme Wiki Index](wiki/index.md)
- [laravel enum anti pattern](wiki/laravel-enum-anti-pattern.md)
- [lessons learned header auth state](wiki/lessons-learned-header-auth-state.md)
- [llm wiki usage](wiki/llm-wiki-usage.md)
- [log](wiki/log.md)
- [Playwright — Visual Testing Tema Sixteen](wiki/playwright-visual-testing.md)
- [Civic Theme Wiki — ingresso](wiki/README.md)
- [schema](wiki/schema.md)

**`wiki/commands/`**

- [Commands Index](wiki/commands/index.md)

**`wiki/comparisons/`**

- [design comuni header source analysis](wiki/comparisons/design-comuni-header-source-analysis.md)
- [Segnalazione step 1 — Design Comuni header HTML structure delta](wiki/comparisons/design-comuni-header-structure-delta.md)
- [header visual parity audit](wiki/comparisons/header-visual-parity-audit.md)
- [Segnalazione step 1 — Design Comuni static vs wizard locale](wiki/comparisons/ticket-01-privacy-design-comuni-vs-local-wizard.md)
- [ticket 01 privacy parity](wiki/comparisons/ticket-01-privacy-parity.md)
- [Segnalazione step2 (dati) — Design Comuni static vs wizard locale](wiki/comparisons/ticket-02-dati-design-comuni-vs-local.md)
- [Segnalazione Crea Step Dati Screenshot Audit 2026-04-28](wiki/comparisons/ticket-crea-step-dati-screenshot-audit.md)

**`wiki/concepts/`**

- [Audit di accessibilita' (DCP-143): axe, tastiera e cio' che manca](wiki/concepts/accessibility-audit-dcp.md)
- [AI harness — disciplina agenti tema Sixteen](wiki/concepts/ai-harness-theme-sixteen.md)
- [auth login ux fixes](wiki/concepts/auth-login-ux-fixes.md)
- [Percorsi canonici skill agenti (bashscripts) e tema Sixteen](wiki/concepts/bashscripts-agent-skill-canonical-paths.md)
- [blade component extraction rule](wiki/concepts/blade-component-extraction-rule.md)
- [bmad context compression](wiki/concepts/bmad-context-compression.md)
- [BMad Method in Sixteen Theme](wiki/concepts/bmad-method.md)
- [Bootstrap Italia + Tailwind CSS — Filosofia e Regole](wiki/concepts/bootstrap-italia-tailwind-philosophy.md)
- [Bootstrap → Tailwind Mapping for Design Comuni Parity](wiki/concepts/bootstrap-tailwind-mapping.md)
- [ci — semantic release tema Sixteen](wiki/concepts/ci-semantic-release.md)
- [claude code theme rules path scoping](wiki/concepts/claude-code-theme-rules-path-scoping.md)
- [comuni design system guidance](wiki/concepts/comuni-design-system-guidance.md)
- [Context compression and summary Infolist rule](wiki/concepts/context-compression-and-summary-infolist-rule.md)
- [Sixteen theme context compression boundary](wiki/concepts/context-compression-plugin.md)
- [Cookie Bar Concept](wiki/concepts/cookiebar.md)
- [CoordinatePicker Design Comuni Parity Rule](wiki/concepts/coordinate-picker-design-comuni-parity-rule.md)
- [coordinate picker fullscreen theme layer rule](wiki/concepts/coordinate-picker-fullscreen-theme-layer-rule.md)
- [coordinate picker fullscreen wizard contract](wiki/concepts/coordinate-picker-fullscreen-wizard-contract.md)
- [CSS filenames — English only](wiki/concepts/css-filename-english-naming.md)
- [css wizard notes](wiki/concepts/css-wizard-notes.md)
- [DaisyUI — pro, contro, metriche (tema Sixteen)](wiki/concepts/daisyui-pro-contro-metriche.md)
- [design comuni font tokens](wiki/concepts/design-comuni-font-tokens.md)
- [design comuni header green navbar rule](wiki/concepts/design-comuni-header-green-navbar-rule.md)
- [DesignComuni ODS presentation — Sixteen](wiki/concepts/design-comuni-ods-presentation.md)
- [Design Comuni Italia — Struttura pagine di riferimento](wiki/concepts/design-comuni-page-structure.md)
- [Metodo di parity Design Comuni (guidato da JSON, Tailwind + Alpine)](wiki/concepts/design-comuni-parity-method.md)
- [Design Comuni — componenti riutilizzabili](wiki/concepts/design-comuni-reusable-components.md)
- [Design Comuni Site-Wide Component CSS Rule](wiki/concepts/design-comuni-site-wide-component-css-rule.md)
- [Proxy HTTPS di sviluppo e audit it/en](wiki/concepts/dev-https-proxy-and-i18n-audit.md)
- [Document shell: modello autonomo](wiki/concepts/document-shell.md)
- [E2E e .env.testing — stesso stack DB dei moduli](wiki/concepts/env-testing-e2e.md)
- [Sixteen — test FO e .env.testing](wiki/concepts/env-testing-pest-fo.md)
- [Filament 5.x Blade Components — Reference e Regola Filament-First](wiki/concepts/filament-5x-blade-components-reference.md)
- [filament admin style ownership boundary](wiki/concepts/filament-admin-style-ownership-boundary.md)
- [Filament Custom Field — State Binding Modifiers: confine tema/modulo](wiki/concepts/filament-custom-field-binding-modifiers-theme-boundary.md)
- [Filament-first sul frontoffice Sixteen](wiki/concepts/filament-first-frontoffice.md)
- [filament multiple forms rule](wiki/concepts/filament-multiple-forms-rule.md)
- [filament multiple forms](wiki/concepts/filament-multiple-forms.md)
- [filament v5 hybrid pattern reference](wiki/concepts/filament-v5-hybrid-pattern-reference.md)
- [Filament Wizard Custom Component - Theme Sixteen](wiki/concepts/filament-wizard-custom-component.md)
- [filament wizard theme override](wiki/concepts/filament-wizard-theme-override.md)
- [filament wizard zen](wiki/concepts/filament-wizard-zen.md)
- [Filament 5 Schema — accesso form nelle view Sixteen](wiki/concepts/filament5-schema-form-access-rule.md)
- [Filament 5 Schema Section Namespace Rule For Sixteen Views](wiki/concepts/filament5-schema-section-namespace-rule.md)
- [filament5 widget schema submit bridge rule](wiki/concepts/filament5-widget-schema-submit-bridge-rule.md)
- [fixcity ticket infolist theme boundary](wiki/concepts/fixcity-ticket-infolist-theme-boundary.md)
- [fixcity wizard full width and opaque fields](wiki/concepts/fixcity-wizard-full-width-and-opaque-fields.md)
- [FixCity — contratto UI/UX wizard Sixteen](wiki/concepts/fixcity-wizard-ux-contract.md)
- [Link FO multilingua — path Folio + FrontofficeUrl](wiki/concepts/fo-folio-links-multilingua.md)
- [Header FO — named route Folio verificate](wiki/concepts/fo-folio-named-routes-header.md)
- [FO Folio — zen routing (file = rotta)](wiki/concepts/fo-folio-routing-zen.md)
- [Header FO — contratto URL Folio + chiavi traduzione 5 livelli](wiki/concepts/fo-header-url-and-translation-contract.md)
- [FO PA tokens — uniformità Design Comuni](wiki/concepts/fo-pa-tokens-uniformity.md)
- [Proprietà del blade Folio generico (container0)/(slug0)](wiki/concepts/folio-generic-blade-ownership.md)
- [folio — vietato pages/tickets e namespace sixteen nelle view](wiki/concepts/folio-no-semantic-pages-tickets.md)
- [Folio Page Shell Pattern - Volt Component](wiki/concepts/folio-page-shell-pattern.md)
- [Folio — parametri route via mount(), non request()-)route()](wiki/concepts/folio-route-params-mount.md)
- [folio slug routing pattern](wiki/concepts/folio-slug-routing-pattern.md)
- [Footer partner / sponsorship — decisione marketing](wiki/concepts/footer-partner-sponsorship-marketing.md)
- [FreeLLMAPI boundary — Sixteen](wiki/concepts/freellmapi-boundary.md)
- [frontend design — adattamento plugin anthropic al tema sixteen](wiki/concepts/frontend-design-civic-anthropic-adaptation.md)
- [frontend design fixcity overlay](wiki/concepts/frontend-design-fixcity-overlay.md)
- [Frontoffice Ticket Priority Theme Boundary](wiki/concepts/frontoffice-ticket-priority-theme-boundary.md)
- [geo lit components must be imported rule](wiki/concepts/geo-lit-components-must-be-imported-rule.md)
- [geo map lit search default theme boundary](wiki/concepts/geo-map-lit-search-default-theme-boundary.md)
- [geo map marker civic pin theme boundary](wiki/concepts/geo-map-marker-civic-pin-theme-boundary.md)
- [geo map popup leaflet boundary](wiki/concepts/geo-map-popup-leaflet-boundary.md)
- [geo picker theme consumption rule](wiki/concepts/geo-picker-theme-consumption-rule.md)
- [Theme CSS discipline - global site CSS, no per-page selectors (wizard parity)](wiki/concepts/global-css-no-page-selectors-wizard-parity.md)
- [Header slim — stato autenticazione (Design Comuni)](wiki/concepts/header-authenticated-state.md)
- [header color parity](wiki/concepts/header-color-parity.md)
- [header component extraction](wiki/concepts/header-component-extraction.md)
- [header design comuni code analysis](wiki/concepts/header-design-comuni-code-analysis.md)
- [header design comuni parity mapping](wiki/concepts/header-design-comuni-parity-mapping.md)
- [Header Dynamic Navigation](wiki/concepts/header-dynamic-navigation.md)
- [Header logged — dropdown UX spec](wiki/concepts/header-logged-dropdown-ux-spec.md)
- [header logged in parity delta](wiki/concepts/header-logged-in-parity-delta.md)
- [header nav dynamic architecture](wiki/concepts/header-nav-dynamic-architecture.md)
- [Header Nav Dynamic Links — Sixteen Theme](wiki/concepts/header-nav-dynamic-links.md)
- [header navbar background cascade rule](wiki/concepts/header-navbar-background-cascade-rule.md)
- [header navbar green component rule](wiki/concepts/header-navbar-green-component-rule.md)
- [header navigation background fix](wiki/concepts/header-navigation-background-fix.md)
- [Header partials location rule](wiki/concepts/header-partials-location-rule.md)
- [header slim dropdown behavior](wiki/concepts/header-slim-dropdown-behavior.md)
- [header ssot](wiki/concepts/header-ssot.md)
- [Header style layer rule](wiki/concepts/header-style-layer-rule.md)
- [header styling requirements](wiki/concepts/header-styling-requirements.md)
- [homepage guest visual fix](wiki/concepts/homepage-guest-visual-fix.md)
- [concepts index — Sixteen](wiki/concepts/index.md)
- [laravel13 package boundary for themes](wiki/concepts/laravel13-package-boundary-for-themes.md)
- [leaflet map flicker visual contract](wiki/concepts/leaflet-map-flicker-visual-contract.md)
- [Map-lit cluster fix — lezione cascade + lezioni operative multi-repo](wiki/concepts/leaflet-no-transform-on-marker-icon.md)
- [leaflet partial tile theme rule](wiki/concepts/leaflet-partial-tile-theme-rule.md)
- [leaflet shadow dom visual verification rule](wiki/concepts/leaflet-shadow-dom-visual-verification-rule.md)
- [leaflet z index layering](wiki/concepts/leaflet-z-index-layering.md)
- [Legal Consent UI Boundary](wiki/concepts/legal-consent-ui-boundary.md)
- [livewire alpine esm order (tema sixteen)](wiki/concepts/livewire-alpine-esm-order.md)
- [livewire cache table rate limiter](wiki/concepts/livewire-cache-table-rate-limiter.md)
- [login invalid credentials copy rule](wiki/concepts/login-invalid-credentials-copy-rule.md)
- [map fullscreen handling](wiki/concepts/map-fullscreen-handling.md)
- [map fullscreen issues](wiki/concepts/map-fullscreen-issues.md)
- [map lit legend theme boundary](wiki/concepts/map-lit-legend-theme-boundary.md)
- [map lit vite build troubleshooting](wiki/concepts/map-lit-vite-build-troubleshooting.md)
- [map tile loading fix](wiki/concepts/map-tile-loading-fix.md)
- [marker cluster hover stability](wiki/concepts/marker-cluster-hover-stability.md)
- [mcp validation fo pages](wiki/concepts/mcp-validation-fo-pages.md)
- [Sixteen: contratto navigazione mobile](wiki/concepts/mobile-navigation-contract.md)
- [Multilingua e dispositivi: comportamenti osservati (it, en, de, es; 375, 768, 1024, 1440)](wiki/concepts/multilingua-e-dispositivi-comportamenti.md)
- [no app/Support — theme Actions](wiki/concepts/no-app-support-queueable-actions.md)
- [No Bootstrap Runtime Assets Rule](wiki/concepts/no-bootstrap-runtime-assets-rule.md)
- [No Controllers — Solo Folio + Volt + Filament](wiki/concepts/no-controllers-folio-volt-filament.md)
- [no domain css classes in theme](wiki/concepts/no-domain-css-classes.md)
- [no page specific css](wiki/concepts/no-page-specific-css.md)
- [No Services / No Support — QueueableAction only](wiki/concepts/no-services-no-support-queueable-actions.md)
- [Sixteen — no Livewire standalone in frontoffice](wiki/concepts/no-standalone-livewire-frontoffice.md)
- [obsidian vault alignment](wiki/concepts/obsidian-vault-alignment.md)
- [obsolete ticket crea blade](wiki/concepts/obsolete-ticket-crea-blade.md)
- [Area personale — rotte FO (deprecato, vedi canon)](wiki/concepts/personal-area-routes.md)
- [personal-area shared nav tabs contract](wiki/concepts/personal-area-shared-nav-tabs-contract.md)
- [Sixteen Theme - PHPStan Type Compliance](wiki/concepts/phpstan-compliance.md)
- [Visual Testing per Frontend (Sixteen Theme)](wiki/concepts/playwright-visual-testing.md)
- [policy rendering boundary](wiki/concepts/policy-rendering-boundary.md)
- [ponytail audit](wiki/concepts/ponytail-audit.md)
- [Privacy Policy Concept](wiki/concepts/privacy.md)
- [publichtml/themes/Sixteen e' un symlink al public del tema](wiki/concepts/public-html-themes-symlink.md)
- [Documentazione wizard Sixteen ridondanza intenzionale vs duplicabile](wiki/concepts/ridondanze-documentazione-wizard.md)
- [route target recheck rule](wiki/concepts/route-target-recheck-rule.md)
- [Second Brain — confine memoria tema Sixteen](wiki/concepts/second-brain-theme-boundary.md)
- [Segnalazioni elenco — tab Filament 5 su /it](wiki/concepts/segnalazioni-elenco-filament-tabs.md)
- [segnalazioni elenco map integration](wiki/concepts/segnalazioni-elenco-map-integration.md)
- [Pagine = composizione di blocchi condivisi, nessun CSS di pagina](wiki/concepts/shared-block-composition-no-page-css.md)
- [Sixteen Theme Best Practices](wiki/concepts/sixteen-best-practices.md)
- [Sixteen is DesignComuni](wiki/concepts/sixteen-design-comuni-theme-identity.md)
- [Sixteen Theme — Tailwind CSS Patterns](wiki/concepts/tailwind-patterns.md)
- [testing](wiki/concepts/testing.md)
- [Theme bridge-only — Sixteen app/ remediation](wiki/concepts/theme-bridge-only.md)
- [theme bundle integration false friends](wiki/concepts/theme-bundle-integration-false-friends.md)
- [theme cms block architecture ticket crea](wiki/concepts/theme-cms-block-architecture-ticket-crea.md)
- [Sixteen — contratto test componenti da modulo UI](wiki/concepts/theme-component-test-contract.md)
- [Theme Composer Boundary](wiki/concepts/theme-composer-boundary.md)
- [theme css only parity rule](wiki/concepts/theme-css-only-parity-rule.md)
- [Theme Geo JS Boundary](wiki/concepts/theme-geo-js-boundary.md)
- [theme owned scripts rule](wiki/concepts/theme-owned-scripts-rule.md)
- [theme owned wizard css parity rule](wiki/concepts/theme-owned-wizard-css-parity-rule.md)
- [folio page-shell — data-page presentation only](wiki/concepts/theme-page-shell.md)
- [Cartelle root maiuscole — tema Sixteen](wiki/concepts/theme-root-uppercase-folders.md)
- [theme stack daisyui](wiki/concepts/theme-stack-daisyui.md)
- [Segnalazione-01-Privacy: Design Comuni vs Local Wizard](wiki/concepts/ticket-01-privacy-design-comuni-vs-local.md)
- [Segnalazione-02-Dati: Design Comuni vs Local Wizard](wiki/concepts/ticket-02-dati-design-comuni-vs-local.md)
- [Segnalazione-03-Riepilogo: Design Comuni vs Local Wizard](wiki/concepts/ticket-03-riepilogo-design-comuni-vs-local.md)
- [ticket crea header and map visual regression contract](wiki/concepts/ticket-crea-header-and-map-visual-regression-contract.md)
- [ticket crea navbar green contract](wiki/concepts/ticket-crea-navbar-green-contract.md)
- [ticket detail page](wiki/concepts/ticket-detail-page.md)
- [Estrazione token class= — 7 HTML segnalazione (fonte .planning/research)](wiki/concepts/ticket-html-samples-class-token-extraction.md)
- [Tabella token class= — 7 HTML locali (.planning/research)](wiki/concepts/ticket-local-html-class-token-table.md)
- [ticket map and section spacing parity](wiki/concepts/ticket-map-and-section-spacing-parity.md)
- [ticket privacy parity audit](wiki/concepts/ticket-privacy-parity-audit.md)
- [ticket riepilogo reference gap plan](wiki/concepts/ticket-riepilogo-reference-gap-plan.md)
- [ticket runtime asset integrity](wiki/concepts/ticket-runtime-asset-integrity.md)
- [ticket visual parity correction plan](wiki/concepts/ticket-visual-parity-correction-plan.md)
- [ticket wizard cta parity](wiki/concepts/ticket-wizard-cta-parity.md)
- [ui ai tooling on demand](wiki/concepts/ui-ai-tooling-on-demand.md)
- [CSS di terzi sulle pagine data-dc, esenzione nel guard PostCSS](wiki/concepts/vendor-css-on-data-dc-pages-needs-guard-exemption.md)
- [visual parity verification rule](wiki/concepts/visual-parity-verification-rule.md)
- [Wizard Custom View Architecture - Theme Sixteen](wiki/concepts/wizard-custom-view-architecture.md)
- [wizard parity documentation map — segnalazione theme sixteen](wiki/concepts/wizard-parity-documentation-map.md)
- [wizard visual parity](wiki/concepts/wizard-visual-parity.md)
- [x page data bag only](wiki/concepts/x-page-data-bag-only.md)
- [xotbasefield view resolution rule](wiki/concepts/xotbasefield-view-resolution-rule.md)
- [xotbasefield view rule](wiki/concepts/xotbasefield-view-rule.md)
- [zen pubthemewizard philosophy](wiki/concepts/zen-pubthemewizard-philosophy.md)
- [zen wizard header philosophy](wiki/concepts/zen-wizard-header-philosophy.md)

**`wiki/design/`**

- [auth login ux design wcag](wiki/design/auth-login-ux-design-wcag.md)
- [wizard review parity](wiki/design/wizard-review-parity.md)

**`wiki/entities/`**

- [Bootstrap Italia — inventario classi per le 7 pagine segnalazione](wiki/entities/bootstrap-italia-class-inventory.md)
- [design comuni class mapping](wiki/entities/design-comuni-class-mapping.md)

**`wiki/governance/`**

- [Politica Git Forward-Only — Tema Sixteen](wiki/governance/git-forward-only-policy.md)

**`wiki/how-to/`**

- [Catalogo sottocartelle blocks/ (Flowbite + Tailwind UI)](wiki/how-to/blocks-subfolder-catalog.md)

**`wiki/improvements/`**

- [visual parity plan](wiki/improvements/visual-parity-plan.md)

**`wiki/memories/`**

- [anthropic frontend design skill adapted](wiki/memories/anthropic-frontend-design-skill-adapted.md)
- [frontend design anthropic — modalità civic su sixteen](wiki/memories/frontend-design-anthropic-civic-mode.md)
- [frontend stack religion standing](wiki/memories/frontend-stack-religion-standing.md)
- [Memories Index](wiki/memories/index.md)

**`wiki/overviews/`**

- [Sixteen — roadmap completamento tema FO](wiki/overviews/completion-roadmap.md)
- [sixteen theme](wiki/overviews/sixteen-theme.md)

**`wiki/redundancy/`**

- [Duplicated Blade Blocks Across Modules and Themes](wiki/redundancy/duplicated-blade-blocks.md)

**`wiki/rules/`**

- [Asset 404 Fixes (Theme Sixteen)](wiki/rules/assets-404-fix.md)
- [CMS Block naming — Tailwind UI / Flowbite (Sixteen)](wiki/rules/cms-block-naming-tailwind-flowbite.md)
- [CMS content slug = Folio page name (two page families)](wiki/rules/cms-content-slug-matches-folio-page-name.md)
- [container0 index folio pattern](wiki/rules/container0-index-folio-pattern.md)
- [Folio Frontend Architecture - No Controller/Routes](wiki/rules/folio-routing-architecture.md)
- [Frontend Stack Canonico — Tailwind + Alpine + Lit + DaisyUI + Flowbite + Filament](wiki/rules/frontend-stack-canonical.md)
- [Header Authenticated State Parity](wiki/rules/header-authenticated-parity.md)
- [Rules Index](wiki/rules/index.md)
- [Livewire Assets Out‑of‑Date Fix](wiki/rules/livewire-assets-fix.md)
- [No Italian File Names in Code](wiki/rules/no-italian-component-names.md)
- [No Italian CSS filenames](wiki/rules/no-italian-css-filenames.md)
- [No parallel DesignComuni layout](wiki/rules/no-parallel-design-comuni-layout.md)
- [QueueableAction execute entrypoint](wiki/rules/queueable-action-execute-entrypoint.md)
- [Volt in pagine Folio — @volt statico obbligatorio](wiki/rules/volt-usage-rule.md)

**`wiki/sources/`**

- [Design Comuni Header Source Reference](wiki/sources/design-comuni-header-reference.md)

**`wiki/stories/`**

- [story 8 108 ticket crea parity](wiki/stories/story-8-108-ticket-crea-parity.md)

**`wiki/troubleshooting/`**

- [git merge conflict inventory](wiki/troubleshooting/git-merge-conflict-inventory.md)
- [Leak CSS header sito su popup Leaflet](wiki/troubleshooting/global-header-css-leak-leaflet-popup.md)
- [README](wiki/troubleshooting/README.md)
- [RouteNotFoundException — vista compilata stale](wiki/troubleshooting/route-not-found-view-cache.md)

</details>

<details>
<summary><strong>`wizard/`</strong>: 1 documenti</summary>

- [form tag fix](wizard/form-tag-fix.md)

</details>

<!-- docs-index:end -->

---

**Civic** è il nome di destinazione; **Sixteen** identifica ancora una parte del codice e della documentazione importati. Il piano sopra è un elenco di lavoro, non una dichiarazione di migrazione conclusa.
