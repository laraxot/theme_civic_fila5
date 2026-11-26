<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): account_menu. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'dashboard' => [
        'welcome' => [
            'message' => '[[MT-REV]] Welcome to the dashboard',
        ],
    ],
    'validation' => [
        'errors_title' => [
            'label' => '[[MT-REV]] Whoops! Something went wrong.',
        ],
    ],
    'menu' => [
        'switch_teams' => [
            'label' => '[[MT-REV]] Switch Teams',
        ],
        'create_team' => [
            'label' => '[[MT-REV]] Create New Team',
        ],
        'team_settings' => [
            'label' => '[[MT-REV]] Team Settings',
        ],
        'manage_team' => [
            'label' => '[[MT-REV]] Manage Team',
        ],
        'api_tokens' => [
            'label' => '[[MT-REV]] API Tokens',
        ],
        'profile' => [
            'label' => 'Profil',
        ],
        'manage_account' => [
            'label' => '[[MT-REV]] Manage Account',
        ],
    ],
    'profile' => [
        'delete' => [
            'title' => '[[MT-REV]] Delete Account',
            'help' => '[[MT-REV]] After deleting your account, all data and resources are permanently removed. Enter your password to confirm deletion.',
            'confirm' => '[[MT-REV]] Are you sure you want to delete your account?',
        ],
        'cancel' => [
            'label' => 'Ikkanċella',
        ],
        'update' => [
            'label' => 'Aġġorna',
        ],
        'password' => [
            'help' => '[[MT-REV]] Ensure your account is using a long, random password to stay secure.',
            'title' => 'Aġġorna l-password',
        ],
        'information' => [
            'help' => '[[MT-REV]] Update your account\'s profile information and email address.',
            'title' => 'Informazzjoni tal-profil',
        ],
    ],
];
