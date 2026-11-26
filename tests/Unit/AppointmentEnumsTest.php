<?php

declare(strict_types=1);

require_once dirname(__DIR__).'/Support/civic-autoload.php';

use Tests\TestCase;
use Themes\Civic\Enums\AppointmentServiceTypeEnum;
use Themes\Civic\Enums\AppointmentStatusEnum;
use Themes\Civic\Models\Appointment;

uses(TestCase::class);

beforeEach(function (): void {
    // ThemeServiceProvider registra `civic::` solo quando il tema e' attivo: qui lo registriamo a mano.
    app('translator')->addNamespace('civic', base_path('Themes/Civic/lang'));
});

test('appointment status enum keeps the AGID values and isOpen semantics', function (): void {
    expect(array_map(static fn (AppointmentStatusEnum $s): string => $s->value, AppointmentStatusEnum::cases()))
        ->toBe(['pending', 'confirmed', 'completed', 'cancelled', 'no_show']);

    expect(AppointmentStatusEnum::PENDING->isOpen())->toBeTrue()
        ->and(AppointmentStatusEnum::CONFIRMED->isOpen())->toBeTrue()
        ->and(AppointmentStatusEnum::COMPLETED->isOpen())->toBeFalse()
        ->and(AppointmentStatusEnum::CANCELLED->isOpen())->toBeFalse()
        ->and(AppointmentStatusEnum::NO_SHOW->isOpen())->toBeFalse();
});

test('appointment enums resolve every label/color/icon from the civic lang namespace', function (): void {
    foreach (['it', 'en'] as $locale) {
        app()->setLocale($locale);

        foreach (AppointmentStatusEnum::cases() as $status) {
            expect($status->getLabel())->not->toContain('civic::')
                ->and($status->getColor())->not->toContain('civic::')
                ->and($status->getIcon())->toStartWith('heroicon-');
        }

        foreach (AppointmentServiceTypeEnum::cases() as $type) {
            expect($type->getLabel())->not->toContain('civic::');
        }
    }
});

test('appointment model casts status to the enum and exposes translated option maps', function (): void {
    app()->setLocale('it');

    $appointment = new Appointment(['status' => 'confirmed']);

    expect($appointment->status)->toBe(AppointmentStatusEnum::CONFIRMED)
        ->and(Appointment::getStatuses())->toHaveKey('no_show', 'Non presentato')
        ->and(Appointment::getServiceTypes())->toHaveKey('suap', 'SUAP');
});
