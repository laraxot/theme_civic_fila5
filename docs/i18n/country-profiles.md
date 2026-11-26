---
title: "Profili Paese/ente e terminologia configurabile — contratto"
type: contract
theme: Civic
created: 2026-11-26
updated: 2026-11-26
status: draft
tags: [docs, civic, i18n, country-profile]
---

# Profili Paese/ente — issue #6

Un solo tema Civic deve rappresentare **Comuni italiani** e **Local Councils maltesi**
senza fork di layout o logica. Il contratto e' in `config/civic.php` (sezione
`countries`, in testa al file) risolto a runtime da
`Themes\Civic\Support\CountryProfile`.

## Cosa contiene un profilo (`countries.<CODE>`)

| Chiave | Contenuto | Esempio IT / MT |
|---|---|---|
| `locales` | lingue del paese | `['it','en','de','es']` / `['en','mt']` |
| `entity.singular`/`plural` | nome dell'ente (dato del tenant) | `Comune` / `Local Council` |
| `entity_profile` | puntatore alla terminologia in `lang/*/entity.php` | `comune` / `local_council` |
| `formats.date` | pattern data CLDR per ICU | `dd/MM/yyyy` |
| `formats.address_format` | template `{street}, {locality} {postcode}…` | vedi `formats.md` |
| `formats.address_order` | ordine delle parti (documentazione) | IT: `street,postcode,locality,province,country` |
| `formats.postcode_pattern` | regex CAP/C.A. | IT `^\d{5}$` / MT `^[A-Z]{3}\s\d{4}$` |
| `formats.postcode_normalize` | normalizzazione CAP | MT `uppercase_space` |
| `formats.phone_country_code` | prefisso telefonico | `+39` / `+356` |
| `formats.phone_pattern` | regex numero nazionale | vedi `formats.md` |
| `formats.phone_groups` | raggruppamento visuale | `null` (da verificare) |

## Risoluzione (`CountryProfile::resolve`)

1. `civic.country` (override per tenant, impostato dall'host) se presente;
2. altrimenti `civic.default_country` (`IT` di default — fallback esplicito, non un
   modello italiano implicito: un tenant maltese imposta `MT` o `civic.country`);
3. codice sconosciuto/vuoto → `default_country`, `isFallback = true`;
4. se nemmeno il default esiste → primo profilo disponibile o profile "vuoto" con
   `formats()` che torna ai default neutrali di `CountryProfile::defaultFormats()`.

**Nessun hardcode italiano:** i componenti chiedono `CountryProfile::current()` (o
`resolve()` con la config) e ricevono entita', lingue e formati del profilo. Il nome
dell'ente ("Comune di X", "Kunsill Lokali ta'") e' dato del tenant (CMS/config), non
del tema.

## Terminologia: `lang/<locale>/entity.php`

Le etichette istituzionali NON sono in config: vivono in `entity.profiles.<profilo>`
con 13 termini gia' composti (`name`, `of`, `to`, `your`, `offices`, `services`,
`administration`, `head`, `contact_cta`, `reports_of`, `portal`, `territory`,
`name_plural`). Profili: `generic` (neutro, fallback — mai `comune` per un Paese
sconosciuto), `comune`, `local_council`. Stessa struttura in ogni lingua
(test di parita' in `tests/Unit/I18n/LangParityTest.php`, contratto
`docs/contracts/i18n-entity-terminology.md`, ADR 0011).

Le viste compongono con `entity.profiles.<entity_profile>.<termine>` — la chiave
esatta la da' `CountryProfile::entityTermKey($term)` →
`pub_theme::entity.profiles.<profilo>.<termine>` — e passano la terminologia come
dato: nessuna concatenazione articolo+nome (gli articoli cambiano con lingua e genere).

## Cosa appartiene a chi (confine del contratto)

| Dato | Proprietario |
|---|---|
| `countries.*` (lingue, entity_profile, formats) | **tema** (`config/civic.php`) |
| `civic.country` per tenant | **host** (config tenant o `config()->set`) |
| Nome/indirizzo/recapiti dell'ente | **tenant/CMS** (`config/local/<tenant>/`, JSON) |
| Testi UI | `lang/<locale>/*` del tema + moduli |
| Branding (colori, logo) | `civic.brand`/tenant tokens — gia' configurabili |
| Marchi e riferimenti normativi IT (AGID, SPID, CIE, PEC, IPA) | solo profilo `comune`/IT: **non** devono apparire per `local_council` |

## Test

- `tests/Unit/Support/CountryProfileTest.php`: risoluzione, fallback, isolamento
  tenant (MT non riceve formati IT), `entity_profile`.
- `tests/Unit/CivicLocalizationConfigTest.php`: config caricabile, `supported_locales`
  con `mt`, `fallback_locale=en`, profili IT/MT separati (gira con TestCase).
- `tests/Unit/I18n/LangParityTest.php` (sezione entity): stessa struttura e 13
  termini per ogni `entity.php`.

## Resta da fare (issue resta aperta — dipendenze CIV-M1)

- Consumatori: le view non usano ancora `CountryProfile`/`entityTermKey()`/
  `entity.profiles.*` — l'integrazione nelle Blade e' il lavoro di wiring (owner: view).
- `entity.singular/plural` in config e' una scorciatoia per contesti non-locale;
  il percorso canonico e' `entity.php` per lingua (ADR 0011).
- Decisione host: dove vive `civic.country` per tenant (config publish vs
  service provider del tenant).
