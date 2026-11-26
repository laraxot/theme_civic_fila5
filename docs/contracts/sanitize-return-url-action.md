---
title: "Contratto — SanitizeReturnUrlAction (Civic)"
type: contract
action: "Themes\\Civic\\Actions\\Auth\\SanitizeReturnUrlAction"
theme: Civic
status: accepted
created: 2026-11-26
updated: 2026-11-26
related:
  - ../../../Sixteen/docs/contracts/sanitize-return-url-action.md
  - ../../app/Http/Controllers/SpidAuthController.php
  - ../../app/Http/Controllers/CieAuthController.php
---

# Contratto: SanitizeReturnUrlAction (copia di Civic)

`Themes/Civic/app/Actions/Auth/SanitizeReturnUrlAction.php` dichiara `Themes\Civic\Actions\Auth\SanitizeReturnUrlAction`, con lo stesso codice di quella di Sixteen
(cambia solo il namespace, ADR 0004). E' l'unica difesa contro l'open redirect nei flussi SPID/CIE: i controller
(derivati da quelli di Sixteen) la usano per non rimandare il cittadino autenticato su un dominio altrui.

## Input

- `execute(Request $request, mixed $candidate, string $fallback)`: `$candidate` arriva da query string o sessione
  (`return_url`), quindi puo' essere qualunque cosa.

## Output

- `$candidate` se valido (un percorso relativo `/…` diventa assoluto sull'host corrente); altrimenti `$fallback` intatto.

## Invarianti

| ID | Regola | Group Pest |
|:---|:---|:---|
| CIVIC-RETURN-INV-1 | Un URL con host, schema o porta diversi da quelli della richiesta (compresi `//host`) da' il fallback. Se viene violata, il cittadino autenticato finisce su un sito altrui. | `CIVIC-RETURN-INV-1` |
| CIVIC-RETURN-INV-2 | Non-stringa, stringa vuota, `\` o caratteri di controllo (0x00-0x1F, 0x7F) danno il fallback. | `CIVIC-RETURN-INV-2` (prova parziale) |
| CIVIC-RETURN-INV-3 | Un percorso `/…` (non `//`) diventa `<schema>://<host><percorso>` della richiesta. | `CIVIC-RETURN-INV-3` |

Prova: `tests/Unit/DigitalIdentityAuthenticationSecurityTest.php`, test «digital identity return urls stay on the current
host», con quattro casi (`/it/area-personale`, `//evil.example/path`, `https://evil.example/path`, un percorso con tabulazione).
Il test ha tre group perche' i casi li coprono: INV-1 con i due host estranei, INV-3 con il percorso relativo, INV-2 con la
sola tabulazione (non il caso non-stringa, vuoto o con `\`: prova parziale). Gira con l'app (`uses(TestCase::class)`); non
eseguito in questa passata. Sixteen ha un test piu' completo (`AuthAndAssetActionContractsTest`), Civic no.

## Effetti collaterali

Nessuno.

## Errori

- Non lancia: un URL non analizzabile (`Safe\Exceptions\UrlException`) da' il fallback (`SanitizeReturnUrlAction.php:32-36`).

## Non fa

- Non valida il `$fallback`: e' fidato per costruzione (rotta interna o `GetPostLoginUrlAction`).
- Non controlla che il percorso esista ne' che l'utente possa vederlo.
- Non ammette sottodomini o host «fratelli»: serve l'host identico.
