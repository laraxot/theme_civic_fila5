<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): common. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'navigation' => [
        'home' => [
            'label' => 'Paġna ewlenija',
        ],
        'back_home' => [
            'label' => 'Lura lejn il-paġna ewlenija',
        ],
        'contacts' => [
            'label' => 'Kuntatt',
        ],
        'information' => [
            'label' => 'Informazzjoni',
        ],
        'new_report' => [
            'label' => '[[MT-REV]] New report',
        ],
        'reports' => [
            'label' => 'Rapporti',
        ],
    ],
    'aria' => [
        'breadcrumb_nav' => [
            'label' => '[[MT-REV]] Breadcrumb navigation',
        ],
        'breadcrumb' => [
            'label' => '[[MT-REV]] Breadcrumb',
        ],
    ],
    'links' => [
        'opens_new_window' => [
            'label' => '[[MT-REV]] (opens in a new window)',
        ],
    ],
    'actions' => [
        'cancel' => [
            'label' => 'Ikkanċella',
        ],
        'back' => [
            'label' => 'Lura',
        ],
        'next' => [
            'label' => 'Li jmiss',
        ],
        'close_menu' => [
            'label' => '[[MT-REV]] Close menu',
        ],
        'save' => [
            'label' => '[[MT-REV]] Save',
        ],
    ],
    'pagination' => [
        'of' => [
            'label' => '[[MT-REV]] of',
        ],
        'next' => [
            'label' => 'Li jmiss',
        ],
        'page' => [
            'label' => 'Paġna',
        ],
        'previous' => [
            'label' => 'Ta’ qabel',
        ],
        'next_page' => [
            'label' => 'Il-paġna li jmiss',
        ],
        'previous_page' => [
            'label' => 'Il-paġna ta’ qabel',
        ],
        'go_to_page' => [
            'label' => '[[MT-REV]] Go to page :page',
        ],
        'nav' => [
            'label' => '[[MT-REV]] Page navigation',
        ],
    ],
    'search' => [
        'empty_hint' => [
            'message' => '[[MT-REV]] Try changing the search filters',
        ],
    ],
    'filters' => [
        'all' => [
            'label' => 'Kollha',
        ],
    ],
    'states' => [
        'loading' => [
            'message' => '[[MT-REV]] Loading...',
        ],
    ],
    'forms' => [
        'optional' => [
            'label' => '[[MT-REV]] (optional)',
        ],
    ],
];
