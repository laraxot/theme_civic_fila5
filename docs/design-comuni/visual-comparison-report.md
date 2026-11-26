---
title: "visual comparison report"
type: note
tags: [documentation]
created: 2026-09-26
updated: 2026-11-26
qmd: "visual comparison report"
issues: []
discussions: []
status: draft
---

# Visual Comparison Report - Homepage

**Data**: 2026-04-02
**Reference**: https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html
**FixCity**: http://127.0.0.1:8000/it/tests/homepage
**Strumento**: Playwright (headless Chromium) + Analisi programmatica

---
## 📊 Risultato Comparazione

### Classi CSS
| Metrica | Reference | FixCity | Match |
|---------|-----------|---------|-------|
| Classi totali | 285 | 266 | - |
| Classi mancanti | - | 19 | **93.3%** |
| Classi extra | - | 0 | ✅ Nessuna |

### Elementi Strutturali
| Elemento | Reference | FixCity | Stato |
|----------|-----------|---------|-------|
| Skiplink | ✅ | ✅ | ✅ |
| Header slim | ✅ | ✅ | ✅ |
| Brand | ✅ | ✅ | ✅ |
| Socials | ✅ | ✅ | ✅ |
| Search button | ✅ | ✅ | ✅ |
| Navbar | ✅ | ✅ | ✅ |
| Hero card | ✅ | ✅ | ✅ |
| Read-more links | ✅ | ✅ | ✅ |
| Card-teaser | ✅ | ✅ | ✅ |
| Chips | ✅ | ✅ | ✅ |
| Carousel (Splide) | ✅ | ✅ | ✅ |
| Rating section | ✅ | ✅ | ✅ |
| Search modal | ✅ | ✅ | ✅ |
| Footer | ✅ | ✅ | ✅ |

### Contenuto
| Sezione | Reference | FixCity | Match |
|---------|-----------|---------|-------|
| Regione link | "Nome della Regione" | "Nome della Regione" | ✅ |
| Brand title | "Il mio Comune" | "Il mio Comune" | ✅ |
| Hero title | "Parte l'estate con oltre 300 eventi..." | "Parte l'estate con oltre 300 eventi..." | ✅ |
| Calendar title | "Eventi" | "Eventi" | ✅ |
| Evidence title | "Argomenti in evidenza" | "Argomenti in evidenza" | ✅ |
| Images | picsum.photos | picsum.photos | ✅ |

### Sezioni per Sezione
| Sezione | Images | Links | Cards | Match |
|---------|--------|-------|-------|-------|
| Head-section | 1 | 3 | 3 | ✅ |
| Calendario | 6 | 24 | 64 | ✅ |

---

## ⚠️ Classi Mancanti (19)

### Componenti Modal (6)
- `modal`, `modal-body`, `modal-content`, `modal-dialog`, `modal-lg`, `modal-title`
- **Impatto**: Il modal di ricerca potrebbe non funzionare correttamente

### Layout (2)
- `col-lg-5`, `d-md-none`
- **Impatto**: Minore, responsive breakpoints

### Tipografia (1)
- `text-underline`
- **Impatto**: Minore, stile testo

### Varie (10)
- `col`, `fade`, `icon-md`, `other-link-title`, `perfect-scrollbar`, `ps-5`, `search-modal`, `searches-list`, `searches-list-wrapper`, `variable-gutters`
- **Impatto**: Basso, principalmente funzionalità avanzate

---

## 📸 Screenshots

Screenshot catturati in `docs/design-comuni/screenshots/`:
- `reference-desktop.png` - Reference desktop (1440px)
- `reference-mobile.png` - Reference mobile (375px)
- `fixcity-desktop.png` - FixCity desktop (1440px)
- `fixcity-mobile.png` - FixCity mobile (375px)

---

## ✅ Conclusioni

### Cosa Funziona
- ✅ **Tutte le sezioni principali presenti**
- ✅ **Contenuto identico** (testi, immagini, link)
- ✅ **93.3% classi CSS replicate**
- ✅ **Struttura HTML corrispondente** per le sezioni visibili
- ✅ **Nessuna classe extra** in FixCity (pulito)

### Cosa Manca
- ⚠️ **Modal search** - 6 classi mancanti (funzionalità non critica)
- ⚠️ **19 classi CSS** mancanti (impatto visivo minimo)
- ⚠️ **Extra section** `section-muted` tra useful-links e rating

### Prossimi Passi
1. Aggiungere classi modal mancanti per search functionality
2. Rimuovere o nascondere extra section-muted
3. Verifica visiva manuale degli screenshot
4. Test responsive su dispositivi reali

---

**Collegamenti**:
- [00-index.md](00-index.md) - Indice documentazione
- [css-js-alignment-plan.md](css-js-alignment-plan.md) - Piano di lavoro
- [html-structure-comparison-2026-04-02.md](html-structure-comparison.md) - Analisi struttura

---

## Documento assorbito: `VISUAL-COMPARISON-REPORT.md` (2026-11-26, deduplica nomi)

# Homepage Visual Comparison Report

