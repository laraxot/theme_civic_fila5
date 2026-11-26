---
title: "Civic — indice architettura"
type: readme
tags: [documentation, civic, architecture, legacy-sixteen]
created: 2026-09-26
updated: 2026-11-26
qmd: "Civic architectural index inherited Sixteen Folio Volt CMS layouts modular ownership"
issues: []
discussions: []
status: active
---

# Architettura Civic

Questa directory documenta i contratti architetturali importati dal tema
**Sixteen**, punto di partenza del nuovo tema **Civic**. Il codice non è ancora
stato migrato completamente: vedere lo [stato tecnico Civic](../README.md)
prima di assumere che namespace e percorsi funzionino sotto `Themes\Civic`.

## Documentazione disponibile

### Pagine, CMS e rendering

| Documento | Tema |
| --- | --- |
| [page-routing-architecture.md](./page-routing-architecture.md) | Risoluzione delle pagine e routing Folio |
| [page-component-architecture.md](./page-component-architecture.md) | Composizione delle pagine in componenti |
| [cms-driven-blocks.md](./cms-driven-blocks.md) | Dati e blocchi CMS |
| [component-namespace.md](./component-namespace.md) | Registrazione e nomi dei componenti |
| [layout-architecture.md](./layout-architecture.md) | Layout pubblici e gerarchia |
| [layout-body-page-contract.md](./layout-body-page-contract.md) | Contratto tra layout, body e singola pagina |
| [privacy-policy-folio-route.md](./privacy-policy-folio-route.md) | Pagina privacy e routing |

### CSS, componenti e interazioni

| Documento | Tema |
| --- | --- |
| [fo-pa-tokens-uniformity.md](./fo-pa-tokens-uniformity.md) | Token visivi per il frontoffice italiano |
| [css-filename-english-naming.md](./css-filename-english-naming.md) | Denominazione tecnica delle risorse |
| [css-scoping-rule.md](./css-scoping-rule.md) | Isolamento degli stili |
| [tailwind-alpine-philosophy.md](./tailwind-alpine-philosophy.md) | Convenzioni Tailwind / Alpine |
| [stepper-responsive-rule.md](./stepper-responsive-rule.md) | Comportamento responsive dello stepper |
| [wizard-parity.md](./wizard-parity.md) | Confronti con i pattern italiani di riferimento |
| [wizard-philosophy-analysis.md](./wizard-philosophy-analysis.md) | Scelte UX del wizard |
| [wizard-step-visibility.md](./wizard-step-visibility.md) | Visibilità e stato dei passi |

## Regole di progettazione

1. **Tema ≠ modulo di dominio.** Civic compone le interfacce; Action, modelli,
   autorizzazioni, validazione e notifiche restano nei moduli proprietari.
2. **Una shell pubblica per le pagine dinamiche.** Prima di creare una nuova
   route o Blade specifica, verificare Folio, layout e convenzioni CMS già
   presenti nell'applicazione ospitante.
3. **Asset con manifest verificato.** Il `vite.config.js` importato usa ancora
   `/themes/Sixteen/`; il suo output va in `public/`. L'attuale `package.json`
   **non contiene** uno script `npm run copy`: non seguire vecchie istruzioni
   che lo prescrivono.
4. **Internationalizzazione.** I nomi tecnici rimangono in inglese. Terminologia
   istituzionale, servizi, uffici e UI devono essere configurabili per Italia
   e Malta; `mt` è ancora da implementare.
5. **Evidenze, non slogan.** La compatibilità con normative o requisiti di
   accessibilità va testata nelle installazioni target. I report storici di
   Sixteen non certificano automaticamente Civic.

## Riferimenti interni

- [README principale](../../README.md)
- [Documentazione tecnica Civic](../README.md)
- [Design system del tema](../design-system/README.md)
- [Convenzioni di test](../testing-convention.md)
- [Pattern Folio](../folio-page-pattern.md)
- [Contratti italiani di riferimento](../design-comuni/README.md)

I link a file esterni alla directory del tema sono volutamente esclusi da
questo indice: la loro validità dipende dalla struttura dell'applicazione
Laraxot ospitante.
