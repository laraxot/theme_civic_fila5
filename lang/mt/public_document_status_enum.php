<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): public_document_status_enum. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'values' => [
        'draft' => [
            'label' => 'Abbozz',
        ],
        'review' => [
            'label' => '[[MT-REV]] In review',
        ],
        'approved' => [
            'label' => 'Approvat',
        ],
        'published' => [
            'label' => 'Ippubblikat',
        ],
        'effective' => [
            'label' => '[[MT-REV]] In force',
        ],
        'suspended' => [
            'label' => '[[MT-REV]] Suspended',
        ],
        'revoked' => [
            'label' => '[[MT-REV]] Revoked',
        ],
        'expired' => [
            'label' => 'Skadut',
        ],
        'archived' => [
            'label' => 'Arkivjat',
        ],
    ],
];
