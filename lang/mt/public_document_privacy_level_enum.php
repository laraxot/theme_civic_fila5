<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): public_document_privacy_level_enum. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'values' => [
        'public' => [
            'label' => 'Pubbliku',
        ],
        'restricted' => [
            'label' => '[[MT-REV]] Restricted access',
        ],
        'confidential' => [
            'label' => '[[MT-REV]] Confidential',
        ],
        'classified' => [
            'label' => '[[MT-REV]] Classified',
        ],
        'personal_data' => [
            'label' => '[[MT-REV]] Personal data',
        ],
        'sensitive_data' => [
            'label' => '[[MT-REV]] Sensitive data',
        ],
    ],
];
