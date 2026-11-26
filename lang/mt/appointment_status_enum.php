<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): appointment_status_enum. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'values' => [
        'pending' => [
            'label' => '[[MT-REV]] Pending',
            'color' => 'warning',
            'icon' => 'heroicon-o-clock',
        ],
        'confirmed' => [
            'label' => 'Ikkonfermat',
            'color' => 'info',
            'icon' => 'heroicon-o-check-circle',
        ],
        'completed' => [
            'label' => '[[MT-REV]] Completed',
            'color' => 'success',
            'icon' => 'heroicon-o-check-badge',
        ],
        'cancelled' => [
            'label' => 'Ikkanċellat',
            'color' => 'danger',
            'icon' => 'heroicon-o-x-circle',
        ],
        'no_show' => [
            'label' => '[[MT-REV]] No show',
            'color' => 'gray',
            'icon' => 'heroicon-o-user-minus',
        ],
    ],
];
