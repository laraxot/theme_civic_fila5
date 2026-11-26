---
title: "Esperienza Malta per Local Councils — analisi e checklist"
type: analysis
theme: Civic
created: 2026-11-26
updated: 2026-11-26
status: draft
tags: [docs, civic, i18n, malta, local-council]
---

# Malta / Local Councils — issue #9

Obiettivo: stesso tema, nessun fork. Questo documento separa i **riferimenti italiani
(D designers Italia)** dai **requisiti maltesi** e indica cosa deve diventare
configurazione invece di testo fisso.

## 1. Riferimenti italiani da non imporre a Malta

| Elemento | Perche' e' italiano | Dove vive oggi |
|---|---|---|
| "Comune", "Sindaco", "Giunta", "Consiglio Comunale" | organi del Comune italiano | `config/civic.php` menu (header/footer), `design-comuni/pages/homepage.blade.php:73-86` |
| "Anagrafe e stato civile", "URP", "Ufficio Tributi", "Tributi e pagamenti", "Pratiche edilizie", "Certificati anagrafici" | uffici/servizi PA italiana | `config/civic.php` menu; `lang/*/comune_pages.php`, `services.php` |
| SPID, CIE 3.0, PEC, Codice fiscale, Partita IVA, IPA, ADI | identita'/istituti italiani | `lang/*/auth*`, `components_pagopa_button`, `config/civic.php` `contact`, `config/spid.php`, `cie.php` |
| "Amministrazione Trasparente", "Dichiarazione di accessibilita'" (AgID), mappa sito | adempimenti italiani | `config/civic.php` `menu.slim_header`/`footer_bar`, `lang/*/legal.php` |
| Formato CAP `\d{5}`, provincia `(RM)`, `+39` | formato italiano | vedi `formats.md` — gia' profilato |
| Pagopa, pagoPA | sistema di pagamento italiano | `components_pagopa_button.php`, `lang/*/flow_payment.php` |
| "Vivere il comune", "Mobilita' in Comune", "Citta' Metropolitana" | copy PA italiana | `homepage.blade.php:202-313`, `config/civic.php` menu |

**Regola Malta:** niente di quanto sopra deve essere *obbligatorio*. Gli equivalenti
maltesi ("Local Council", "Mayor", "Council", "Public Services") arrivano da
`entity.php` profilo `local_council` + `lang/mt|en` + config tenant — non da copie
nel tema.

## 2. Cosa deve diventare configurazione (checklist)

- [ ] **Menu di default** (`config/civic.php` `menu.*`): i valori attuali sono il
  modello italiano. Devono essere *default del profilo* o sostituibili per tenant:
  il tenant maltese pubblica il proprio menu (già possibile via config), ma il
  tema non dovrebbe *consigliare* "Sindaco/Giunta" come unica forma.
- [ ] **Terminologia ente**: gia' risolta da `entity.php` + `entity_profile`
  (`country-profiles.md`); le viste devono usarla invece di `__('...Comune...')`.
- [ ] **Login**: SPID/CIE non si applicano; servono credenziali locali o un IdP
  maltese — `civic.auth.spid.enabled=false` esiste; va verificato che la UI non
  mostri comunque i pulsanti (v. `header-slim`, `auth` views).
- [ ] **Contatti**: `contact.*` ha default italiani (Via Roma, `+39`, `pec`, `cf_piva`,
  `ipa_code`): per MT devono restare vuoti o maltasi — `env()` li copre, ma le view
  non devono stampare etichette "Codice fiscale"/"P.IVA" se vuote.
- [ ] **Date/indirizzi/telefoni/CAP**: `LocaleFormats` + profilo (fatto, `formats.md`).
- [ ] **Legale**: privacy/cookie in maltese/inglese con riferimenti maltesi
  (GDPR UE si applica; nominativo del DPO del council); niente "AgID"/"linee guida
  AgID" — l'accessibilita' maltese fa riferimento a WCAG/EN 301 549.
- [ ] **Pagamenti**: Pagopa non esiste; `flow_payment` va reso opzionale/tenant.

## 3. Testi "Comune/Provincia" obbligatori nelle view (owner: view — NON editati)

| File | Riga | Testo | Resa Malta |
|---|---|---|---|
| `resources/views/components/footer-comune.blade.php` | ~101-102 | "Comune di Nome Comune", "Via Roma 123, 00100 Nome Comune (RM)" | placeholder + formato; serve `formatAddress` e nome ente da tenant |
| `resources/views/components/layout/sections/header-slim.blade.php` | 3 | `config('app.name','Comune di ')` | default italiano nel fallback |
| `resources/views/sections/footer-slim.blade.php` | 21 | `'Nome del Comune'` | idem |
| `resources/views/sections/footer-full.blade.php` | 72,90 | "Anagrafe e stato civile" | voce di menu hardcoded |
| `resources/views/design-comuni/pages/homepage.blade.php` | 9,73,86,202,312-313 | title "Il mio Comune", "Il Sindaco della citta'", "Il Consiglio…", "Vivere il Comune", "Mobilita' in Comune" | copy demo hardcoded — la homepage vera e' JSON CMS, questo file e' da verificare se servito |
| `config/civic.php` | menu.* | vedi tabella §1 | default del tema |

## 4. Smoke test Malta (dati sintetici, en + mt)

Prerequisiti: tenant con `civic.country=MT`, `entity_profile=local_council`,
locale `en` (poi `mt` dopo revisione).

- [ ] `/en` e `/mt`: header/footer mostrano "Local Council"/"Kunsill Lokali",
  MAI "Comune"/"Sindaco".
- [ ] Menu: nessuna voce "Anagrafe", "URP", "Tributi" se non configurate dal tenant.
- [ ] Wizard segnalazione `/tickets/create`: categoria, localita', CAP `VLT 1117`,
  telefono `+356 …` validati dal profilo.
- [ ] Dettaglio/lista segnalazioni: date `dd/MM/yyyy`, indirizzo `locality postcode`.
- [ ] Area personale: login senza SPID/CIE; "My reports"/"Rapporti".
- [ ] Footer: niente "PEC", "Codice fiscale", "Amministrazione Trasparente" se non
  pertinenti; mappa/contatti con formati MT.
- [ ] `entity.php` profilo `local_council` in `en` e `mt`: 13 termini presenti.

## 5. Designer Italia vs Malta — separazione

- **Designers Italia / AGID** riguardano il *tema* Sixteen→Civic per PA italiane:
  restano nel profilo `comune`/IT e nella documentazione Sixteen. Non sono un
  requisito per Malta.
- **Malta** richiede: Local Councils (68 authorities), `en`+`mt`, indirizzi
  `locality + POSTCODE` (formato `XXX NNNN`), `+356`, nessun SPID/CIE/PEC/AGID.
  Riferimenti normativi: GDPR UE (privacy), WCAG 2.1/EN 301 549 (accessibilita'),
 Freedom of Information (FOI) del council — **da validare con fonti ufficiali**;
  nessuna affermazione di conformita' e' scritta qui senza evidenza.
