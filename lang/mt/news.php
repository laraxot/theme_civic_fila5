<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): news. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'meta' => [
        'title' => '[[MT-REV]] News and press releases',
        'description' => '[[MT-REV]] Municipal news, press releases and notices.',
        'breadcrumb' => 'Aħbarijiet',
    ],
    'hero' => [
        'title' => '[[MT-REV]] News and press releases',
        'subtitle' => '[[MT-REV]] Official updates and useful information from the city.',
    ],
    'filters' => [
        'aria' => '[[MT-REV]] News filters',
        'all' => '[[MT-REV]] All news',
        'press' => 'Stqarrijiet għall-istampa',
        'notices' => 'Avviżi',
    ],
    'latest' => [
        'title' => '[[MT-REV]] Latest news',
        'subtitle' => '[[MT-REV]] Keep up with municipal updates.',
    ],
    'search' => [
        'label' => '[[MT-REV]] Search news',
        'placeholder' => '[[MT-REV]] Search news',
    ],
    'read_more' => 'Aqra aktar',
    'index' => [
        'default_category' => 'Aħbarijiet',
        'default_event_category' => 'Avvenimenti',
        'search_label' => 'Fittex',
        'search_placeholder' => '[[MT-REV]] Search by keyword',
        'search_submit' => 'Ibgħat',
        'result_one' => '[[MT-REV]] 1 news item found',
        'result_many' => '[[MT-REV]] :count news items found',
        'feedback' => [
            'title' => '[[MT-REV]] How clear is the information on this page?',
            'legend' => '[[MT-REV]] Rate this page from 1 to 5 stars',
            'star_label' => '[[MT-REV]] Rate %d out of 5 stars',
            'thanks' => '[[MT-REV]] Thank you. Your feedback will help us improve this service.',
            'positive' => [
                'question' => '[[MT-REV]] What did you like most?',
                'answers' => [
                    'clear' => '[[MT-REV]] The instructions were clear',
                    'complete' => '[[MT-REV]] The instructions were complete',
                    'progress' => '[[MT-REV]] I always knew I was following the right steps',
                    'technical' => '[[MT-REV]] I did not have any technical issues',
                    'other' => '[[MT-REV]] Other',
                ],
            ],
            'negative' => [
                'question' => '[[MT-REV]] Where did you have the most difficulty?',
                'answers' => [
                    'clear' => '[[MT-REV]] The instructions were sometimes unclear',
                    'complete' => '[[MT-REV]] The instructions were sometimes incomplete',
                    'progress' => '[[MT-REV]] I was sometimes unsure whether I was following the right steps',
                    'technical' => '[[MT-REV]] I had technical issues',
                    'other' => '[[MT-REV]] Other',
                ],
            ],
            'detail' => [
                'question' => '[[MT-REV]] Would you like to add more details?',
                'label' => 'Dettalji',
                'help' => '[[MT-REV]] Enter up to 200 characters',
            ],
            'back' => 'Lura',
            'next' => 'Li jmiss',
        ],
    ],
    'items' => [
        'one' => [
            'category' => '[[MT-REV]] Press release',
            'date_iso' => '[[MT-REV]] 2026-09-01',
            'date' => '[[MT-REV]] 1 September 2026',
            'title' => '[[MT-REV]] New digital services for citizens',
            'body' => '[[MT-REV]] New online journeys are available for municipal services.',
        ],
        'two' => [
            'category' => '[[MT-REV]] Notice',
            'date_iso' => '[[MT-REV]] 2026-08-20',
            'date' => '[[MT-REV]] 20 August 2026',
            'title' => '[[MT-REV]] Service updates across the city',
            'body' => '[[MT-REV]] Read operational updates and useful community information.',
        ],
        'three' => [
            'category' => '[[MT-REV]] Event',
            'date_iso' => '[[MT-REV]] 2026-08-05',
            'date' => '[[MT-REV]] 5 August 2026',
            'title' => '[[MT-REV]] Open events for the community',
            'body' => '[[MT-REV]] Discover upcoming initiatives and take part in city life.',
        ],
    ],
];
