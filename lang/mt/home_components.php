<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): home_components. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'dc_homepage' => [
        'services' => [
            'connectivity_voucher' => [
                'label' => '[[MT-REV]] Connectivity voucher',
            ],
            'voter_card' => [
                'label' => '[[MT-REV]] Issuance of voter card',
            ],
            'appointments' => [
                'label' => '[[MT-REV]] Appointment booking',
            ],
            'online_taxes' => [
                'label' => '[[MT-REV]] Online taxes',
            ],
            'residence_change' => [
                'label' => '[[MT-REV]] Change of residence',
            ],
            'cie' => [
                'label' => '[[MT-REV]] Issuance of Electronic Identity Card (CIE)',
            ],
        ],
        'topics' => [
            'cycle_path' => [
                'label' => '[[MT-REV]] Cycle path',
            ],
            'education' => [
                'label' => 'Edukazzjoni',
            ],
            'taxes' => [
                'label' => 'Taxxi',
            ],
            'waste_management' => [
                'label' => 'Ġestjoni tal-iskart',
            ],
            'renewable_energy' => [
                'label' => '[[MT-REV]] Renewable energy',
            ],
            'competitions' => [
                'label' => '[[MT-REV]] Competitions',
            ],
            'associations' => [
                'label' => '[[MT-REV]] Associations',
            ],
        ],
        'explore_topic' => [
            'label' => '[[MT-REV]] Explore topic',
        ],
        'service' => [
            'label' => '[[MT-REV]] Service',
        ],
        'news' => [
            'concert_detail' => '[[MT-REV]] free concert in Piazza XX Settembre by the Sweet Soul Music Revue. 20 musicians from all over the world on stage',
            'highlight' => '[[MT-REV]] Opening on Monday 2 July',
            'concert_intro' => '[[MT-REV]] with the',
            'title' => '[[MT-REV]] Summer kicks off with over 300 events downtown and in the neighbourhoods, all the scheduled events',
        ],
    ],
    'home_page' => [
        'results' => [
            'label' => 'Riżultati',
        ],
        'categories' => [
            'roads' => [
                'label' => '[[MT-REV]] Roads, pavements, signage and traffic',
            ],
            'safety' => [
                'label' => '[[MT-REV]] Safety, urban and social decay',
            ],
            'municipal_services' => [
                'label' => '[[MT-REV]] Municipal services',
            ],
            'parks' => [
                'label' => '[[MT-REV]] Parks and public green spaces',
            ],
            'public_order' => [
                'label' => '[[MT-REV]] Public order, disturbance of the peace',
            ],
            'buildings' => [
                'label' => '[[MT-REV]] Maintenance of properties, public buildings, schools, architectural barriers, cemeteries',
            ],
            'hygiene' => [
                'label' => '[[MT-REV]] Urban hygiene, waste, cleaning and decorum',
            ],
            'stray_animals' => [
                'label' => '[[MT-REV]] Road damage, disruption, stray animals',
            ],
            'street_furniture' => [
                'label' => '[[MT-REV]] Street furniture',
            ],
            'environment' => [
                'label' => '[[MT-REV]] Environment, pollution, environmental protection',
            ],
            'water' => [
                'label' => '[[MT-REV]] Water, flooding, water supply problems',
            ],
        ],
        'category' => [
            'title' => '[[MT-REV]] CATEGORY',
        ],
        'results_found' => [
            'label' => '[[MT-REV]] Reports found:',
        ],
        'search' => [
            'placeholder' => '[[MT-REV]] Search reports...',
        ],
        'list' => [
            'title' => [
                'label' => '[[MT-REV]] Reports list',
            ],
        ],
        'tagline' => [
            'label' => '[[MT-REV]] Reports and services',
        ],
    ],
];
