<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): municipal_news_type_enum. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'values' => [
        'news' => [
            'label' => 'Aħbarijiet',
        ],
        'press_release' => [
            'label' => '[[MT-REV]] Press release',
        ],
        'public_notice' => [
            'label' => '[[MT-REV]] Public notice',
        ],
        'announcement' => [
            'label' => '[[MT-REV]] Announcement',
        ],
        'alert' => [
            'label' => '[[MT-REV]] Alert',
        ],
        'service_update' => [
            'label' => '[[MT-REV]] Service update',
        ],
        'regulation_update' => [
            'label' => '[[MT-REV]] Regulation update',
        ],
        'event_announcement' => [
            'label' => '[[MT-REV]] Event announcement',
        ],
        'tender_notice' => [
            'label' => '[[MT-REV]] Tender notice',
        ],
        'job_posting' => [
            'label' => '[[MT-REV]] Job posting',
        ],
        'council_update' => [
            'label' => '[[MT-REV]] Council update',
        ],
        'mayor_message' => [
            'label' => '[[MT-REV]] Message from the mayor',
        ],
        'citizen_info' => [
            'label' => '[[MT-REV]] Information for citizens',
        ],
        'emergency' => [
            'label' => 'Emerġenza',
        ],
        'other' => [
            'label' => '[[MT-REV]] Other',
        ],
    ],
];
