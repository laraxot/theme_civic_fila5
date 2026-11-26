<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): agid_components. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'header' => [
        'open_navigation_menu' => [
            'label' => '[[MT-REV]] Open navigation menu',
        ],
        'personal_area' => [
            'label' => '[[MT-REV]] Personal area',
        ],
        'search_field' => [
            'label' => '[[MT-REV]] Search field',
        ],
        'search_the_site' => [
            'message' => 'Fittex fis-sit...',
        ],
        'close_menu' => [
            'label' => '[[MT-REV]] Close menu',
        ],
        'close_search' => [
            'label' => '[[MT-REV]] Close search',
        ],
        'information' => [
            'label' => 'Informazzjoni',
        ],
        'current_language_colon' => [
            'label' => '[[MT-REV]] Current language:',
        ],
        'language_and_login' => [
            'label' => '[[MT-REV]] Language and login',
        ],
        'main_navigation' => [
            'label' => 'Navigazzjoni ewlenija',
        ],
        'new_report' => [
            'label' => '[[MT-REV]] New report',
        ],
        'citizen_reports' => [
            'label' => '[[MT-REV]] Citizen reports',
        ],
        'select_language' => [
            'label' => 'Agħżel il-lingwa',
        ],
        'go_to_main_content' => [
            'label' => '[[MT-REV]] Go to main content',
        ],
        'go_to_footer' => [
            'label' => '[[MT-REV]] Go to footer',
        ],
        'go_to_navigation' => [
            'label' => '[[MT-REV]] Go to navigation',
        ],
    ],
    'contrast_toggle' => [
        'turn_high_contrast_on_or_off' => [
            'title' => '[[MT-REV]] Turn high contrast on or off to improve readability',
        ],
        'normal_contrast_is_on' => [
            'label' => '[[MT-REV]] Normal contrast is on',
        ],
        'high_contrast' => [
            'label' => '[[MT-REV]] High contrast',
        ],
    ],
    'font_size' => [
        'increase_text_size' => [
            'label' => '[[MT-REV]] Increase text size',
        ],
        'increase_the_text_size' => [
            'title' => '[[MT-REV]] Increase the text size',
        ],
        'decrease_text_size' => [
            'label' => '[[MT-REV]] Decrease text size',
        ],
        'decrease_the_text_size' => [
            'title' => '[[MT-REV]] Decrease the text size',
        ],
        'status' => [
            'message' => '[[MT-REV]] Text size: :size',
        ],
        'text_size' => [
            'label' => '[[MT-REV]] Text size',
        ],
        'large' => [
            'label' => '[[MT-REV]] Large',
        ],
        'very_large' => [
            'label' => '[[MT-REV]] Very large',
        ],
        'normal' => [
            'label' => 'Normali',
        ],
        'small' => [
            'label' => '[[MT-REV]] Small',
        ],
    ],
    'banner' => [
        'dismiss' => [
            'label' => '[[MT-REV]] Dismiss',
        ],
    ],
    'application_logo' => [
        'citizen_megaphone_logo_fixcity_heroicons_outline' => [
            'label' => '[[MT-REV]] Citizen Megaphone logo — FixCity (Heroicons Outline v2)',
        ],
    ],
    'breadcrumb' => [
        'navigation_path' => [
            'label' => '[[MT-REV]] Navigation path',
        ],
    ],
    'footer' => [
        'back_to_the_top_of_the' => [
            'label' => '[[MT-REV]] Back to the top of the page',
        ],
        'back_to_top' => [
            'label' => '[[MT-REV]] Back to top',
        ],
    ],
];
