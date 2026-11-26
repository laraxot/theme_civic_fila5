---
title: "Contratto — SpidAuthAction (Civic)"
type: contract
action: "Themes\\Sixteen\\Actions\\SpidAuthAction"
theme: Civic
status: accepted
created: 2026-11-26
updated: 2026-11-26
related:
  - ../../../Sixteen/docs/contracts/spid-auth-action.md
  - ../../app/Http/Controllers/SpidAuthController.php
---

# Contratto: SpidAuthAction (copia di Civic)

Service Provider SAML per SPID. `Themes/Civic/app/Actions/SpidAuthAction.php` dichiara la stessa classe
`Themes\Sixteen\Actions\SpidAuthAction` di Sixteen: stesso comportamento, **con una differenza** (il log dei dati
personali, vedi «Limiti noti»). Il [contratto di Sixteen](../../../Sixteen/docs/contracts/spid-auth-action.md) e' quello
esteso. Le rotte esistono solo con l'identita' digitale abilitata. **Con SPID acceso valgono i «Limiti noti»: la firma e'
controllata, il contenuto dell'asserzione no.**

## Input

- Costruttore: `spid.entity_id` (fallback `app.url`), rotte `spid.callback` e `spid.slo` (devono esistere: con le rotte spente
  il costruttore fallisce), `spid.providers`.
- `getLoginUrl(string $provider, int $level = 2, ?string $returnUrl = null)`, `getLogoutUrl(string $provider, string $nameId,
  string $sessionIndex)`, `processCallback(Request $request)` (`SAMLResponse` base64 e `RelayState` nel POST).

## Output

- `getLoginUrl` / `getLogoutUrl`: URL dell'IdP con `SAMLRequest` (deflate + base64) e `RelayState` = id della richiesta.
- `processCallback`: array normalizzato (`spid_code`, `name`, `surname`, `fiscal_code`, `email`, `mobile`, `birth_date`,
  `birth_place`, `gender`, `address`, `digital_address`, `company_name`, `vat_number`, `provider`, `auth_level`).
- `getMetadata()`: XML del Service Provider.

## Invarianti

| ID | Regola | Group Pest |
|:---|:---|:---|
| CIVIC-SPID-INV-1 | Una risposta senza `ds:Signature` viene rifiutata (`Exception('SPID authentication failed')`), anche con `StatusCode` Success. Se viene violata, chiunque puo' presentare un codice fiscale arbitrario (incidente SEC-02). | `CIVIC-SPID-INV-1` |
| CIVIC-SPID-INV-2 | Una risposta con `StatusCode` diverso da `urn:oasis:names:tc:SAML:2.0:status:Success` viene rifiutata, prima di ogni controllo di firma (`SpidAuthAction.php:337-344`). | — (non dimostrato) |
| CIVIC-SPID-INV-3 | L'impronta del certificato nella firma deve coincidere con quella del certificato fidato `storage/certificates/spid/<spid.providers.<p>.cert_file>`; senza `cert_file`, file mancante o vuoto la risposta e' rifiutata. | — (non dimostrato) |
| CIVIC-SPID-INV-4 | `RelayState` deve essere non vuoto e coincidere con `spid.request_id` in sessione, altrimenti `Exception('RelayState non valido')` (`SpidAuthAction.php:113`). Non e' anti-replay: vedi «Limiti noti». | — (non dimostrato) |
| CIVIC-SPID-INV-5 | Sono accettati solo gli algoritmi di firma RSA-SHA256 e RSA-SHA1; la firma sul `SignedInfo` canonicalizzato (C14N) deve verificarsi con la chiave del certificato fidato (`SpidAuthAction.php:379-393`). | — (non dimostrato) |

INV-1 e' provata senza app (`tests/Unit/DigitalIdentityAuthenticationSecurityTest.php`, test «SPID rejects a response without
an XML signature»); non eseguita in questa passata. Civic non ha un test per lo `StatusCode` (a differenza di Sixteen).
INV-2…INV-5 non hanno un test: servirebbe una risposta SAML firmata di prova e una sessione.

## Effetti collaterali

- Sessione: `getLoginUrl` scrive `spid.request_id`, `spid.provider`, `spid.return_url`, `spid.auth_level`; `getLogoutUrl`
  scrive `spid.logout_request_id`; `logout()` cancella `spid.authenticated`, `spid.user_data`, `spid.provider`,
  `spid.request_id`, `spid.auth_level` (non `spid.return_url` ne' `spid.logout_request_id`).
- Lettura file: in `processCallback`, il certificato fidato da `storage_path('certificates/spid/...')`.
- Log: `Log::info('SPID authentication successful')` con il provider e gli attributi **per intero**
  (`SpidAuthAction.php:130-133`).
- Nessuna chiamata HTTP: il browser va all'IdP tramite redirect.

## Errori

- `InvalidArgumentException` per provider non configurato.
- `Exception('SAMLResponse mancante' | 'RelayState non valido' | 'SAMLResponse non decodificabile')`.
- `Exception('SPID authentication failed')` per ogni violazione di stato, firma, certificato o algoritmo: messaggio unico voluto.

## Non fa

- Non autentica l'utente in Laravel: lo fa `SpidAuthController` (`Auth::login`, `UpsertUserFromDigitalIdentityAction`).
- Non valida l'URL di ritorno: lo fa `SanitizeReturnUrlAction` nel controller.
- Non firma le `AuthnRequest` (i metadata dichiarano `AuthnRequestsSigned="true"`, `SpidAuthAction.php:144`).
- Non controlla `NotOnOrAfter`, `Audience`, `InResponseTo`, `Destination` ne' `Issuer` dell'asserzione.

## Limiti noti

- Limite noto (dati personali nei log, **differenza da Sixteen**): `SpidAuthAction.php:132` scrive `'user_attributes' =>
  $attributes` in `Log::info`, cioe' codice fiscale, email e telefono in chiaro. Sixteen scrive solo i nomi degli attributi.
  Non corretto in questa passata (solo documentazione).
- Limite noto (sicurezza, da leggere prima di abilitare SPID): `validateSamlResponse` (`SpidAuthAction.php:331-397`) verifica
  la firma sul `SignedInfo` (`openssl_verify`, riga 379) ma non legge ne' ricalcola `ds:Reference` / `ds:DigestValue`, e
  `extractUserAttributes` legge `//saml:Attribute` ovunque nel documento (riga 399): la firma non e' legata agli attributi
  letti. Da lettura del codice; non provato con una risposta forgiata.
- Limite noto: `spid.request_id` non viene consumato dopo un login riuscito, e `RelayState` arriva nello stesso POST
  controllato da chi invia la risposta; `InResponseTo` non si confronta.
- Limite noto: come in Sixteen, `SpidAuthController.php:101` scrive `fiscal_code` in `Log::info`, `:113` scrive `$request->all()`
  (compresa la `SAMLResponse`) in `Log::error`, e `:121` mostra al cittadino `$e->getMessage()`.
- Limite noto: RSA-SHA1 resta accettato (INV-5) e l'impronta del certificato e' SHA-1; il ritorno di `DOMDocument::loadXML`
  non e' controllato (`SpidAuthAction.php:124`).
