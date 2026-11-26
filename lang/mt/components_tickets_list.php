<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): components_tickets_list. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'list' => [
        'region' => [
            'aria_label' => '[[MT-REV]] Reports list',
        ],
        'intro' => [
            'description' => '[[MT-REV]] View and filter all the Municipality reports.',
        ],
    ],
    'filters' => [
        'group' => [
            'aria_label' => '[[MT-REV]] Report filters',
        ],
        'all' => [
            'label' => 'Kollha',
        ],
        'open' => [
            'label' => '[[MT-REV]] Open',
        ],
        'closed' => [
            'label' => 'Magħluq',
        ],
    ],
    'items' => [
        'title' => [
            'title' => '[[MT-REV]] Report #:number',
        ],
        'status' => [
            'label' => '[[MT-REV]] Status:',
        ],
        'open' => [
            'label' => '[[MT-REV]] Open',
        ],
        'closed' => [
            'label' => 'Magħluq',
        ],
        'description' => [
            'description' => '[[MT-REV]] Full description of the report. Real data for the authenticated user.',
        ],
    ],
    'map' => [
        'show' => [
            'label' => '[[MT-REV]] Show map (DivIcon #007A52)',
        ],
        'placeholder' => [
            'message' => '[[MT-REV]] Leaflet / OpenStreetMap map — reports view',
        ],
    ],
];
