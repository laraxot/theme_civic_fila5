<?php

declare(strict_types=1);

namespace Themes\Civic\Enums;

use Filament\Support\Contracts\HasLabel;
use Themes\Civic\Enums\Concerns\HasLangLabel;

/**
 * Stati di un evento.
 *
 * Sostituisce la costante MunicipalEvent::EVENT_STATUSES. Le label vivono in
 * lang/<locale>/municipal_event_status_enum.php (namespace `civic::`).
 */
enum MunicipalEventStatusEnum: string implements HasLabel
{
    use HasLangLabel;

    case SCHEDULED = 'scheduled';
    case CONFIRMED = 'confirmed';
    case CANCELLED = 'cancelled';
    case POSTPONED = 'postponed';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case DRAFT = 'draft';
}
