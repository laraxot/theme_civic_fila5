<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): offline_page. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'offline' => [
        'status' => [
            'syncing' => [
                'message' => '[[MT-REV]] Synchronisation in progress...',
            ],
            'checking' => [
                'message' => '[[MT-REV]] Checking connection...',
            ],
        ],
        'actions' => [
            'continue' => [
                'label' => '[[MT-REV]] Continue Offline',
            ],
            'retry' => [
                'label' => '[[MT-REV]] Retry Connection',
            ],
        ],
        'features' => [
            'sync' => [
                'label' => '[[MT-REV]] Sync',
            ],
            'edit_ticket' => [
                'label' => '[[MT-REV]] Edit Ticket',
            ],
            'view_ticket' => [
                'label' => '[[MT-REV]] View Tickets',
            ],
            'create_ticket' => [
                'label' => '[[MT-REV]] Create Ticket',
            ],
            'title' => '[[MT-REV]] Features available offline:',
        ],
        'reassurance' => [
            'message' => '[[MT-REV]] Don\'t worry, you can still use some FixCity features.',
        ],
        'intro' => [
            'message' => '[[MT-REV]] It looks like you don\'t have an active internet connection.',
        ],
        'title' => [
            'label' => '[[MT-REV]] Offline Connection',
        ],
        'page_title' => [
            'label' => '[[MT-REV]] Offline - FixCity Platform',
        ],
    ],
];
