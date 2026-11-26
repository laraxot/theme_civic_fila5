<?php

declare(strict_types=1);

/*
 * Header (es). Catalogo esplicito: prima era `array_replace_recursive(en/header.php, [...])`, quindi ogni voce non
 * tradotta restava in inglese senza errori (13 voci, vedi docs/contracts/i18n-catalog-parity.md).
 * Chiavi `user.dropdown.*` lette da partials/user-dropdown.blade.php; `slim.tools_aria` distingue i landmark di navigazione (axe landmark-unique).
 */
return [
    'brand' => [
        'name' => 'FixCity',
    ],
    'guest' => [
        'login' => [
            'label' => 'Acceder',
            'placeholder' => '',
            'help' => '',
        ],
        'register' => [
            'label' => 'Registrarse',
            'placeholder' => '',
            'help' => '',
        ],
        'cta' => [
            'label' => 'Área personal',
            'placeholder' => '',
            'help' => 'Acceder al área personal.',
        ],
    ],
    'user' => [
        'unread_notifications' => 'notificaciones no leídas',
        'personal_area' => 'Área personal',
        'welcome' => [
            'label' => 'Hola, :name',
            'placeholder' => '',
            'help' => '',
        ],
        'aria' => [
            'toggle_menu' => [
                'label' => 'Abrir menú de usuario',
                'placeholder' => '',
                'help' => '',
            ],
        ],
        'dropdown' => [
            'my_reports' => [
                'label' => 'Mis incidencias',
            ],
            'followed_reports' => [
                'label' => 'Incidencias que sigo',
            ],
            'notification_center' => [
                'label' => 'Notificaciones',
            ],
            'settings_privacy' => [
                'label' => 'Ajustes y privacidad',
            ],
            'my_services' => [
                'label' => 'Mis servicios',
                'placeholder' => '',
                'help' => '',
            ],
            'my_practices' => [
                'label' => 'Mis trámites',
                'placeholder' => '',
                'help' => '',
            ],
            'notifications' => [
                'label' => 'Notificaciones',
                'placeholder' => '',
                'help' => '',
            ],
            'settings' => [
                'label' => 'Ajustes',
                'placeholder' => '',
                'help' => '',
            ],
            'logout' => [
                'label' => 'Cerrar sesión',
                'placeholder' => '',
                'help' => '',
            ],
        ],
    ],
    'slim' => [
        'tools_aria' => 'Idioma y área personal',
        'region' => [
            'name' => [
                'label' => 'Nombre de la región',
                'placeholder' => '',
                'help' => 'Texto que se muestra en la barra superior.',
            ],
            'portal_aria' => [
                'label' => 'Ir al portal :region — enlace externo — se abre en una pestaña nueva',
                'placeholder' => '',
                'help' => '',
            ],
            'portal_title' => [
                'label' => 'Ir al portal :region',
                'placeholder' => '',
                'help' => '',
            ],
        ],
    ],
    'center' => [
        'brand' => [
            'title' => [
                'label' => 'Mi Ayuntamiento',
                'placeholder' => '',
                'help' => '',
            ],
            'tagline' => [
                'label' => 'Una ciudad para vivir',
                'placeholder' => '',
                'help' => '',
            ],
            'home_link' => [
                'title' => [
                    'label' => 'Ir a la página de inicio',
                    'placeholder' => '',
                    'help' => '',
                ],
            ],
        ],
        'search' => [
            'label' => 'Buscar',
            'toggle_aria' => [
                'label' => 'Buscar en el sitio',
                'placeholder' => '',
                'help' => '',
            ],
        ],
        'social' => [
            'follow' => [
                'label' => 'Síguenos en',
                'placeholder' => '',
                'help' => '',
            ],
        ],
        'nav' => [
            'toggle_aria' => [
                'label' => 'Mostrar u ocultar la navegación',
                'placeholder' => '',
                'help' => '',
            ],
            'close_aria' => [
                'label' => 'Cerrar navegación',
                'placeholder' => '',
                'help' => '',
            ],
            'primary_aria' => [
                'label' => 'Navegación principal',
                'placeholder' => '',
                'help' => '',
            ],
            'secondary_aria' => [
                'label' => 'Navegación secundaria',
                'placeholder' => '',
                'help' => '',
            ],
            'amministrazione' => [
                'label' => 'Administración',
                'placeholder' => '',
                'help' => '',
            ],
            'novita' => [
                'label' => 'Noticias',
                'placeholder' => '',
                'help' => '',
            ],
            'servizi' => [
                'label' => 'Servicios',
                'placeholder' => '',
                'help' => '',
            ],
            'vivere' => [
                'label' => 'Vivir en el municipio',
                'placeholder' => '',
                'help' => '',
            ],
            'iscrizioni' => [
                'label' => 'Inscripciones',
                'placeholder' => '',
                'help' => '',
            ],
            'estate' => [
                'label' => 'Verano en la ciudad',
                'placeholder' => '',
                'help' => '',
            ],
            'polizia' => [
                'label' => 'Policía local',
                'placeholder' => '',
                'help' => '',
            ],
            'argomenti' => [
                'label' => 'Todos los temas',
                'placeholder' => '',
                'help' => '',
            ],
            'hamburger_brand' => [
                'label' => 'Nombre del Ayuntamiento',
                'placeholder' => '',
                'help' => '',
            ],
        ],
    ],
    'language' => [
        'active_prefix' => [
            'label' => 'Idioma actual:',
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
            'label' => 'seleccionado',
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
