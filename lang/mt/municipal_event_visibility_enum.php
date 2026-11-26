<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): municipal_event_visibility_enum. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'values' => [
        'public' => [
            'label' => 'Pubbliku',
        ],
        'restricted' => [
            'label' => '[[MT-REV]] Restricted',
        ],
        'internal' => [
            'label' => '[[MT-REV]] Internal',
        ],
        'invite_only' => [
            'label' => '[[MT-REV]] Invitation only',
        ],
    ],
];
