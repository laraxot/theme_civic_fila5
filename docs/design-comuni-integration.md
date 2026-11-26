---
title: "design comuni integration"
type: note
tags: [documentation]
created: 2026-09-26
updated: 2026-11-26
qmd: "design comuni integration"
issues: []
discussions: []
status: draft
---

# 🏛️ DESIGN COMUNI ITALIANI - INTEGRATION GUIDE

**Data**: 2025-10-02  
**Source**: https://github.com/italia/design-comuni-pagine-statiche  
**Live Demo**: https://italia.github.io/design-comuni-pagine-statiche  
**Purpose**: Integrare il design system ufficiale dei comuni italiani in FixCity  

---
## 📊 ANALISI DESIGN COMUNI

### Scopo
Template HTML ufficiali per i siti web e servizi digitali dei Comuni Italiani, conformi alle Linee guida di design per i servizi web della PA.

### Stack Tecnologico
- **Bootstrap Italia** - Framework UI ufficiale
- **Handlebars** - Template engine
- **SCSS** - Styling
- **Webpack** - Build system
- **Node >= 18** - Runtime

### Caratteristiche Principali
✅ **AGID Compliant** - 100% conforme linee guida  
✅ **Accessibilità** - WCAG 2.1 AA validato  
✅ **Bootstrap Italia** - UI Kit ufficiale  
✅ **Responsive** - Mobile-first design  
✅ **Templates Pronti** - HTML/CSS/JS validati  

---

## 🎯 TEMPLATES ANALIZZATI

### Segnalazione Disservizio (PERFETTO PER FIXCITY!)

#### 1. Scheda Servizio
**File**: `segnalazione-dettaglio.html`
- Presentazione servizio segnalazione
- Informazioni necessarie
- Accesso alla funzionalità
- Lista tutte le segnalazioni

#### 2. Step 1 - Privacy
**File**: `segnalazione-01-privacy.html`
- Informativa privacy
- Consenso trattamento dati
- GDPR compliant

#### 3. Step 2 - Dati Segnalazione
**File**: `segnalazione-02-dati.html`
- Inserimento luogo
- Dettagli disservizio
- Upload allegati
- Dati autore segnalazione

#### 4. Step 3 - Riepilogo
**File**: `segnalazione-03-riepilogo.html`
- Riepilogo informazioni
- Conferma o modifica
- Validazione finale

#### 5. Step 4 - Conferma
**File**: `segnalazione-04-conferma.html`
- Conferma invio
- Numero protocollo
- Prossimi passi

#### 6. Area Personale
**File**: `segnalazione-area-personale.html`
- Dashboard utente
- Ultime attività
- Segnalazioni effettuate

#### 7. Elenco Segnalazioni
**File**: `ticket-list.html`
- Lista completa segnalazioni
- Mappa interattiva
- Filtri per tipologia
- Ricerca avanzata

---

## 🚀 APPLICABILITÀ A FIXCITY

### Similitudini Perfette
| Design Comuni | FixCity | Match |
|---------------|---------|-------|
| Segnalazione Disservizio | Ticket System | ✅ 100% |
| Step Privacy | GDPR Consent | ✅ 100% |
| Form Dati | Ticket Creation | ✅ 100% |
| Riepilogo | Ticket Preview | ✅ 100% |
| Conferma | Ticket Submitted | ✅ 100% |
| Area Personale | User Dashboard | ✅ 100% |
| Elenco + Mappa | Tickets List + Map | ✅ 100% |

### Differenze
- Design Comuni: Template statici
- FixCity: Applicazione dinamica Laravel
- Design Comuni: HTML puro
- FixCity: Livewire + Blade

---

## 📦 COMPONENTI DA INTEGRARE

### 1. Bootstrap Italia (CRITICAL)

**Cosa**: Framework UI ufficiale AGID

**Installazione**:
```bash
npm install bootstrap-italia
```

**Benefits**:
- ✅ AGID 100% compliant
- ✅ Accessibilità garantita
- ✅ Componenti validati
- ✅ Design system ufficiale
- ✅ Manutenzione attiva

### 2. Layout Templates

