<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): ui_components. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'cookiebar' => [
        'accept' => [
            'label' => 'Aċċetta l-cookies',
        ],
        'reject' => [
            'label' => '[[MT-REV]] Reject cookies',
        ],
    ],
    'footer' => [
        'country' => [
            'label' => '[[MT-REV]] Italy',
        ],
        'improving_together' => [
            'label' => '[[MT-REV]] Let\'s improve our city together.',
        ],
        'tagline' => [
            'label' => '[[MT-REV]] Platform for managing citizen reports.',
        ],
    ],
    'header' => [
        'search_field' => [
            'label' => '[[MT-REV]] Search field',
        ],
        'search_site' => [
            'placeholder' => 'Fittex fis-sit...',
        ],
        'close_search' => [
            'label' => '[[MT-REV]] Close search',
        ],
        'follow_us' => [
            'label' => '[[MT-REV]] Follow us on:',
        ],
        'site_title' => [
            'label' => '[[MT-REV]] Citizen Reports',
        ],
        'current_language' => [
            'label' => '[[MT-REV]] Current language:',
        ],
        'select_language' => [
            'label' => 'Agħżel il-lingwa',
        ],
        'language_access' => [
            'label' => '[[MT-REV]] Language and access',
        ],
        'skip_footer' => [
            'label' => '[[MT-REV]] Skip to footer',
        ],
        'skip_nav' => [
            'label' => '[[MT-REV]] Skip to navigation',
        ],
        'skip_main' => [
            'label' => '[[MT-REV]] Skip to main content',
        ],
    ],
    'hero' => [
        'scroll' => [
            'label' => '[[MT-REV]] Scroll to the main content',
        ],
        'video_unsupported' => [
            'message' => '[[MT-REV]] Your browser does not support the video tag.',
        ],
        'section' => [
            'label' => '[[MT-REV]] Main section',
        ],
    ],
    'notifiche' => [
        'close' => [
            'label' => '[[MT-REV]] Close notification',
        ],
    ],
    'select' => [
        'placeholder' => [
            'placeholder' => 'Agħżel',
        ],
    ],
    'services_grid' => [
        'pagination' => [
            'label' => '[[MT-REV]] Services pagination',
        ],
        'empty' => [
            'message' => '[[MT-REV]] No service found',
        ],
        'search' => [
            'placeholder' => '[[MT-REV]] Search services...',
        ],
    ],
];
