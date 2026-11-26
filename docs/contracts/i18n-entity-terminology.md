---
title: "Contratto — terminologia dell'ente per profilo Paese (`entity.php`)"
type: i18n-contract
theme: Civic
status: accepted
created: 2026-11-26
updated: 2026-11-26
issues:
  - "https://github.com/laraxot/theme_civic_fila5/issues/6"
related:
  - ../adr/0011-profili-paese-ente-e-terminologia.md
  - i18n-catalog-parity.md
---

# Terminologia dell'ente per profilo Paese

Contratto di **dati** (`type: i18n-contract`, nessun `action`). Promette il formato di `lang/<locale>/entity.php`, che cosa deve fare chi lo usa e
che cosa NON deve contenere. Il perche' e le alternative scartate: [ADR 0011](../adr/0011-profili-paese-ente-e-terminologia.md).

## Input

- `lang/<locale>/entity.php` per `it en de es mt`: `['profiles' => ['<id>' => ['<termine>' => '<testo>', ...], ...]]`.
- Profili: `generic` (ripiego neutro), `comune` (Italia), `local_council` (Malta). Chiave di profilo: minuscole e underscore.
- Termini, **tredici, chiusi, gli stessi in ogni profilo e lingua**, ciascuno una forma gia' composta:

  | Termine | Significato | Esempio `comune` / `it` |
  | :--- | :--- | :--- |
  | `name` | nome comune dell'ente, singolare | Comune |
  | `name_plural` | plurale | Comuni |
  | `of` | «di + ente» con articolo | del Comune |
  | `to` | «a + ente» con articolo | al Comune |
  | `your` | «il tuo ente» | il tuo Comune |
  | `offices` | uffici dell'ente | Uffici comunali |
  | `services` | servizi dell'ente | Servizi comunali |
  | `administration` | l'amministrazione | Amministrazione comunale |
  | `head` | il capo dell'ente | Sindaco |
  | `contact_cta` | invito a contattare l'ente | Contatta il Comune |
  | `reports_of` | le segnalazioni dell'ente (dopo un articolo o un numero) | segnalazioni del Comune |
  | `portal` | il portale digitale | Portale digitale del Comune |
  | `territory` | il territorio di competenza | territorio comunale |

- Il **profilo del tenant**: `countries.<CC>.entity_profile` in `config/civic.php` (**non ancora presente**, richiesta a P1 nella story) risolto sul Paese
  corrente di `Themes\Civic\Support\CountryProfile`.
- Il **nome dell'ente** («Comune di Fixcity», «Birkirkara Local Council») e' `config/local/<tenant>/ente.php`, chiave `name`: non fa parte del contratto.

## Output

- Chiamata di un termine: `__('pub_theme::entity.profiles.<id>.<termine>')` → la forma gia' composta nella lingua corrente.
- Profilo mancante o sconosciuto → `generic`, mai `comune`.
- Gli usi nei componenti **non esistono ancora**: oggi il tema usa i letterali di config e 57 (it) / 57 (en) / 69 (de) / 57 (es) testi scritti a mano. Il numero e'
  il debito misurato e non puo' salire (INV-12).

## Invarianti

| ID | Regola | Group Pest |
|:---|:---|:---|
| CIVIC-I18N-INV-10 | In ogni lingua i profili sono `generic`, `comune`, `local_council` e ognuno ha gli stessi tredici termini, nello stesso ordine di `it`. | `CIVIC-I18N-INV-10` |
| CIVIC-I18N-INV-11 | Nessun profilo contiene il lessico istituzionale di un altro Paese: `generic` niente comune/provincia/municipality/Gemeinde/Ayuntamiento/consiglio/council; `comune` niente Consiglio locale/Local Council/Kunsill; `local_council` niente comune/provincia/Gemeinde/Ayuntamiento. Il capo di un Local Council e' un Mayor: sindaco/Bürgermeister/alcalde sono ammessi li'. Controllato su `it en de es`. | `CIVIC-I18N-INV-11` |
| CIVIC-I18N-INV-12 | I testi dei cataloghi (fuori da `entity.*`) che citano comune/Comuni (it), municipality/council/city hall/town hall (en), Gemeinde/Stadtverwaltung/Kommune (de), ayuntamiento/municipi- (es) non superano il debito misurato il 2026-11-26: 57, 57, 69, 57. Il numero puo' solo scendere; chi lo abbassa aggiorna la baseline nel test. | `CIVIC-I18N-INV-12` |
| CIVIC-I18N-INV-17 | Un componente non scrive il nome di un Paese ne' di un'istituzione: chiama un termine del profilo. | — (non dimostrato: nessun componente usa ancora il profilo, serve P1) |

Verifica, da `laravel/`: `APP_CONFIG_CACHE=/nonexistent/config.php bash ../bashscripts/tools/pest-scratch-db.sh
Themes/Civic/tests/Unit/I18n/LangParityTest.php` (i gruppi 10, 11, 12 stanno nello stesso file).

## Effetti collaterali

Nessuno: sono testi in file PHP. Il test legge i file, non scrive.

## Errori

- Un termine mancante in un profilo o in una lingua: INV-10 fallisce con il profilo e la lingua. Una forma gia' composta mancante non si ricostruisce
  concatenando: si scrive nel catalogo di quella lingua.
- Un profilo sconosciuto richiesto da un componente: ricade su `generic`; il componente non lancia.
- `mt` con `[[MT-REV]]`: vale come nel contratto di parita'; i termini `local_council` in `mt` sono scritti ma non rivisti (ADR 0010).

## Non fa

- Non contiene il **nome proprio** dell'ente ne' dati di tenant (indirizzi, contatti, numeri).
- Non contiene riferimenti normativi, che sono dell'ente.
- Non traduce «Comune di X»: il nome non cambia con la lingua.
- Non dice che nei componenti la terminologia sia gia' non scritta a mano: il debito e' misurato, non pagato.
- Non risolve il nome tedesco/spagnolo dei Local Council maltesi: `de` ed `es` usano «Local Council», nome ufficiale inglese, in attesa di una scelta dell'ente.