**Header Ufficiale**:
```html
<header class="it-header-wrapper">
  <div class="it-header-slim-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="it-header-slim-wrapper-content">
            <!-- Slim header content -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="it-nav-wrapper">
    <div class="it-header-center-wrapper">
      <!-- Main header -->
    </div>
  </div>
</header>
```

**Footer Ufficiale**:
```html
<footer class="it-footer">
  <div class="it-footer-main">
    <div class="container">
      <!-- Footer content -->
    </div>
  </div>
  <div class="it-footer-small-prints">
    <div class="container">
      <!-- Legal links -->
    </div>
  </div>
</footer>
```

### 3. Form Wizard Pattern

**Step Indicator**:
```html
<div class="steppers">
  <div class="steppers-header">
    <ul>
      <li class="confirmed">Step 1 <span class="sr-only">Confermato</span></li>
      <li class="active">Step 2 <span class="sr-only">Attivo</span></li>
      <li>Step 3</li>
      <li>Step 4</li>
    </ul>
  </div>
</div>
```

### 4. Card Components

**Ticket Card**:
```html
<div class="card-wrapper card-space">
  <div class="card card-bg card-big">
    <div class="card-body">
      <div class="category-top">
        <span class="category">Categoria</span>
        <span class="data">01/01/2025</span>
      </div>
      <h5 class="card-title big-heading">Titolo Segnalazione</h5>
      <p class="card-text">Descrizione breve...</p>
      <span class="card-signature">Autore</span>
      <a class="read-more" href="#">
        <span class="text">Leggi di più</span>
        <svg class="icon"><use href="/bootstrap-italia/svg/sprites.svg#it-arrow-right"></use></svg>
      </a>
    </div>
  </div>
</div>
```

### 5. Status Badges

**Badge Ufficiali**:
```html
<!-- Status badges -->
<span class="badge badge-danger">Aperto</span>
<span class="badge badge-warning">In Corso</span>
<span class="badge badge-success">Risolto</span>
<span class="badge badge-secondary">Chiuso</span>

<!-- Priority badges -->
<span class="badge badge-danger">Urgente</span>
<span class="badge badge-warning">Alta</span>
<span class="badge badge-info">Media</span>
<span class="badge badge-secondary">Bassa</span>
```

### 6. Timeline Component

**Activity Timeline**:
```html
<div class="timeline-wrapper">
  <div class="timeline">
    <div class="timeline-element">
      <span class="it-now-label d-none d-lg-flex">Ora</span>
      <div class="it-pin-wrapper it-evidence">
        <div class="pin-icon">
          <svg class="icon"><use href="/bootstrap-italia/svg/sprites.svg#it-check"></use></svg>
        </div>
      </div>
      <div class="card-wrapper">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Evento</h5>
            <p class="card-text">Descrizione evento</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
```

### 7. Map Integration

**Mappa Segnalazioni**:
```html
<div class="map-wrapper">
  <div id="map" class="map-container"></div>
  <div class="map-legend">
    <ul class="legend-list">
      <li><span class="legend-marker marker-red"></span> Aperto</li>
      <li><span class="legend-marker marker-orange"></span> In Corso</li>
      <li><span class="legend-marker marker-green"></span> Risolto</li>
    </ul>
  </div>
</div>
```

---

## 🎨 BLADE COMPONENTS DA CREARE

### 1. Header Component
```php
// Themes/Sixteen/Resources/views/components/header.blade.php
<header class="it-header-wrapper" {{ $attributes }}>
    <x-sixteen::header.slim />
    <x-sixteen::header.center />
    <x-sixteen::header.nav />
</header>
```

### 2. Footer Component
```php
// Themes/Sixteen/Resources/views/components/footer.blade.php
<footer class="it-footer">
    <x-sixteen::footer.main />
    <x-sixteen::footer.small-prints />
</footer>
```

