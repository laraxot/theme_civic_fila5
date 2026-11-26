<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): components_marketing_footer. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'brand' => [
        'logo' => [
            'alt' => '[[MT-REV]] FlowBite Logo',
        ],
    ],
    'sections' => [
        'resources' => [
            'title' => '[[MT-REV]] Resources',
        ],
        'follow_us' => [
            'title' => '[[MT-REV]] Follow us',
        ],
        'legal' => [
            'title' => '[[MT-REV]] Legal',
        ],
    ],
    'legal' => [
        'privacy_policy' => [
            'label' => 'Politika tal-Privatezza',
        ],
        'terms' => [
            'label' => '[[MT-REV]] Terms & Conditions',
        ],
        'rights_reserved' => [
            'label' => '[[MT-REV]] . All Rights Reserved.',
        ],
    ],
    'social' => [
        'facebook' => [
            'label' => '[[MT-REV]] Facebook page',
        ],
        'discord' => [
            'label' => '[[MT-REV]] Discord community',
        ],
        'twitter' => [
            'label' => '[[MT-REV]] Twitter page',
        ],
        'github' => [
            'label' => '[[MT-REV]] GitHub account',
        ],
        'dribbble' => [
            'label' => '[[MT-REV]] Dribbble account',
        ],
    ],
];
