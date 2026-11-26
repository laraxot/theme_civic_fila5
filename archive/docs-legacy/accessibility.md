---
title: "accessibility"
type: note
tags: [documentation]
created: 2026-09-26
updated: 2026-11-26
qmd: "accessibility"
issues: []
discussions: []
status: draft
---


## Panoramica

Il tema Sixteen è progettato per garantire **accessibilità completa** seguendo gli standard **WCAG 2.1 AA** e le **Linee Guida di Design per i Servizi Digitali della Pubblica Amministrazione**.

## Tipografia FO (DCP-221)

Allineata a Bootstrap Italia: Titillium (sans), **Lora** (serif), Roboto Mono.
L'H1 hero di `/it` («Segnalazioni e servizi per la tua comunità») usa **Lora Regular 400**
(leggibilità display / ipovedenti); gli altri titoli UI Titillium a **600** con lh >= 1.15.
Font self-hosted via Vite (DCP-183), no CDN. Il 2026-10-20 è stata corretta una regressione
che aveva riportato l'H1 a Titillium 700 («ciccione»).
[dcp-221](bmad/stories/dcp-221-homepage-tipografia-leggibilita-wcag.story.md) ·
[font tokens](wiki/concepts/design-comuni-font-tokens.md) ·
[prompt 04](prompts/04.md).

## Standard di Conformità

### WCAG 2.1 AA
- **Livello A**: Requisiti base di accessibilità
- **Livello AA**: Requisiti avanzati (obiettivo del tema Sixteen)
- **Livello AAA**: Requisiti massimi (opzionale)

### Principi Fondamentali
1. **Percepibile**: Le informazioni devono essere presentate in modo che gli utenti possano percepirle
2. **Operabile**: Gli utenti devono poter navigare e interagire con l'interfaccia
3. **Comprensibile**: Le informazioni e l'operazione dell'interfaccia devono essere comprensibili
4. **Robusto**: Il contenuto deve essere interpretabile da una vasta gamma di tecnologie assistive

## Contrasto e Colori

### Requisiti di Contrasto
```css
/* Testo normale (≤ 18px) */
--text-normal: #1f2937; /* Contrasto ≥ 4.5:1 */
--text-normal-bg: #ffffff;

/* Testo grande (> 18px) */
--text-large: #374151; /* Contrasto ≥ 3:1 */
--text-large-bg: #f9fafb;
```

### Palette Colori Accessibile
```css
:root {
    /* Colori primari con contrasto garantito */
    --sixteen-primary: #0066cc;
    --sixteen-primary-dark: #004499;
    --sixteen-primary-light: #3388dd;
    
    /* Colori semantici */
    --sixteen-success: #28a745;
    --sixteen-warning: #ffc107;
    --sixteen-danger: #dc3545;
    --sixteen-info: #17a2b8;
}
```

## Navigazione da Tastiera

### Focus Management
```css
/* Stili per focus visibile */
.focus-visible {
    outline: 2px solid var(--sixteen-primary);
    outline-offset: 2px;
    border-radius: 4px;
}
```

### Skip Links
```html
<!-- Link per saltare la navigazione -->
<a href="#main-content" class="sr-only focus:not-sr-only">
    Vai al contenuto principale
</a>
```

## Screen Reader Support

### ARIA Labels
```html
<!-- Etichette ARIA per elementi interattivi -->
<button aria-label="Chiudi finestra" aria-describedby="close-help">
    <x-pub_theme::icon.x />
</button>
```

### Landmark Roles
```html
<!-- Ruoli di landmark per struttura semantica -->
<header role="banner">
    <nav role="navigation" aria-label="Navigazione principale">
        <!-- Menu -->
    </nav>
</header>

<main role="main" id="main-content">
    <!-- Contenuto principale -->
</main>
```

## Form e Input

### Label Associate
```html
<!-- Label esplicite -->
<label for="email">Indirizzo Email</label>
<input type="email" id="email" name="email" aria-describedby="email-help">

<!-- Help text -->
<div id="email-help" class="help-text">
    L'email verrà utilizzata per accedere al sistema
</div>
```

### Required Fields
```html
<!-- Campi obbligatori -->
<label for="name">
    Nome Completo
    <span aria-label="obbligatorio">*</span>
</label>
<input 
    type="text" 
    id="name" 
    name="name" 
    required 
    aria-required="true"
>
```

## Immagini e Media

### Alt Text
```html
<!-- Testo alternativo descrittivo -->
<img src="logo.png" alt="Logo della Pubblica Amministrazione">

<!-- Immagini decorative -->
<img src="decoration.png" alt="" role="presentation">
```

## Componenti Interattivi

### Modal e Dialog
```html
<!-- Modal accessibile -->
<div 
    role="dialog" 
    aria-modal="true" 
    aria-labelledby="modal-title"
    aria-describedby="modal-description"
>
    <h2 id="modal-title">Conferma Eliminazione</h2>
    <p id="modal-description">
        Sei sicuro di voler eliminare questo elemento?
    </p>
</div>
```

## Testing di Accessibilità

### Test Automatici
```javascript
// Test con axe-core
import axe from 'axe-core';

axe.run((err, results) => {
    if (results.violations.length > 0) {
        console.warn('Violazioni di accessibilità trovate:', results.violations);
    }
});
```

### Strumenti di Testing
- **axe DevTools**: Estensione browser per test automatici
- **WAVE**: Web Accessibility Evaluation Tool
- **Lighthouse**: Audit di accessibilità integrato
- **Color Contrast Analyzer**: Test contrasto colori

## Best Practices

### 1. Struttura Semantica
```html
<!-- Utilizzare sempre elementi semantici -->
<header>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/about">Chi Siamo</a></li>
        </ul>
    </nav>
</header>
```

