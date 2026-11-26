<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): components_jetstream_welcome. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'hero' => [
        'welcome' => [
            'title' => '[[MT-REV]] Welcome to your Jetstream application!',
        ],
        'intro' => [
            'description' => '[[MT-REV]] Laravel Jetstream provides a beautiful, robust starting point for your next Laravel application. Laravel is designed to help you build your application using a development environment that is simple, powerful, and enjoyable. We believe you should love expressing your creativity through programming, so we have spent time carefully crafting the Laravel ecosystem to be a breath of fresh air. We hope you love it.',
        ],
    ],
    'cards' => [
        'documentation' => [
            'title' => '[[MT-REV]] Documentation',
            'description' => '[[MT-REV]] Laravel has wonderful documentation covering every aspect of the framework. Whether you\'re new to the framework or have previous experience, we recommend reading all of the documentation from beginning to end.',
        ],
        'documentation_link' => [
            'label' => '[[MT-REV]] Explore the documentation',
        ],
        'laracasts' => [
            'description' => '[[MT-REV]] Laracasts offers thousands of video tutorials on Laravel, PHP, and JavaScript development. Check them out, see for yourself, and massively level up your development skills in the process.',
        ],
        'laracasts_link' => [
            'label' => '[[MT-REV]] Start watching Laracasts',
        ],
        'tailwind' => [
            'description' => '[[MT-REV]] Laravel Jetstream is built with Tailwind, an amazing utility first CSS framework that doesn\'t get in your way. You\'ll be amazed how easily you can build and maintain fresh, modern designs with this wonderful framework at your fingertips.',
        ],
        'authentication' => [
            'title' => '[[MT-REV]] Authentication',
            'description' => '[[MT-REV]] Authentication and registration views are included with Laravel Jetstream, as well as support for user email verification and resetting forgotten passwords. So, you\'re free to get started with what matters most: building your application.',
        ],
    ],
];
