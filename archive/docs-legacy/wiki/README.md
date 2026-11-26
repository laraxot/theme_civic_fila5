---
title: "Civic Theme Wiki — ingresso"
type: concept
sources:
  - ../../README.md
  - ../README.md
confidence: high
created: 2026-09-26
updated: 2026-11-26
tags: [civic, documentation, wiki, migration]
related:
  - ../README.md
  - ../architecture/README.md
  - ../design-system/README.md
---

# Wiki del tema Civic

La documentazione di riferimento per la nuova identità del tema è in
[**Civic — guida tecnica**](../README.md). La [presentazione generale](../../README.md)
descrive obiettivi e stato della migrazione Sixteen → Civic.

Questa cartella contiene soprattutto **conoscenza storica importata da Sixteen**:
contratti di rendering, accessibilità, integrazione Geo, Folio/Volt e regole di
confine tra tema e moduli. Le istruzioni e le verifiche relative al runtime di
Sixteen **non attestano** il funzionamento di Civic nel nuovo repository.

## Indici e contratti utili

- [Indice storico del wiki Sixteen](./index.md)
- [Regole per il mantenimento del wiki](./agents.md)
- [Testing dei componenti del tema](./concepts/theme-component-test-contract.md)
- [Confine legale e consenso nell'interfaccia](./concepts/legal-consent-ui-boundary.md)
- [Principi visivi e Bootstrap Italia/Tailwind](./concepts/bootstrap-italia-tailwind-philosophy.md)
- [Documentazione architetturale del tema](../architecture/README.md)
- [Contratto del design system](../design-system/README.md)

Durante la migrazione, verificare che ogni link e ogni contratto descrivano
codice realmente presente. Non riscrivere automaticamente le evidenze storiche
e non spostare la logica di dominio dai moduli al tema.
