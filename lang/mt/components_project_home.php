<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): components_project_home. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'hero' => [
        'welcome' => [
            'title' => '[[MT-REV]] Welcome to',
        ],
        'subtitle' => [
            'description' => '[[MT-REV]] Technical management and advanced planning system',
        ],
    ],
    'quick_actions' => [
        'employees' => [
            'title' => '[[MT-REV]] Employee Management',
            'description' => '[[MT-REV]] Manage staff and attendance',
        ],
        'admin' => [
            'title' => '[[MT-REV]] Admin Dashboard',
            'description' => '[[MT-REV]] Administrative control panel',
        ],
        'charts' => [
            'title' => '[[MT-REV]] Charts and Reports',
            'description' => '[[MT-REV]] View statistics and analytics',
        ],
    ],
];
