---
type: contract-template
status: proposed
action: <FQCN>
---

<!-- Copiando questo file: `type: contract` e `action:` con il FQCN reale. Il tipo `contract-template` evita che
`Modules/Xot/tests/Unit/Docs/ActionContractsAreCompleteTest.php` cerchi un'Action chiamata `<FQCN>`. -->

# <operazione> — contratto comportamentale

Classe o superficie: `<FQCN>`  
Riferimento nel codice: `@contract docs/contracts/<file>.md`

## Input

- <input e validazione>

## Output

- <risultato osservabile>

## Invarianti

| ID | Regola | Verifica |
|---|---|---|
| `<MODULE>-INV-1` | <regola che deve restare vera> | <test o controllo ripetibile> |

Gli ID sono stabili: un test Pest li usa come `group` (`--group=<MODULE>-INV-1`).

## Effetti collaterali

- <scritture, eventi, chiamate esterne o nessuno>

## Errori

- `<eccezione/status>` — <condizione>

## Non fa

- <confine esplicito del contratto>

