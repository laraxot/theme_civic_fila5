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

Questa è la **porta d'ingresso tecnica** di `laraxot/theme_civic_fila5`. Il [README principale](../README.md) presenta obiettivi e funzionalità; la [presentazione inglese](./readme-en.md) descrive l'ambito internazionale. L'[indice ereditato](./00-INDEX.md) raccoglie la documentazione storica di Sixteen: i suoi percorsi e le sue verifiche non devono essere considerati automaticamente aggiornati per Civic.

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
| Indice precedente | [00-INDEX.md](./00-INDEX.md) | Snapshot Sixteen: non sostituisce questa guida |

## Regole per gli aggiornamenti

- Lavorare sul branch **`dev`** esistente del repository Civic; nessun branch nuovo.
- Preservare evidenze e report di Sixteen come **storici**, esplicitando il contesto quando li si cita.
- Aggiornare i README e i contratti prima di dichiarare implementate funzionalità non verificate.
- Non creare un secondo tema per Malta: usare componenti condivisi e adattatori/configurazioni per Paese.
- Associare a ogni dichiarazione di conformità una verifica ripetibile e datata; non utilizzare badge di certificazione non dimostrati.

---

**Civic** è il nome di destinazione; **Sixteen** identifica ancora una parte del codice e della documentazione importati. Il piano sopra è un elenco di lavoro, non una dichiarazione di migrazione conclusa.
