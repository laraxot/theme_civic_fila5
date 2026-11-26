---
title: "Contratto — CieAuthAction (Civic)"
type: contract
action: "Themes\\Civic\\Actions\\CieAuthAction"
theme: Civic
status: accepted
created: 2026-11-26
updated: 2026-11-26
related:
  - ../../../Sixteen/docs/contracts/cie-auth-action.md
  - ../../app/Http/Controllers/CieAuthController.php
  - ../../config/cie.php
---

# Contratto: CieAuthAction (copia di Civic)

Client OpenID Connect verso l'IdP CIE. `Themes/Civic/app/Actions/CieAuthAction.php` dichiara la classe
`Themes\Civic\Actions\CieAuthAction`, derivata dall'omonima di Sixteen (FQCN diverso dal 2026-11-26, ADR 0004): il comportamento e'
lo stesso, **con una differenza** (il log dei dati personali, vedi «Limiti noti»). Il
[contratto di Sixteen](../../../Sixteen/docs/contracts/cie-auth-action.md) e' quello esteso; questo documenta la copia di Civic.
Le rotte (`routes/auth.php`, prefisso `civic/auth`) esistono solo se l'identita' digitale e' abilitata
(`civic.auth.spid.enabled`, ADR 0007).

## Input

- Config: `cie.base_url` (default preproduzione; la chiave non e' definita in `config/cie.php`), `cie.client_id`,
  `cie.client_secret`, `cie.redirect_uris.callback` (fallback `route('cie.callback')`), `cie.certificates.jwks_uri`,
  `cie.token.algorithms`.
- `getLoginUrl(?string $returnUrl)`, `getMobileLoginUrl(?string $returnUrl)`, `processCallback(Request $request)`
  (`code`, `state`, `error`), `logout()`, `refreshToken()`, `getLogoutUrl(?string $returnUrl)`.

## Output

- URL di autorizzazione `…/oidc/authorize` (`response_type=code`, `scope=openid profile email`) o `cieid://login?…`.
- `processCallback`: attributi mappati (`cie_id`, `name`, `surname`, `fiscal_code`, …) da userinfo + claim dell'id_token.
- `refreshToken`: i nuovi token o `null`.

## Invarianti

| ID | Regola | Group Pest |
|:---|:---|:---|
| CIVIC-CIE-INV-1 | Un id_token si accetta solo con `alg` tra `cie.token.algorithms` e firma verificata sul JWKS di `cie.certificates.jwks_uri`; senza JWKS configurato il login fallisce con `JWT signature verification unavailable`. Se viene violata, un JWT non firmato autentica un cittadino. | `CIVIC-CIE-INV-1` (prova parziale) |
| CIVIC-CIE-INV-2 | `state` della callback deve essere non vuoto e coincidere con `cie.state` in sessione, altrimenti `State parameter mismatch`, prima di qualunque chiamata all'IdP (`CieAuthAction.php:100`). | — (non dimostrato) |
| CIVIC-CIE-INV-3 | Il claim `nonce` deve coincidere con `cie.nonce`, `aud` con `client_id`, `iss` con `base_url`, e `exp` deve essere nel futuro; ciascuno, se manca o non coincide, da' un'`Exception` dedicata (`CieAuthAction.php:283-297`). | — (non dimostrato) |

Prova di INV-1: `tests/Unit/DigitalIdentityAuthenticationSecurityTest.php`, test «CIE rejects an unsigned JWT before reading
claims» (richiede il boot dell'app). Passa dal ramo «JWKS assente» o da quello «`alg` fuori lista» a seconda che
`CIE_JWKS_URI` sia impostata nell'ambiente di test; non c'e' un test per l'accettazione di un token valido. Non eseguito in
questa passata. Civic non ha l'equivalente del test di Sixteen sul sorgente del log (`AuthAndAssetActionContractsTest`).

## Effetti collaterali

In `processCallback`, nell'ordine:

1. Sessione: lettura di `cie.state` (INV-2).
2. HTTP `POST <base_url>/oidc/token` (scambio del `code`).
3. HTTP `GET <base_url>/oidc/userinfo` con il bearer token.
4. HTTP `GET <jwks_uri>` (solo se configurato) per verificare l'id_token, poi lettura di `cie.nonce`.
5. Log: `Log::info('CIE authentication successful')` con `user_attributes` **per intero** (valori compresi) e `auth_method`
   (`CieAuthAction.php:116-119`).

Gli altri metodi: `getLoginUrl` e `getMobileLoginUrl` scrivono `cie.state`, `cie.nonce`, `cie.return_url` (e `cie.auth_method`);
`logout()` fa `POST <base_url>/oidc/revoke` se c'e' `cie.refresh_token` e cancella `cie.authenticated`, `cie.user_data`,
`cie.access_token`, `cie.refresh_token`, `cie.state`, `cie.nonce`, `cie.auth_method` (non `cie.return_url`);
`refreshToken()` fa `POST <base_url>/oidc/token` e scrive `cie.access_token` e, se presente, `cie.refresh_token`.

## Errori

- `Exception` con messaggi `CIE authentication error: …`, `State parameter mismatch`, `Authorization code missing`,
  `Token exchange failed: <body>`, `UserInfo request failed: <body>`, `JWT signature verification unavailable | failed`,
  `Nonce|Audience|Issuer verification failed`, `Token expired`.
- `logout()` e `refreshToken()` non lanciano: loggano un `Log::warning` e proseguono.

## Non fa

- Non crea ne' autentica l'utente Laravel: lo fa `CieAuthController` (`Auth::login`, `UpsertUserFromDigitalIdentityAction`).
- Non sanifica `returnUrl`: lo fa il controller con `SanitizeReturnUrlAction`.
- Non mette in cache il JWKS e non consuma `cie.state` e `cie.nonce` dopo un login riuscito.
- Non salva i token del primo scambio in sessione: `refreshToken()` parte da `cie.refresh_token`, che il flusso di login non
  imposta, quindi al primo giro torna `null`.

## Limiti noti

- Limite noto (dati personali nei log, **differenza da Sixteen**): `CieAuthAction.php:117` scrive `'user_attributes' =>
  $userAttributes` in `Log::info`, cioe' codice fiscale, email e il resto degli attributi in chiaro. Sixteen scrive
  `attribute_names => array_keys(...)`. Non corretto in questa passata (solo documentazione).
- Limite noto: come in Sixteen, `CieAuthController.php:137` scrive `fiscal_code` in `Log::info`, `:149` scrive
  `$request->all()` in `Log::error`, e `:157` mostra al cittadino `$e->getMessage()` (anche il corpo della risposta dell'IdP).
- Limite noto: `cie.base_url` non esiste in `config/cie.php` (che ha `urls.preprod|prod.base_url` + `environment`):
  `CieAuthAction.php:37` usa sempre il default di preproduzione, anche con `CIE_ENVIRONMENT=prod`; il controllo di `iss`
  (INV-3) confronta con quel valore.
- Limite noto: `CIE_CLIENT_ID` o `CIE_CLIENT_SECRET` assenti portano a un `TypeError` nel costruttore (`null` assegnato a una
  proprieta' `string`, `CieAuthAction.php:38-39`).
- Limite noto: userinfo (passo 3) e' chiamato prima di verificare l'id_token (passo 4); `aud` si confronta con `!==`
  (`CieAuthAction.php:287`) e un `aud` array verrebbe rifiutato.
