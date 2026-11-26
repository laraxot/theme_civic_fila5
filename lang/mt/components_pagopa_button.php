<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): components_pagopa_button. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'button' => [
        'pay' => [
            'label' => '[[MT-REV]] Pay',
        ],
        'with_pagopa' => [
            'label' => '[[MT-REV]] with PagoPA',
        ],
        'processing' => [
            'label' => '[[MT-REV]] Processing...',
        ],
    ],
    'info' => [
        'secure_payments' => [
            'message' => '[[MT-REV]] Secure payments powered by PagoPA',
        ],
    ],
    'methods' => [
        'accepted' => [
            'label' => '[[MT-REV]] Accepted:',
        ],
    ],
];
