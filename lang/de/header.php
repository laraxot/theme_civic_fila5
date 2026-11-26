<?php

declare(strict_types=1);

/*
 * Header (de). Catalogo esplicito: prima era `array_replace_recursive(en/header.php, [...])`, quindi ogni voce non
 * tradotta restava in inglese senza errori (13 voci, vedi docs/contracts/i18n-catalog-parity.md).
 * Chiavi `user.dropdown.*` lette da partials/user-dropdown.blade.php; `slim.tools_aria` distingue i landmark di navigazione (axe landmark-unique).
 */
return [
    'brand' => [
        'name' => 'FixCity',
    ],
    'guest' => [
        'login' => [
            'label' => 'Anmelden',
            'placeholder' => '',
            'help' => '',
        ],
        'register' => [
            'label' => 'Registrieren',
            'placeholder' => '',
            'help' => '',
        ],
        'cta' => [
            'label' => 'Persönlicher Bereich',
            'placeholder' => '',
            'help' => 'Zum persönlichen Bereich.',
        ],
    ],
    'user' => [
        'unread_notifications' => 'ungelesene Benachrichtigungen',
        'personal_area' => 'Persönlicher Bereich',
        'welcome' => [
            'label' => 'Hallo, :name',
            'placeholder' => '',
            'help' => '',
        ],
        'aria' => [
            'toggle_menu' => [
                'label' => 'Benutzermenü öffnen',
                'placeholder' => '',
                'help' => '',
            ],
        ],
        'dropdown' => [
            'my_reports' => [
                'label' => 'Meine Meldungen',
            ],
            'followed_reports' => [
                'label' => 'Meldungen, denen ich folge',
            ],
            'notification_center' => [
                'label' => 'Benachrichtigungen',
            ],
            'settings_privacy' => [
                'label' => 'Einstellungen und Datenschutz',
            ],
            'my_services' => [
                'label' => 'Meine Dienste',
                'placeholder' => '',
                'help' => '',
            ],
            'my_practices' => [
                'label' => 'Meine Vorgänge',
                'placeholder' => '',
                'help' => '',
            ],
            'notifications' => [
                'label' => 'Benachrichtigungen',
                'placeholder' => '',
                'help' => '',
            ],
            'settings' => [
                'label' => 'Einstellungen',
                'placeholder' => '',
                'help' => '',
            ],
            'logout' => [
                'label' => 'Abmelden',
                'placeholder' => '',
                'help' => '',
            ],
        ],
    ],
    'slim' => [
        'tools_aria' => 'Sprache und persönlicher Bereich',
        'region' => [
            'name' => [
                'label' => 'Name der Region',
                'placeholder' => '',
                'help' => 'Bezeichnung, die in der oberen Leiste angezeigt wird.',
            ],
            'portal_aria' => [
                'label' => 'Zum Portal :region wechseln — externer Link — öffnet in einem neuen Tab',
                'placeholder' => '',
                'help' => '',
            ],
            'portal_title' => [
                'label' => 'Zum Portal :region',
                'placeholder' => '',
                'help' => '',
            ],
        ],
    ],
    'center' => [
        'brand' => [
            'title' => [
                'label' => 'Meine Gemeinde',
                'placeholder' => '',
                'help' => '',
            ],
            'tagline' => [
                'label' => 'Eine Gemeinde zum Leben',
                'placeholder' => '',
                'help' => '',
            ],
            'home_link' => [
                'title' => [
                    'label' => 'Zur Startseite',
                    'placeholder' => '',
                    'help' => '',
                ],
            ],
        ],
        'search' => [
            'label' => 'Suchen',
            'toggle_aria' => [
                'label' => 'Website durchsuchen',
                'placeholder' => '',
                'help' => '',
            ],
        ],
        'social' => [
            'follow' => [
                'label' => 'Folgen Sie uns auf',
                'placeholder' => '',
                'help' => '',
            ],
        ],
        'nav' => [
            'toggle_aria' => [
                'label' => 'Navigation anzeigen oder ausblenden',
                'placeholder' => '',
                'help' => '',
            ],
            'close_aria' => [
                'label' => 'Navigation schließen',
                'placeholder' => '',
                'help' => '',
            ],
            'primary_aria' => [
                'label' => 'Hauptnavigation',
                'placeholder' => '',
                'help' => '',
            ],
            'secondary_aria' => [
                'label' => 'Sekundärnavigation',
                'placeholder' => '',
                'help' => '',
            ],
            'amministrazione' => [
                'label' => 'Verwaltung',
                'placeholder' => '',
                'help' => '',
            ],
            'novita' => [
                'label' => 'Nachrichten',
                'placeholder' => '',
                'help' => '',
            ],
            'servizi' => [
                'label' => 'Dienste',
                'placeholder' => '',
                'help' => '',
            ],
            'vivere' => [
                'label' => 'Leben in der Gemeinde',
                'placeholder' => '',
                'help' => '',
            ],
            'iscrizioni' => [
                'label' => 'Anmeldungen',
                'placeholder' => '',
                'help' => '',
            ],
            'estate' => [
                'label' => 'Sommer in der Stadt',
                'placeholder' => '',
                'help' => '',
            ],
            'polizia' => [
                'label' => 'Ortspolizei',
                'placeholder' => '',
                'help' => '',
            ],
            'argomenti' => [
                'label' => 'Alle Themen',
                'placeholder' => '',
                'help' => '',
            ],
            'hamburger_brand' => [
                'label' => 'Name der Gemeinde',
                'placeholder' => '',
                'help' => '',
            ],
        ],
    ],
    'language' => [
        'active_prefix' => [
            'label' => 'Aktuelle Sprache:',
            'placeholder' => '',
            'help' => '',
        ],
        'code_it' => [
            'label' => 'ITA',
            'placeholder' => '',
            'help' => '',
        ],
        'code_en' => [
            'label' => 'ENG',
            'placeholder' => '',
            'help' => '',
        ],
        'selected_suffix' => [
            'label' => 'ausgewählt',
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
