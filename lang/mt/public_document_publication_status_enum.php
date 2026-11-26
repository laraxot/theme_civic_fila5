<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): public_document_publication_status_enum. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'values' => [
        'unpublished' => [
            'label' => '[[MT-REV]] Unpublished',
        ],
        'scheduled' => [
            'label' => '[[MT-REV]] Scheduled',
        ],
        'published' => [
            'label' => 'Ippubblikat',
        ],
        'updated' => [
            'label' => '[[MT-REV]] Updated',
        ],
        'withdrawn' => [
            'label' => '[[MT-REV]] Withdrawn',
        ],
    ],
];
