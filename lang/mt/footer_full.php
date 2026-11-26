<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): footer_full. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'logo' => [
        'eu' => [
            'label' => '[[MT-REV]] European Union logo',
        ],
    ],
    'admin' => [
        'heading' => [
            'title' => 'Amministrazzjoni',
        ],
    ],
    'services' => [
        'heading' => [
            'title' => '[[MT-REV]] Service categories',
        ],
    ],
    'contacts' => [
        'heading' => [
            'title' => 'Kuntatti',
        ],
        'phone' => [
            'label' => 'Telefon:',
        ],
        'email' => [
            'label' => 'Email:',
        ],
        'pec' => [
            'label' => '[[MT-REV]] PEC (certified email):',
        ],
        'hours' => [
            'label' => '[[MT-REV]] Counter hours:',
        ],
    ],
    'social' => [
        'heading' => [
            'title' => 'Segwina fuq',
        ],
    ],
    'sponsor' => [
        'heading' => [
            'title' => '[[MT-REV]] Sponsors',
        ],
        'subtitle' => [
            'help' => '[[MT-REV]] Advertising spaces available - Contact us to promote your brand',
        ],
    ],
];
