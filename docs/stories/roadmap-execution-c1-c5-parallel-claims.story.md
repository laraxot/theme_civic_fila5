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
| P2 | P1 | `app/Support/LocaleFormats.php` (#17), difetti **misurati** il 2026-11-26 con chiamate dirette: (1) `formatDate('2026-11-26', ['date' => 'd MMMM yyyy'])` restituisce `26 1111 2026` (con `dd MMM yyyy`: `26 11Nov 2026`): `phpDateFormat` traduce solo `yyyy yy MM dd HH mm` e `date()` non e' localizzata; riscriverla su `IntlDateFormatter` con locale `<lingua>_<PAESE>` (ADR 0012). (2) `isValidPhone`, `formatPhone`, `normalizePostcode`/`isMaltaPostcode` hanno rami `IT`/`MT` nel codice: `normalizePostcode('vlt1117', <profilo IT>)` restituisce `VLT 1117`. Spostare le regole in `config/civic.php` (`formats.phone_pattern`, `phone_groups`, `postcode_normalize`). (3) `formatPhone('+356 7921 2345', <profilo MT>)` restituisce `+356 79 212 345` mentre il commento promette `+356 7921 2345`: raggruppamento non verificato contro una fonte. Invarianti `CIVIC-I18N-INV-18..21` nel contratto `docs/contracts/i18n-country-formats.md`. | aperta |
| P2 | lead (Geo) | `Modules/Geo/app/Datas/Geocoding/AddressData.php:20` (`?int $postal_code`) e `Modules/Geo/app/Actions/Photon/GetAddressFromPhotonAction.php:61` (`SafeIntCastAction::cast($photonData->postcode ?: 0)`): il codice postale e' un intero, `(int) "VLT 1117"` = 0 e `(int) "00100"` = 100 (il database e' `string(20)`). Portarlo a `?string` e adeguare i test Geo. Il test `CountryFormatsTest` (INV-16, secondo test) e' ora saltato e si attiva da solo. Modulo fuori dal mio perimetro. | aperta |
| P2 | P1 / P4 | Chiavi `pub_theme::` citate dalle viste e assenti da ogni lingua: `home.hero.eyebrow` (`resources/views/components/blocks/home/hero.blade.php:21`, ripiego quando il JSON non da' l'eyebrow: oggi il JSON lo da', senza il JSON si legge la chiave grezza; il testo e' di tenant e cita «Comune», non lo invento); `accessibility.accessibility_tools`, `.high_contrast`, `.font_size`, `.accessibility_statement`, `.privacy_policy`, `.close_accessibility_bar` tutte in `resources/views/partials/accessibility-bar.blade.php`, che nessun file del tema, dei moduli o delle rotte include: partial morta, toglierla o collegarla. `a11y.actions` l'ho aggiunta io (5 lingue). | aperta |
| P2 | P1 | I 57/57/69/57 testi dei cataloghi (it/en/de/es) con «comune/municipality/Gemeinde/ayuntamiento» scritti a mano (ratchet `CIVIC-I18N-INV-12`) si sostituiscono con `pub_theme::entity.profiles.<profilo>.<termine>` solo insieme alle viste che li chiamano (`resources/**`): storia a parte, dopo `entity_profile` (riga sopra). | aperta |
| P2 | lead | `lang/*/ui.php`: chiavi che sono frasi italiane (`'Accedi ai servizi' => ...`) e un orario scritto nel catalogo di tutte le lingue (`'Orari: Lun-Ven 9:00-17:00 \| Sab 9:00-13:00'`): e' un dato di tenant (`config/local/<tenant>/ente.php`, chiave `hours`), non un testo del tema. Non l'ho tolto: non conosco i chiamanti. | aperta |
| P3 | P1 | Due rinomine tenute ferme perche' il codice le cita: `docs/prompts/homepage/00-coordination.md` (in `resources/views/components/layouts/app.blade.php`) e `docs/design-comuni/ticket-creation-wizard.md` (in `resources/views/components/blocks/tests/ticket-crea.blade.php`, `resources/views/components/blocks/ticket-create/design-comuni.blade.php`, `tests/Unit/TicketCreateBlockTest.php`, `tests/Unit/TestsBlocksContractTest.php`). Aggiornare i riferimenti ai nomi `00-coordination.md` e `ticket-creation-wizard.md`; poi P3 rinomina con `docs/scripts/docs-apply-map.py` (sezione `hold` di `docs/scripts/docs-migration-map.json`). | aperta |
| P3 | P1 / lead | `docs/contracts/README.md` e `docs/contracts/README.md` sono gemelli per maiuscola (collidono su un filesystem insensibile): tenere `README.md` o `index.md` e togliere `INDEX.md` (`docs/contracts/**` e' in scrittura solo a P1). | aperta |
| P3 | lead | Sola lettura per P3 in `docs/stories/**`: nomi non conformi `story-blog003-reusable-components.md` e `const-to-enum-sixteen-appointment-dev.md`; menzioni in chiaro ormai stantie: `const-to-enum-sixteen-appointment-dev.md:28` cita `docs/index.md` e `docs/README.md` (ora `docs/README.md`), `homepage-taste-skill-bmad.story.md:35` cita `docs/homepage-parity.md` (ora `docs/homepage-parity-scope.md`). | aperta |
| P3 | altra sessione (README, CONTRIBUTING) | `README.md:94` linka `./docs/README.md`, archiviato in `docs/archive/00-index-sixteen.md` (la rottura e' effetto dell'archiviazione di P3): puntare a `docs/README.md`, che e' l'ingresso unico di `docs/`. Radice `README.md` e `CONTRIBUTING.md` non toccati da P3. | aperta |
| P3 | P1 | Controlli sui docs come test Pest in `tests/Unit/Docs/` (`tests/` e' di P1): `python3 -I docs/scripts/docs-audit.py all` (link, nomi, avanzi, raggiungibilita') e `docs-index.py --check` (catalogo aggiornato). Oggi `names` ha 15 nomi aperti e `links` circa 1500 link storici: il test va a tetto (non cresce), non a zero. | aperta |
| P3 | lead | Altri scrittori in `docs/` (commit `27d5d30` #26 archivio e `8abe3f1` #27 accessibilita'/roadmap/integrazione; file non tracciati in `docs/design/`, `docs/audits/`, `docs/i18n/`) si sovrappongono a #26 e #27 assegnati a P3. P3 non li ha toccati e ha verificato a macchina che i 5 fratelli rimossi sono contenuti nei canonici (residuo 0). Dopo ogni nuovo `.md`: `python3 -I docs/scripts/docs-index.py` rigenera il catalogo. | aperta |
| P1 | lead / `Modules/Xot` | `Modules/Xot/app/Actions/Composer/RegisterRuntimePsr4NamespacesAction.php` mappa solo `Themes\TwentyOne`, `Themes\Sixteen`, `Themes\Sixteen\Tests`, `Themes\Two`: aggiungere `Themes\Civic\` -> `Themes/Civic/app` e `Themes\Civic\Tests\` -> `Themes/Civic/tests` (e il suo contratto in `Modules/Xot/docs/contracts/`). Senza, una classe di Civic non si carica a runtime; i test del tema usano `tests/Support/civic-autoload.php` finche' la voce manca (ADR 0005 punto 4.1, ADR 0007). | aperta |
| P1 | lead / `Modules/Xot` | `Modules/Xot/app/Providers/XotBaseThemeServiceProvider.php`: `register()` registra `{module_ns}\Providers\RouteServiceProvider` ed `EventServiceProvider`, che un tema non ha, e `module_ns` e' gia' il namespace del provider (`...\Providers\Providers\...`). Civic l'ha aggirato non chiamando `parent::register()`; altri temi che ereditano la base restano esposti a `Class not found` (ADR 0007). | aperta |
| P1 | lead (host) | Passaggio a Civic, in questo ordine (ADR 0005 punto 4, mai fatto da P1): `laravel/routes/web.php` (import `Themes\Sixteen\Actions\Assets\...` e rotta `/themes/Sixteen/{path}`), `laravel/app/Application.php`, `laravel/app/Http/Middleware/BlockShowcasePages.php` (aggiungere `civic/test-auth` ai `PREFIXES`), `laravel/package.json` (script `cd Themes/Sixteen`), `laravel/config/nativephp.php`, `laravel/resources/views/folio/layouts/default.blade.php` (`@vite(..., 'themes/Sixteen')`), `deploy.sh:159-160` (controlli `manifest.json` e sprite fissi su Sixteen; `DesignComuniIconSpriteIsDeployableTest` diventa rosso se `pub_theme` passa a `Civic` senza estenderli). | aperta |
| P1 | lead (moduli) | Moduli che citano Sixteen e non Civic: `Notify` (`DetermineSeasonalContentViewPathAction` -> `sixteen::emails.*`), `Geo` (`GeoServiceProvider`, percorso del manifest), `Blog` (factory e pagine con `Themes\Sixteen\Presentation\Metadata\PageDescription`), `Fixcity` (39 file fra viste, test e seeder), `Comment`, `Cms` e `UI` (test di integrita'). Rendere i riferimenti dipendenti da `pub_theme` o aggiungere Civic prima del passaggio (ADR 0005 punto 4.5). | aperta |
| P1 | lead | `.env` del tenant: copiare i valori `SIXTEEN_*` in `CIVIC_*` prima di attivare Civic (nessun ripiego in lettura, ADR 0007); se SPID/CIE e' gia' abilitato presso un IdP, l'URL dell'ACS passa da `sixteen/auth` a `civic/auth` e va ri-registrato. Decisione umana: quando e se passare `pub_theme` a `Civic`. | aperta |
| P1 | Build/CI | Fuori dal perimetro di P1 e ancora con la parola Sixteen: `index.html`, `build-advanced.sh`, `COMPILE-STATUS.md`, `assets/css/comune-custom.css`, `assets/js/comune-functions.js`, e la cartella compilata `public/` (`public/themes/sixteen/`, `fonts-manifest.json`, due bundle con base `/themes/Sixteen/`): si ricostruisce con `npm ci && npm run build`. #22 e #23 sono stati ceduti a questa wave. | aperta |
| P1 | P3 | `README.md`, `CHANGELOG.md` (24 righe), `README-HOMEPAGE-REPLICATION.md` (13 righe) e `CONTRIBUTING.md` citano ancora Sixteen come identita' corrente (non come provenienza); `docs/**` ha 1169 file con la parola, per la maggior parte storici da classificare (vedi `docs/migration/sixteen-references-audit.md`). | aperta |
| P1 | P2 | `config/civic.php` e' ora l'unico file di config del tema (fuso con l'ex `config/sixteen.php`, blocco profili paese di P2 inserito alla lettera dopo `return [`): modificarlo solo con Edit mirati, mai riscrivendo l'intero file. `lang/es/auth.php:6` e `lang/de/auth.php:8` citano ancora Sixteen nei commenti (`lang/**` e' di P2). | aperta |
| P1 | P3 | `docs/adr/0006-identita-civic-namespace-manifest-e-url-degli-asset.md` e `docs/adr/0004`/`0005` sono stati scritti da un altro scrittore in `docs/adr/` (perimetro esclusivo di P1): P1 li ha tenuti e ha numerato il suo `0007`; `docs/contracts/theme-identity.md` (riscritto da altri) aveva `type: contract` senza `action:` e senza le sei sezioni: `Modules/Xot/tests/Unit/Docs/ActionContractsAreCompleteTest.php` lo avrebbe dato rosso, P1 l'ha portato a `type: identity-contract` e vi ha aggiunto `CIVIC-ID-INV-5..7`. | informativa |

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