### 2. Testo Alternativo
```html
<!-- Sempre fornire alt text appropriato -->
<img src="icon.png" alt="Icona informazione">

<!-- Per immagini decorative -->
<img src="decoration.png" alt="" role="presentation">
```

## Compliance Legale

### Normativa Italiana
- **Legge Stanca**: Legge 4/2004 per l'accessibilità
- **Linee Guida AGID**: Requisiti tecnici per siti PA
- **WCAG 2.1 AA**: Standard internazionale

### Requisiti PA
- **Contrasto minimo**: 4.5:1 per testo normale
- **Navigazione da tastiera**: Completa
- **Screen reader**: Supporto completo
- **Testo alternativo**: Obbligatorio per immagini
- **Struttura semantica**: Corretta

---
**Versione**: 1.0.0  
**Ultimo aggiornamento**: Gennaio 2025  
**Standard**: WCAG 2.1 AA, Legge Stanca, Linee Guida AGID 
# Accessibilità del Tema Sixteen

---

# Sezioni fuse dai documenti duplicati (2026-11-26, issue #27)


## Documento assorbito: `accessibility-components.md`

# Componenti di Accessibilità - Tema Sixteen

## Panoramica

Il tema Sixteen implementa componenti di accessibilità conformi alle linee guida AGID e WCAG 2.1 AA per garantire l'accessibilità completa dell'interfaccia utente.

## Componenti Disponibili

### 1. Toggle Component

Componente toggle per switch on/off con supporto completo per accessibilità e design AGID.

**Percorso**: `resources/views/components/ui/toggle.blade.php`

**Utilizzo**:
```blade
<x-toggle 
    name="demo_toggle"
    label="Enable notifications"
    checked="true"
/>
```

**Caratteristiche**:
- Switch on/off con animazioni fluide
- Supporto per label personalizzate
- Stati checked/unchecked
- Varianti di stile (lever-left, lever-right)
- Accessibilità completa con ARIA attributes
- Conformità AGID design system

### 2. Notifiche Component

Componente per la visualizzazione di notifiche e messaggi di sistema.

**Percorso**: `resources/views/components/ui/notifiche.blade.php`

**Utilizzo**:
```blade
<x-notifiche 
    type="success"
    title="Success!"
    message="Operation completed successfully"
/>
```

**Caratteristiche**:
- Supporto per diversi tipi (success, info, warning, danger)
- Icone personalizzabili
- Posizionamento flessibile (static, fixed, absolute)
- Auto-dismiss con timeout configurabile
- Accessibilità completa con ARIA attributes
- Conformità AGID design system

### 3. Cookiebar Component

Componente per la gestione del consenso ai cookie conforme al GDPR.

**Percorso**: `resources/views/components/ui/cookiebar.blade.php`

**Utilizzo**:
```blade
<x-cookiebar 
    title="Cookie Policy"
    message="Questo sito utilizza cookie per migliorare la tua esperienza."
    accept-text="Accetta"
    decline-text="Rifiuta"
/>
```

**Caratteristiche**:
- Conformità GDPR completa
- Meccanismo di consenso chiaro
- Link alla privacy policy
- Posizionamento flessibile (top, bottom)
- Accessibilità completa con ARIA attributes
- Conformità AGID design system

### 4. Hero Component

Componente hero per sezioni principali delle pagine.

**Percorso**: `resources/views/components/ui/hero.blade.php`

**Utilizzo**:
```blade
<x-pub_theme::ui.hero type="centered" size="small">
    <x-slot name="content">
        <h1>Titolo principale</h1>
        <p>Descrizione della sezione</p>
    </x-slot>
</x-pub_theme::ui.hero>
```

**Caratteristiche**:
- Supporto per diversi tipi (centered, image, video)
- Dimensioni flessibili (small, medium, large)
- Immagini di sfondo personalizzabili
- Accessibilità completa con ARIA attributes
- Conformità AGID design system

### 5. Tab Component

Componente per la navigazione a tab.

**Percorso**: `resources/views/components/ui/tab.blade.php`

**Utilizzo**:
```blade
<x-pub_theme::ui.tab orientation="horizontal" full-width="true">
    <x-slot name="tabs">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab">
                Tab 1
            </button>
        </li>
    </x-slot>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1" role="tabpanel">
            Contenuto tab 1
        </div>
    </div>
</x-pub_theme::ui.tab>
```

**Caratteristiche**:
- Supporto per orientamento orizzontale e verticale
- Navigazione da tastiera completa
- Accessibilità completa con ARIA attributes
- Conformità AGID design system

### 6. Accordion Component

Componente accordion per contenuti espandibili.

**Percorso**: `resources/views/components/ui/accordion.blade.php`

**Utilizzo**:
```blade
<x-pub_theme::ui.accordion>
    <x-slot name="items">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                    Item 1
                </button>
            </h2>
            <div id="collapse1" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    Contenuto item 1
                </div>
            </div>
        </div>
    </x-slot>
</x-pub_theme::ui.accordion>
```

**Caratteristiche**:
- Supporto per contenuti espandibili
- Navigazione da tastiera completa
- Accessibilità completa con ARIA attributes
- Conformità AGID design system

### 7. Bottom Navigation Component

Componente per la navigazione in fondo alla pagina.

**Percorso**: `resources/views/components/navigation/bottom-nav.blade.php`

**Utilizzo**:
```blade
<x-pub_theme::navigation.bottom-nav fixed="false">
    <x-slot name="links">
        <a href="#" class="nav-link active">
            <svg class="icon"><use href="#it-home"></use></svg>
            <span class="bottom-nav-label">Home</span>
        </a>
    </x-slot>
</x-pub_theme::navigation.bottom-nav>
```

**Caratteristiche**:
- Navigazione mobile-friendly
- Supporto per icone e etichette
- Posizionamento fisso o relativo
- Accessibilità completa con ARIA attributes
- Conformità AGID design system

