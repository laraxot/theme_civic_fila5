<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): tickets_list. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'page' => [
        'title' => [
            'title' => '[[MT-REV]] List of reports',
        ],
        'resolved' => [
            'message' => '[[MT-REV]] In the last :months months, :count reports have been resolved.',
        ],
        'cta' => [
            'label' => 'Ibgħat rapport',
        ],
    ],
    'breadcrumb' => [
        'home' => [
            'label' => 'Paġna ewlenija',
        ],
    ],
    'filters' => [
        'category' => [
            'title' => '[[MT-REV]] CATEGORY',
        ],
        'results' => [
            'label' => ':count riżultati',
        ],
    ],
    'view_toggle' => [
        'map' => [
            'label' => 'Mappa',
        ],
        'list' => [
            'label' => 'Lista',
        ],
    ],
    'map' => [
        'marker' => [
            'label' => '[[MT-REV]] Report in the area',
        ],
        'report_default' => [
            'label' => 'Rapport',
        ],
        'details' => [
            'label' => 'Dettalji',
        ],
    ],
    'categories' => [
        'water' => [
            'label' => '[[MT-REV]] Water, flooding, water supply issues',
        ],
        'environment' => [
            'label' => '[[MT-REV]] Environment, pollution, environmental protection',
        ],
        'street_furniture' => [
            'label' => '[[MT-REV]] Street furniture',
        ],
        'pest_control' => [
            'label' => '[[MT-REV]] Pest control, rodent control, stray animals',
        ],
        'urban_hygiene' => [
            'label' => '[[MT-REV]] Urban hygiene, waste, cleaning and public decorum',
        ],
        'buildings' => [
            'label' => '[[MT-REV]] Maintenance of properties, public buildings, schools, architectural barriers, cemeteries',
        ],
        'public_order' => [
            'label' => '[[MT-REV]] Public order, disturbance of the peace',
        ],
        'parks' => [
            'label' => '[[MT-REV]] Parks and public green spaces',
        ],
        'municipal_services' => [
            'label' => '[[MT-REV]] Municipal services',
        ],
        'safety' => [
            'label' => '[[MT-REV]] Safety, urban and social decay',
        ],
        'roads' => [
            'label' => '[[MT-REV]] Roads, sidewalks, signage and traffic',
        ],
    ],
];
