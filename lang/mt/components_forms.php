<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): components_forms. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'upload' => [
        'drag_here' => [
            'label' => '[[MT-REV]] Drag your file here or',
        ],
        'browse' => [
            'label' => '[[MT-REV]] browse',
        ],
        'icon_alt' => [
            'label' => '[[MT-REV]] Upload icon',
        ],
        'submit' => [
            'label' => 'Ibgħat',
        ],
        'or' => [
            'label' => 'jew',
        ],
        'drag_to_upload' => [
            'label' => '[[MT-REV]] Drag the file to upload it',
        ],
        'select_from_device' => [
            'label' => '[[MT-REV]] select it from your device',
        ],
        'completed' => [
            'label' => '[[MT-REV]] Upload complete',
        ],
        'loading_file_name' => [
            'label' => '[[MT-REV]] Name of the file being uploaded',
        ],
        'loaded_file_name' => [
            'label' => '[[MT-REV]] Name of the uploaded file',
        ],
    ],
    'password_confirm' => [
        'security' => [
            'message' => '[[MT-REV]] For your security, please confirm your password to continue.',
        ],
    ],
    'password' => [
        'field' => [
            'label' => 'Password',
        ],
    ],
    'table' => [
        'select_all' => [
            'label' => '[[MT-REV]] Select all',
        ],
        'items_selected' => [
            'label' => '[[MT-REV]] item(s) selected',
        ],
        'deselect_all' => [
            'label' => '[[MT-REV]] Deselect all',
        ],
        'empty' => [
            'message' => '[[MT-REV]] No data available',
        ],
    ],
    'clear' => [
        'search' => [
            'label' => '[[MT-REV]] Clear search',
        ],
        'date' => [
            'label' => '[[MT-REV]] Clear date',
        ],
        'time' => [
            'label' => '[[MT-REV]] Clear time',
        ],
    ],
    'validation' => [
        'required' => [
            'label' => '[[MT-REV]] Required field',
        ],
        'error_heading' => [
            'message' => '[[MT-REV]] Whoops! Something went wrong.',
        ],
    ],
    'date_picker' => [
        'close' => [
            'label' => '[[MT-REV]] Close calendar',
        ],
        'select' => [
            'label' => '[[MT-REV]] Select date',
        ],
        'today' => [
            'label' => '[[MT-REV]] Today',
        ],
        'min' => [
            'label' => '[[MT-REV]] Minimum date:',
        ],
        'max' => [
            'label' => '[[MT-REV]] Maximum date:',
        ],
        'format' => [
            'placeholder' => '[[MT-REV]] DD/MM/YYYY',
        ],
    ],
    'number' => [
        'increase' => [
            'label' => '[[MT-REV]] Increase',
        ],
        'decrease' => [
            'label' => '[[MT-REV]] Decrease',
        ],
        'min' => [
            'label' => '[[MT-REV]] Minimum value:',
        ],
        'max' => [
            'label' => '[[MT-REV]] Maximum value:',
        ],
    ],
    'select' => [
        'default' => [
            'placeholder' => 'Agħżel',
        ],
    ],
    'time_picker' => [
        'empty' => [
            'message' => '[[MT-REV]] No time available',
        ],
        'min' => [
            'label' => '[[MT-REV]] Minimum time:',
        ],
        'max' => [
            'label' => '[[MT-REV]] Maximum time:',
        ],
    ],
    'autocomplete' => [
        'min_length' => [
            'text' => '[[MT-REV]] Enter at least :min characters',
        ],
        'no_results' => [
            'message' => '[[MT-REV]] No results found',
        ],
    ],
    'fields' => [
        'autocomplete' => [
            'placeholder' => 'Fittex...',
        ],
    ],
];
