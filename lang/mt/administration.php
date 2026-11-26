<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): administration. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'meta' => [
        'title' => 'Amministrazzjoni',
        'description' => '[[MT-REV]] Municipal organisation, documents and administrative data.',
        'breadcrumb' => 'Amministrazzjoni',
    ],
    'hero' => [
        'title' => 'Amministrazzjoni',
        'subtitle' => '[[MT-REV]] Information about municipal organisation, documents and data.',
    ],
    'sections' => [
        'aria' => '[[MT-REV]] Administration sections',
        'organisation' => '[[MT-REV]] Organisation',
        'documents' => 'Dokumenti',
        'data' => '[[MT-REV]] Data and statistics',
    ],
    'more' => '[[MT-REV]] Learn more',
    'organisation' => [
        'title' => '[[MT-REV]] Organisation',
        'subtitle' => '[[MT-REV]] Offices, people and responsibilities.',
        'cards' => [
            'first' => [
                'title' => '[[MT-REV]] Municipal offices',
                'body' => '[[MT-REV]] Contacts, opening hours and responsibilities.',
            ],
            'second' => [
                'title' => '[[MT-REV]] Organisation chart',
                'body' => '[[MT-REV]] Structure and organisational responsibilities.',
            ],
            'third' => [
                'title' => '[[MT-REV]] Staff',
                'body' => '[[MT-REV]] Information about roles and services.',
            ],
        ],
    ],
    'documents' => [
        'title' => 'Dokumenti',
        'subtitle' => '[[MT-REV]] Acts, regulations and administrative information.',
        'cards' => [
            'first' => [
                'title' => '[[MT-REV]] Notice board',
                'body' => '[[MT-REV]] Browse documents published by the administration.',
            ],
            'second' => [
                'title' => '[[MT-REV]] Regulations',
                'body' => '[[MT-REV]] Find municipal rules and documents.',
            ],
            'third' => [
                'title' => '[[MT-REV]] Tenders',
                'body' => '[[MT-REV]] Browse open opportunities and procedures.',
            ],
        ],
    ],
    'data' => [
        'title' => '[[MT-REV]] Data and statistics',
        'subtitle' => '[[MT-REV]] Transparent information about municipal activity.',
        'cards' => [
            'first' => [
                'title' => '[[MT-REV]] Open data',
                'body' => '[[MT-REV]] Download public data in open formats.',
            ],
            'second' => [
                'title' => 'Baġit',
                'body' => '[[MT-REV]] Browse economic and financial data.',
            ],
            'third' => [
                'title' => '[[MT-REV]] Transparency',
                'body' => '[[MT-REV]] Access information required by law.',
            ],
        ],
    ],
];