### 3. Ticket Card Component
```php
// Fixcity/Resources/views/components/ticket-card.blade.php
<div class="card-wrapper card-space">
    <div class="card card-bg">
        <div class="card-body">
            <div class="category-top">
                <span class="category">{{ $ticket->category->name }}</span>
                <span class="data">{{ $ticket->created_at->format('d/m/Y') }}</span>
            </div>
            <h5 class="card-title">{{ $ticket->name }}</h5>
            <p class="card-text">{{ Str::limit($ticket->content, 150) }}</p>
            <x-sixteen::badge :status="$ticket->status" />
            <a class="read-more" href="{{ route('tickets.show', $ticket) }}">
                <span class="text">Leggi di più</span>
                <svg class="icon"><use href="/bootstrap-italia/svg/sprites.svg#it-arrow-right"></use></svg>
            </a>
        </div>
    </div>
</div>
```

### 4. Form Wizard Component
```php
// Fixcity/Resources/views/components/wizard.blade.php
<div class="steppers">
    <div class="steppers-header">
        <ul>
            @foreach($steps as $index => $step)
                <li class="{{ $currentStep > $index ? 'confirmed' : ($currentStep === $index ? 'active' : '') }}">
                    {{ $step }}
                    @if($currentStep > $index)
                        <span class="sr-only">Confermato</span>
                    @elseif($currentStep === $index)
                        <span class="sr-only">Attivo</span>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    <div class="steppers-content">
        {{ $slot }}
    </div>
</div>
```

---

## 🔧 IMPLEMENTATION PLAN

### Phase 1: Bootstrap Italia Setup (Week 1)
1. [ ] Install Bootstrap Italia npm package
2. [ ] Configure Webpack/Vite
3. [ ] Import SCSS variables
4. [ ] Setup icon sprites
5. [ ] Test basic components

### Phase 2: Layout Components (Week 2)
6. [ ] Create Header component
7. [ ] Create Footer component
8. [ ] Create Navigation component
9. [ ] Create Breadcrumbs component
10. [ ] Test responsive layout

### Phase 3: Ticket Components (Week 3)
11. [ ] Create Ticket Card component
12. [ ] Create Ticket List component
13. [ ] Create Ticket Detail component
14. [ ] Create Status Badges component
15. [ ] Create Priority Badges component

### Phase 4: Form Wizard (Week 4)
16. [ ] Create Wizard component
17. [ ] Implement Step 1 - Privacy
18. [ ] Implement Step 2 - Data
19. [ ] Implement Step 3 - Review
20. [ ] Implement Step 4 - Confirmation

### Phase 5: Advanced Components (Week 5)
21. [ ] Create Timeline component
22. [ ] Create Map Legend component
23. [ ] Create Filter Sidebar
24. [ ] Create Search component
25. [ ] Create Pagination component

### Phase 6: Polish & Testing (Week 6)
26. [ ] AGID compliance audit
27. [ ] Accessibility testing
28. [ ] Responsive testing
29. [ ] Browser compatibility
30. [ ] Performance optimization

---

## 📋 PACKAGE.JSON ADDITIONS

```json
{
  "dependencies": {
    "bootstrap-italia": "^2.8.0",
    "owl.carousel": "^2.3.4",
    "accessible-autocomplete": "^2.0.4"
  },
  "devDependencies": {
    "@babel/core": "^7.23.0",
    "@babel/preset-env": "^7.23.0",
    "sass": "^1.69.0",
    "webpack": "^5.89.0"
  }
}
```

---

## 🎯 BENEFITS FOR FIXCITY

### Compliance
✅ **AGID 100%** - Conformità garantita  
✅ **WCAG 2.1 AA** - Accessibilità validata  
✅ **Design System** - Ufficiale PA  
✅ **Best Practices** - Linee guida seguite  

### User Experience
✅ **Familiare** - Design riconoscibile  
✅ **Accessibile** - Per tutti gli utenti  
✅ **Responsive** - Mobile-first  
✅ **Intuitivo** - Pattern consolidati  

### Technical
✅ **Manutenuto** - Aggiornamenti regolari  
✅ **Documentato** - Guide complete  
✅ **Testato** - Validato su tutti i browser  
✅ **Community** - Supporto attivo  

### Business
✅ **Credibilità** - Design ufficiale PA  
✅ **Conformità** - Requisiti legali  
✅ **Adozione** - Facilita deployment comuni  
✅ **Certificazione** - AGID ready  

---

## 📚 RESOURCES

