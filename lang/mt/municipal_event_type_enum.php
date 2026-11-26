<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): municipal_event_type_enum. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'values' => [
        'council_meeting' => [
            'label' => '[[MT-REV]] City council meeting',
        ],
        'committee_meeting' => [
            'label' => '[[MT-REV]] Committee meeting',
        ],
        'public_meeting' => [
            'label' => '[[MT-REV]] Public assembly',
        ],
        'public_hearing' => [
            'label' => '[[MT-REV]] Public hearing',
        ],
        'conference' => [
            'label' => '[[MT-REV]] Conference',
        ],
        'workshop' => [
            'label' => '[[MT-REV]] Workshop',
        ],
        'seminar' => [
            'label' => '[[MT-REV]] Seminar',
        ],
        'training' => [
            'label' => '[[MT-REV]] Training',
        ],
        'cultural_event' => [
            'label' => '[[MT-REV]] Cultural event',
        ],
        'sports_event' => [
            'label' => '[[MT-REV]] Sports event',
        ],
        'celebration' => [
            'label' => '[[MT-REV]] Celebration',
        ],
        'ceremony' => [
            'label' => '[[MT-REV]] Ceremony',
        ],
        'exhibition' => [
            'label' => '[[MT-REV]] Exhibition',
        ],
        'fair' => [
            'label' => '[[MT-REV]] Fair',
        ],
        'festival' => [
            'label' => '[[MT-REV]] Festival',
        ],
        'competition' => [
            'label' => '[[MT-REV]] Competition',
        ],
        'tender_opening' => [
            'label' => '[[MT-REV]] Tender opening',
        ],
        'public_consultation' => [
            'label' => '[[MT-REV]] Public consultation',
        ],
        'other' => [
            'label' => '[[MT-REV]] Other',
        ],
    ],
];
