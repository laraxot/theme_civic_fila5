<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): municipal_location_category_enum. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'values' => [
        'administrative' => [
            'label' => '[[MT-REV]] Administrative',
        ],
        'cultural' => [
            'label' => '[[MT-REV]] Cultural',
        ],
        'educational' => [
            'label' => '[[MT-REV]] Educational',
        ],
        'sports' => [
            'label' => '[[MT-REV]] Sports',
        ],
        'social' => [
            'label' => '[[MT-REV]] Social',
        ],
        'healthcare' => [
            'label' => '[[MT-REV]] Healthcare',
        ],
        'tourist' => [
            'label' => 'Turiżmu',
        ],
        'commercial' => [
            'label' => '[[MT-REV]] Commercial',
        ],
        'environmental' => [
            'label' => '[[MT-REV]] Environmental',
        ],
        'emergency' => [
            'label' => 'Emerġenza',
        ],
    ],
];
