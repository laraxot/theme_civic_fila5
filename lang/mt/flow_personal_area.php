<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): flow_personal_area. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'dashboard' => [
        'activities' => [
            'label' => '[[MT-REV]] Activities',
        ],
        'completed' => [
            'label' => '[[MT-REV]] Completed',
        ],
        'page_index' => [
            'label' => '[[MT-REV]] PAGE INDEX',
        ],
        'pending' => [
            'label' => '[[MT-REV]] Pending',
        ],
        'messages' => [
            'label' => '[[MT-REV]] Messages',
        ],
        'sort' => [
            'label' => '[[MT-REV]] Sort',
        ],
        'complete_the_request' => [
            'label' => '[[MT-REV]] Complete the request',
        ],
        'most_recent' => [
            'label' => '[[MT-REV]] Most recent',
        ],
        'oldest' => [
            'label' => '[[MT-REV]] Oldest',
        ],
        'case_colon' => [
            'label' => '[[MT-REV]] Case:',
        ],
        'cases' => [
            'label' => '[[MT-REV]] Cases',
        ],
        'service_sheet' => [
            'label' => '[[MT-REV]] Service sheet',
        ],
        'desk' => [
            'label' => '[[MT-REV]] Desk',
        ],
        'non_digital_service' => [
            'label' => '[[MT-REV]] Non-digital service',
        ],
        'latest_activities' => [
            'label' => '[[MT-REV]] Latest activities',
        ],
        'latest_messages' => [
            'label' => '[[MT-REV]] Latest messages',
        ],
        'see_more_activities' => [
            'label' => '[[MT-REV]] See more activities',
        ],
        'see_more_messages' => [
            'label' => '[[MT-REV]] See more messages',
        ],
        'folder_completed' => [
            'label' => '[[MT-REV]] folder Completed',
        ],
        'folder_pending' => [
            'label' => '[[MT-REV]] folder Pending',
        ],
        'request_status' => [
            'message' => '[[MT-REV]] The request has been :status...',
        ],
    ],
];
