<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): header. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'brand' => [
        'name' => 'FixCity',
    ],
    'guest' => [
        'login' => [
            'label' => 'Idħol',
            'placeholder' => '',
            'help' => '',
        ],
        'register' => [
            'label' => 'Irreġistra',
            'placeholder' => '',
            'help' => '',
        ],
        'cta' => [
            'label' => '[[MT-REV]] Personal area',
            'placeholder' => '',
            'help' => '[[MT-REV]] Link to citizen sign-in.',
        ],
    ],
    'user' => [
        'unread_notifications' => '[[MT-REV]] unread notifications',
        'personal_area' => '[[MT-REV]] Personal area',
        'welcome' => [
            'label' => '[[MT-REV]] Hello, :name',
            'placeholder' => '',
            'help' => '',
        ],
        'aria' => [
            'toggle_menu' => [
                'label' => '[[MT-REV]] Open user menu',
                'placeholder' => '',
                'help' => '',
            ],
        ],
        'dropdown' => [
            'my_reports' => [
                'label' => '[[MT-REV]] My reports',
            ],
            'followed_reports' => [
                'label' => '[[MT-REV]] Reports I follow',
            ],
            'notification_center' => [
                'label' => 'Notifiki',
            ],
            'settings_privacy' => [
                'label' => '[[MT-REV]] Settings and privacy',
            ],
            'my_services' => [
                'label' => '[[MT-REV]] My services',
                'placeholder' => '',
                'help' => '',
            ],
            'my_practices' => [
                'label' => '[[MT-REV]] My applications',
                'placeholder' => '',
                'help' => '',
            ],
            'notifications' => [
                'label' => 'Notifiki',
                'placeholder' => '',
                'help' => '',
            ],
            'settings' => [
                'label' => '[[MT-REV]] Settings',
                'placeholder' => '',
                'help' => '',
            ],
            'logout' => [
                'label' => 'Oħroġ',
                'placeholder' => '',
                'help' => '',
            ],
        ],
    ],
    'slim' => [
        'tools_aria' => '[[MT-REV]] Language and personal area',
        'region' => [
            'name' => [
                'label' => '[[MT-REV]] Region name',
                'placeholder' => '',
                'help' => '[[MT-REV]] Label shown in the top slim bar.',
            ],
            'portal_aria' => [
                'label' => '[[MT-REV]] Go to :region portal — external link — opens in a new tab',
                'placeholder' => '',
                'help' => '',
            ],
            'portal_title' => [
                'label' => '[[MT-REV]] Go to :region portal',
                'placeholder' => '',
                'help' => '',
            ],
        ],
    ],
    'center' => [
        'brand' => [
            'title' => [
                'label' => '[[MT-REV]] My municipality',
                'placeholder' => '',
                'help' => '',
            ],
            'tagline' => [
                'label' => '[[MT-REV]] A municipality to live in',
                'placeholder' => '',
                'help' => '',
            ],
            'home_link' => [
                'title' => [
                    'label' => '[[MT-REV]] Go to homepage',
                    'placeholder' => '',
                    'help' => '',
                ],
            ],
        ],
        'search' => [
            'label' => 'Fittex',
            'toggle_aria' => [
                'label' => 'Fittex fis-sit',
                'placeholder' => '',
                'help' => '',
            ],
        ],
        'social' => [
            'follow' => [
                'label' => 'Segwina fuq',
                'placeholder' => '',
                'help' => '',
            ],
        ],
        'nav' => [
            'toggle_aria' => [
                'label' => '[[MT-REV]] Show/Hide navigation',
                'placeholder' => '',
                'help' => '',
            ],
            'close_aria' => [
                'label' => '[[MT-REV]] Hide navigation',
                'placeholder' => '',
                'help' => '',
            ],
            'primary_aria' => [
                'label' => '[[MT-REV]] Main',
                'placeholder' => '',
                'help' => '',
            ],
            'secondary_aria' => [
                'label' => '[[MT-REV]] Secondary',
                'placeholder' => '',
                'help' => '',
            ],
            'amministrazione' => [
                'label' => 'Amministrazzjoni',
                'placeholder' => '',
                'help' => '',
            ],
            'novita' => [
                'label' => 'Aħbarijiet',
                'placeholder' => '',
                'help' => '',
            ],
            'servizi' => [
                'label' => 'Servizzi',
                'placeholder' => '',
                'help' => '',
            ],
            'vivere' => [
                'label' => '[[MT-REV]] Living the municipality',
                'placeholder' => '',
                'help' => '',
            ],
            'iscrizioni' => [
                'label' => '[[MT-REV]] Registrations',
                'placeholder' => '',
                'help' => '',
            ],
            'estate' => [
                'label' => '[[MT-REV]] Summer in the city',
                'placeholder' => '',
                'help' => '',
            ],
            'polizia' => [
                'label' => '[[MT-REV]] Local police',
                'placeholder' => '',
                'help' => '',
            ],
            'argomenti' => [
                'label' => '[[MT-REV]] All topics',
                'placeholder' => '',
                'help' => '',
            ],
            'hamburger_brand' => [
                'label' => '[[MT-REV]] Municipality name',
                'placeholder' => '',
                'help' => '',
            ],
        ],
    ],
    'language' => [
        'active_prefix' => [
            'label' => '[[MT-REV]] Current language:',
            'placeholder' => '',
            'help' => '',
        ],
        'code_it' => [
            'label' => '[[MT-REV]] ITA',
            'placeholder' => '',
            'help' => '',
        ],
        'code_en' => [
            'label' => '[[MT-REV]] ENG',
            'placeholder' => '',
            'help' => '',
        ],
        'selected_suffix' => [
            'label' => '[[MT-REV]] selected',
            'placeholder' => '',
            'help' => '',
        ],
    ],
    'social' => [
        'twitter' => [
            'label' => 'Twitter',
            'placeholder' => '',
            'help' => '',
        ],
        'facebook' => [
            'label' => 'Facebook',
            'placeholder' => '',
            'help' => '',
        ],
        'youtube' => [
            'label' => 'YouTube',
            'placeholder' => '',
            'help' => '',
        ],
        'telegram' => [
            'label' => 'Telegram',
            'placeholder' => '',
            'help' => '',
        ],
        'whatsapp' => [
            'label' => 'WhatsApp',
            'placeholder' => '',
            'help' => '',
        ],
        'rss' => [
            'label' => 'RSS',
            'placeholder' => '',
            'help' => '',
        ],
    ],
];
