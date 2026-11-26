<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): design_comuni_pages. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'homepage' => [
        'hero_image' => [
            'title' => '[[MT-REV]] Image title',
            'alt' => '[[MT-REV]] Image description',
        ],
    ],
];
