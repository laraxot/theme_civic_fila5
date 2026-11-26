<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): public_person_role_enum. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'values' => [
        'mayor' => [
            'label' => '[[MT-REV]] Mayor',
        ],
        'deputy_mayor' => [
            'label' => '[[MT-REV]] Deputy mayor',
        ],
        'councillor' => [
            'label' => '[[MT-REV]] Councillor',
        ],
        'president' => [
            'label' => '[[MT-REV]] President',
        ],
        'vice_president' => [
            'label' => '[[MT-REV]] Vice president',
        ],
        'secretary' => [
            'label' => '[[MT-REV]] Secretary',
        ],
        'general_manager' => [
            'label' => '[[MT-REV]] General manager',
        ],
        'manager' => [
            'label' => 'Maniġer',
        ],
        'supervisor' => [
            'label' => '[[MT-REV]] Supervisor',
        ],
        'employee' => [
            'label' => 'Impjegat',
        ],
        'consultant' => [
            'label' => '[[MT-REV]] Consultant',
        ],
        'collaborator' => [
            'label' => '[[MT-REV]] Collaborator',
        ],
    ],
];
