<?php

declare(strict_types=1);

/*
 * Catalogo `de`: appointment_status_enum. Struttura e chiavi come `en`; i testi sono tradotti, non ereditati.
 * @see docs/contracts/i18n-catalog-parity.md
 */
return [
    'values' => [
        'pending' => [
            'label' => 'Ausstehend',
            'color' => 'warning',
            'icon' => 'heroicon-o-clock',
        ],
        'confirmed' => [
            'label' => 'Bestätigt',
            'color' => 'info',
            'icon' => 'heroicon-o-check-circle',
        ],
        'completed' => [
            'label' => 'Abgeschlossen',
            'color' => 'success',
            'icon' => 'heroicon-o-check-badge',
        ],
        'cancelled' => [
            'label' => 'Storniert',
            'color' => 'danger',
            'icon' => 'heroicon-o-x-circle',
        ],
        'no_show' => [
            'label' => 'Nicht erschienen',
            'color' => 'gray',
            'icon' => 'heroicon-o-user-minus',
        ],
    ],
];
