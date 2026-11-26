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
| Architettura | [architecture/README.md](../archive/docs-legacy/architecture/README.md) | Raccolta ereditata: contiene riferimenti Sixteen da riconciliare |
| Design system | [design-system/README.md](../archive/docs-legacy/design-system/README.md) | Contratto visivo storico; target da rendere indipendente dal Paese |
| Superfici GitHub | [github-surfaces.md](../archive/docs-legacy/github-surfaces.md) | Issues, milestone, label, Actions, Security, Discussions |
| Wiki | [wiki/README.md](../archive/docs-legacy/wiki/README.md) | Indice locale delle conoscenze importate |
| Test | [testing-convention.md](../archive/docs-legacy/testing-convention.md) | Convenzioni per il tema |
| Folio / pagine | [folio-page-pattern.md](./folio-page-pattern.md) | Struttura pagina dell'implementazione precedente |
| Linee guida italiane | [design-comuni/README.md](../archive/docs-legacy/design-comuni/README.md) | Riferimento specifico per l'Italia, non base universale |
| ADR | [adr/README.md](./adr/README.md) | Decisioni da riesaminare nel contesto Civic |
| Ricerca e rilievi | [analysis/README.md](../archive/docs-legacy/analysis/README.md) | Evidenze e analisi storiche |
| Contratti | [contracts/README.md](./contracts/README.md) | Cosa promettono le Action e le interfacce del tema |
| Storie BMAD | [stories/](./stories/) | Lavoro in corso e criteri di accettazione |
| Archivio | [archive/README.md](../archive/docs-legacy/archive/README.md) | Documenti storici dichiarati immutabili |
| Controlli sui docs | `scripts/docs-audit.py`, `scripts/docs-index.py`, `scripts/docs-apply-map.py` | Link, nomi, avanzi, raggiungibilità, catalogo, mappa di migrazione |

## Come leggere la documentazione

_Fuso dalla mappa della conoscenza di Sixteen, ora in `../archive/docs-legacy/archive/knowledge-map.md`._

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

## README del repository: classificazione

I ~41 file `README*.md` del repository sono classificati per ownership e stato
(dati macchina: `docs/scripts/readme-classification.json`; applicati con
`docs/scripts/docs-apply-map.py`):

| Classe | File | Stato |
|---|---|---|
| Canonici Civic | `README.md` (radice), `docs/README.md` (questo indice), `docs/readme-en.md`, `../archive/docs-legacy/architecture/README.md`, `../archive/docs-legacy/design-system/README.md`, `../archive/docs-legacy/wiki/README.md`, `docs/adr/README.md`, `docs/contracts/README.md`, `../archive/docs-legacy/archive/README.md`, `../archive/docs-legacy/raw/README.md`, `resources/mail-layouts/README.md` | attivi, da mantenere aggiornati |
| Storici Sixteen | 29 README sotto `docs/` (analysis, blocks, body-structure-comparison, design-comuni, html-structure-comparison, mappings, phases, product, prompts, roadmap, sources, wiki/troubleshooting) | `status: historical` con avviso e link all'ingresso attuale |
| Contributori | `CONTRIBUTING.md`, `SECURITY.md` | attivi |
| Generati/di comodo | `readme-homepage-replication.md`, `../archive/docs-legacy/root-md-files/changelog.md` | da trattare come evidenza, non come indice |

La guida per issue, discussioni, PR, verifiche e convenzioni di commit e' in
[`CONTRIBUTING.md`](../CONTRIBUTING.md). La configurazione Malta/Italy e' in
corso in [`docs/i18n/`](./i18n/index.md) (indice di comportamento multilingua e
glossario) e nei contratti `docs/contracts/i18n-*.md`.

## Indice operativo ereditato da Sixteen

