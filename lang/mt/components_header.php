<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): components_header. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'personal_area' => [
        'ranking' => [
            'label' => '[[MT-REV]] Ranking',
        ],
        'permits' => [
            'label' => '[[MT-REV]] Permits',
        ],
        'benefits' => [
            'label' => '[[MT-REV]] Benefits',
        ],
        'payments' => [
            'label' => '[[MT-REV]] Payments',
        ],
    ],
    'language' => [
        'select' => [
            'label' => 'Agħżel il-lingwa',
        ],
        'select_it' => [
            'label' => '[[MT-REV]] Select Italian language',
        ],
        'select_en' => [
            'label' => '[[MT-REV]] Select English language',
        ],
        'switch_to' => [
            'label' => '[[MT-REV]] Switch to :language',
        ],
    ],
    'brand' => [
        'go_home' => [
            'title' => '[[MT-REV]] Go to the homepage',
        ],
        'go_home_new_tab' => [
            'label' => '[[MT-REV]] Go to the homepage - opens in a new tab',
        ],
        'logo_alt' => [
            'label' => '[[MT-REV]] Municipality logo',
        ],
        'municipality_of' => [
            'label' => '[[MT-REV]] Municipality of',
        ],
        'institutional_portal' => [
            'label' => '[[MT-REV]] Institutional portal',
        ],
        'municipality_name_caps' => [
            'label' => '[[MT-REV]] MUNICIPALITY NAME',
        ],
        'municipality_name_default' => [
            'label' => '[[MT-REV]] Municipality name',
        ],
    ],
    'nav' => [
        'summer_city' => [
            'label' => '[[MT-REV]] Summer in the City',
        ],
        'local_police' => [
            'label' => '[[MT-REV]] Local Police',
        ],
    ],
    'social' => [
        'external_link' => [
            'label' => '[[MT-REV]] :platform - external link - opens in a new tab',
        ],
    ],
    'region' => [
        'portal_external' => [
            'label' => '[[MT-REV]] Go to the :region portal - external link - opens in a new tab',
        ],
        'portal' => [
            'title' => '[[MT-REV]] Go to the :region portal',
        ],
    ],
];
