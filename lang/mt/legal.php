<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): legal. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'home' => 'Paġna ewlenija',
    'documents' => [
        'privacy' => [
            'title' => 'Avviż dwar il-privatezza',
        ],
        'legal_notes' => [
            'title' => '[[MT-REV]] Legal notes',
        ],
        'media_policy' => [
            'title' => '[[MT-REV]] Media policy',
        ],
        'terms_disclaimer' => [
            'title' => '[[MT-REV]] Terms and disclaimer',
        ],
    ],
    'incomplete' => [
        'title' => '[[MT-REV]] Text not complete yet',
        'intro_missing' => '[[MT-REV]] The data controller still has to provide the following information before the service goes live.',
        'intro_present' => '[[MT-REV]] The text below is incomplete: the data controller still has to provide or complete the following information before the service goes live.',
        'document_missing' => '[[MT-REV]] The municipality has not provided the text of this document yet. The controller must publish it before the service goes live.',
    ],
];