_Fuso dall'indice operativo di Sixteen, ora in `../archive/docs-legacy/archive/00-index-sixteen.md`. I conteggi delle cartelle sono quelli del 2026-10-14: per quelli attuali vale il catalogo in fondo._

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
  [vite-configuration-guide.md](../archive/docs-legacy/build/vite-configuration-guide.md);
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
8. [header/footer rationale](../archive/docs-legacy/second-brain/header-footer-rationale.md) — decisione e perché;
9. [front-office readiness plan](../archive/docs-legacy/bmad/front-office-production-readiness-plan.md) — copertura guest/auth e gate;
10. [front-office readiness brainstorming](../archive/docs-legacy/bmad/front-office-readiness-brainstorming.md) — otto tecniche BMAD;
11. [Cms Head adoption plan](../../../Modules/Cms/docs/bmad/head-component-adoption-plan.md) — ownership, decisioni e parita';
12. [wiki](../archive/docs-legacy/wiki/README.md) — conoscenza consolidata e regole on-demand;
13. [design-comuni](../archive/docs-legacy/design-comuni/design-comuni-canonical.md) — vincoli visuali;
14. [design-system](../archive/docs-legacy/design-system/README.md) — token e componenti del tema;
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
| Layout/Folio | `layout-runtime-contract.md` + `../archive/docs-legacy/wiki/rules/no-parallel-design-comuni-layout.md` | `design-comuni` come nome di layout runtime; i valori CMS storici vengono risolti da `x-layouts.app`, mentre `-authenticated` e `-bare` restano template specializzati di test |
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
- [Brainstorming BMAD a otto tecniche](../archive/docs-legacy/bmad/front-office-readiness-brainstorming.md)
- [Piano di readiness](../archive/docs-legacy/bmad/front-office-production-readiness-plan.md)
- [Decisioni Head e parita'](../../../Modules/Cms/docs/bmad/head-component-adoption-plan.md)
- [Discussion #93](https://github.com/laraxot/theme_sixteen_fila5/discussions/93)

### Story BMAD recenti (standard di codice)

- [Parity degli attributi data-* (2026-10-29)](stories/data-attribute-parity.story.md) — via `data-sixteen-*` dal markup; regola in [data-attribute-rule.md](../archive/docs-legacy/data-attribute-rule.md) (scala di scelta, inventario del riferimento: 12 nomi, nessuno col nome del tema); 6 varianti legacy di header, una sola con un consumatore.
- [Passata UX mobile (2026-10-28)](stories/mobile-ux-pass.story.md) — **in revisione**: il tema servito e' Two, non Sixteen; `loading="lazy"` annullato; viewport senza blocco zoom, campi a 16 px, mappa a schermo intero in `dvh` da confermare contro il riferimento.
- [Services -> Actions e const -> enum (2026-10-08)](../archive/docs-legacy/stories/services-to-actions-sixteen.story.md) — il tema non ha piu' `app/Services/`; 31 const in enum con lang it/en.
- [Niente testi fissi nelle Blade (2026-10-30)](../archive/docs-legacy/stories/blade-i18n-no-hardcoded-text.story.md) — chiavi `pub_theme::` in it, en, de, es; numeri, residui e regola dei link.

### Parity Design Comuni v2 (2026-10-13)
- Epic DCP-00 e storie per la ripresa (`bmad/stories/dcp-00-epic-design-comuni-parity-v2.story.md`, non presente in Civic)
- Perche' la parity non e' stata completata e guardrail (`bmad/decisions/parity-root-cause-and-guardrails.md`, non presente in Civic)
- [Dossier dei 14 difetti della homepage](../archive/docs-legacy/bmad/homepage-visual-parity-defects/defects-d01-d14.md)
- [Coordinamento tra agenti](../archive/docs-legacy/prompts/homepage/00-coordination.md)
- Zen del wizard segnalazione (logica/perche'/filosofia/religione/politica) (`bmad/decisions/segnalazione-flow-parity-zen.md`, non presente in Civic)
- DCP-32 wizard step 1 privacy (`bmad/stories/dcp-32-wizard-step1-privacy.story.md`, non presente in Civic) · DCP-33 step 2 dati + mappa (`bmad/stories/dcp-33-wizard-step2-dati.story.md`, non presente in Civic) · DCP-34 step 3 riepilogo + mappa (`bmad/stories/dcp-34-wizard-step3-riepilogo.story.md`, non presente in Civic) · DCP-35 conferma (`bmad/stories/dcp-35-conferma-parity.story.md`, non presente in Civic)
- Strumenti: `bashscripts/docs/visual-comparison/INDEX.md`

### Wizard /it/tickets/create: DCP-35 (Fixcity) e D15
- [DCP-35 (modulo Fixcity): passi 1 e 2 del wizard e coordinamento tra agenti](../../../Modules/Fixcity/docs/stories/dcp-35-tickets-create-privacy-dati-coordinamento.story.md): attenzione, la numerazione DCP-32..35 esiste anche nelle story del tema (voci sopra), con significato diverso (qui DCP-35 = conferma)
- [D15: il Volt della pagina generica ha una radice propria](../archive/docs-legacy/decision-log/d15-volt-fragment-explicit-root.md): causa di `MethodNotFoundException` su «Avanti»; esiste un secondo D15, [conferma post-save](../archive/docs-legacy/decision-log/d15-conferma-post-save.md)

### Story tickets/create lato tema (2026-10-13)
- DCP-40 radice del Volt nella pagina generica (`bmad/stories/dcp-40-volt-radice-widget-livewire.story.md`, non presente in Civic)
- DCP-50 guardia di compilazione dei template Blade (`bmad/stories/dcp-50-guardia-compilazione-template-blade.story.md`, non presente in Civic)
- [D15 radice del Volt (decisione)](../archive/docs-legacy/decision-log/d15-volt-fragment-explicit-root.md)

### Multilingua it, en, de, es (DCP-120)
- [i18n/INDEX.md](i18n/index.md): comportamento multilingua (lingua, fallback, selettore, link, formati) e glossario di traduzione
- DCP-120 copertura de/es (`bmad/stories/dcp-120-multilingua-comportamenti-e-copertura.story.md`, non presente in Civic) · DCP-123 lingua dichiarata e link localizzati (`bmad/stories/dcp-123-lingua-dichiarata-e-link-localizzati.story.md`, non presente in Civic)
- [Multilingua e dispositivi: comportamenti osservati](../archive/docs-legacy/wiki/concepts/multilingua-e-dispositivi-comportamenti.md): misure su lingua, selettore, wizard, formati, menu e bersagli tattili a 375, 768, 1024, 1440 (studio in DCP-55 (`bmad/stories/dcp-55-multilingua-e-dispositivi.story.md`, non presente in Civic))

### Area personale (DCP-106, DCP-110)
- DCP-110 area personale: Le mie segnalazioni e Segnalazioni che seguo (`bmad/stories/dcp-110-area-personale-pratiche-e-seguite.story.md`, non presente in Civic)

### Registro story e dettaglio ticket (2026-10-14)
- [Registro completo delle story](../archive/docs-legacy/bmad/stories/00-registro-completo.md): le story di `stories/` e `bmad/stories/` che prima non avevano un indice (stato e titolo dichiarati nei file)
- DCP-148 dettaglio pubblico e Segui (`bmad/stories/dcp-148-dettaglio-pubblico-segnalazione-e-segui.story.md`, non presente in Civic): blocco `components/blocks/ticket-detail/design-comuni.blade.php`
- [DCP-152 (modulo Geo): marker del dettaglio e pulsanti della mappa](../../../Modules/Geo/docs/stories/dcp-152-marker-dettaglio-ticket-e-pulsanti-mappa-su-pagine-dc.story.md): il blocco passa `marker-icon-url`, `marker-color`, `marker-label` al `coordinate-picker-lit` (vedi [coordinate-picker](../archive/docs-legacy/wiki/coordinate-picker.md))

### Audit front office anonimo (2026-11-12)

- [Sprite delle icone: deve arrivare in produzione (F-01/F-02)](../archive/docs-legacy/stories/icon-sprite-deployability.story.md): `.gitignore` a due livelli, `test -f` in `deploy.sh`, guardia che interroga git
- [Home «Novita'»: 3 card per riga (F-06)](../archive/docs-legacy/stories/home-news-grid-specificity.story.md): specificita' dello scope contro il `<style>` dei blocchi
- [Sweep del front office anonimo e diff dell'head](../archive/docs-legacy/how-to/front-office-anonymous-sweep.md): metodo, soglie, trappole
- [Piano di hardening: guardie e strumenti](../archive/docs-legacy/plans/front-office-hardening-plan.md): onde per non ripetere i difetti muti
- [Brainstorming, sessione 85](../archive/docs-legacy/bmad-brainstorming.md): 5 Perche', reverse brainstorming, matrice delle guardie
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
- **Superato, non seguire:** `npm run build && npm run copy`. Lo step di copia non esiste più; vedi [build-workflow.md](../archive/docs-legacy/build-workflow.md).
- **Nomi dei file `.md`:** niente date nel nome, la data va nel frontmatter.
- **Template e-mail:** [resources/mail-layouts](../resources/mail-layouts/README.md); documenti: [christmas-email-template-implementation.md](../archive/docs-legacy/christmas-email-template-implementation.md), [christmas-email-layout.md](../archive/docs-legacy/christmas-email-layout.md), [mail-layouts-natale.md](../archive/docs-legacy/mail-layouts-natale.md). Widget di login: [login-widget-form-binding.md](../archive/docs-legacy/auth/login-widget-form-binding.md).
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

Documenti catalogati: 97 (questo file escluso), in 12 aree.

<details>
<summary><strong>radice di `docs/`</strong>: 7 documenti</summary>

- [Appointment enums (Sixteen)](appointment-enums.md)
- [Sixteen Folio Page Pattern - mount() + x-page](folio-page-pattern.md)
- [Header Sixteen: componenti Design Comuni](header-components.md)
- [html parity body policy](html-parity-body-policy.md)
- [mustache variables](mustache-variables.md)
- [Civic — English overview](readme-en.md)
- [BMAD + Second Brain: Folio Architecture Analysis (index vs auth/login)](social-login-bmad.md)

</details>

<details>
<summary><strong>`adr/`</strong>: 13 documenti</summary>

- [ADR — (decisione in una riga)](adr/0000-template.md)
- [ADR — Civic compila gli asset con Vite, senza copie, e oggi non li pubblica](adr/0001-build-assets-via-vite-and-symlink.md)
- [ADR — Civic possiede la presentazione e le shell Folio sottili, non la risoluzione delle pagine](adr/0002-front-office-theme-owns-presentation.md)
- [Versionare package-lock.json nel repository del tema](adr/0003-version-package-lock-in-theme-repo.md)
- [Inventario dei riferimenti Sixteen e confini tema/moduli](adr/0004-inventario-riferimenti-sixteen.md)
- [Attivazione di Civic e convivenza con Sixteen](adr/0005-attivazione-civic-e-convivenza-con-sixteen.md)
- [Identità Civic: namespace Themes/Civic, manifest theme.json e base Vite /themes/Civic/](adr/0006-identita-civic-namespace-manifest-e-url-degli-asset.md)
- [Rinomina di variabili d'ambiente, rotte e config; correzione del provider](adr/0007-rinomina-env-rotte-e-provider-del-tema.md)
- [ADR 0010 — Catalogo maltese mt: bozza con marcatore di revisione, non una traduzione dichiarata com…](adr/0010-catalogo-maltese-bozza-e-revisione.md)
- [ADR 0011 — Profili Paese/ente e terminologia istituzionale in lang/(locale)/entity.php](adr/0011-profili-paese-ente-e-terminologia.md)
- [ADR 0012 — Formati per Paese: date, numeri, indirizzi, telefoni e codici postali](adr/0012-formati-per-paese.md)
- [ADR 0013 — Parita' dei cataloghi misurata sull'unione delle chiavi; il fallback e' una rete di sicu…](adr/0013-fallback-di-localizzazione-e-parita-dei-cataloghi.md)
- [ADR del tema Civic](adr/README.md)

</details>

<details>
<summary><strong>`architecture/`</strong>: 1 documenti</summary>

- [PAGE ROUTING ARCHITECTURE](architecture/page-routing-architecture.md)

</details>

<details>
<summary><strong>`audits/`</strong>: 6 documenti</summary>

- [Censimento blocchi CMS — dati di ente hardcoded (#20)](audits/cms-blocks-data-contract.md)
- [Integrazione funzioni cittadino FixCity nel frontend Civic](audits/fixcity-integration.md)
- [Audit performance, SEO tecnico e budget asset](audits/performance-seo.md)
- [Audit sicurezza e privacy del layer UI (Civic)](audits/security-privacy-ui.md)
- [Piano regressione visuale (screenshot reali)](audits/visual-regression.md)
- [Audit WCAG — frontend Civic](audits/wcag-audit.md)

</details>

<details>
<summary><strong>`contracts/`</strong>: 12 documenti</summary>

- [Contratto — build asset Civic](contracts/build-surface.md)
- [Contratto — CieAuthAction (Civic)](contracts/cie-auth-action.md)
- [(operazione) — contratto comportamentale](contracts/contract-template.md)
- [Contratto — Civic Folio page shell](contracts/folio-page-shell.md)
- [Contratto — parita' dei cataloghi lang/ di Civic (it, en, de, es, mt)](contracts/i18n-catalog-parity.md)
- [Contratto — formati per Paese di Civic: date, numeri, indirizzi, telefoni, codici postali](contracts/i18n-country-formats.md)
- [Contratto — terminologia dell'ente per profilo Paese (entity.php)](contracts/i18n-entity-terminology.md)
- [Contratti del tema Civic](contracts/README.md)
- [Contratto — SanitizeReturnUrlAction (Civic)](contracts/sanitize-return-url-action.md)
- [Contratto — ServeThemeAssetAction (Civic)](contracts/serve-theme-asset-action.md)
- [Contratto — SpidAuthAction (Civic)](contracts/spid-auth-action.md)
- [Contratto — identità del tema Civic](contracts/theme-identity.md)

</details>

<details>
<summary><strong>`design/`</strong>: 1 documenti</summary>

- [Design token e branding multi-tenant (Civic)](design/design-tokens.md)

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
<summary><strong>`marketing/`</strong>: 1 documenti</summary>

- [Homepage marketing contract](marketing/homepage-conversion-contract.md)

</details>

<details>
<summary><strong>`migration/`</strong>: 2 documenti</summary>

- [Integrazione del tema Civic nell'host FixCity](migration/host-integration.md)
- [Audit dei riferimenti Sixteen e confini tema/moduli](migration/sixteen-references-audit.md)

</details>

<details>
<summary><strong>`release/`</strong>: 4 documenti</summary>

- [Build, deploy e rollback di Civic sull'host FixCity](release/deploy-and-rollback.md)
- [Go/No-Go checklist — rilascio Civic](release/go-no-go.md)
- [Smoke checklist post-deploy — Civic](release/smoke-checklist.md)
- [Versioning, compatibilità e politica del changelog — Civic](release/versioning-and-compatibility.md)

</details>

<details>
<summary><strong>`stories/`</strong>: 38 documenti</summary>

- [Authentication pages redesign with Design Comuni](stories/11-auth-pages-design-comuni-redesign.story.md)
- [Civic — completamento parallelo issue aperte](stories/11-open-issues-parallel-completion.story.md)
- [Tests DesignComuni: complete segnalazione wizard parity (4 steps + elenco + area personale)](stories/701-tests-segnalazione-wizard-parity.story.md)
- [Parity degli attributi data-: via il nome del tema dal markup di Sixteen](stories/data-attribute-parity.story.md)
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
- [DCP-449: salto di layout del wizard /tickets/create (CLS 0,44 desktop, 0,49 mobile): barra cookie i…](stories/dcp-449-salto-di-layout-del-wizard-tickets-create.story.md)
- [DCP-450: peso e cache degli asset del tema (CSS 3,34 MB, JS 1,47 MB anche sul login, max-age 3600)](stories/dcp-450-peso-e-cache-degli-asset-del-tema.story.md)
- [DCP-451: guardia sui riferimenti a viste cancellate (632 viste tolte da 483080dcac, 26 nomi ancora…](stories/dcp-451-guardia-sui-riferimenti-a-viste-cancellate.story.md)
- [DCP-452: residui di UX, accessibilità e messa in produzione del tema («Demo», favicon, forced-color…](stories/dcp-452-residui-di-ux-accessibilita-e-messa-in-produzione-del-tema.story.md)
- [Integrate Design Italia Guidelines into Sixteen Theme](stories/design-italia-guidelines-integration.story.md)
- [Integrate Disclaimer and Cookie Preferences into Sixteen Theme](stories/disclaimer-integration.story.md)
- [Front office completeness audit and fixes](stories/front-office-completeness-audit.story.md)
- [Redesign tutte le pagine front office con DesignComuni v2.4.0](stories/front-office-design-comuni-rebuild.story.md)
- [Front office detail 404 and site map page](stories/front-office-detail-not-found-and-sitemap-page.story.md)
- [Front office production readiness audit (anonymous and logged in)](stories/front-office-production-readiness-audit.story.md)
- [Header and footer: Design Comuni markup inside the v1 contract](stories/header-footer-design-comuni-markup.story.md)
- [Homepage audit — taste-skill + BMAD v6 + second brain](stories/homepage-taste-skill-bmad.story.md)
- [Issue #104 — Design Comuni, editorial DRY e wizard parity](stories/issue-104-design-comuni-editorial-dry-wizard-parity.story.md)
- [Build Sixteen: Leaflet risolvibile in CI](stories/issue-82-sixteen-leaflet-build.story.md)
- [Passata UX mobile del tema Sixteen (viewport, prototipo mobile, mappa a schermo intero)](stories/mobile-ux-pass.story.md)
- [php artisan optimize verde e pagine Volt con proprieta' bloccate](stories/optimize-view-cache-and-locked-volt-pages.story.md)
- [Sixteen: chiavi pubtheme bloccate dal rekey e nomi di rotta che non esistono](stories/pub-theme-keys-and-route-names-residuals.story.md)
- [Esecuzione parallela della roadmap Civic (C1–C6): claim, perimetri e prove](stories/roadmap-execution-c1-c5-parallel-claims.story.md)
- [Sixteen test suite: stale contracts and real bugs](stories/sixteen-suite-stale-contracts.story.md)
- [Sixteen: passo privacy tickets/create con informativa a due livelli](stories/ticket-create-privacy-design-comuni-decision.story.md)
- [Visual parity 95%+ — Design Comuni test pages](stories/visual-parity-95-design-comuni.story.md)

</details>

<details>
<summary><strong>`wiki/`</strong>: 3 documenti</summary>


**`wiki/concepts/`**

- [Link FO multilingua — path Folio + FrontofficeUrl](wiki/concepts/fo-folio-links-multilingua.md)
- [Header FO — named route Folio verificate](wiki/concepts/fo-folio-named-routes-header.md)
- [header color parity](wiki/concepts/header-color-parity.md)

</details>

<!-- docs-index:end -->

---

**Civic** è il nome di destinazione; **Sixteen** identifica ancora una parte del codice e della documentazione importati. Il piano sopra è un elenco di lavoro, non una dichiarazione di migrazione conclusa.
