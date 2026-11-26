## Why this change?

Describe the problem, user impact and related issue (for example: Closes #123).

## Scope

- [ ] Presentation-only change; business rules remain in the owning Laraxot module
- [ ] No unrelated refactor or destructive change
- [ ] Backward compatibility with Sixteen and the FixCity host considered

## What changed?

Summarize implementation, trade-offs and any migration steps.

## Verification

Check only tasks actually performed; attach logs or evidence.

- [ ] Build: npm run build
- [ ] Unit/component tests: npm test
- [ ] Lint: npm run lint
- [ ] Relevant PHP/Pest tests
- [ ] Real browser smoke test on a Laraxot host
- [ ] Real mobile/tablet/desktop screenshots if UI changed

## Italy and Malta

- [ ] Translations reviewed (it/en; mt if applicable)
- [ ] Local Council / Comune terminology comes from configuration or translations
- [ ] Accessibility: keyboard, focus, contrast, labels and errors checked
- [ ] No personal data, credentials or tenant data leaked

## Deployment and rollback

Describe impacts on Composer, providers, Blade/CMS, Vite manifest, theme URLs and the way to roll back.

## Reviewer notes

Include linked issues, known gaps and non-obvious decisions. A PR must reflect real code changes on an authorized source branch; do not create a branch just to populate the PR list.
