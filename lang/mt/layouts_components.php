<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): layouts_components. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'guest' => [
        'footer_links' => [
            'privacy' => [
                'label' => 'Privatezza',
            ],
        ],
        'useful_links' => [
            'title' => '[[MT-REV]] Useful links',
        ],
        'keyboard' => [
            'label' => '[[MT-REV]] Keyboard navigation:',
            'help' => '[[MT-REV]] Use Tab to move between fields and Enter to submit the form.',
        ],
        'accessibility' => [
            'label' => '[[MT-REV]] Accessibility:',
            'message' => '[[MT-REV]] This service is accessible in accordance with the WCAG 2.1 AA guidelines.',
        ],
        'privacy' => [
            'link' => '[[MT-REV]] privacy notice',
            'intro' => '[[MT-REV]] For information about privacy, see the',
        ],
        'agid' => [
            'link' => '[[MT-REV]] AGID guidelines',
            'intro' => '[[MT-REV]] This service complies with the',
        ],
        'help' => [
            'title' => 'Għandek bżonn għajnuna?',
        ],
        'security' => [
            'message' => '[[MT-REV]] Your data is protected and encrypted',
        ],
        'login' => [
            'help' => '[[MT-REV]] Use the credentials provided by the administrator',
            'title' => '[[MT-REV]] Log in with your credentials',
        ],
        'entity_site' => [
            'label' => '[[MT-REV]] Go to the organisation\'s website',
        ],
    ],
];
