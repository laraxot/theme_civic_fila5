<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): navigation. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'main' => 'Navigazzjoni ewlenija',
    'site_title' => 'FixCity',
    'home' => 'Paġna ewlenija',
    'about' => '[[MT-REV]] About',
    'contact' => 'Kuntatt',
    'services' => 'Servizzi',
    'portfolio' => '[[MT-REV]] Portfolio',
    'news' => 'Aħbarijiet',
    'blog' => '[[MT-REV]] Blog',
    'homepage' => [
        'featured_content' => '[[MT-REV]] Featured content',
        'services' => 'Servizzi',
        'all_services' => '[[MT-REV]] All services',
        'administration' => 'Amministrazzjoni',
        'all_administration' => '[[MT-REV]] All administration',
        'news' => 'Aħbarijiet',
        'all_news' => '[[MT-REV]] All news',
        'events' => '[[MT-REV]] Living in the City',
        'all_events' => '[[MT-REV]] All events',
        'featured_events' => '[[MT-REV]] Featured events',
        'empty_events' => '[[MT-REV]] There are no published events yet.',
        'related_events' => '[[MT-REV]] Related events',
        'featured_locations' => '[[MT-REV]] Featured places',
        'all_locations' => '[[MT-REV]] All places',
        'featured_topics' => '[[MT-REV]] Featured topics',
        'other_topics' => '[[MT-REV]] Other topics',
        'show_all' => 'Uri kollox',
        'thematic_sites' => '[[MT-REV]] Thematic sites',
        'useful_links' => '[[MT-REV]] Useful links',
        'search_placeholder' => '[[MT-REV]] Search for a keyword',
        'search' => 'Fittex',
        'page_rating' => '[[MT-REV]] How clear is the information on this page?',
        'rate_5' => '[[MT-REV]] Rate 5 stars out of 5',
        'rate_4' => '[[MT-REV]] Rate 4 stars out of 5',
        'rate_3' => '[[MT-REV]] Rate 3 stars out of 5',
        'rate_2' => '[[MT-REV]] Rate 2 stars out of 5',
        'rate_1' => '[[MT-REV]] Rate 1 star out of 5',
        'positive_feedback' => '[[MT-REV]] What did you like about this page?',
        'negative_feedback' => '[[MT-REV]] What did you not find clear?',
        'add_details' => '[[MT-REV]] Do you want to add other details?',
        'detail_hint' => '[[MT-REV]] Enter maximum 200 characters',
        'back' => 'Lura',
        'next' => 'Li jmiss',
        'contacts' => '[[MT-REV]] Contact the municipality',
        'faq' => '[[MT-REV]] Read the FAQs',
        'assistance' => '[[MT-REV]] Request assistance',
        'call' => '[[MT-REV]] Call the toll-free number',
        'appointment' => '[[MT-REV]] Book an appointment',
        'report_issue' => 'Irrapporta problema',
        'maybe_searching' => '[[MT-REV]] Perhaps you were looking for',
    ],
];
