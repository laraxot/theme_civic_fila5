---
title: "Contratti del tema Civic"
type: index
tags: [contracts, civic]
created: 2026-11-18
updated: 2026-11-26
---

# Contratti del tema Civic

Cosa promette la superficie pubblica di questo pacchetto. Civic e' uno snapshot divergente di Sixteen (stesso package,
stesso namespace `Themes\Sixteen\`, non e' `pub_theme`): le sue Action hanno lo stesso nome completo di quelle di Sixteen, e
`diff -rq app/Actions` dice che differiscono in 3 file su 16 (`ServeThemeAssetAction` solo nel docblock;
`CieAuthAction` e `SpidAuthAction` anche nel log). I contratti qui descrivono la copia di Civic; i contratti di Sixteen
([indice](../../../Sixteen/docs/contracts/README.md)) restano la fonte estesa.

## Contratto di comportamento di un'Action

Un file per Action, nome in kebab-case della classe (`create-ticket-action.md`), frontmatter `type: contract`, `action: <FQCN>`,
`theme`, `status`, `updated`, e queste sei sezioni nell'ordine: `## Input`, `## Output`, `## Invarianti`,
`## Effetti collaterali`, `## Errori`, `## Non fa`. Le invarianti sono una tabella `| ID | Regola | Group Pest |` con ID
`<SCOPE>-INV-<N>`; il Group e' l'ID usato in `->group('<ID>')` da un test che la dimostra, altrimenti
«— (non dimostrato)». Il docblock dell'Action contiene `@see docs/contracts/<file>.md` e `@contract docs/contracts/<file>.md`.
Chi cambia il comportamento aggiorna il contratto nello stesso commit.

Il modello per un contratto nuovo e' [contract-template.md](contract-template.md); lo standard condiviso e' in
[Modules/Xot/docs/contracts](../../../../Modules/Xot/docs/contracts/README.md). Questo README e' l'indice unico della
cartella: `INDEX.md` e `index.md` sono stati fusi qui il 2026-11-26.

## Contratti

- [CieAuthAction](cie-auth-action.md) — flusso OIDC CIE. Differenza da Sixteen: scrive gli attributi per intero nel log.
- [SpidAuthAction](spid-auth-action.md) — richieste SAML e validazione della risposta SPID. Differenza da Sixteen: stesso difetto sul log.
- [SanitizeReturnUrlAction](sanitize-return-url-action.md) — l'URL di ritorno resta sullo stesso host, o si usa il fallback.
- [ServeThemeAssetAction](serve-theme-asset-action.md) — serve file di `Themes/Civic/public`.

### Contratti che non sono di Action

- [Identità del tema](theme-identity.md) — namespace, manifest, URL e tag release sono Civic; eccezioni Sixteen solo quelle di ADR 0004.
- [Build asset Civic](build-surface.md) — `type: build-contract`: cosa produce `npm run build` e cosa no.
- [Civic Folio page shell](folio-page-shell.md) — `type: presentation-contract`: forma delle quattro shell Folio. Le sette invarianti
  `CIVIC-FOLIO-INV-N` hanno sei group Pest.

## Stato di copertura

Misurato il 2026-11-26 con `audit_docs.py` e con la lettura dei test.

| Voce | Esito |
|:---|:---|
| Action in `app/Actions` | 16 |
| Contratti di Action | 4 (`CieAuthAction`, `SpidAuthAction`, `SanitizeReturnUrlAction`, `ServeThemeAssetAction`) |
| Contratti di build e di presentazione | 2 |
| Invarianti | 24 (BUILD 4, CIE 3, SPID 5, RETURN 3, ASSET 2, FOLIO 7) |
| Con un group Pest | 11 su 24 |
| Senza test (non dimostrate) | 13: `CIVIC-BUILD-INV-1..4`, `CIVIC-CIE-INV-2`, `CIVIC-CIE-INV-3`, `CIVIC-SPID-INV-2..5`, `CIVIC-ASSET-INV-1`, `CIVIC-ASSET-INV-2`, `CIVIC-FOLIO-INV-7` |
| Prove parziali | `CIVIC-CIE-INV-1`, `CIVIC-RETURN-INV-2`, `CIVIC-FOLIO-INV-2`, `CIVIC-FOLIO-INV-4` |
| Action a rischio senza contratto | 0 |

Nessun test e' stato eseguito in questa passata.

## Backlog contract

- `ServeDesignComuniAssetAction`: delega a `ServeThemeAssetAction`; coperta dal contratto di quest'ultima.
- Le altre 11 Action (`Block/*`, `Url/*`, `Folio/ResolveContainer0IndexAction`, `Contacts/*`, `MenuBuilderAction`) leggono o
  calcolano e basta.
- Decisione umana prima di investire altro: Civic sostituisce Sixteen o resta snapshot. Se resta snapshot, i contratti di
  `SanitizeReturnUrlAction` e `ServeThemeAssetAction` sono duplicati di quelli di Sixteen e andrebbero ritirati.

## Backlog test

- `CIVIC-ASSET-INV-1`, `CIVIC-ASSET-INV-2`: Civic non ha test per `ServeThemeAssetAction`; si puo' portare quello di Sixteen
  (`AuthAndAssetActionContractsTest`).
- `CIVIC-SPID-INV-2..5`, `CIVIC-CIE-INV-2`, `CIVIC-CIE-INV-3`: richiedono una risposta SAML firmata di prova, un id_token di prova e
  una sessione (stesso backlog di Sixteen).
- `CIVIC-BUILD-INV-1..4`: nessun test; `ThemePublicSymlinkTest` di Xot copre il solo divieto dello script `copy`.
- Un test che fallisca se `Log::info` di Cie/Spid scrive `user_attributes` (Civic lo fa, Sixteen no).

## Nota sull'audit

`audit_docs.py` segnala `build-surface.md` e `folio-page-shell.md` con `type:contract, action:FQCN`: sono falsi positivi, due
contratti che non riguardano un'Action.

Difetto nei test, non corretto: Civic e Sixteen dichiarano entrambi `function folioBladePaths` a livello di file
(`tests/Unit/FolioPageMountContractTest.php:6` in ciascuno), e i due `DigitalIdentityAuthenticationSecurityTest.php` fanno
`require_once` di due file che dichiarano la stessa classe `Themes\Sixteen\Actions\...`. Caricarli nello stesso processo Pest
puo' dare «Cannot redeclare»; non verificato, e per questo i comandi dei contratti lanciano un tema alla volta.