### 8. AGID Service Card Component

Componente per la visualizzazione di card di servizi conformi al design system AGID.

**Percorso**: `resources/views/components/agid/service-card.blade.php`

**Utilizzo**:
```blade
<x-ui.service-card
    title="Nome Servizio"
    description="Descrizione del servizio"
    icon="it-settings"
    url="/servizio"
    category="Categoria"
/>
```

**Caratteristiche**:
- Design conforme al design system AGID
- Supporto per icone e categorie
- Link ai servizi
- Accessibilità completa con ARIA attributes
- Conformità AGID design system

### 9. AGID Services Grid Component

Componente per la visualizzazione di una griglia di servizi conformi al design system AGID.

**Percorso**: `resources/views/components/agid/services-grid.blade.php`

**Utilizzo**:
```blade
<x-ui.services-grid
    :services="$services"
    :columns="3"
    :show-filters="true"
    :show-search="true"
/>
```

**Caratteristiche**:
- Griglia responsive per servizi
- Filtri e ricerca integrata
- Design conforme al design system AGID
- Accessibilità completa con ARIA attributes
- Conformità AGID design system

### 10. Contrast Toggle

Componente per il controllo del contrasto dell'interfaccia.

**Percorso**: `resources/views/components/accessibility/contrast-toggle.blade.php`

**Utilizzo**:
```blade
<x-pub_theme::accessibility.contrast-toggle />
```

**Caratteristiche**:
- Toggle per attivare/disattivare l'alto contrasto
- Conformità WCAG 2.1 AA
- Supporto per screen reader
- Persistenza dello stato

### 2. Font Size Controls

Componente per il controllo della dimensione del font.

**Percorso**: `resources/views/components/accessibility/font-size-controls.blade.php`

**Utilizzo**:
```blade
<x-pub_theme::accessibility.font-size-controls />
```

**Caratteristiche**:
- Controlli per aumentare/diminuire la dimensione del font
- Range di dimensioni accessibili
- Persistenza delle preferenze utente

### 3. Skip Links

Componente per i link di salto per la navigazione da tastiera.

**Percorso**: `resources/views/components/accessibility/skip-links.blade.php`

**Utilizzo**:
```blade
<x-pub_theme::accessibility.skip-links />
```

**Caratteristiche**:
- Link per saltare al contenuto principale
- Visibili solo al focus
- Navigazione da tastiera ottimizzata

### 4. Accessibility Statement

Componente per la dichiarazione di accessibilità.

**Percorso**: `resources/views/components/accessibility/accessibility-statement.blade.php`

**Utilizzo**:
```blade
<x-pub_theme::accessibility.accessibility-statement />
```

**Caratteristiche**:
- Dichiarazione di conformità WCAG
- Link alle linee guida di accessibilità
- Informazioni sui test effettuati

## Struttura Directory

```
resources/views/components/accessibility/
├── contrast-toggle.blade.php
├── font-size-controls.blade.php
├── skip-links.blade.php
└── accessibility-statement.blade.php
```

## Configurazione

I componenti di accessibilità sono configurati nel file `config/sixteen.php`:

```php
'accessibility' => [
    'skip_links' => env('SIXTEEN_SKIP_LINKS', true),
    'high_contrast' => env('SIXTEEN_HIGH_CONTRAST', false),
    'font_size_controls' => env('SIXTEEN_FONT_SIZE_CONTROLS', false),
    'keyboard_navigation' => env('SIXTEEN_KEYBOARD_NAV', true),
    'screen_reader_content' => env('SIXTEEN_SCREEN_READER', true),
],
```

## JavaScript di Supporto

I componenti di accessibilità utilizzano JavaScript per:

- Gestione dello stato del contrasto
- Controllo della dimensione del font
- Navigazione da tastiera
- Persistenza delle preferenze utente

**File**: `resources/js/accessibility.js`

## CSS di Supporto

Gli stili per l'accessibilità sono definiti in:

**File**: `resources/css/accessibility.css`

### Classi CSS Principali

```css
/* Alto contrasto */
.high-contrast {
    --bg-primary: #000000;
    --text-primary: #ffffff;
    --border-primary: #ffffff;
}

/* Font size controls */
.font-size-small { font-size: 0.875rem; }
.font-size-normal { font-size: 1rem; }
.font-size-large { font-size: 1.125rem; }
.font-size-xl { font-size: 1.25rem; }

/* Skip links */
.skip-link {
    position: absolute;
    top: -40px;
    left: 6px;
    background: #000;
    color: #fff;
    padding: 8px;
    text-decoration: none;
    z-index: 1000;
}

.skip-link:focus {
    top: 6px;
}
```

## Testing

### Test di Accessibilità

```php
// Test per contrast toggle
public function test_contrast_toggle_renders_correctly()
{
    $this->blade('<x-pub_theme::accessibility.contrast-toggle />')
        ->assertSee('Alto contrasto')
        ->assertSee('aria-label');
}

// Test per skip links
public function test_skip_links_are_present()
{
    $this->get('/')
        ->assertSee('Vai al contenuto principale')
        ->assertSee('class="skip-link"');
}
```

### Test WCAG

I componenti sono testati per:

- Contrasto colori ≥ 4.5:1
- Navigazione da tastiera completa
- Supporto screen reader
- Focus visibile
- Struttura semantica corretta

## Riferimenti

