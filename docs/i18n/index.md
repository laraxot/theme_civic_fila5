---
title: "i18n del tema Civic: indice"
type: index
theme: Civic
created: 2026-10-13
updated: 2026-11-26
qmd: "i18n multilingua indice lingua locale it en de es mt glossario fallback selettore lingua local council malta"
status: draft
tags: [docs, civic, i18n]
---

# i18n del tema Civic

Il sito serve `it`, `en`, `de`, `es` e — come catalogo in bozza — `mt`
(`laravel/config/laravellocalization.php`; `mt` non ancora abilitato nell'host).
Questa cartella dice come funziona la lingua, come si traduce e come si adatta a
Italia e Malta.

## Comportamento e traduzione

1. [00-comportamento-multilingua.md](00-comportamento-multilingua.md): come si sceglie e si dichiara la lingua, fallback, selettore, metadati, link interni, date e numeri, difetti noti con file e riga.
2. [01-glossario.md](01-glossario.md): registro, termini della PA, cosa non si traduce, come aggiungere una lingua.
3. [translation-coverage.md](translation-coverage.md): audit dei cataloghi it/en/de/es/mt, testi hardcoded nelle view, regole di fallback (issue #7).
4. [02-catalog-parity.md](02-catalog-parity.md): contratto di parita' dei file `lang/` e convenzione `[[MT-REV]]`.
5. [mt-catalog.md](mt-catalog.md): stato della bozza maltese, marcatore di revisione, abilitazione (issue #8).

## Paese, ente e formati

6. [country-profiles.md](country-profiles.md): contratto dei profili Paese/ente (`config/civic.php`, `CountryProfile`, `entity.php`) — issue #6.
7. [formats.md](formats.md): date, indirizzi, telefoni e codici postali via `LocaleFormats` — issue #17.
8. [malta-local-councils.md](malta-local-councils.md): riferimenti italiani vs requisiti maltesi, checklist e smoke test — issue #9.

Story: [DCP-120 copertura](../bmad/stories/dcp-120-multilingua-comportamenti-e-copertura.story.md), [DCP-123 lingua dichiarata e link localizzati](../bmad/stories/dcp-123-lingua-dichiarata-e-link-localizzati.story.md).

Guardie automatiche: `Themes/Civic/tests/Unit/I18n/` (parita' cataloghi + mt),
`tests/Unit/Support/` (profili e formati), `tests/Unit/CivicLocalizationConfigTest.php`.
Audit sul sito acceso: `bashscripts/docs/i18n-locale-audit.md`.
