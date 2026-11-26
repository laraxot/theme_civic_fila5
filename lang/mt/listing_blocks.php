<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): listing_blocks. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'common' => [
        'search' => [
            'label' => 'Fittex',
            'placeholder' => 'Fittex...',
        ],
        'details' => [
            'label' => 'Dettalji',
        ],
    ],
    'filters' => [
        'title' => [
            'title' => '[[MT-REV]] Filters',
        ],
        'reset' => [
            'label' => '[[MT-REV]] Reset filters',
        ],
        'type' => [
            'label' => '[[MT-REV]] Type',
        ],
    ],
    'sorting' => [
        'sort_by' => [
            'label' => '[[MT-REV]] Sort by',
        ],
        'date' => [
            'label' => 'Data',
        ],
        'popularity' => [
            'label' => '[[MT-REV]] Popularity',
        ],
        'date_asc' => [
            'label' => '[[MT-REV]] Date (ascending)',
        ],
        'date_desc' => [
            'label' => '[[MT-REV]] Date (descending)',
        ],
    ],
    'pagination' => [
        'nav' => [
            'label' => 'Paġinazzjoni',
        ],
        'previous_page' => [
            'label' => 'Il-paġna ta’ qabel',
        ],
        'next_page' => [
            'label' => 'Il-paġna li jmiss',
        ],
        'previous' => [
            'label' => 'Ta’ qabel',
        ],
        'next' => [
            'label' => 'Li jmiss',
        ],
        'page' => [
            'label' => 'Paġna',
        ],
        'of' => [
            'label' => '[[MT-REV]] of',
        ],
    ],
    'search_results' => [
        'site' => [
            'label' => 'Fittex fis-sit',
        ],
        'submit' => [
            'label' => '[[MT-REV]] Run search',
        ],
        'summary_prefix' => [
            'label' => '[[MT-REV]] There are',
        ],
        'summary_for' => [
            'label' => '[[MT-REV]] for',
        ],
        'default_label' => [
            'label' => 'Riżultati',
        ],
        'empty' => [
            'title' => '[[MT-REV]] No results found',
            'help' => '[[MT-REV]] Try changing the filters or your search.',
        ],
        'updated' => [
            'label' => '[[MT-REV]] Updated:',
        ],
        'rated' => [
            'label' => '[[MT-REV]] You rated:',
        ],
    ],
];
