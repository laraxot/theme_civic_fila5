<?php

declare(strict_types=1);

/*
 * Catalogo `es`: appointment_status_enum. Struttura e chiavi come `en`; i testi sono tradotti, non ereditati.
 * @see docs/contracts/i18n-catalog-parity.md
 */
return [
    'values' => [
        'pending' => [
            'label' => 'Pendiente',
            'color' => 'warning',
            'icon' => 'heroicon-o-clock',
        ],
        'confirmed' => [
            'label' => 'Confirmada',
            'color' => 'info',
            'icon' => 'heroicon-o-check-circle',
        ],
        'completed' => [
            'label' => 'Completada',
            'color' => 'success',
            'icon' => 'heroicon-o-check-badge',
        ],
        'cancelled' => [
            'label' => 'Cancelada',
            'color' => 'danger',
            'icon' => 'heroicon-o-x-circle',
        ],
        'no_show' => [
            'label' => 'No se presentó',
            'color' => 'gray',
            'icon' => 'heroicon-o-user-minus',
        ],
    ],
];
