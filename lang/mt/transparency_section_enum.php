<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): transparency_section_enum. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'values' => [
        'organization' => [
            'label' => '[[MT-REV]] Organization',
        ],
        'consulting' => [
            'label' => '[[MT-REV]] Consultants and collaborators',
        ],
        'personnel' => [
            'label' => '[[MT-REV]] Personnel',
        ],
        'performance' => [
            'label' => '[[MT-REV]] Performance',
        ],
        'public_procurement' => [
            'label' => '[[MT-REV]] Tenders and contracts',
        ],
        'grants' => [
            'label' => '[[MT-REV]] Grants, contributions and subsidies',
        ],
        'budgets' => [
            'label' => '[[MT-REV]] Budgets',
        ],
        'assets' => [
            'label' => '[[MT-REV]] Real estate and asset management',
        ],
        'services' => [
            'label' => '[[MT-REV]] Services provided',
        ],
        'public_works' => [
            'label' => '[[MT-REV]] Public works',
        ],
        'urban_planning' => [
            'label' => '[[MT-REV]] Urban planning and land management',
        ],
        'environmental_info' => [
            'label' => '[[MT-REV]] Environmental information',
        ],
        'social_interventions' => [
            'label' => '[[MT-REV]] Extraordinary and emergency interventions',
        ],
        'other' => [
            'label' => '[[MT-REV]] Other content',
        ],
    ],
];
