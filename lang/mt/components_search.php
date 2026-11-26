<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): components_search. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'fields' => [
        'site' => [
            'placeholder' => 'Fittex fis-sit...',
        ],
        'keyword' => [
            'placeholder' => '[[MT-REV]] Search for a keyword',
            'label' => '[[MT-REV]] Keyword',
        ],
        'keyword_search' => [
            'placeholder' => '[[MT-REV]] Search by keyword',
        ],
    ],
    'filters' => [
        'to_apply_title' => [
            'label' => '[[MT-REV]] Filters to apply',
        ],
        'by_category' => [
            'label' => 'Iffiltra skont il-kategorija',
        ],
        'to_apply' => [
            'label' => '[[MT-REV]] filters to apply',
        ],
        'topics' => [
            'label' => '[[MT-REV]] Topics',
        ],
    ],
    'page' => [
        'title' => [
            'label' => 'Fittex',
        ],
    ],
    'results' => [
        'title' => [
            'label' => '[[MT-REV]] Search results',
        ],
        'empty' => [
            'message' => '[[MT-REV]] No results found. Try a different keyword.',
        ],
    ],
    'panel' => [
        'search_heading' => [
            'label' => '[[MT-REV]] SEARCH',
        ],
    ],
    'feedback' => [
        'help_improve' => [
            'text' => '[[MT-REV]] Help us improve the service',
        ],
    ],
    'demo' => [
        'search_example' => [
            'placeholder' => '[[MT-REV]] TARI payment',
        ],
        'with_label' => [
            'label' => '[[MT-REV]] With label',
        ],
        'with_label_lower' => [
            'label' => '[[MT-REV]] With label',
        ],
    ],
    'types' => [
        'organizational_unit' => [
            'label' => '[[MT-REV]] Organizational unit',
        ],
        'public_person' => [
            'label' => '[[MT-REV]] Public person',
        ],
        'documents' => [
            'label' => 'Dokumenti',
        ],
        'document' => [
            'label' => '[[MT-REV]] Document',
        ],
    ],
];