### Official Documentation
- [Bootstrap Italia Docs](https://italia.github.io/bootstrap-italia/)
- [Design System Docs](https://docs.italia.it/italia/designers-italia/design-linee-guida-docs/)
- [UI Kit](https://designers.italia.it/kit/ui-kit/)
- [Design Comuni GitHub](https://github.com/italia/design-comuni-pagine-statiche)

### Examples
- [Live Templates](https://italia.github.io/design-comuni-pagine-statiche)
- [Comuni Reference](https://designers.italia.it/modello/comuni/)

---

## 🎨 DESIGN TOKENS

### Colors
```scss
// Primary colors
$primary: #0066CC;
$secondary: #5C6F82;
$success: #008758;
$danger: #D9364F;
$warning: #A66300;
$info: #0073E6;

// Neutral colors
$white: #FFFFFF;
$black: #17324D;
$gray-100: #F5F6F7;
$gray-200: #E3E7EB;
$gray-300: #C5CBD4;
```

### Typography
```scss
// Font family
$font-family-sans-serif: 'Titillium Web', 'HelveticaNeue', 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;
$font-family-monospace: 'Roboto Mono', monospace;

// Font sizes
$font-size-base: 1rem; // 16px
$h1-font-size: 2.5rem; // 40px
$h2-font-size: 2rem; // 32px
$h3-font-size: 1.5rem; // 24px
```

### Spacing
```scss
// Spacing scale
$spacer: 1rem;
$spacers: (
  0: 0,
  1: ($spacer * 0.25), // 4px
  2: ($spacer * 0.5),  // 8px
  3: $spacer,          // 16px
  4: ($spacer * 1.5),  // 24px
  5: ($spacer * 3),    // 48px
);
```

---

## 🔍 CHECKLIST AGID

### Layout
- [ ] Header slim con ente appartenenza
- [ ] Logo comune posizionato correttamente
- [ ] Navigation accessibile
- [ ] Footer con link obbligatori
- [ ] Breadcrumbs su tutte le pagine

### Components
- [ ] Form con label visibili
- [ ] Errori di validazione chiari
- [ ] Focus indicators visibili
- [ ] Skip links implementati
- [ ] ARIA labels corretti

### Content
- [ ] Linguaggio semplice
- [ ] Informazioni chiare
- [ ] Call to action evidenti
- [ ] Date in formato italiano
- [ ] Numeri formattati

### Accessibility
- [ ] Contrasto colori 4.5:1
- [ ] Navigazione da tastiera
- [ ] Screen reader friendly
- [ ] Alt text su immagini
- [ ] Heading hierarchy corretta

---

**Status**: 📋 READY TO IMPLEMENT  
**Priority**: CRITICAL  
**Estimated Time**: 6 weeks  
**Impact**: AGID 100% COMPLIANCE  

*"Integrando il design system ufficiale dei comuni italiani, FixCity sarà 100% AGID compliant e pronto per l'adozione da parte di qualsiasi comune italiano!"*

---

# Sezione fusa (2026-11-26, issue #27)

## Documento assorbito: `design-comuni-italia-integration.md`

# 🇮🇹 Design Comuni Italia - Integration Analysis

**Date:** 2025-10-02  
**Theme:** Sixteen (AGID Bootstrap Italia)  
**Status:** Analysis & Implementation Plan

---
## 📋 Executive Summary

**Design Comuni Italia** è il modello ufficiale per i siti web dei Comuni Italiani, sviluppato da Designers Italia e basato su Bootstrap Italia. Il nostro tema Sixteen è già allineato con Bootstrap Italia, rendendo l'integrazione naturale e completa.

**Compatibilità con FixCity:** PERFETTA - Il tema Sixteen usa già Bootstrap Italia come base!

---

## 🔍 Analisi Progetto Design Comuni

### Informazioni Generali

| Aspetto | Dettaglio |
|---------|-----------|
| **Repository** | https://github.com/italia/design-comuni-pagine-statiche |
| **Demo Live** | https://italia.github.io/design-comuni-pagine-statiche |
| **Licenza** | EUPL-1.2 |
| **Releases** | 18 versioni |
| **Contributors** | 14 sviluppatori |
| **Stars** | ~100+ |
| **Ultimo Update** | Attivo |

### Stack Tecnologico

#### Core Technologies
- **Bootstrap Italia** - Framework UI ufficiale PA
- **Handlebars** - Template engine
- **SCSS** - Preprocessore CSS
- **Webpack** - Module bundler
- **Node.js** >= 18.0.0 (consigliato v20)

#### Conformità
- ✅ **AGID Guidelines** - Linee guida design PA
- ✅ **Accessibilità** - WCAG 2.1 Level AA
- ✅ **Responsive** - Mobile-first approach
- ✅ **Performance** - Ottimizzato per velocità

---

## 📚 Struttura Template

### Sezioni Principali

#### 1. **Generali**
- Homepage
- Lista risorse per categorie
- Mappa del sito
- Ricerca
- Pagina 404

#### 2. **Amministrazione**
- Pagina principale amministrazione
- Organi di governo
- Aree amministrative
- Uffici
- Persone
- Documenti e dati
- Atti normativi

#### 3. **Novità**
- Lista novità (notizie, comunicati, avvisi)
- Dettaglio notizia
- Dettaglio comunicato
- Dettaglio avviso
- Eventi
- Calendario eventi

#### 4. **Servizi**
- Lista servizi
- Servizi per categoria
- Scheda servizio dettaglio
- Come fare per...
- Prenotazione appuntamento
- Richiesta assistenza
- Segnalazione disservizio

#### 5. **Vivere il Comune**
- Luoghi
- Luoghi per categoria
- Dettaglio luogo
- Eventi
- Dettaglio evento

---

## 🎯 Mapping con FixCity

### Corrispondenze Dirette

| Design Comuni | FixCity Module | Implementazione |
|---------------|----------------|-----------------|
| **Segnalazione Disservizio** | Fixcity (Tickets) | ✅ Già presente |
| **Prenotazione Appuntamento** | User (Appointments) | 🔄 Da implementare |
| **Richiesta Assistenza** | Fixcity (Support) | 🔄 Da implementare |
| **Servizi** | Cms (Services) | ✅ Parziale |
| **Novità** | Blog (News) | ✅ Già presente |
| **Luoghi** | Geo (Places) | 🔄 Da implementare |
| **Eventi** | Blog (Events) | ✅ Parziale |
| **Documenti** | Cms (Documents) | ✅ Già presente |

---

## 🏗️ Implementazione nel Tema Sixteen

### Struttura Proposta

```
Themes/Sixteen/
├── resources/
│   ├── views/
│   │   ├── comuni/                    # Template Design Comuni
│   │   │   ├── generali/
│   │   │   │   ├── homepage.blade.php
│   │   │   │   ├── mappa-sito.blade.php
│   │   │   │   └── ricerca.blade.php
│   │   │   ├── amministrazione/
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── organi.blade.php
│   │   │   │   └── uffici.blade.php
│   │   │   ├── novita/
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── notizia.blade.php
│   │   │   │   └── evento.blade.php
│   │   │   ├── servizi/
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── categoria.blade.php
│   │   │   │   ├── dettaglio.blade.php
│   │   │   │   ├── prenotazione.blade.php
│   │   │   │   ├── assistenza.blade.php
│   │   │   │   └── segnalazione.blade.php
│   │   │   └── vivere/
│   │   │       ├── luoghi.blade.php
│   │   │       ├── luogo-dettaglio.blade.php
│   │   │       └── eventi.blade.php
│   │   └── components/
│   │       └── comuni/                # Componenti Design Comuni
│   │           ├── card-servizio.blade.php
│   │           ├── card-notizia.blade.php
│   │           ├── card-evento.blade.php
│   │           ├── breadcrumb.blade.php
│   │           ├── hero.blade.php
│   │           └── footer-comuni.blade.php
│   └── assets/
│       └── scss/
│           └── comuni/                # Stili Design Comuni
│               ├── _variables.scss
│               ├── _servizi.scss
│               ├── _novita.scss
│               └── comuni.scss
└── docs/
    └── DESIGN_COMUNI_ITALIA_INTEGRATION.md
```

---

## 💻 Implementazione Componenti

### 1. Card Servizio

```blade
{{-- resources/views/components/comuni/card-servizio.blade.php --}}
@props([
    'title',
    'description',
    'category',
    'icon' => 'it-pa',
    'url',
])

<div class="card card-teaser shadow p-4 rounded border border-light">
    <svg class="icon">
        <use href="/bootstrap-italia/svg/sprites.svg#{{ $icon }}"></use>
    </svg>
    <div class="card-body">
        <div class="category-top">
            <span class="category">{{ $category }}</span>
        </div>
        <h5 class="card-title">
            <a href="{{ $url }}">{{ $title }}</a>
        </h5>
        <p class="card-text">{{ $description }}</p>
    </div>
</div>
```

### 2. Hero Section

```blade
{{-- resources/views/components/comuni/hero.blade.php --}}
@props([
    'title',
    'subtitle' => null,
    'breadcrumbs' => [],
    'image' => null,
])

<div class="it-hero-wrapper it-dark it-overlay">
    @if($image)
    <div class="img-responsive-wrapper">
        <div class="img-responsive">
            <div class="img-wrapper">
                <img src="{{ $image }}" title="{{ $title }}" alt="{{ $title }}">
            </div>
        </div>
    </div>
    @endif
    
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="it-hero-text-wrapper bg-dark">
                    @if(count($breadcrumbs) > 0)
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            @foreach($breadcrumbs as $crumb)
                            <li class="breadcrumb-item @if($loop->last) active @endif">
                                @if($loop->last)
                                    {{ $crumb['label'] }}
                                @else
                                    <a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a>
                                @endif
                            </li>
                            @endforeach
                        </ol>
                    </nav>
                    @endif
                    
                    <h1 class="no_toc">{{ $title }}</h1>
                    
                    @if($subtitle)
                    <p class="d-none d-lg-block">{{ $subtitle }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
```

### 3. Scheda Servizio

```blade
{{-- resources/views/comuni/servizi/dettaglio.blade.php --}}
<x-layouts.sixteen>
    <x-comuni.hero 
        :title="$service->title"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Servizi', 'url' => route('servizi.index')],
            ['label' => $service->category->name, 'url' => route('servizi.categoria', $service->category)],
            ['label' => $service->title, 'url' => '#'],
        ]"
    />

    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-12 col-lg-3">
                <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
                    <nav class="navbar it-navscroll-wrapper navbar-expand-lg">
                        <div class="menu-wrapper">
                            <div class="link-list-wrapper">
                                <ul class="link-list">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#cos-e">
                                            <span>Cos'è</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#a-chi-si-rivolge">
                                            <span>A chi si rivolge</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#come-fare">
                                            <span>Come fare</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#cosa-serve">
                                            <span>Cosa serve</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#costi">
                                            <span>Costi e vincoli</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tempi">
                                            <span>Tempi e scadenze</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#contatti">
                                            <span>Contatti</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- Content -->
            <div class="col-12 col-lg-9">
                <div class="it-page-sections-container">
                    <!-- Cos'è -->
                    <section id="cos-e" class="it-page-section mb-5">
                        <h4>Cos'è</h4>
                        <div class="richtext-wrapper">
                            {!! $service->description !!}
                        </div>
                    </section>

                    <!-- A chi si rivolge -->
                    <section id="a-chi-si-rivolge" class="it-page-section mb-5">
                        <h4>A chi si rivolge</h4>
                        <div class="richtext-wrapper">
                            {!! $service->target_audience !!}
                        </div>
                    </section>

                    <!-- Come fare -->
                    <section id="come-fare" class="it-page-section mb-5">
                        <h4>Come fare</h4>
                        <div class="richtext-wrapper">
                            {!! $service->how_to !!}
                        </div>
                        
                        @if($service->has_online_access)
                        <div class="callout callout-highlight ps-3 warning">
                            <div class="callout-title">
                                <svg class="icon icon-sm"><use href="/bootstrap-italia/svg/sprites.svg#it-info-circle"></use></svg>
                                <span class="text">Accedi al servizio</span>
                            </div>
                            <p>
                                Puoi accedere al servizio online tramite SPID o CIE.
                            </p>
                            <a href="{{ route('servizi.accedi', $service) }}" class="btn btn-primary">
                                Accedi con SPID
                            </a>
                        </div>
                        @endif
                    </section>

                    <!-- Cosa serve -->
                    <section id="cosa-serve" class="it-page-section mb-5">
                        <h4>Cosa serve</h4>
                        <div class="richtext-wrapper">
                            {!! $service->requirements !!}
                        </div>
                    </section>

                    <!-- Costi -->
                    <section id="costi" class="it-page-section mb-5">
                        <h4>Costi e vincoli</h4>
                        <div class="richtext-wrapper">
                            @if($service->cost)
                                {!! $service->cost_description !!}
                            @else
                                <p>Questo servizio è gratuito.</p>
                            @endif
                        </div>
                    </section>

                    <!-- Tempi -->
                    <section id="tempi" class="it-page-section mb-5">
                        <h4>Tempi e scadenze</h4>
                        <div class="richtext-wrapper">
                            {!! $service->timing !!}
                        </div>
                    </section>

                    <!-- Contatti -->
                    <section id="contatti" class="it-page-section mb-5">
                        <h4>Contatti</h4>
                        <div class="card-wrapper card-teaser-wrapper">
                            @foreach($service->contacts as $contact)
                            <div class="card card-teaser shadow p-4 rounded border border-light">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $contact->office }}</h5>
                                    <div class="card-text">
                                        @if($contact->phone)
                                        <p>
                                            <svg class="icon icon-sm"><use href="/bootstrap-italia/svg/sprites.svg#it-telephone"></use></svg>
                                            <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>
                                        </p>
                                        @endif
                                        
                                        @if($contact->email)
                                        <p>
                                            <svg class="icon icon-sm"><use href="/bootstrap-italia/svg/sprites.svg#it-mail"></use></svg>
                                            <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                        </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>

                    <!-- Ulteriori informazioni -->
                    <section class="it-page-section mb-5">
                        <h4>Ulteriori informazioni</h4>
                        
                        @if($service->documents->count() > 0)
                        <div class="card-wrapper card-teaser-wrapper">
                            <h5>Documenti</h5>
                            @foreach($service->documents as $document)
                            <div class="card card-teaser shadow p-3 rounded border border-light mb-2">
                                <div class="card-body">
                                    <svg class="icon icon-sm"><use href="/bootstrap-italia/svg/sprites.svg#it-file-pdf"></use></svg>
                                    <a href="{{ $document->url }}" target="_blank">{{ $document->title }}</a>
                                    <span class="text-muted ms-2">({{ $document->size }})</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        @if($service->links->count() > 0)
                        <div class="mt-4">
                            <h5>Link utili</h5>
                            <ul class="link-list">
                                @foreach($service->links as $link)
                                <li>
                                    <a href="{{ $link->url }}" target="_blank">
                                        {{ $link->title }}
                                        <svg class="icon icon-sm"><use href="/bootstrap-italia/svg/sprites.svg#it-external-link"></use></svg>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-layouts.sixteen>
```

---

## 📊 Database Schema Extensions

### Servizi (Services)

```sql
-- Estensioni per conformità Design Comuni
ALTER TABLE services ADD COLUMN target_audience TEXT;
ALTER TABLE services ADD COLUMN how_to TEXT;
ALTER TABLE services ADD COLUMN requirements TEXT;
ALTER TABLE services ADD COLUMN cost DECIMAL(10,2);
ALTER TABLE services ADD COLUMN cost_description TEXT;
ALTER TABLE services ADD COLUMN timing TEXT;
ALTER TABLE services ADD COLUMN has_online_access BOOLEAN DEFAULT FALSE;
ALTER TABLE services ADD COLUMN spid_required BOOLEAN DEFAULT FALSE;
ALTER TABLE services ADD COLUMN cie_required BOOLEAN DEFAULT FALSE;
ALTER TABLE services ADD COLUMN status ENUM('draft', 'published', 'archived') DEFAULT 'draft';

-- Contatti servizio
CREATE TABLE service_contacts (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    service_id BIGINT NOT NULL,
    office VARCHAR(255),
    phone VARCHAR(50),
    email VARCHAR(255),
    address TEXT,
    opening_hours JSON,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);

-- Documenti servizio
CREATE TABLE service_documents (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    service_id BIGINT NOT NULL,
    title VARCHAR(255),
    description TEXT,
    file_path VARCHAR(500),
    file_size VARCHAR(20),
    mime_type VARCHAR(100),
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);

-- Link utili servizio
CREATE TABLE service_links (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    service_id BIGINT NOT NULL,
    title VARCHAR(255),
    url VARCHAR(500),
    description TEXT,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);
```

---

## 🚀 Roadmap Implementazione

### Phase 1: Foundation (Week 1-2)
- [ ] Creare componenti Blade base Design Comuni
- [ ] Implementare hero, breadcrumb, card components
- [ ] Setup SCSS per stili Design Comuni
- [ ] Migrare template esistenti

### Phase 2: Servizi (Week 3-4)
- [ ] Estendere database schema servizi
- [ ] Implementare scheda servizio completa
- [ ] Aggiungere prenotazione appuntamenti
- [ ] Implementare richiesta assistenza

### Phase 3: Novità & Eventi (Week 5-6)
- [ ] Template lista novità
- [ ] Template dettaglio notizia/comunicato
- [ ] Template eventi
- [ ] Calendario eventi

### Phase 4: Luoghi & Amministrazione (Week 7-8)
- [ ] Sezione luoghi
- [ ] Dettaglio luogo
- [ ] Sezione amministrazione
- [ ] Organi e uffici

---

## 📋 Checklist Conformità AGID

### Accessibilità
- [ ] WCAG 2.1 Level AA
- [ ] Navigazione da tastiera
- [ ] Screen reader friendly
- [ ] Contrasto colori adeguato
- [ ] Form accessibili

### Performance
- [ ] Lighthouse score > 90
- [ ] First Contentful Paint < 1.8s
- [ ] Time to Interactive < 3.8s
- [ ] Cumulative Layout Shift < 0.1

### SEO
- [ ] Meta tags completi
- [ ] Structured data (Schema.org)
- [ ] Sitemap XML
- [ ] robots.txt
- [ ] Open Graph tags

### Security
- [ ] HTTPS only
- [ ] CSP headers
- [ ] HSTS enabled
- [ ] Cookie policy
- [ ] Privacy policy

---

## 💡 Innovazioni Proposte

### 1. Integrazione SPID/CIE
Autenticazione tramite identità digitale per accesso servizi.

### 2. Notifiche Push
Sistema notifiche per aggiornamenti servizi e scadenze.

### 3. Chatbot Assistenza
Bot intelligente per supporto cittadini 24/7.

### 4. App Mobile
Progressive Web App per accesso mobile ottimizzato.

### 5. Accessibilità Avanzata
Modalità alto contrasto, font dyslexia-friendly, sintesi vocale.

---

## 📊 Metriche di Successo

| Metrica | Target | Misurazione |
|---------|--------|-------------|
| Conformità AGID | 100% | Audit checklist |
| Accessibilità WCAG | AA | Automated testing |
| Performance Lighthouse | >90 | Lighthouse CI |
| Soddisfazione utenti | >4.5/5 | Survey |
| Servizi online | >80% | Admin dashboard |

---

## 🎯 Conclusioni

### Pro dell'Integrazione
✅ **Già compatibile** - Sixteen usa Bootstrap Italia  
✅ **Standard ufficiale** - Modello approvato AGID  
✅ **Accessibilità garantita** - WCAG 2.1 AA compliant  
✅ **Manutenzione attiva** - Progetto governativo  
✅ **Community** - Supporto community italiana  

### Raccomandazione

**IMPLEMENTARE SUBITO** - L'integrazione dei template Design Comuni nel tema Sixteen è essenziale per conformità AGID e offre un'esperienza utente ottimale per i cittadini.

**Priority: CRITICAL**  
**Effort: MEDIUM**  
**Impact: VERY HIGH**  
**Compliance: MANDATORY**

---

**📝 Documento preparato da:** Super Mucca 🐮  
**📅 Data:** 2025-10-02  
**📧 Contatto:** sixteen-theme@fixcity.com

---

*Prossimi passi: Iniziare implementazione Phase 1 con componenti base.*

