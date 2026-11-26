<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): components_reports. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'rating' => [
        'region' => [
            'label' => '[[MT-REV]] Rating',
        ],
        'rate_range' => [
            'label' => '[[MT-REV]] Rate from 1 to :max stars',
        ],
        'stars' => [
            'label' => '{1} [[MT-REV]] :count star|[2,*] [[MT-REV]] :count stars',
        ],
        'stars_suffix' => [
            'label' => '[[MT-REV]] stars',
        ],
        'service_ease' => [
            'title' => '[[MT-REV]] How easy was it to use this service?',
        ],
    ],
    'filters' => [
        'close' => [
            'label' => '[[MT-REV]] Close filters',
        ],
        'filter' => [
            'label' => 'Iffiltra',
        ],
        'remove_all' => [
            'label' => '[[MT-REV]] Remove all filters',
        ],
    ],
    'view' => [
        'mode' => [
            'label' => '[[MT-REV]] Reports view',
        ],
    ],
    'map' => [
        'reports_map' => [
            'label' => '[[MT-REV]] Reports map',
        ],
        'open_report_on_map' => [
            'label' => '[[MT-REV]] Open report on the map',
        ],
        'open_report' => [
            'label' => '[[MT-REV]] Open report',
        ],
        'pin' => [
            'label' => '[[MT-REV]] Geolocation pin',
        ],
    ],
    'feedback' => [
        'rate_clarity' => [
            'label' => '[[MT-REV]] Rate the clarity of the page',
        ],
        'thanks_site' => [
            'text' => '[[MT-REV]] Thank you, your feedback will help us improve the Municipality\'s website.',
        ],
        'add_details' => [
            'label' => '[[MT-REV]] Add more details',
        ],
        'rate_1_5' => [
            'label' => '[[MT-REV]] Rate from 1 to 5',
        ],
        'negative' => [
            'documents' => [
                'label' => '[[MT-REV]] I did not understand which documents were needed',
            ],
        ],
    ],
    'cta' => [
        'make_report' => [
            'title' => '[[MT-REV]] Make a report',
            'text' => '[[MT-REV]] If you want to add a report, you can do so after signing in with your SPID or CIE credentials.',
        ],
        'report_issue' => [
            'button' => '[[MT-REV]] Report a service issue',
        ],
    ],
    'detail' => [
        'report_type' => [
            'label' => '[[MT-REV]] Report type',
        ],
        'show_all' => [
            'label' => 'Uri kollox',
        ],
        'report_image' => [
            'label' => '[[MT-REV]] Report image',
        ],
        'map_image_cap' => [
            'label' => '[[MT-REV]] Map image showing where the issue is located',
        ],
        'map_image' => [
            'label' => '[[MT-REV]] map image showing where the issue is located',
        ],
        'description' => [
            'placeholder' => '[[MT-REV]] Report description...',
        ],
    ],
    'contacts' => [
        'call_toll_free' => [
            'label' => '[[MT-REV]] Call the toll-free number 05 0505',
        ],
    ],
    'personal_area' => [
        'report' => [
            'title' => '[[MT-REV]] Report - Personal area',
        ],
        'your_reports' => [
            'title' => '[[MT-REV]] Your reports',
        ],
    ],
];
