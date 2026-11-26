# Contributing to Civic

Thank you for improving Civic, the Laraxot public-facing theme for Italy, Malta and other local authorities.

## Choose the right place

- **Bug or actionable task:** [Issues](https://github.com/laraxot/theme_civic_fila5/issues) (use the bug or feature forms).
- **Questions and design choices:** [Discussions](https://github.com/laraxot/theme_civic_fila5/discussions) (General, Ideas or Q&A).
- **Priorities and dependencies:** [Civic roadmap](https://github.com/laraxot/theme_civic_fila5/issues/37) and [milestones](https://github.com/laraxot/theme_civic_fila5/milestones).
- **Reviewed code contributions:** [Pull requests](https://github.com/laraxot/theme_civic_fila5/pulls). Every PR needs a real, authorized source branch and actual changes.

## Branch policy

Development currently happens on **dev**. Do not create a new branch unless the repository owner explicitly authorizes it. Do not fabricate a PR to fill the PR list.

## Architecture

1. Civic owns layout, visual components, assets, localization and rendering.
2. Laraxot modules own domain actions, models, authorization, persistence and notifications.
3. FixCity is one host product, not the name of the reusable theme.
4. Keep Italy and Malta differences in configuration/locales; avoid hardcoded Comune/Local Council labels in shared components.
5. Keep legacy Sixteen migration evidence intact and do not blindly replace historical references.

## Before requesting review

- Reference a linked issue and explain the problem, alternative approaches and impact.
- Describe changes to Composer, namespaces, Vite, CMS blocks and theme selection if relevant.
- Record commands actually run; never mark an unrun test as passed.
- For UI changes, attach **real** responsive screenshots (mobile, tablet, desktop) and accessibility checks.
- Check multilingual text (it/en; mt when present), keyboard navigation, contrast and tenant isolation.
- Never include credentials, user PII, private addresses or production databases in public issues, discussions or screenshots.
- Document deployment and rollback steps for compatibility-breaking changes.

## Useful commands

Inside a Laraxot host checkout with the required modules:

~~~bash
npm install
npm run build
npm test
npm run lint
~~~

Check the actual scripts in [package.json](package.json). The original imported repository did not contain a committed npm lockfile, so do not claim clean-install reproducibility before the lockfile and CI issues are resolved.

## Documentation

- [Italian README](README.md)
- [English overview](docs/readme-en.md)
- [Technical migration status](docs/README.md)
- [Roadmap](https://github.com/laraxot/theme_civic_fila5/issues/37)
