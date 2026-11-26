<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): bootstrap_italia. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'bottom_nav' => [
        'bottom_navigation' => [
            'label' => '[[MT-REV]] Bottom navigation',
        ],
    ],
    'progress_indicators' => [
        'loading' => [
            'message' => '[[MT-REV]] Loading...',
        ],
    ],
    'notifiche' => [
        'close_notification' => [
            'label' => '[[MT-REV]] Close notification',
        ],
    ],
    'skiplinks' => [
        'skip_to_content' => [
            'label' => '[[MT-REV]] Skip to content',
        ],
        'skip_to_the_navigation_menu' => [
            'label' => '[[MT-REV]] Skip to the navigation menu',
        ],
        'skip_links' => [
            'label' => '[[MT-REV]] Skip links',
        ],
        'screen_reader' => [
            'label' => '[[MT-REV]] screen reader',
        ],
    ],
    'upload' => [
        'drag_the_file_here_or' => [
            'label' => '[[MT-REV]] Drag the file here or',
        ],
        'browse' => [
            'label' => '[[MT-REV]] browse',
        ],
    ],
];
