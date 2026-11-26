<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): municipal_location_type_enum. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'values' => [
        'headquarters' => [
            'label' => '[[MT-REV]] Headquarters',
        ],
        'office' => [
            'label' => 'Uffiċċju',
        ],
        'service_center' => [
            'label' => '[[MT-REV]] Service center',
        ],
        'library' => [
            'label' => '[[MT-REV]] Library',
        ],
        'school' => [
            'label' => '[[MT-REV]] School',
        ],
        'sports_facility' => [
            'label' => '[[MT-REV]] Sports facility',
        ],
        'cultural_center' => [
            'label' => '[[MT-REV]] Cultural center',
        ],
        'healthcare' => [
            'label' => '[[MT-REV]] Healthcare facility',
        ],
        'social_center' => [
            'label' => '[[MT-REV]] Community center',
        ],
        'cemetery' => [
            'label' => '[[MT-REV]] Cemetery',
        ],
        'market' => [
            'label' => '[[MT-REV]] Market',
        ],
        'parking' => [
            'label' => 'Parkeġġ',
        ],
        'park' => [
            'label' => '[[MT-REV]] Park',
        ],
        'square' => [
            'label' => '[[MT-REV]] Square',
        ],
        'monument' => [
            'label' => '[[MT-REV]] Monument',
        ],
        'tourist_office' => [
            'label' => '[[MT-REV]] Tourist office',
        ],
        'waste_center' => [
            'label' => '[[MT-REV]] Waste collection center',
        ],
        'emergency' => [
            'label' => '[[MT-REV]] Emergency facility',
        ],
        'other' => [
            'label' => '[[MT-REV]] Other',
        ],
    ],
];
