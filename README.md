---
title: "Civic — tema pubblico Laraxot"
type: readme
tags: [documentation, civic, laraxot, fixcity]
created: 2026-09-26
updated: 2026-11-26
qmd: "Civic theme Laraxot frontoffice Italy Malta migration Sixteen"
issues: []
discussions: []
status: active
---

# Civic

**Tema frontoffice riutilizzabile per servizi civici, enti locali e piattaforme di partecipazione.**

[![CI](https://github.com/laraxot/theme_civic_fila5/actions/workflows/ci.yml/badge.svg?branch=dev)](https://github.com/laraxot/theme_civic_fila5/actions/workflows/ci.yml)
[![Repository](https://img.shields.io/badge/repository-theme__civic__fila5-2563eb)](https://github.com/laraxot/theme_civic_fila5)
[![Filament](https://img.shields.io/badge/Filament-5-f59e0b)](https://filamentphp.com/)
[![Documentation](https://img.shields.io/badge/docs-Italiano%20%7C%20English-64748b)](./docs/README.md)

> **Civic è il nome del tema; FixCity è un prodotto che può utilizzarlo.** Il tema è pensato per essere riutilizzato da più enti e in più Paesi, a partire da Italia e Malta.

> [!IMPORTANT]
> **Migrazione tecnica non ancora completata.** Il repository Civic nasce dal codice del precedente tema **Sixteen**. Al 26 novembre 2026, `composer.json`, `package.json`, `theme.json` e `vite.config.js` contengono ancora riferimenti a `Sixteen`. Il nome del repository **non** equivale a un tema `Themes\Civic` già installabile o attivo. Prima di attivarlo occorre completare e verificare la migrazione; vedi [stato tecnico](./docs/README.md).

## Obiettivi

- **Un unico tema, più enti:** riutilizzo tra installazioni e tenant, con configurazioni e contenuti specifici dell'ente.
- **Italia e Malta:** supporto alla terminologia e ai percorsi di ciascun contesto amministrativo senza duplicare il frontend.
- **Accessibilità:** componenti, navigazione da tastiera, contrasto e feedback verificabili. La conformità va dimostrata con audit, non dedotta dall'uso di un design system.
- **Separazione delle responsabilità:** il tema gestisce presentazione e composizione; le regole di dominio rimangono nei moduli Laraxot proprietari.
- **Evoluzione controllata:** preservare il funzionamento del tema esistente durante l'adozione di Civic.

## Tecnologie presenti nel codice importato

| Ambito | Tecnologie o convenzioni |
| --- | --- |
| Backend | PHP 8.4, Laravel 13 nel progetto FixCity ospitante, Filament 5 |
| Frontend | Blade, Folio/Volt nell'applicazione, Tailwind CSS 4, Alpine.js, Lit, DaisyUI, Flowbite |
| Asset | Vite 8; compilazione nella directory `public/` del tema |
| Geografia | Integrazione con il modulo Geo e componenti mappa |
| Documentazione | Guide e contratti tecnici in `docs/` |

Le versioni dell'applicazione ospitante non sono garantite dal solo repository del tema. Per le dipendenze effettive consultare [`composer.json`](./composer.json) e [`package.json`](./package.json).

## Internazionalizzazione

| Paese | Lingue previste | Stato nel repository |
| --- | --- | --- |
| Italia | Italiano (`it`), eventualmente inglese (`en`) | Directory di traduzione esistenti |
| Malta | Inglese (`en`), maltese (`mt`) | Inglese presente; **maltese da implementare** |
| Altri mercati | Configurabili | Il codice importato include anche `de` ed `es`; copertura da verificare |

La terminologia (*Comune*, *Local Council*, servizi, uffici e ruoli) deve essere gestita tramite traduzioni e configurazione dell'ente, non inserita direttamente nei componenti condivisi. La localizzazione deve includere testi, validazione, formati e accessibilità; la presenza di una directory linguistica non prova la copertura completa.

## Architettura e responsabilità

- **Tema Civic (obiettivo):** layout pubblici, componenti UI, token, asset e integrazione delle viste dei moduli.
- **Moduli Laraxot:** dati, autorizzazioni, processi, notifiche e Action di dominio.
- **Applicazione ospitante:** configurazione del tema attivo, routing, CMS/tenant, servizi e deployment.

Il codice ereditato da Sixteen impiega un frontend basato su Blade/Folio, blocchi CMS e componenti condivisi. Non introdurre nuove rotte o logiche di business nel tema senza valutare prima i contratti esistenti e i moduli owner.

## Sviluppo e verifiche

**Per il codice attuale, ancora identificato come Sixteen**, all'interno di una checkout Laraxot che includa i moduli richiesti:

```bash
# Dalla directory del tema
npm install
npm run build
npm test
npm run lint
# Sviluppo con hot reload: npm run dev
```

Gli script sono definiti in `package.json`; nella copia verificata non è presente `package-lock.json`, quindi `npm ci` non è ancora utilizzabile. La build usa riferimenti relativi alla struttura dell'applicazione (`Modules/`, `public_html/`) e può non funzionare in una checkout isolata. L'esistenza degli script **non** implica che test, lint o build siano già passati per Civic.

## Adozione di Civic: passaggi ancora necessari

1. Aggiornare metadati e autoload Composer (`laraxot/theme_civic_fila5`, `Themes\Civic`, service provider).
2. Migrare `theme.json`, nome del package npm, path e `base` Vite da `Sixteen` a `Civic`.
3. Verificare i riferimenti PHP, Blade, Folio/Volt, CMS, configurazioni `pub_theme`, asset, traduzioni e submodule nell'applicazione ospitante.
4. Introdurre il catalogo `mt` e verificare le differenze tra Italia e Malta a livello di contenuti, enti e servizi.
5. Eseguire build, test, controlli di accessibilità e smoke test reali prima di dichiarare Civic pronto alla produzione.

Non rinominare automaticamente stringhe storiche, documenti di audit o URL: distinguere sempre i riferimenti al vecchio tema da quelli ancora usati a runtime.

## Documentazione

- [Guida tecnica e stato reale della migrazione](./docs/README.md)
- [English overview](./docs/readme-en.md)
- [Indice storico della documentazione importata](./docs/00-INDEX.md)
- [Architettura](./docs/architecture/README.md)
- [Design system](./docs/design-system/README.md)
- [Wiki tecnica](./docs/wiki/README.md)
- [Contribuire](./CONTRIBUTING.md)
- [Segnalare vulnerabilità](./SECURITY.md)

## Riferimenti

- [Designers Italia — Modello Comuni](https://designers.italia.it/modelli/comuni/) — riferimento per il contesto italiano, **non** una certificazione del tema.
- [Repository del tema originale Sixteen](https://github.com/laraxot/theme_sixteen_fila5) — origine del codice da migrare.
- [Repository Civic](https://github.com/laraxot/theme_civic_fila5) — sviluppo sul branch `dev`, senza creare branch paralleli salvo indicazioni esplicite.

**Licenza:** MIT (come dichiarato in `composer.json`; verificare il file di licenza nella distribuzione).
