<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): api_tokens. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'api_token_manager' => [
        'api_token' => [
            'label' => '[[MT-REV]] API Token',
        ],
        'api_token_permissions' => [
            'label' => '[[MT-REV]] API Token Permissions',
        ],
        'api_tokens_allow_third_party_services' => [
            'message' => '[[MT-REV]] API tokens allow third-party services to authenticate with our application on your behalf.',
        ],
        'are_you_sure_you_would_like' => [
            'label' => '[[MT-REV]] Are you sure you would like to delete this API token?',
        ],
        'close' => [
            'label' => 'Agħlaq',
        ],
        'create' => [
            'label' => '[[MT-REV]] Create',
        ],
        'create_api_token' => [
            'label' => '[[MT-REV]] Create API Token',
        ],
        'created' => [
            'message' => '[[MT-REV]] Created.',
        ],
        'delete' => [
            'label' => 'Ħassar',
        ],
        'delete_api_token' => [
            'label' => '[[MT-REV]] Delete API Token',
        ],
        'last_used' => [
            'label' => '[[MT-REV]] Last used',
        ],
        'manage_api_tokens' => [
            'label' => '[[MT-REV]] Manage API Tokens',
        ],
        'permissions' => [
            'label' => '[[MT-REV]] Permissions',
        ],
        'please_copy_your_new_api_token' => [
            'message' => '[[MT-REV]] Please copy your new API token. For your security, it won\'t be shown again.',
        ],
        'save' => [
            'label' => '[[MT-REV]] Save',
        ],
        'token_name' => [
            'label' => '[[MT-REV]] Token Name',
        ],
        'you_may_delete_any_of_your' => [
            'message' => '[[MT-REV]] You may delete any of your existing tokens if they are no longer needed.',
        ],
    ],
    'index' => [
        'api_tokens' => [
            'label' => '[[MT-REV]] API Tokens',
        ],
    ],
];
