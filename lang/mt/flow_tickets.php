<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): flow_tickets. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'elenco' => [
        'load_more_reports' => [
            'label' => '[[MT-REV]] Load more reports',
        ],
        'categories' => [
            'label' => '[[MT-REV]] Categories',
        ],
        'report_details' => [
            'message' => '[[MT-REV]] Report details...',
        ],
        'list' => [
            'label' => 'Lista',
        ],
        'list_of_reports' => [
            'label' => '[[MT-REV]] List of reports',
        ],
        'submit_a_report' => [
            'label' => 'Ibgħat rapport',
        ],
        'filter_by_category' => [
            'label' => 'Iffiltra skont il-kategorija',
        ],
        'map' => [
            'label' => 'Mappa',
        ],
        'map_of_reports' => [
            'label' => '[[MT-REV]] Map of reports',
        ],
        'remove_all_filters' => [
            'label' => '[[MT-REV]] Remove all filters',
        ],
        'if_you_want_to_add_a' => [
            'message' => '[[MT-REV]] If you want to add a report, you can do so after signing in with your SPID or CIE credentials.',
        ],
        'rate_the_service_from_1_to' => [
            'label' => '[[MT-REV]] Rate the service from 1 to 5 stars',
        ],
    ],
];
