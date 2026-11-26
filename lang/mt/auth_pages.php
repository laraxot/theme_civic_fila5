<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): auth_pages. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'verify_email' => [
        'a_new_verification_link_has_been' => [
            'message' => '[[MT-REV]] A new verification link has been sent to the email address you provided in your profile settings.',
        ],
        'before_continuing_could_you_verify_your' => [
            'message' => '[[MT-REV]] Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.',
        ],
        'edit_profile' => [
            'label' => '[[MT-REV]] Edit Profile',
        ],
        'log_out' => [
            'label' => 'Oħroġ',
        ],
        'resend_verification_email' => [
            'label' => '[[MT-REV]] Resend Verification Email',
        ],
    ],
    'register' => [
        'access_the_municipality_s_services' => [
            'label' => '[[MT-REV]] Access the municipality\'s services',
        ],
        'accessibility' => [
            'label' => 'Aċċessibbiltà',
        ],
        'i_accept_the_terms_and_the' => [
            'label' => '[[MT-REV]] I accept the :terms and the :privacy',
        ],
        'confirm_password' => [
            'label' => 'Ikkonferma l-password',
        ],
        'wcag_2_1_aa_compliant' => [
            'label' => '[[MT-REV]] WCAG 2.1 AA compliant',
        ],
        'create_your_account' => [
            'label' => 'Oħloq il-kont tiegħek',
        ],
        'create_a_new_account' => [
            'label' => '[[MT-REV]] Create a new account',
        ],
        'accessibility_statement' => [
            'label' => 'Dikjarazzjoni dwar l-aċċessibbiltà',
        ],
        'forgot_your_password' => [
            'label' => 'Insejt il-password tiegħek?',
        ],
        'already_have_an_account' => [
            'label' => 'Diġà għandek kont?',
        ],
        'navigation' => [
            'label' => '[[MT-REV]] Navigation',
        ],
        'privacy' => [
            'label' => 'Privatezza',
        ],
        'recover_password' => [
            'label' => '[[MT-REV]] Recover password',
        ],
        'sign_up' => [
            'label' => '[[MT-REV]] Sign up',
        ],
        'tab_to_move_around_enter_to' => [
            'label' => '[[MT-REV]] Tab to move around • Enter to confirm',
        ],
        'terms_of_service' => [
            'label' => '[[MT-REV]] Terms of service',
        ],
    ],
    'two_factor_challenge' => [
        'code' => [
            'label' => '[[MT-REV]] Code',
        ],
        'log_in' => [
            'label' => 'Idħol',
        ],
        'please_confirm_access_to_your_account' => [
            'message' => '[[MT-REV]] Please confirm access to your account by entering one of your emergency recovery codes.',
        ],
        'please_confirm_access_to_your_account_2' => [
            'message' => '[[MT-REV]] Please confirm access to your account by entering the authentication code provided by your authenticator application.',
        ],
        'recovery_code' => [
            'label' => '[[MT-REV]] Recovery Code',
        ],
        'use_a_recovery_code' => [
            'label' => '[[MT-REV]] Use a recovery code',
        ],
        'use_an_authentication_code' => [
            'label' => '[[MT-REV]] Use an authentication code',
        ],
    ],
    'shared' => [
        'confirm' => [
            'label' => 'Ikkonferma',
        ],
        'confirm_password' => [
            'label' => 'Ikkonferma l-password',
        ],
        'password' => [
            'label' => 'Password',
        ],
    ],
    'forgot_password' => [
        'email_password_reset_link' => [
            'label' => '[[MT-REV]] Email Password Reset Link',
        ],
        'forgot_your_password_no_problem_just' => [
            'message' => '[[MT-REV]] Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.',
        ],
    ],
    'confirms_password' => [
        'for_your_security_please_confirm_your' => [
            'message' => '[[MT-REV]] For your security, please confirm your password to continue.',
        ],
    ],
    'reset_password' => [
        'reset_password' => [
            'label' => '[[MT-REV]] Reset Password',
        ],
    ],
    'confirm_password' => [
        'this_is_a_secure_area_of' => [
            'message' => '[[MT-REV]] This is a secure area of the application. Please confirm your password before continuing.',
        ],
    ],
];
