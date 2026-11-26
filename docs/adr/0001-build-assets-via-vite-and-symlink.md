---
title: "ADR — Civic compila gli asset con Vite, senza copie, e oggi non li pubblica"
type: decision
status: accepted
theme: Civic
created: 2026-11-23
updated: 2026-11-26
decision-makers: [team front office]
issues:
  - "https://github.com/laraxot/theme_sixteen_fila5/issues/104"
related:
  - ../contracts/build-surface.md
  - ../../../Sixteen/docs/adr/0004-theme-assets-via-public-symlink.md
---

# ADR: Civic compila con Vite e non ha script `copy`; la pubblicazione via symlink non e' decisa

Questo ADR era una copia del testo di Sixteen («Sixteen e' il tema front office attivo»). Qui riguarda Civic: la parte sulla
build vale, quella sul symlink no (vedi «Stato attuale»).

## Contesto

Civic nasce come snapshot di Sixteen e dal 2026-11-26 ha identita' propria (ADR 0004 e 0007). Misurato dalla radice `laravel/`
(le righe segnate «prima» descrivono lo stato a cui questo ADR rispondeva):

- `Themes/Civic/composer.json` ha nome `laraxot/theme_civic_fila5` e namespace `Themes\Civic\` (autoload `app/`);
  `theme.json` ha `"name": "Civic"` (prima: `laraxot/theme_sixteen_fila5`, `Themes\Sixteen\`, `Sixteen`). Ha un repository git
  proprio e una voce in `gitmodules.ini:67`.
- Non e' il tema pubblico: `config/local/fixcity/xra.php:10` imposta `'pub_theme' => 'Sixteen'`.
- `scripts.build` di `package.json` e' `npm run prepare:static-assets && vite build && npm run prune:assets`; `vite.config.js` ha
  `base: '/themes/Civic/'` e `outDir: './public'` (prima: base `/themes/Sixteen/`, file identici a quelli di Sixteen).
- `public_html/themes/` contiene un solo link, `Sixteen -> ../../laravel/Themes/Sixteen/public/`. Non esiste
  `public_html/themes/Civic`.

## Driver della decisione

- Avere un'unica pipeline di build per tema, riproducibile e verificabile: l'output e' `public/` e il manifest Vite.
- Non introdurre copie di asset nel docroot: `public_html` e' la document root e non si svuota ne' si riempie a mano.
- Non far passare per «build riuscita» un output vecchio gia' presente in `public/`.

## Alternative scartate

- **Copiare gli asset nel webroot dopo ogni build.** Una copia diverge dalla sorgente e va riallineata a mano; il progetto la
  vieta (`AGENTS.md`, «Asset dei temi per symlink»).
- **Mantenere una seconda pipeline Vite fuori dal tema.** Due configurazioni dello stesso bundle divergono.
- **Usare la presenza di asset gia' compilati come prova di una build corrente.** `public/` contiene gia' file compilati
  (`public/assets/app-*.css`, `app-*.js`): non dicono se la build di oggi passa.

## Decisione

La build supportata e' `npm run build` eseguita da `laravel/Themes/Civic`; il package non ha uno script `copy` e non si
documenta una copia manuale come requisito. La decisione non attribuisce al tema responsabilita' su dati, routing o dominio.

La pubblicazione degli asset di Civic tramite symlink **non e' decisa qui**: serve sapere se Civic sostituira' Sixteen o resta
uno snapshot (decisione umana, vedi «Stato attuale»).

## Conseguenze

- `public/` e il manifest sono l'output verificabile. `prune:assets` puo' rimuovere asset orfani; una build fallita lascia
  l'output non verificato.
- Civic e Sixteen hanno pipeline di build parallele ma package e namespace distinti: una modifica alla pipeline va fatta in
  entrambi, o divergono.
- Gli asset di Civic non raggiungono il browser: vedi «Stato attuale».

## Stato attuale

L'ADR originale presentava il symlink come parte del quadro («il webroot tratta `public_html/themes/Sixteen` come collegamento
alla `public/` del tema»). Per Civic non e' cosi':

- `public_html/themes/Sixteen` punta a `laravel/Themes/Sixteen/public/` (`readlink`), cioe' a Sixteen. Non c'e' un link per Civic.
- Una build di Civic produce asset con base `/themes/Civic/` (`vite.config.js`), coerente con `public_html/themes/Civic`, che
  `deploy.sh` (ciclo su `Themes/*/public`) e `php artisan xot:theme-link` (`ThemeLinkCommand.php:54`) creano da soli. Finche' il
  link non c'e' e `pub_theme` resta un altro tema, quegli URL non sono serviti (ADR 0005). Il `public/` gia' compilato ha ancora la
  vecchia base finche' la wave Build/CI non ricostruisce.
- `Modules/Xot/tests/Unit/ThemePublicSymlinkTest.php` include Civic nei dataset (`Themes/*/public`) ma il test sul link
  **salta** per Civic, perche' il link manca (`markTestSkipped`, riga 55): oggi non prova niente su Civic.

Esito: la build di Civic puo' essere eseguita, la sua pubblicazione non esiste.

## Conferma

Conferma automatica parziale: `Modules/Xot/tests/Unit/ThemePublicSymlinkTest.php`, test «nessun tema conserva lo script npm
copy» (righe 102-112), che include Civic e verifica l'assenza di `"copy"` in `package.json`. Il test sul symlink salta per
Civic (vedi sopra). Controlli ripetibili dalla radice `laravel/`:

```bash
jq '.scripts.build' Themes/Civic/package.json            # npm run prepare:static-assets && vite build && ...
grep -n "base:" Themes/Civic/vite.config.js               # base: '/themes/Civic/'
readlink ../public_html/themes/Sixteen                    # .../Themes/Sixteen/public/
test -e ../public_html/themes/Civic || echo "assente"     # assente
cd Themes/Civic && npm run build                          # da lanciare nel contesto del tema
```

Proposta: dopo la decisione umana su Civic, un test Pest (in `Modules/Xot/tests/Unit`) che fallisca, invece di saltare, se un
tema con `public/` e `theme.json` `"active": true` non ha il link in `public_html/themes`.