**Date:** 2026-04-07
**Reference:** https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html
**Local:** http://127.0.0.1:8000/it/tests/homepage

## Screenshots

| # | File | Description |
|---|------|-------------|
| 01 | [01-remote-reference-full.png](screenshots/01-remote-reference-full.png) | Full page reference screenshot |
| 02 | [02-remote-reference-above-fold.png](screenshots/02-remote-reference-above-fold.png) | Above-fold reference |
| 03 | [03-local-homepage-above-fold.png](screenshots/03-local-homepage-above-fold.png) | Local before fixes |
| 04 | [04-local-homepage-after-fixes.png](screenshots/04-local-homepage-after-fixes.png) | Local after fixes (above fold) |
| 05 | [05-local-homepage-full-after-fixes.png](screenshots/05-local-homepage-full-after-fixes.png) | Local after fixes (full page) |

## Fixes Applied

### Hero Section
- Removed inline search form (`cmp-search`)
- Removed `min-vh-lg-50`, `align-items-center` from row
- Removed `text-uppercase`, `text-success`, `chip-success` from elements
- Changed `read-more` classes to match reference (`pb-3` instead of `text-success fw-bold text-uppercase`)
- Removed `order-1 order-lg-2` from image column

### Governance Cards
- Added `card-wrapper`, `card-overlapping`, `card-teaser-wrapper`, `card-teaser-wrapper-equal`, `card-teaser-block-3` classes
- Changed typography: `text-paragraph-medium`, `u-grey-light`, `text-paragraph-card`
- Removed `d-flex`, `flex-row`, `align-items-start` from card body
- Changed row from `g-4 mb-5` to `mb-2`

### Evidence Section
- Added `card-wrapper`, `card-teaser-wrapper`, `card-teaser-wrapper-equal`, `card-teaser-block-3` to topic cards
- Added `card-wrapper`, `card-teaser-wrapper`, `card-teaser-wrapper-equal`, `card-teaser-block-3`, `pb-0` to thematic sites

### Feedback Rating
- Changed `rating-green-bg` to `bg-primary`
- Added `shadow`, `pt-lg-80`, `pb-lg-80` classes
- Added multi-step form with positive/negative fieldsets
- Added `d-flex`, `justify-content-center` to row
- Changed col width from `col-lg-10` to `col-lg-6`

### Layout
- Removed `id="main-container"` from container div (H1 in hero has it)

## Remaining Visual Differences

### 1. Governance Cards Overlapping Effect
**Severity:** Medium
**Issue:** Remote cards have a slight visual overlap effect. Local cards have uniform gaps.
**CSS needed:** The `card-overlapping` class needs CSS rules to produce negative margins or transform for the overlap effect.

### 2. Evidence Section Background Pattern
**Severity:** Low
**Issue:** Remote has a subtle geometric pattern overlay on the green gradient. Local shows only the gradient.
**CSS needed:** Add `::before` or `::after` pseudo-element with pattern background image.

### 3. Event Calendar Number Colors
**Severity:** Low
**Issue:** Calendar day numbers (15, 16, etc.) are blue in local. Remote uses dark gray.
**CSS needed:** Override default link/number color in calendar cards.

### 4. Third Topic Card ("Sport") Missing Links
**Severity:** Medium
**Issue:** The JSON content for "Sport" topic has links defined, but they may not be rendering.
**Action:** Verify JSON content and blade template rendering.

### 5. Thematic Sites - Third Card Visibility
**Severity:** Low
**Issue:** Third thematic site card ("Musei Civici") may not be fully visible or styled correctly.
**Action:** Verify grid layout and card rendering.

### 6. Services/Administration Blocks
**Severity:** N/A (intentional)
**Note:** These blocks do NOT exist in the reference. They are local enhancements.
**Decision:** Keep as local enhancements or remove for strict parity.

### 7. Final Search Block
**Severity:** N/A (intentional)
**Note:** This block does NOT exist in the reference. It is a local enhancement.
**Decision:** Keep as local enhancement or remove for strict parity.

## CSS Files to Check

The following CSS files in `laravel/Themes/Sixteen/resources/css/` may need updates:

1. `design-comuni/css/style-apply.css` - Main @apply rules
2. `design-comuni/css/cards.css` - Card wrapper and overlapping styles
3. `design-comuni/css/evidence.css` - Evidence section background
4. `design-comuni/css/calendar.css` - Event calendar styling

## Related Documents

- [HOMEPAGE-HTML-STRUCTURE-COMPARISON.md](homepage-html-structure-comparison.md) - HTML structure analysis
- [../ARCHITECTURAL_DECISIONS.md](architectural-decisions.md) - Architecture decisions
- [../../../docs/design-comuni/README.md](README.md) - Design Comuni index

## Next Steps

1. Add CSS for `card-overlapping` effect
2. Fix evidence section background pattern
3. Fix calendar number colors
4. Verify third topic card links rendering
5. Decide on Services/Administration/Final Search blocks (keep or remove)

---
*Generated by visual comparison on 2026-04-07*

