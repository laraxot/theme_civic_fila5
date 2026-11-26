---
title: "Civic design system — inherited Sixteen reference"
type: design-system-index
owner: Themes/Sixteen
status: draft
updated: 2026-11-26
tags: [docs, sixteen, civic, design-system]
qmd: "Civic design system migration inherited Sixteen visual contract"
---

# Ownership and usage

> [!IMPORTANT]
> **Migration in progress:** this design-system index was written for Sixteen.
> In the `theme_civic_fila5` repository it remains a reference for the imported
> UI, **not** a verified Civic implementation. See [Civic technical status](../README.md).
> Malta-specific language, terminology and design requirements are not yet
> covered by the Italian Design Comuni parity documentation below.

This directory is the visual source of truth for the Sixteen theme. It belongs
inside the theme because tokens, component states, typography, spacing and page
patterns are implementation decisions of Sixteen, not global FixCity domain
rules and not reusable infrastructure for other themes.

`MASTER.md` contains the shared visual contract. Page-specific exceptions belong
in `pages/` and must link back to the relevant BMAD story and accessibility
evidence. The planning and traceability artifacts live in the theme's `docs/bmad`,
`docs/investigation`, `docs/stories`, `docs/decision-log` and `docs/wiki` areas.

The repository-level `bmad-output/front-office-design-comuni` remains the
cross-cutting planning workspace; it must reference this file instead of
duplicating the theme's design source of truth.
