<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): emails_christmas. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'greeting' => [
        'snowflakes' => [
            'label' => '[[MT-REV]] Animated snowflakes',
        ],
        'wishes' => [
            'message' => '[[MT-REV]] It is with great pleasure that we extend our warmest wishes for a peaceful Christmas and a happy New Year!',
        ],
        'salutation' => [
            'label' => '[[MT-REV]] Dear clients and colleagues,',
        ],
    ],
    'closing' => [
        'team' => [
            'label' => '[[MT-REV]] The Team of our Office',
        ],
        'regards' => [
            'label' => '[[MT-REV]] With best wishes,',
        ],
        'thanks' => [
            'message' => '[[MT-REV]] Thank you for your trust and cooperation throughout the year.',
        ],
    ],
    'closure' => [
        'resume' => [
            'message' => '[[MT-REV]] We will resume normal activities from',
        ],
        'resume_date' => [
            'label' => '[[MT-REV]] 8 January',
        ],
        'from' => [
            'label' => '[[MT-REV]] From',
        ],
        'start_date' => [
            'label' => '[[MT-REV]] 24 December',
        ],
        'to' => [
            'label' => '[[MT-REV]] to',
        ],
        'end_date' => [
            'label' => '[[MT-REV]] 7 January',
        ],
        'inclusive' => [
            'label' => '[[MT-REV]] inclusive.',
        ],
        'title' => [
            'label' => '[[MT-REV]] Office Closure:',
        ],
        'notice' => [
            'message' => '[[MT-REV]] We inform you that our office will be closed for the Christmas holidays:',
        ],
    ],
];
