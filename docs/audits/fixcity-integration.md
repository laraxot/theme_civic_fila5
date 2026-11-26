---
title: Integrazione funzioni cittadino FixCity nel frontend Civic
issue: 34
verificato: 2026-11-26 — audit statico viste tema vs contratti/modulo FixCity
---

# Integrazione funzioni cittadino FixCity

Issue: [#34](https://github.com/laraxot/theme_civic_fila5/issues/34).
**Regola rispettata: nessuna Action di dominio nuova nel tema** — le viste chiamano
solo Action/Livewire del modulo owner. Il tema non deve duplicare logica.

## 1. Inventario: cosa esiste già nel tema

| Funzione | Action/contratto owner | Vista tema | Stato |
|---|---|---|---|
| Elenco ticket pubblici | `ListPublicTicketsAction`, `ApplyPublicTicketFiltersAction` | `blocks/ticket-list/design-comuni`, `filters`, `segnalazioni/layout` | ✅ integrato |
| Dettaglio pubblico | `BuildPublicTicketDetailAction` (`build-public-ticket-detail-action.md`) | `blocks/ticket-detail/design-comuni` | ✅ integrato |
| Foto pubbliche | `BuildTicketPublicImageUrlsAction`, `CanViewTicketMediaAction`, `SignTicketMediaUrlAction` | `ticket-detail`, `segnalazioni/layout` | ✅ integrato (visibilità per ruolo demandata all'Action) |
| Timeline | `BuildTicketTimelineAction` | `ticket-detail/timeline`, `components/pages/ticket-track` | ✅ |
| Next steps | `BuildTicketNextStepsAction` | `ticket-detail/design-comuni` | ✅ |
| Conferma creazione | `ResolveTicketConfirmationDataAction`, `BuildTicketConfirmationDataAction` | `ticket-confirmation`, `wizard/*` | ✅ |
| Follow/unfollow | `FollowTicketAction` (rotta `tickets.follow`) | `ticket-detail` form POST+CSRF | ✅ |
| Tracking con codice | `GetPublicTicketByCodeAction` + middleware `RedirectTicketTrackCodeMiddleware` | `components/pages/ticket-track` | ✅ |
| Ricerca FO | `SearchFrontOfficeAction` | `blocks/search-results/live` | ✅ |
| Area personale | `BuildPersonalArea*DataAction` | `personal-area-*` | ✅ |
| Notifiche IM | `PersonalAreaNotificationsWidget`, `MarkPersonalAreaNotificationsAsReadAction` | `personal-area-settings/*` | ✅ |
| Preferenze mail | `TicketNotificationPreferencesWidget`, `SetFixcityEmailNotificationPreferenceAction` | `personal-area-settings/settings` | ✅ |
| Commenti | gate `CanViewTicketMediaAction`/ticket commentabile | `ticket-detail` sezione commenti | ✅ |
| Rating generico | `feedback/rating` (news) — **non** il rating cittadino ticket | — | ⚠️ vedi sotto |

## 2. Gap: Action esistenti nel modulo senza UI frontoffice

Trovati in `Modules/Fixcity/app/Actions` (con contratto o codice) e **non chiamati
da nessuna vista** del tema:

| Action | Scopo | Gap #34 |
|---|---|---|
| `ConfirmTicketResolutionAction` (`execute(Ticket, UserContract, bool $accepted, ?string $reason)`) | cittadino conferma o contesta la risoluzione | **✅ integrato in questa passata**: `ticket-detail/design-comuni` mostra il form (radio `decision` + `reason`, CSRF) quando `is_owner && status==='resolved'`, verso `route('tickets.resolution')` (esiste in `laravel/routes/web.php`, auth+throttle); feedback `resolution_feedback` mostrato. `RejectTicketAction` resta lato operatore (Filament), non serve UI cittadino. |
| `SubmitCitizenTicketRatingAction` | valutazione 1-5 del servizio | esiste solo `Filament/Widgets/TicketCitizenRatingPromptWidget` (backoffice); **manca widget FO** — candidato a Livewire nel modulo + `@livewire` nel tema |
| `FindNearbyPublicTicketsAction` (`type,lat,lng,radius`) | suggerimento segnalazioni duplicate/ordinamento | nessun uso in wizard/dettaglio — valutare integrazione in `report-step` (suggerimento «esiste già una segnalazione simile?») |
| `BuildPublicNeighborhoodStatsAction` (`days=30`) | statistiche territoriali pubbliche | nessuna dashboard FO — candidato a blocco CMS `stats`/`dashboard` che chiama l'Action |
| `SetTicketSubscriptionAction` | iscrizione notifiche | parzialmente coperta da follow + preferenze; verificare |

## 3. Foto prima/dopo e feedback cittadino

- Foto: la pipeline esiste (`BuildTicketPublicImageUrlsAction`); «prima/dopo» come
  coppia tipizzata **non esiste** nel contratto (le immagini sono una galleria
  generica). Se il prodotto la vuole, è una decisione del modulo (tipo media), non del tema.
- Feedback cittadino: vedi rating sopra.

## 4. Ospite / cittadino / operatore

- Ospite: elenco, dettaglio pubblico, tracking con codice, wizard (privacy step anonimo?), mappa — coperto dalle pagine CMS esistenti.
- Cittadino loggato: follow, area personale, preferenze, commenti — coperto.
- Operatore: Filament (modulo), fuori scope tema FO.

## 5. Issue da aprire (gap reali)

- ~~conferma/contestazione risoluzione~~ → **fatto** in `ticket-detail/design-comuni` (questa passata).
- Rating cittadino FO (`SubmitCitizenTicketRatingAction` senza UI) → issue.
- Suggerimento duplicati (`FindNearbyPublicTicketsAction`) + dashboard quartiere (`BuildPublicNeighborhoodStatsAction`) → issue.
- Foto «prima/dopo» tipizzata: decisione prodotto del modulo (oggi galleria generica) → nota, non issue tema.
- Verifica endpoint/ruolo per `SetTicketSubscriptionAction` → nota.

Tutto il resto dei flussi (elenco, dettaglio, foto firmate, timeline, next steps,
conferma creazione, follow, tracking, ricerca, area personale, notifiche, commenti)
è già cablato alle Action del modulo — verificato staticamente.
