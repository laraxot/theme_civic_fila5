---
title: "Esecuzione parallela della roadmap Civic (C1–C6): claim, perimetri e prove"
type: story
status: in-progress
module: theme-civic
tags: [bmad, roadmap, claims, multi-agent, civic]
date: 2026-11-26
issues: [1, 2, 3, 4, 5, 6, 7, 8, 9, 11, 17, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37]
related:
  - ../adr/0002-front-office-theme-owns-presentation.md
---

# Esecuzione parallela della roadmap Civic (C1–C6)

Roadmap e filtri: issue [#37](https://github.com/laraxot/theme_civic_fila5/issues/37). Questa story è il **registro dei claim**:
chi scrive cosa, con quali file in esclusiva e con quale prova. I claim sono dichiarazioni d'intento, non mutex
(workflow `bashscripts/ai/wiki/workflows/multi-agent-claim.md`): li fa rispettare il protocollo.

## Fase BMAD

Solutioning → Implementation. Ordine di esecuzione **random** fra pacchetti indipendenti; ordine **forzato** solo dove c'è una
dipendenza di file o di runtime (pacchetto P4 dopo P1).

## Fatti verificati il 2026-11-26 (con il comando che li riverifica)

| Fatto | Comando |
| --- | --- |
| `composer.json` dichiara ancora `laraxot/theme_sixteen_fila5` e `Themes\Sixteen\` | `grep -nE '"name"\|Themes' composer.json` |
| `theme.json` ha `"name": "Sixteen"`, `package.json` ha `"name": "sixteen"` | `grep '"name"' theme.json package.json` |
| 96 file PHP in `app/` e `tests/` usano `Themes\Sixteen` | `grep -rlE 'Themes\\Sixteen' app tests --include='*.php' \| wc -l` |
| `lang/` contiene solo `de en es it` (nessun `mt`) | `ls lang` |
| Il tenant attivo usa `pub_theme => 'Sixteen'`: migrare Civic **non** tocca la produzione | `grep pub_theme ../../config/local/fixcity/xra.php` |
| Il merge-plugin del composer radice include solo `Modules/*/composer.json`: i temi non sono caricati da Composer ma a runtime | `sed -n 70,75p ../../composer.json` |
| Civic differisce da Sixteen in 61 file (escluse docs/public) | `diff -rq ../Sixteen . -x node_modules -x vendor -x .git -x docs -x public \| wc -l` |
| `package-lock.json` è ignorato di proposito («managed at monorepo root») | `git check-ignore -v package-lock.json` |
| `composer validate --strict`, `php -l` su 475 file e JSON validi: tutti verdi su clone pulito | rieseguire i tre comandi su un clone |

## Registro dei claim

| Pacchetto | Issue | Scrittore | File in esclusiva | Stato |
| --- | --- | --- | --- | --- |
| **P0** governance GitHub | #25, #37, impostazioni repo | altra sessione + lead | `.github/**`, `SECURITY.md`, `README.md`, `CONTRIBUTING.md` | in corso: la CI di `0184cb9` fallisce, la sta correggendo l'altra sessione |
| **P1** migrazione Sixteen → Civic | #1 #2 #3 #4 (**#22 e #23 ceduti alla wave Build/CI dell'altra sessione**, vedi `11-open-issues-parallel-completion.story.md`) | agente A | `composer.json`, `theme.json`, `package.json` (solo `name`), solo il testo `base`/alias del file Vite referenziato (nessun file di build rinominato o rimosso), `app/**`, `tests/**` (tranne `tests/Unit/I18n/`), `routes/**`, `config/*.php`, `src/**`, `pages/**`, `resources/**`, `bootstrap/**` | assegnato |
| **P2** lingue Italia/Malta | #6 #7 #8 #9 #17 | agente B | `lang/**`, `tests/Unit/I18n/**` (solo file nuovi), `docs/adr/*i18n*`, `docs/contracts/*i18n*` | assegnato |
| **P3** documentazione | #26 #27 #29 #30 #36 | agente C | `docs/**` **esclusi** `docs/adr/**`, `docs/contracts/**`, `docs/stories/**` | assegnato |
| **P5** audit statico di sicurezza (solo lettura) | #32 (parte di analisi: i fix vanno in P4) | agente E | nessuno: non scrive file | in corso; rapporto con finding verificati, fonte del dato, correzione e test proposto |
| **P4** design, a11y, sicurezza UI, prestazioni, rilascio | #11 #20 #28 #31 #32 #33 #34 #35 (**#21 #24 → wave Build/CI**) | wave Design dell'altra sessione, dopo il via di A (stessa regola per il lead) | `resources/**`, `scripts/**` | **bloccato da P1**: senza Civic caricabile non c'è nulla da rendere, misurare o fotografare |

Regole di divisione: per **rischio**, non per metà di file. P1 introduce il cambiamento; P2 e P3 coprono ciò che il cambiamento
potrebbe rompere senza che nessuno se ne accorga (lingue, documenti). Nessun file è in due colonne.

## Protocollo per chi scrive

1. Nessun nuovo branch; si lavora su `dev`. Il guard blocca `reset --hard`, `checkout`, `switch`, `restore`, `push --force`.
2. Si tocca **solo** il proprio perimetro. Un file fuori perimetro che serve = lo si scrive in «Richieste ai pacchetti» qui sotto.
3. La sync committa il working tree ogni minuto con messaggio `.`: i commit propri si fanno con percorsi espliciti
   (`git commit -m "…(#N)" -- <percorsi>`), mai `git add -A`, mai le modifiche altrui.
4. Ogni commit cita la sua issue (`#N`). **Il push lo fa solo il lead** (un solo pusher evita le gare sul `dev` remoto).
5. Pest solo con `bashscripts/tools/pest-scratch-db.sh` (e `APP_CONFIG_CACHE=/nonexistent/config.php`): lanciato diretto scrive
   sul database di sviluppo. Mai `RefreshDatabase`, mai `.env`, mai `migrate:fresh`.
6. Nessuna attivazione: `pub_theme` del tenant resta `Sixteen`.
7. Niente «fatto» senza prova: per ogni criterio di accettazione, comando + esito. Dove non si può misurare: **non verificato**.
8. Una decisione umana (dipendenza nuova, scelta fra alternative, dato mancante) chiude il rapporto con `[ATTESA-UMANO]: <domanda>`.

## Richieste ai pacchetti (si aggiungono righe, non si cancellano)

| Da | A | Richiesta | Esito |
| --- | --- | --- | --- |
| P2 | P1 | `lang/mt/common.php` (stub `return require ../en/common.php`, comparso alle 15:27:55 insieme a `config/civic.php`) sta in `lang/**`, perimetro esclusivo di P2: viene sostituito da un catalogo `mt` esplicito (90 file, stesse chiavi di `en`). Servono chiavi `mt`? Chiedetele qui, non create file in `lang/**`. | aperta |
| P2 | P1 | `config/civic.php`, `countries.<CC>.entity.singular/plural` sono testi letterali in config: non traducibili e senza forme grammaticali («del Comune», «al Comune»). Proposta: `countries.<CC>.entity_profile` = `comune` \| `local_council` (id di un profilo di `lang/<locale>/entity.php`, gia' presente in it/en/de/es: `pub_theme::entity.profiles.<profilo>.<termine>`, 13 termini, profilo di ripiego `generic`). Aggiornare `CivicLocalizationConfigTest`. Dettagli: ADR 0011 e contratto `docs/contracts/i18n-entity-terminology.md`. | aperta |
| P2 | P1 | `config/civic.php`, `fallback_locale => 'en'` globale cambierebbe il ripiego attuale di it/de/es (host: `it`). Proposta: un ripiego per Paese, `IT` -> `it` (invariato), `MT` -> `en`, applicato dal middleware di locale con `app()->setFallbackLocale()`. Dettagli: ADR 0013. | aperta |
| P2 | P1 / lead | `mt` e' una bozza (nessuna revisione di un madrelingua): non va tra i `supportedLocales` del host (`config/laravellocalization.php`) finche' `php Themes/Civic/tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` non elenca 0 testi marcati. Il test `CIVIC-I18N-INV-9` diventa rosso se il host abilita `mt` con testi ancora marcati. `supported_locales` di `config/civic.php` dichiara cio' che il tema sa servire, non l'abilitazione. | aperta |

## Evidenze e chiusura

Le issue le chiude solo il lead, dopo la revisione ECC (`ecc:php-reviewer`, `ecc:code-reviewer`, `ecc:security-reviewer` dove
serve) e solo se **tutti** i criteri di accettazione hanno una prova. Gli altri restano aperti con un commento di avanzamento.

| Pacchetto | Revisione | Prove | Issue chiudibili |
| --- | --- | --- | --- |
| P1 | — | — | — |
| P2 | — | — | — |
| P3 | — | — | — |

## Second brain

A fine lavoro: lezioni e decisioni durevoli in `docs/adr/` del tema, fatti riverificabili e memoria di progetto aggiornati dal lead.