- [WCAG 2.1 Guidelines](https://www.w3.org/WAI/WCAG21/quickref/)
- [Linee Guida AGID per l'Accessibilità](https://designers.italia.it/linee-guida/accessibilita/)
- [Bootstrap Italia - Accessibilità](https://italia.github.io/bootstrap-italia/docs/accessibilita/)

---
**Ultimo aggiornamento**: Gennaio 2025  
**Versione**: 1.0.0  
**Compatibilità**: Laravel 10+, Filament 4.x, Tailwind CSS 3.x

## Documento assorbito: `accessibility-implementation-guide.md`

# WCAG 2.1 Accessibility Implementation Guide - Sixteen Theme

## Executive Summary

This document provides specific accessibility implementation guidelines for the **Sixteen Theme**, the citizen-facing frontend of the FixCity platform. All requirements are based on WCAG 2.1 Level AA compliance, mandatory for Italian/EU public sector websites by **June 28, 2025**.

---
## Theme-Specific Accessibility Requirements

### 1. Color Palette & Contrast Compliance

#### Current Color Scheme Analysis

**Primary Colors** (from `tailwind.config.js`):
```javascript
// Verify these meet WCAG AA contrast ratios
colors: {
    primary: {
        50: '#e6f3ff',   // Light backgrounds
        500: '#0066CC',  // Primary actions - CHECK CONTRAST
        700: '#004C99',  // Dark text
        900: '#002852',  // Darkest
    },
    secondary: {
        // Define with accessibility in mind
    },
    success: '#28a745',  // ✅ Status
    warning: '#ffc107',  // ⚠️ CHECK - May fail on white
    danger: '#dc3545',   // ❌ Status
    info: '#17a2b8',     // ℹ️ Status
}
```

**Required Contrast Checks**:
```css
/* All text must meet 4.5:1 ratio (AA) or 7:1 (AAA) */

/* ❌ FAIL EXAMPLE - Warning yellow on white */
.warning-text {
    color: #ffc107; /* Only 1.9:1 contrast ratio */
    background: #ffffff;
}

/* ✅ PASS EXAMPLE - Fixed warning */
.warning-text {
    color: #b38600; /* Darkened to 4.5:1 ratio */
    background: #ffffff;
}

/* Status badges - ensure 3:1 for UI components */
.status-badge {
    border: 2px solid; /* Border must be 3:1 contrast */
}

.status-pending {
    color: #000000;
    background: #fff3cd;
    border-color: #856404; /* 3:1 against bg */
}

.status-completed {
    color: #155724;
    background: #d4edda;
    border-color: #28a745; /* 3:1 against bg */
}
```

**Automated Contrast Testing**:
```javascript
// resources/js/utils/contrast-checker.js
export function checkContrast(foreground, background) {
    const luminance = (color) => {
        const rgb = color.match(/\d+/g).map(Number);
        const [r, g, b] = rgb.map(val => {
            val /= 255;
            return val <= 0.03928
                ? val / 12.92
                : Math.pow((val + 0.055) / 1.055, 2.4);
        });
        return 0.2126 * r + 0.7152 * g + 0.0722 * b;
    };

    const l1 = luminance(foreground);
    const l2 = luminance(background);
    const ratio = (Math.max(l1, l2) + 0.05) / (Math.min(l1, l2) + 0.05);

    return {
        ratio: ratio.toFixed(2),
        passAA: ratio >= 4.5,
        passAAA: ratio >= 7.0,
    };
}
```

---

### 2. Typography & Readability

#### Font Sizing Strategy

```css
/* resources/css/app.css */

/* Base font size - user can zoom */
html {
    font-size: 16px; /* Never use px for body text */
}

/* Use rem for scalability */
body {
    font-size: 1rem; /* 16px */
    line-height: 1.5; /* WCAG recommends 1.5 minimum */
}

h1 {
    font-size: 2.5rem; /* 40px */
    line-height: 1.2;
    margin-bottom: 1.5rem;
}

h2 {
    font-size: 2rem; /* 32px */
    line-height: 1.3;
    margin-bottom: 1.25rem;
}

h3 {
    font-size: 1.5rem; /* 24px */
    line-height: 1.4;
}

/* Small text must be at least 14px (0.875rem) */
.text-small {
    font-size: 0.875rem;
}

/* Ensure text spacing is adjustable */
* {
    letter-spacing: normal;
    word-spacing: normal;
}

/* WCAG 1.4.12 - Text Spacing */
.user-adjustable-text {
    line-height: 1.5 !important;
    letter-spacing: 0.12em !important;
    word-spacing: 0.16em !important;
    paragraph-spacing: 2em !important;
}
```

#### Responsive Typography

```css
/* Mobile-first approach */
@media (max-width: 640px) {
    html {
        font-size: 14px; /* Slightly smaller on mobile */
    }

    h1 {
        font-size: 2rem; /* 28px on mobile */
    }
}

@media (min-width: 1024px) {
    html {
        font-size: 18px; /* Larger on desktop */
    }
}

/* Support 200% zoom without horizontal scroll */
@media (max-width: 1280px) and (min-resolution: 2dppx) {
    .container {
        max-width: 100%;
        padding: 0 1rem;
    }
}
```

---

### 3. Keyboard Navigation & Focus Management

#### Focus Indicators

```css
/* resources/css/components/focus.css */

/* Global focus styles - MUST be visible */
*:focus {
    outline: 3px solid #0066CC;
    outline-offset: 2px;
}

/* Never remove outline without replacement */
*:focus:not(:focus-visible) {
    outline: none;
}

*:focus-visible {
    outline: 3px solid #0066CC;
    outline-offset: 2px;
}

/* Button focus states */
button:focus,
a:focus {
    outline: 3px solid #0066CC;
    outline-offset: 2px;
    box-shadow: 0 0 0 4px rgba(0, 102, 204, 0.25);
}

/* Input focus states */
input:focus,
textarea:focus,
select:focus {
    outline: 2px solid #0066CC;
    outline-offset: 1px;
    border-color: #0066CC;
    box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.25);
}

/* Map marker focus */
.leaflet-marker-icon:focus {
    outline: 3px solid #FFD700; /* High contrast on map */
    outline-offset: 3px;
}

/* Skip link focus */
.skip-link:focus {
    position: absolute;
    top: 0;
    left: 0;
    background: #0066CC;
    color: white;
    padding: 1rem;
    z-index: 9999;
    outline: 3px solid white;
    outline-offset: -3px;
}
```

#### Skip Navigation Links

```blade
{{-- resources/views/components/layout/app.blade.php --}}
<body>
    {{-- Skip links for keyboard users --}}
    <div class="skip-links">
        <a href="#main-content" class="skip-link">
            {{ __('Skip to main content') }}
        </a>
        <a href="#ticket-form" class="skip-link">
            {{ __('Skip to report form') }}
        </a>
        <a href="#ticket-list" class="skip-link">
            {{ __('Skip to ticket list') }}
        </a>
    </div>

    <x-layout.header />

    <main id="main-content" tabindex="-1">
        {{ $slot }}
    </main>

    <x-layout.footer />
</body>
```

```css
/* Hide skip links until focused */
.skip-link {
    position: absolute;
    top: -100px;
    left: 0;
    background: #0066CC;
    color: white;
    padding: 0.5rem 1rem;
    text-decoration: none;
    z-index: 9999;
    transition: top 0.2s;
}

.skip-link:focus {
    top: 0;
}
```

#### Tab Order & Keyboard Traps

```blade
{{-- Ticket creation form with logical tab order --}}
<form @submit.prevent="submitTicket" class="ticket-form">
    {{-- tabindex=0 for normal flow, -1 to exclude from tab order --}}

    <div>
        <label for="title">{{ __('Title') }}</label>
        <input type="text" id="title" name="title" tabindex="0" required>
    </div>

    <div>
        <label for="category">{{ __('Category') }}</label>
        <select id="category" name="category_id" tabindex="0" required>
            {{-- options --}}
        </select>
    </div>

    {{-- Map interaction --}}
    <div>
        <label id="map-label">{{ __('Location') }}</label>
        <div id="map"
             role="application"
             aria-labelledby="map-label"
             tabindex="0"
             @keydown.enter="selectLocationOnMap"
             @keydown.space.prevent="selectLocationOnMap">
        </div>
        <p class="text-sm text-gray-600">
            {{ __('Press Enter or Space to select location') }}
        </p>
    </div>

    <div>
        <label for="description">{{ __('Description') }}</label>
        <textarea id="description" name="description" tabindex="0"></textarea>
    </div>

    <div class="form-actions">
        <button type="submit" tabindex="0">{{ __('Submit') }}</button>
        <button type="button" @click="cancel" tabindex="0">{{ __('Cancel') }}</button>
    </div>
</form>
```

**Modal Focus Trap**:
```javascript
// resources/js/utils/focus-trap.js
export function createFocusTrap(element) {
    const focusableElements = element.querySelectorAll(
        'a[href], button:not([disabled]), textarea, input, select, [tabindex]:not([tabindex="-1"])'
    );

    const firstFocusable = focusableElements[0];
    const lastFocusable = focusableElements[focusableElements.length - 1];

    // Save previously focused element
    const previouslyFocused = document.activeElement;

    // Focus first element
    firstFocusable?.focus();

    function handleTabKey(e) {
        if (e.key !== 'Tab') return;

        if (e.shiftKey) {
            // Shift + Tab
            if (document.activeElement === firstFocusable) {
                e.preventDefault();
                lastFocusable?.focus();
            }
        } else {
            // Tab
            if (document.activeElement === lastFocusable) {
                e.preventDefault();
                firstFocusable?.focus();
            }
        }
    }

    element.addEventListener('keydown', handleTabKey);

    return {
        destroy() {
            element.removeEventListener('keydown', handleTabKey);
            previouslyFocused?.focus();
        }
    };
}
```

**Usage in Livewire Modal**:
```blade
{{-- resources/views/livewire/ticket-detail-modal.blade.php --}}
<div x-data="{
    focusTrap: null,
    open: @entangle('showModal')
}"
     x-init="
        $watch('open', value => {
            if (value) {
                $nextTick(() => {
                    focusTrap = createFocusTrap($refs.modal);
                });
            } else {
                focusTrap?.destroy();
            }
        })
     "
     @keydown.escape.window="open = false">

    <div x-show="open"
         x-ref="modal"
         role="dialog"
         aria-modal="true"
         aria-labelledby="modal-title">

        <h2 id="modal-title">{{ $ticket->title }}</h2>

        {{-- Modal content --}}

        <button @click="open = false">{{ __('Close') }}</button>
    </div>
</div>
```

---

### 4. Images & Media Accessibility

#### Image Alt Text Strategy

```blade
{{-- Ticket images with contextual alt text --}}
@if($ticket->image_url)
    <figure>
        <img src="{{ $ticket->image_url }}"
             alt="{{ __('Photo of :category in :location reported on :date', [
                 'category' => $ticket->category->name,
                 'location' => $ticket->address,
                 'date' => $ticket->created_at->format('d/m/Y')
             ]) }}"
             loading="lazy"
             width="800"
             height="600">

        <figcaption>
            {{ $ticket->title }}
            <span class="sr-only">
                - {{ __('Reported by :name', ['name' => $ticket->owner->name]) }}
            </span>
        </figcaption>
    </figure>
@endif

{{-- Decorative images --}}
<img src="{{ asset('images/hero-bg.svg') }}"
     alt=""
     role="presentation"
     aria-hidden="true">

{{-- Icon-only buttons --}}
<button type="button"
        aria-label="{{ __('Delete ticket :id', ['id' => $ticket->id]) }}">
    <svg aria-hidden="true"><!-- Trash icon --></svg>
</button>
```

#### SVG Accessibility

```blade
{{-- Accessible SVG icons --}}
<svg role="img"
     aria-labelledby="icon-title-{{ $ticket->id }}"
     class="status-icon">
    <title id="icon-title-{{ $ticket->id }}">
        {{ __('Status: :status', ['status' => $ticket->status->label()]) }}
    </title>
    <use xlink:href="#icon-{{ $ticket->status->value }}"></use>
</svg>

{{-- Decorative SVG --}}
<svg aria-hidden="true" focusable="false">
    <!-- Decorative pattern -->
</svg>
```

#### Video/Audio Accessibility

```blade
{{-- If tickets support video reports --}}
@if($ticket->video_url)
    <figure>
        <video controls
               preload="metadata"
               width="640"
               height="360">
            <source src="{{ $ticket->video_url }}" type="video/mp4">
            <track kind="captions"
                   src="{{ $ticket->captions_url }}"
                   srclang="it"
                   label="Italiano">
            <track kind="descriptions"
                   src="{{ $ticket->descriptions_url }}"
                   srclang="it"
                   label="Descrizione audio">
            <p>{{ __('Your browser does not support video playback.') }}</p>
        </video>

        <figcaption>
            {{ $ticket->title }}
            <a href="{{ $ticket->transcript_url }}" download>
                {{ __('Download transcript') }}
            </a>
        </figcaption>
    </figure>
@endif
```

---

### 5. Forms & Input Accessibility

#### Form Labels & Instructions

```blade
{{-- Ticket submission form --}}
<form method="POST" action="{{ route('tickets.store') }}" class="ticket-form">
    @csrf

    {{-- Required field indicator --}}
    <p class="form-required-legend">
        <span aria-label="{{ __('required') }}">*</span> = {{ __('Required field') }}
    </p>

    <fieldset>
        <legend>{{ __('Ticket Information') }}</legend>

        {{-- Title field --}}
        <div class="form-group">
            <label for="ticket-title">
                {{ __('Title') }}
                <span class="required" aria-label="{{ __('required') }}">*</span>
            </label>
            <input type="text"
                   id="ticket-title"
                   name="title"
                   required
                   aria-required="true"
                   aria-invalid="{{ $errors->has('title') ? 'true' : 'false' }}"
                   aria-describedby="title-help {{ $errors->has('title') ? 'title-error' : '' }}"
                   value="{{ old('title') }}">

            <p id="title-help" class="form-help">
                {{ __('Brief description of the issue (max 100 characters)') }}
            </p>

            @error('title')
                <p id="title-error" class="form-error" role="alert">
                    <span class="sr-only">{{ __('Error') }}:</span>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Category select --}}
        <div class="form-group">
            <label for="category">
                {{ __('Category') }}
                <span class="required" aria-label="{{ __('required') }}">*</span>
            </label>
            <select id="category"
                    name="category_id"
                    required
                    aria-required="true">
                <option value="">{{ __('Select a category') }}</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Description textarea --}}
        <div class="form-group">
            <label for="description">{{ __('Description') }}</label>
            <textarea id="description"
                      name="description"
                      rows="5"
                      aria-describedby="description-help"
                      maxlength="500">{{ old('description') }}</textarea>

            <p id="description-help" class="form-help">
                {{ __('Detailed description of the issue') }}
                <span aria-live="polite" aria-atomic="true">
                    <span class="char-count">
                        <span id="char-count">0</span>/500
                    </span>
                </span>
            </p>
        </div>
    </fieldset>

    <fieldset>
        <legend>{{ __('Location') }}</legend>

        {{-- Address autocomplete --}}
        <div class="form-group">
            <label for="address">{{ __('Address') }}</label>
            <input type="text"
                   id="address"
                   name="address"
                   autocomplete="street-address"
                   aria-describedby="address-help"
                   aria-autocomplete="list"
                   aria-controls="address-suggestions"
                   @input="searchAddress">

            <p id="address-help" class="form-help">
                {{ __('Start typing to search for an address') }}
            </p>

            <ul id="address-suggestions"
                role="listbox"
                aria-label="{{ __('Address suggestions') }}"
                x-show="suggestions.length > 0">
                <template x-for="(suggestion, index) in suggestions" :key="index">
                    <li role="option"
                        :aria-selected="index === selectedIndex"
                        @click="selectAddress(suggestion)"
                        @keydown.enter="selectAddress(suggestion)">
                        <span x-text="suggestion.label"></span>
                    </li>
                </template>
            </ul>
        </div>
    </fieldset>

    {{-- Form actions --}}
    <div class="form-actions">
        <button type="submit" class="btn-primary">
            {{ __('Submit Report') }}
        </button>
        <button type="reset" class="btn-secondary">
            {{ __('Reset Form') }}
        </button>
    </div>
</form>
```

#### Error Handling & Live Validation

```javascript
// resources/js/components/form-validation.js
document.addEventListener('alpine:init', () => {
    Alpine.data('ticketForm', () => ({
        errors: {},
        touched: {},

        validateField(field, value) {
            let error = null;

            switch (field) {
                case 'title':
                    if (!value) {
                        error = this.$t('Title is required');
                    } else if (value.length > 100) {
                        error = this.$t('Title must be less than 100 characters');
                    }
                    break;

                case 'category_id':
                    if (!value) {
                        error = this.$t('Please select a category');
                    }
                    break;
            }

            this.errors[field] = error;

            // Update ARIA
            const input = document.getElementById(field);
            if (input) {
                input.setAttribute('aria-invalid', error ? 'true' : 'false');
            }

            // Announce error to screen readers
            if (error && this.touched[field]) {
                this.announceError(field, error);
            }
        },

        announceError(field, message) {
            const liveRegion = document.getElementById('form-errors-live');
            if (liveRegion) {
                liveRegion.textContent = `${field}: ${message}`;
            }
        }
    }));
});
```

```blade
{{-- Live region for error announcements --}}
<div id="form-errors-live"
     class="sr-only"
     role="status"
     aria-live="polite"
     aria-atomic="true">
</div>
```

---

### 6. ARIA Landmarks & Semantic Structure

#### Page Structure Template

```blade
{{-- resources/views/components/layout/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ config('app.name') }}</title>
    {{-- Meta tags --}}
</head>
<body>
    {{-- Skip links --}}
    <div class="skip-links">
        <a href="#main-content" class="skip-link">{{ __('Skip to main content') }}</a>
    </div>

    {{-- Header --}}
    <header role="banner">
        <div class="container">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('images/logo.svg') }}"
                     alt="{{ config('app.name') }} - {{ __('Home') }}">
            </a>

            <nav role="navigation" aria-label="{{ __('Main navigation') }}">
                <ul>
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li><a href="{{ route('tickets.index') }}">{{ __('Reports') }}</a></li>
                    <li><a href="{{ route('tickets.create') }}">{{ __('New Report') }}</a></li>
                    <li><a href="{{ route('about') }}">{{ __('About') }}</a></li>
                </ul>
            </nav>

            {{-- User menu --}}
            @auth
                <nav role="navigation" aria-label="{{ __('User menu') }}">
                    <button aria-expanded="false"
                            aria-controls="user-menu"
                            @click="userMenuOpen = !userMenuOpen">
                        {{ Auth::user()->name }}
                    </button>
                    <ul id="user-menu" hidden>
                        <li><a href="{{ route('profile') }}">{{ __('Profile') }}</a></li>
                        <li><a href="{{ route('logout') }}">{{ __('Logout') }}</a></li>
                    </ul>
                </nav>
            @endauth
        </div>
    </header>

    {{-- Main content --}}
    <main id="main-content" role="main" tabindex="-1">
        {{-- Breadcrumbs --}}
        @if(isset($breadcrumbs))
            <nav aria-label="{{ __('Breadcrumb') }}">
                <ol class="breadcrumbs">
                    @foreach($breadcrumbs as $breadcrumb)
                        <li>
                            @if($loop->last)
                                <span aria-current="page">{{ $breadcrumb['label'] }}</span>
                            @else
                                <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>
        @endif

        {{-- Flash messages --}}
        @if(session('success'))
            <div role="alert" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Page content --}}
        {{ $slot }}
    </main>

    {{-- Sidebar (if present) --}}
    @if(isset($sidebar))
        <aside role="complementary" aria-label="{{ __('Filters and additional information') }}">
            {{ $sidebar }}
        </aside>
    @endif

    {{-- Footer --}}
    <footer role="contentinfo">
        <div class="container">
            <nav aria-label="{{ __('Footer navigation') }}">
                <ul>
                    <li><a href="{{ route('privacy') }}">{{ __('Privacy Policy') }}</a></li>
                    <li><a href="{{ route('terms') }}">{{ __('Terms of Service') }}</a></li>
                    <li><a href="{{ route('accessibility') }}">{{ __('Accessibility') }}</a></li>
                    <li><a href="{{ route('contact') }}">{{ __('Contact Us') }}</a></li>
                </ul>
            </nav>

            <p>&copy; {{ date('Y') }} {{ config('app.name') }}</p>
        </div>
    </footer>

    {{-- Live region for dynamic announcements --}}
    <div id="live-region"
         class="sr-only"
         role="status"
         aria-live="polite"
         aria-atomic="true">
    </div>
</body>
</html>
```

---

### 7. Accessibility Testing & Validation

#### Automated Testing Setup

```bash
# Install testing tools
npm install --save-dev @axe-core/cli pa11y cypress-axe
```

```javascript
// package.json
{
    "scripts": {
        "test:a11y": "npm run test:axe && npm run test:pa11y",
        "test:axe": "axe http://localhost:8000 --tags wcag2a,wcag2aa,wcag21a,wcag21aa",
        "test:pa11y": "pa11y-ci --config .pa11yci.json"
    }
}
```

```.pa11yci.json
{
    "defaults": {
        "standard": "WCAG2AA",
        "timeout": 10000,
        "chromeLaunchConfig": {
            "args": ["--no-sandbox"]
        }
    },
    "urls": [
        "http://localhost:8000/",
        "http://localhost:8000/segnalazioni",
        "http://localhost:8000/segnalazioni/nuova",
        "http://localhost:8000/login"
    ]
}
```

#### Cypress Accessibility Tests

```javascript
// cypress/e2e/accessibility/ticket-form.cy.js
describe('Ticket Form Accessibility', () => {
    beforeEach(() => {
        cy.visit('/segnalazioni/nuova');
        cy.injectAxe();
    });

    it('should have no accessibility violations', () => {
        cy.checkA11y();
    });

    it('should have proper focus order', () => {
        cy.get('#title').should('have.focus');
        cy.realPress('Tab');
        cy.get('#category').should('have.focus');
        cy.realPress('Tab');
        cy.get('#description').should('have.focus');
    });

    it('should announce errors to screen readers', () => {
        cy.get('form').submit();
        cy.get('[role="alert"]').should('be.visible');
        cy.get('#title').should('have.attr', 'aria-invalid', 'true');
    });

    it('should support keyboard navigation', () => {
        cy.get('#category').realPress('Enter');
        cy.get('[role="listbox"]').should('be.visible');
        cy.realPress('ArrowDown');
        cy.realPress('Enter');
        cy.get('#category').should('have.value', '1');
    });
});
```

---

## Implementation Checklist

### Theme-Wide Accessibility Tasks

#### Critical (Level A - Must Fix)
- [ ] Audit color contrast for all text/background combinations
- [ ] Add alt text to all meaningful images
- [ ] Ensure all forms have proper labels
- [ ] Implement skip navigation links
- [ ] Fix keyboard navigation for all interactive elements
- [ ] Remove any keyboard traps
- [ ] Add ARIA labels to icon-only buttons
- [ ] Ensure proper heading hierarchy on all pages
- [ ] Add language attribute to HTML tag
- [ ] Test with keyboard only (no mouse)

#### High Priority (Level AA - Required for Compliance)
- [ ] Ensure 4.5:1 contrast for all text
- [ ] Ensure 3:1 contrast for UI components
- [ ] Implement visible focus indicators
- [ ] Add error suggestions for form validation
- [ ] Ensure consistent navigation across pages
- [ ] Add captions to video content (if any)
- [ ] Support 200% text zoom without loss of functionality
- [ ] Test with NVDA screen reader
- [ ] Test with VoiceOver screen reader

#### Nice to Have (Level AAA - Enhanced Accessibility)
- [ ] Achieve 7:1 contrast for body text
- [ ] Provide sign language interpretation for videos
- [ ] Implement extended audio descriptions
- [ ] Add reading level indicators

---

## Resources

### Testing Tools
- **MAUVE++**: https://mauve.isti.cnr.it/ (Italian accessibility validator)
- **axe DevTools**: Browser extension for automated testing
- **NVDA**: Free screen reader for Windows
- **VoiceOver**: Built-in screen reader for macOS/iOS
- **Color Contrast Analyzer**: Desktop app for contrast checking

### Documentation
- **WCAG 2.1**: https://www.w3.org/TR/WCAG21/
- **ARIA Authoring Practices**: https://www.w3.org/WAI/ARIA/apg/
- **WebAIM**: https://webaim.org/resources/

---

**Document Version**: 1.0
**Next Review**: January 2026

## Documento assorbito: `accessibility-audit-homepage-wcag.md`

# WCAG 2.1 AA Audit — Homepage (misurato)

**Quando:** 2026-10-23  
**URL:** `http://192.168.1.40:8000/it` (+ `/en` e altre guest FO)  
**Tool:** `@axe-core/playwright` 4.x via `tests/browser/a11y-axe.spec.mjs`  
**Tag:** `wcag2a`, `wcag2aa`, `wcag21a`, `wcag21aa`  
**Esclusi dal contratto FO:** `.phpdebugbar` / tooling locale (false positive
`button-name` + `color-contrast` su UI debug Laravel — non codice prodotto).

## Esito axe (blocking serious/critical = 0)

| Pagina | 375px | 1440px |
|--------|-------|--------|
| `/it` | 0 | 0 |
| `/en` | 0 | 0 |
| `/it/auth/login` | 0 | 0 |
| `/it/tickets` | 0 | 0 |
| `/it/tickets/track` | 0 | 0 |
| `/it/domande-frequenti` | 0 | 0 |

Dump homepage multi-viewport (375/768/1440) senza tooling: **0 violazioni**
totali → `/tmp/fc-a11y/axe-home-it.json` (artefatto locale, non commit).

Prima del fix exclude tooling: il test falliva con `critical button-name` e
`serious color-contrast` su bottoni debugbar (`copyToClipboard`, label
«LARAVEL»). Remediation: dismiss cookie + exclude debugbar in
`a11y-axe.spec.mjs`.

## Confronto screenshot pixel (local vs fixcity.eu)

Tool: Puppeteer + `pixelmatch` (threshold 0.1), first viewport, debugbar nascosta.
Artefatti: `/tmp/fc-pixel/{local,eu,diff}-{375,768,1440}.png` + `report.json`.

| Viewport | Match % | Diff % | Note |
|----------|---------|--------|------|
| 1440 | 95.537 | 4.463 | hero locale verde+mappa vs .eu charcoal (scelta desiderabilità pages_old→avanti) |
| 768 | 88.445 | 11.555 | idem + layout stack |
| 375 | 89.049 | 10.951 | idem |

Non è un obiettivo di parity pixel 100% con `.eu` (produzione ancora charcoal):
è una baseline misurata del delta intenzionale.

## Vite JS chunks (misurato)

Entry homepage attuale (`manifest` → `resources/js/app.js`):
`assets/app-CF5BdshJ.js` (~15 KiB) + chunk condivisi
(`theme-map` ~309 KiB, `vendor-ui` ~125 KiB, `theme-behavior` ~42 KiB,
`vendor-alpine` ~25 KiB).

Chunk grandi **fuori first-paint** o orphan:

| Chunk | Size | Ruolo |
|-------|------|--------|
| `vendor-image-conversion-*.js` | ~1.29 MiB | lazy HEIC (`dynamicImport`) — ok |
| `vendor-core-*.js` | ~1.33 MiB | residuo split; non nell’import chain HTML home attuale |
| `app-6gc02iPv.js` / `app-DWB2TmZD.js` ecc. | ~1.8 MiB | **orphan** build precedenti (`emptyOutDir: false`) |

`chunkSizeWarningLimit: 1400` in `vite.config.js` è intenzionale per HEIC.
Il warning Vite “Some chunks are larger than 500 kB” resta informativo sul
lazy HEIC / vendor-core; non blocca la home.

Azione consigliata (forward): GC periodico degli `app-*.js` orphan in
`Themes/Sixteen/public/assets/` non referenziati dal `manifest.json`.

## Non sostituito da questo audit

- Prova manuale tastiera / screen reader (story DCP-143)
- Lighthouse CI score (opzionale)
- Account pages / wizard (richiedono `FIXCITY_STORAGE_STATE`)

## Come ripetere

```bash
cd laravel/Themes/Sixteen
FIXCITY_BASE_URL=http://192.168.1.40:8000 \
  npx playwright test tests/browser/a11y-axe.spec.mjs --grep 'axe /it' --reporter=list
```

