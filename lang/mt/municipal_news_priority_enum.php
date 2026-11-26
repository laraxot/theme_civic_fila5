<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): municipal_news_priority_enum. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'values' => [
        1 => [
            'label' => '[[MT-REV]] Low',
        ],
        2 => [
            'label' => 'Normali',
        ],
        3 => [
            'label' => '[[MT-REV]] High',
        ],
        4 => [
            'label' => 'Urġenti',
        ],
        5 => [
            'label' => '[[MT-REV]] Critical',
        ],
    ],
];
