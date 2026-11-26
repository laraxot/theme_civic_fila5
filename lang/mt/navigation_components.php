<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): navigation_components. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'forward_back' => [
        'last' => [
            'label' => '[[MT-REV]] End',
        ],
        'go_to' => [
            'label' => '[[MT-REV]] Go to: :label',
        ],
        'first' => [
            'label' => '[[MT-REV]] Start',
        ],
        'nav' => [
            'label' => '[[MT-REV]] Forward and back navigation',
        ],
    ],
    'mega_nav' => [
        'close' => [
            'label' => '[[MT-REV]] Close mega menu',
        ],
    ],
    'navbar' => [
        'search_submit' => [
            'label' => '[[MT-REV]] Run search',
        ],
        'search' => [
            'placeholder' => 'Fittex...',
        ],
        'open_menu' => [
            'label' => '[[MT-REV]] Open navigation menu',
        ],
    ],
    'navscroll' => [
        'title' => [
            'label' => '[[MT-REV]] Page navigation',
        ],
    ],
    'skiplinks' => [
        'external_link' => [
            'label' => '[[MT-REV]] (external link)',
        ],
    ],
    'thumbnav' => [
        'go_to' => [
            'label' => '[[MT-REV]] Go to :label',
        ],
    ],
    'toolbar' => [
        'region' => [
            'label' => '[[MT-REV]] Toolbar',
        ],
    ],
    'popover' => [
        'close' => [
            'label' => '[[MT-REV]] Close popover',
        ],
    ],
    'slide_over' => [
        'close' => [
            'label' => 'Agħlaq',
        ],
    ],
    'profile_dropdown' => [
        'logout' => [
            'label' => 'Oħroġ',
        ],
        'admin_area' => [
            'label' => '[[MT-REV]] Admin area',
        ],
    ],
    'contacts' => [
        'opening_hours' => [
            'label' => '[[MT-REV]] Opening hours:',
        ],
    ],
];
