<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): municipal_location_service_enum. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'values' => [
        'citizen_services' => [
            'label' => '[[MT-REV]] Citizen services',
        ],
        'document_collection' => [
            'label' => '[[MT-REV]] Document collection',
        ],
        'payments' => [
            'label' => '[[MT-REV]] Payments',
        ],
        'appointments' => [
            'label' => 'Appuntamenti',
        ],
        'information' => [
            'label' => 'Informazzjoni',
        ],
        'complaints' => [
            'label' => '[[MT-REV]] Complaints and reports',
        ],
        'wifi' => [
            'label' => '[[MT-REV]] Free Wi-Fi',
        ],
        'photocopies' => [
            'label' => '[[MT-REV]] Photocopies',
        ],
        'parking' => [
            'label' => 'Parkeġġ',
        ],
        'accessibility' => [
            'label' => 'Aċċessibbiltà',
        ],
        'translation' => [
            'label' => '[[MT-REV]] Translation services',
        ],
        'assistance' => [
            'label' => '[[MT-REV]] Assistance',
        ],
    ],
];
