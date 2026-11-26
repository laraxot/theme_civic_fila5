<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): organizational_unit_type_enum. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'values' => [
        'municipality' => [
            'label' => '[[MT-REV]] Municipality',
        ],
        'department' => [
            'label' => '[[MT-REV]] Department',
        ],
        'sector' => [
            'label' => '[[MT-REV]] Sector',
        ],
        'office' => [
            'label' => 'Uffiċċju',
        ],
        'service' => [
            'label' => '[[MT-REV]] Service',
        ],
        'area' => [
            'label' => '[[MT-REV]] Area',
        ],
        'division' => [
            'label' => '[[MT-REV]] Division',
        ],
        'unit' => [
            'label' => '[[MT-REV]] Unit',
        ],
        'committee' => [
            'label' => '[[MT-REV]] Committee',
        ],
        'council' => [
            'label' => '[[MT-REV]] Council',
        ],
        'board' => [
            'label' => '[[MT-REV]] Executive board',
        ],
        'authority' => [
            'label' => '[[MT-REV]] Authority',
        ],
        'agency' => [
            'label' => '[[MT-REV]] Agency',
        ],
    ],
];
