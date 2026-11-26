<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): public_person_category_enum. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'values' => [
        'politician' => [
            'label' => '[[MT-REV]] Politician/Administrator',
        ],
        'manager' => [
            'label' => 'Maniġer',
        ],
        'employee' => [
            'label' => 'Impjegat',
        ],
        'consultant' => [
            'label' => '[[MT-REV]] Consultant/Collaborator',
        ],
        'commission_member' => [
            'label' => '[[MT-REV]] Commission member',
        ],
        'board_member' => [
            'label' => '[[MT-REV]] Board member',
        ],
        'authority_member' => [
            'label' => '[[MT-REV]] Authority member',
        ],
        'other' => [
            'label' => '[[MT-REV]] Other',
        ],
    ],
];
