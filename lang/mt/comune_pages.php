<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): comune_pages. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'homepage' => [
        'access_the_municipality_s_online_services' => [
            'label' => '[[MT-REV]] Access the municipality\'s online services',
        ],
        'the_official_portal_for_the_municipality' => [
            'message' => '[[MT-REV]] The official portal for the municipality\'s services and information',
        ],
        'read_the_news' => [
            'label' => '[[MT-REV]] Read the News',
        ],
        'discover_the_latest_news_and_announcements' => [
            'label' => '[[MT-REV]] Discover the latest news and announcements',
        ],
        'report' => [
            'label' => 'Rapport',
        ],
        'report_problems_and_service_issues_in' => [
            'label' => '[[MT-REV]] Report problems and service issues in the municipal area',
        ],
        'latest_news' => [
            'label' => '[[MT-REV]] Latest News',
        ],
        'latest_reports' => [
            'label' => '[[MT-REV]] Latest Reports',
        ],
        'go_to_services' => [
            'label' => '[[MT-REV]] Go to Services',
        ],
        'welcome_to_municipality' => [
            'label' => '[[MT-REV]] Welcome to the Municipality of :name',
        ],
        'page_title' => [
            'title' => '[[MT-REV]] Homepage - Municipality of :name',
        ],
    ],
    'shared' => [
        'municipality_of_name' => [
            'label' => '[[MT-REV]] Municipality of :name',
        ],
    ],
];
