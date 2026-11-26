---
id: footer-sponsor-marketing
slug: footer-sponsor-marketing
type: epic-story
title: "Footer sponsor / sostenitore — studio marketing"
links:
  github_issue: #NULL
status: investigation
---
# Studio marketing footer: sponsor / sostenitore

## Scopo
Valutare se inserire nel footer (footer.json → blade vestito) una sezione "Sostieni il nostro progetto / Sponsor" con banner sponsor.

## Analisi
- Pro: visibilità sponsor, ricavo potenziale, impegno comunità.
- Contro: rischio pubblicità eccessiva su sito PA; accessibilità dei banner; mantenimento; WCAG (immagini con alt + contrasto); privacy (tracking sponsor).
- Alternative migliori (ideare con BMAD + second brain):
  1. Sezione "Partner istituzionali" (logo PA/regione) — neutrale, credibilità.
  2. Banner "Sostieni con una donazione" (link a piattaforma trasparente) — trasparenza pubblica.
  3. Link "Collabora con noi" nel contatti (già nel JSON footer) — zero banner.

## Decisione proposta (BMAD)
NON banner sponsor pubblicitari; invece aggiungere in footer.json `groups` / `columns` un blocco "Collaborazioni e partner" con link istituzionali + opzione donazione trasparente. Mantiene l'awareness senza slop.

## Provenienza
Studio marketing + BMAD + second brain + ponytail + ecc + filament blueprint (m00051).
