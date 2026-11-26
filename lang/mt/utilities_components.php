<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): utilities_components. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'cie' => [
        'login' => [
            'label' => '[[MT-REV]] Log in with Electronic Identity Card',
        ],
    ],
    'pagopa' => [
        'notice_number' => [
            'label' => '[[MT-REV]] Notice number:',
        ],
    ],
    'spid' => [
        'login_cie' => [
            'label' => '[[MT-REV]] Log in with CIE',
        ],
        'security_level' => [
            'label' => '[[MT-REV]] Required security level:',
        ],
        'no_spid' => [
            'label' => '[[MT-REV]] Don\'t have SPID?',
        ],
        'what_is' => [
            'label' => '[[MT-REV]] What is SPID?',
        ],
        'provider_logo' => [
            'label' => '[[MT-REV]] :name logo',
        ],
        'choose_provider' => [
            'help' => '[[MT-REV]] Select the provider with which you activated SPID',
            'title' => '[[MT-REV]] Choose your Identity Provider',
        ],
        'login' => [
            'label' => '[[MT-REV]] Log in with SPID',
        ],
    ],
    'stepper' => [
        'process' => [
            'label' => '[[MT-REV]] Process in :total steps',
        ],
    ],
    'cookiebar' => [
        'accept_sr' => [
            'label' => '[[MT-REV]] the cookies',
        ],
        'preferences_sr' => [
            'label' => '[[MT-REV]] cookies',
        ],
    ],
    'pagination' => [
        'page_number' => [
            'label' => '[[MT-REV]] Page number',
        ],
        'page_jumper' => [
            'label' => '[[MT-REV]] Go to page:',
        ],
        'showing' => [
            'label' => '[[MT-REV]] Showing',
        ],
        'results_summary' => [
            'label' => 'Riżultati',
        ],
    ],
    'wizard' => [
        'save_request' => [
            'label' => '[[MT-REV]] Save request',
        ],
        'steps_nav' => [
            'label' => '[[MT-REV]] Steps',
        ],
    ],
];
