<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): account_forms. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'profile' => [
        'page_title' => [
            'title' => 'Profil',
        ],
        'information' => [
            'title' => 'Informazzjoni tal-profil',
            'help' => '[[MT-REV]] Update your account\'s profile information and email address.',
        ],
        'photo' => [
            'label' => 'Ritratt',
        ],
        'photo_select' => [
            'label' => '[[MT-REV]] Select A New Photo',
        ],
        'photo_remove' => [
            'label' => '[[MT-REV]] Remove Photo',
        ],
        'email_unverified' => [
            'message' => '[[MT-REV]] Your email address is unverified.',
        ],
        'email_resend' => [
            'label' => '[[MT-REV]] Click here to re-send the verification email.',
        ],
        'email_resent' => [
            'message' => '[[MT-REV]] A new verification link has been sent to your email address.',
        ],
    ],
    'password' => [
        'update' => [
            'title' => 'Aġġorna l-password',
            'help' => '[[MT-REV]] Ensure your account is using a long, random password to stay secure.',
        ],
        'current' => [
            'label' => 'Password preżenti',
        ],
        'new' => [
            'label' => 'Password ġdida',
        ],
        'confirm' => [
            'label' => 'Ikkonferma l-password',
        ],
    ],
    'common' => [
        'password' => [
            'label' => 'Password',
            'placeholder' => 'Password',
        ],
        'cancel' => [
            'label' => 'Ikkanċella',
        ],
        'save' => [
            'label' => '[[MT-REV]] Save',
        ],
        'saved' => [
            'message' => '[[MT-REV]] Saved.',
        ],
        'done' => [
            'message' => '[[MT-REV]] Done.',
        ],
        'confirm' => [
            'label' => 'Ikkonferma',
        ],
        'create' => [
            'label' => '[[MT-REV]] Create',
        ],
        'email' => [
            'label' => 'Email',
        ],
        'name' => [
            'label' => 'Isem',
        ],
        'update' => [
            'label' => 'Aġġorna',
        ],
    ],
    'delete_account' => [
        'action' => [
            'label' => '[[MT-REV]] Delete Account',
        ],
        'summary' => [
            'help' => '[[MT-REV]] Permanently delete your account.',
        ],
        'warning' => [
            'help' => '[[MT-REV]] Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.',
        ],
        'confirm' => [
            'title' => '[[MT-REV]] Are you sure you want to delete your account?',
        ],
        'confirm_full' => [
            'message' => '[[MT-REV]] Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.',
        ],
        'confirm_password' => [
            'message' => '[[MT-REV]] Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.',
        ],
        'legacy_warning' => [
            'help' => '[[MT-REV]] After deleting your account, all data and resources are permanently removed. Enter your password to confirm deletion.',
        ],
    ],
    'browser_sessions' => [
        'list' => [
            'title' => '[[MT-REV]] Browser Sessions',
            'help' => '[[MT-REV]] Manage and log out your active sessions on other browsers and devices.',
        ],
        'description' => [
            'help' => '[[MT-REV]] If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.',
        ],
        'unknown' => [
            'label' => 'Mhux magħruf',
        ],
        'this_device' => [
            'label' => '[[MT-REV]] This device',
        ],
        'last_active' => [
            'label' => '[[MT-REV]] Last active',
        ],
        'log_out_others' => [
            'label' => '[[MT-REV]] Log Out Other Browser Sessions',
        ],
        'confirm' => [
            'message' => '[[MT-REV]] Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices.',
        ],
    ],
    'two_factor' => [
        'setup' => [
            'title' => '[[MT-REV]] Two Factor Authentication',
            'help' => '[[MT-REV]] Add additional security to your account using two factor authentication.',
        ],
        'state_finish' => [
            'title' => '[[MT-REV]] Finish enabling two factor authentication.',
        ],
        'state_enabled' => [
            'title' => '[[MT-REV]] You have enabled two factor authentication.',
        ],
        'state_disabled' => [
            'title' => '[[MT-REV]] You have not enabled two factor authentication.',
        ],
        'intro' => [
            'help' => '[[MT-REV]] When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.',
        ],
        'scan_finish' => [
            'help' => '[[MT-REV]] To finish enabling two factor authentication, scan the following QR code using your phone\'s authenticator application or enter the setup key and provide the generated OTP code.',
        ],
        'scan_enabled' => [
            'help' => '[[MT-REV]] Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application or enter the setup key.',
        ],
        'setup_key' => [
            'label' => '[[MT-REV]] Setup Key',
        ],
        'code' => [
            'label' => '[[MT-REV]] Code',
        ],
        'recovery_codes' => [
            'help' => '[[MT-REV]] Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.',
        ],
        'enable' => [
            'label' => '[[MT-REV]] Enable',
        ],
        'recovery_regenerate' => [
            'label' => '[[MT-REV]] Regenerate Recovery Codes',
        ],
        'recovery_show' => [
            'label' => '[[MT-REV]] Show Recovery Codes',
        ],
        'disable' => [
            'label' => '[[MT-REV]] Disable',
        ],
    ],
    'team' => [
        'settings' => [
            'title' => '[[MT-REV]] Team Settings',
        ],
        'create' => [
            'title' => '[[MT-REV]] Create Team',
            'help' => '[[MT-REV]] Create a new team to collaborate with others on projects.',
        ],
        'details' => [
            'title' => '[[MT-REV]] Team Details',
        ],
        'owner' => [
            'label' => '[[MT-REV]] Team Owner',
        ],
        'name' => [
            'label' => '[[MT-REV]] Team Name',
            'help' => '[[MT-REV]] The team\'s name and owner information.',
        ],
        'delete' => [
            'label' => '[[MT-REV]] Delete Team',
        ],
        'delete_summary' => [
            'help' => '[[MT-REV]] Permanently delete this team.',
        ],
        'delete_warning' => [
            'help' => '[[MT-REV]] Once a team is deleted, all of its resources and data will be permanently deleted. Before deleting this team, please download any data or information regarding this team that you wish to retain.',
        ],
        'delete_confirm' => [
            'message' => '[[MT-REV]] Are you sure you want to delete this team? Once a team is deleted, all of its resources and data will be permanently deleted.',
        ],
    ],
    'members' => [
        'add' => [
            'title' => '[[MT-REV]] Add Team Member',
            'help' => '[[MT-REV]] Add a new team member to your team, allowing them to collaborate with you.',
        ],
        'add_email' => [
            'help' => '[[MT-REV]] Please provide the email address of the person you would like to add to this team.',
        ],
        'role' => [
            'label' => '[[MT-REV]] Role',
        ],
        'added' => [
            'message' => '[[MT-REV]] Added.',
        ],
        'add_action' => [
            'label' => '[[MT-REV]] Add',
        ],
        'pending' => [
            'title' => '[[MT-REV]] Pending Team Invitations',
            'help' => '[[MT-REV]] These people have been invited to your team and have been sent an invitation email. They may join the team by accepting the email invitation.',
        ],
        'list' => [
            'title' => '[[MT-REV]] Team Members',
            'help' => '[[MT-REV]] All of the people that are part of this team.',
        ],
        'leave' => [
            'label' => '[[MT-REV]] Leave',
        ],
        'remove' => [
            'label' => '[[MT-REV]] Remove',
        ],
        'manage_role' => [
            'title' => '[[MT-REV]] Manage Role',
        ],
        'leave_team' => [
            'title' => '[[MT-REV]] Leave Team',
            'message' => '[[MT-REV]] Are you sure you would like to leave this team?',
        ],
        'remove_member' => [
            'title' => '[[MT-REV]] Remove Team Member',
            'message' => '[[MT-REV]] Are you sure you would like to remove this person from the team?',
        ],
    ],
];
