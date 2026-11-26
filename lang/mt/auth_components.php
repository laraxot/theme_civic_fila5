<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): auth_components. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'login' => [
        'forgot_password' => [
            'label' => 'Insejt il-password tiegħek?',
        ],
        'invalid_credentials' => [
            'message' => '[[MT-REV]] The provided credentials are incorrect.',
        ],
        'no_account' => [
            'label' => 'M’għandekx kont?',
        ],
        'title' => [
            'label' => '[[MT-REV]] Log in to FixCity',
        ],
    ],
    'logout' => [
        'log_back' => [
            'label' => '[[MT-REV]] Click here to log back on',
        ],
        'done' => [
            'message' => '[[MT-REV]] You have logged out',
        ],
        'goodbye' => [
            'title' => '[[MT-REV]] Goodbye',
        ],
    ],
    'register' => [
        'submit' => [
            'label' => 'Irreġistra',
        ],
        'password_confirmation' => [
            'label' => 'Ikkonferma l-password',
        ],
        'password' => [
            'label' => 'Password',
        ],
        'email' => [
            'label' => 'Indirizz tal-email',
        ],
        'name' => [
            'label' => 'Isem',
        ],
        'sign_in' => [
            'label' => '[[MT-REV]] sign in to your account',
        ],
        'title' => [
            'label' => '[[MT-REV]] Create a new account',
        ],
    ],
    'verify' => [
        'not_received' => [
            'message' => '[[MT-REV]] If you did not receive the email,',
        ],
        'resend' => [
            'label' => '[[MT-REV]] click here to request another',
        ],
        'check_email' => [
            'message' => '[[MT-REV]] Before proceeding, please check your email for a verification link.',
        ],
        'link_sent' => [
            'message' => '[[MT-REV]] A fresh verification link has been sent to your email address.',
        ],
        'sign_out' => [
            'label' => '[[MT-REV]] sign out',
        ],
        'title' => [
            'label' => '[[MT-REV]] Verify your email address',
        ],
    ],
    'reset' => [
        'help' => [
            'message' => '[[MT-REV]] Choose a new password for your account.',
        ],
        'title' => [
            'label' => '[[MT-REV]] Reset password',
        ],
    ],
];
