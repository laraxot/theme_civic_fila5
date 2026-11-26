<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): components_common. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'actions' => [
        'close' => [
            'label' => 'Agħlaq',
        ],
        'close_aria' => [
            'label' => 'Agħlaq',
        ],
        'read_more' => [
            'label' => 'Aqra aktar',
        ],
        'read_all' => [
            'label' => '[[MT-REV]] Read all',
        ],
        'load_more_results' => [
            'label' => '[[MT-REV]] Load more results',
        ],
        'download' => [
            'label' => 'Niżżel',
        ],
        'apply' => [
            'label' => '[[MT-REV]] Apply',
        ],
        'submit' => [
            'label' => 'Ibgħat',
        ],
        'discover_more' => [
            'label' => '[[MT-REV]] Learn more',
        ],
        'close_modal' => [
            'label' => '[[MT-REV]] Close modal window',
        ],
        'edit' => [
            'label' => '[[MT-REV]] Edit',
        ],
        'close_alert' => [
            'label' => '[[MT-REV]] Close alert',
        ],
        'close_notification' => [
            'label' => '[[MT-REV]] Close notification',
        ],
        'confirm' => [
            'label' => 'Ikkonferma',
        ],
        'cancel' => [
            'label' => 'Ikkanċella',
        ],
        'close_callout' => [
            'label' => '[[MT-REV]] Close callout',
        ],
        'dismiss' => [
            'label' => '[[MT-REV]] Dismiss',
        ],
        'reset' => [
            'label' => '[[MT-REV]] Reset',
        ],
        'view' => [
            'label' => '[[MT-REV]] View',
        ],
    ],
    'fields' => [
        'report' => [
            'label' => 'Rapport',
        ],
        'types' => [
            'label' => '[[MT-REV]] Types',
        ],
        'category_colon' => [
            'label' => '[[MT-REV]] Category:',
        ],
        'rating' => [
            'label' => '[[MT-REV]] Rating',
        ],
        'status_colon' => [
            'label' => '[[MT-REV]] Status:',
        ],
        'detail' => [
            'label' => '[[MT-REV]] Detail',
        ],
        'office' => [
            'label' => 'Uffiċċju',
        ],
        'contact_details' => [
            'label' => '[[MT-REV]] Contact details',
        ],
        'hours' => [
            'label' => '[[MT-REV]] Opening hours',
        ],
        'service' => [
            'label' => '[[MT-REV]] Service',
        ],
        'category_lower' => [
            'label' => '[[MT-REV]] category',
        ],
        'details' => [
            'label' => 'Dettalji',
        ],
        'date' => [
            'label' => 'Data',
        ],
        'place' => [
            'label' => '[[MT-REV]] Place',
        ],
        'status' => [
            'label' => '[[MT-REV]] Status',
        ],
        'images' => [
            'label' => 'Immaġini',
        ],
        'title' => [
            'label' => 'Titlu',
        ],
        'topic' => [
            'label' => '[[MT-REV]] Topic',
        ],
        'action' => [
            'label' => '[[MT-REV]] Action',
        ],
        'year' => [
            'label' => '[[MT-REV]] Year',
        ],
    ],
    'a11y' => [
        'logo' => [
            'label' => '[[MT-REV]] Logo',
        ],
        'toggle_navigation' => [
            'label' => '[[MT-REV]] Toggle navigation',
        ],
        'toggle_navigation_it' => [
            'label' => '[[MT-REV]] Show/Hide navigation',
        ],
        'main_navigation' => [
            'label' => 'Navigazzjoni ewlenija',
        ],
        'image' => [
            'label' => '[[MT-REV]] Image',
        ],
        'breadcrumb' => [
            'label' => '[[MT-REV]] Breadcrumb',
        ],
        'breadcrumb_trail' => [
            'label' => '[[MT-REV]] breadcrumb',
        ],
        'pagination' => [
            'label' => 'Paġinazzjoni',
        ],
        'navigation_path' => [
            'label' => '[[MT-REV]] Navigation path',
        ],
        'back_home' => [
            'label' => 'Lura lejn il-paġna ewlenija',
        ],
        'page_index' => [
            'label' => '[[MT-REV]] Page index',
        ],
        'secondary_navigation' => [
            'label' => '[[MT-REV]] Secondary navigation',
        ],
        'index_sections' => [
            'label' => '[[MT-REV]] Index sections',
        ],
        'bottom_navigation' => [
            'label' => '[[MT-REV]] Bottom navigation',
        ],
        'back_to_top' => [
            'label' => '[[MT-REV]] Back to top',
        ],
        'primary' => [
            'label' => '[[MT-REV]] Primary',
        ],
        'secondary' => [
            'label' => '[[MT-REV]] Secondary',
        ],
        'status_value' => [
            'label' => '[[MT-REV]] Status: :status',
        ],
        'badge_value' => [
            'label' => '[[MT-REV]] Badge: :badge',
        ],
        'entity_logo' => [
            'label' => '[[MT-REV]] Organisation logo',
        ],
    ],
    'pagination' => [
        'page' => [
            'label' => 'Paġna',
        ],
        'first' => [
            'label' => '[[MT-REV]] First page',
        ],
        'previous_page' => [
            'label' => 'Il-paġna ta’ qabel',
        ],
        'next_page' => [
            'label' => 'Il-paġna li jmiss',
        ],
        'last' => [
            'label' => '[[MT-REV]] Last page',
        ],
        'previous' => [
            'label' => 'Ta’ qabel',
        ],
        'next' => [
            'label' => 'Li jmiss',
        ],
    ],
    'form' => [
        'address_colon' => [
            'label' => 'Indirizz:',
        ],
        'phone_colon' => [
            'label' => 'Telefon:',
        ],
        'email_colon' => [
            'label' => 'Email:',
        ],
        'address' => [
            'label' => 'Indirizz',
        ],
        'other' => [
            'label' => '[[MT-REV]] Other',
        ],
        'tel_colon' => [
            'label' => '[[MT-REV]] Tel:',
        ],
        'email' => [
            'label' => 'Email',
        ],
    ],
    'nav' => [
        'home' => [
            'label' => 'Paġna ewlenija',
        ],
        'contacts' => [
            'label' => 'Kuntatti',
        ],
        'menu' => [
            'label' => 'Menu',
        ],
        'access' => [
            'label' => '[[MT-REV]] Access',
        ],
        'current_page' => [
            'label' => '[[MT-REV]] Current page',
        ],
    ],
    'search' => [
        'results_count' => [
            'label' => 'Riżultati',
        ],
    ],
    'states' => [
        'loading_in_progress' => [
            'label' => '[[MT-REV]] Loading...',
        ],
        'loading' => [
            'label' => '[[MT-REV]] Loading...',
        ],
    ],
    'skiplinks' => [
        'region' => [
            'label' => '[[MT-REV]] Skip links',
        ],
        'content' => [
            'label' => '[[MT-REV]] Skip to content',
        ],
        'navigation' => [
            'label' => '[[MT-REV]] Skip to navigation menu',
        ],
        'go_content' => [
            'label' => '[[MT-REV]] Go to content',
        ],
        'go_footer' => [
            'label' => '[[MT-REV]] Go to footer',
        ],
        'main_content' => [
            'label' => '[[MT-REV]] Skip to main content',
        ],
        'login_form' => [
            'label' => '[[MT-REV]] Go to the login form',
        ],
    ],
    'footer' => [
        'support' => [
            'label' => '[[MT-REV]] Support',
        ],
        'information' => [
            'label' => 'Informazzjoni',
        ],
        'help' => [
            'label' => '[[MT-REV]] Help',
        ],
        'agid_compliance' => [
            'text' => '[[MT-REV]] Compliant with AGID guidelines for digital services of the Public Administration',
        ],
    ],
    'carousel' => [
        'previous' => [
            'label' => 'Ta’ qabel',
        ],
        'next' => [
            'label' => 'Li jmiss',
        ],
        'slide' => [
            'label' => '[[MT-REV]] Slide :number',
        ],
    ],
    'rating' => [
        'current' => [
            'text' => '[[MT-REV]] Current rating: :value out of :max stars.',
        ],
        'levels' => [
            'terrible' => [
                'label' => '[[MT-REV]] Terrible',
            ],
            'poor' => [
                'label' => '[[MT-REV]] Poor',
            ],
            'fair' => [
                'label' => '[[MT-REV]] Fair',
            ],
            'good' => [
                'label' => '[[MT-REV]] Good',
            ],
            'excellent' => [
                'label' => '[[MT-REV]] Excellent',
            ],
        ],
        'rate_out_of' => [
            'label' => '[[MT-REV]] Rate :star stars out of :max',
        ],
    ],
    'brand' => [
        'entity_name' => [
            'label' => '[[MT-REV]] Organisation name',
        ],
        'digital_services' => [
            'text' => '[[MT-REV]] Digital services for citizens',
        ],
        'digital_services_short' => [
            'text' => '[[MT-REV]] Digital services',
        ],
        'municipality' => [
            'label' => '[[MT-REV]] Municipality',
        ],
    ],
    'fallback' => [
        'social' => [
            'label' => '[[MT-REV]] Social',
        ],
        'link' => [
            'label' => '[[MT-REV]] Link',
        ],
        'customer' => [
            'label' => '[[MT-REV]] Customer',
        ],
        'avatar' => [
            'label' => '[[MT-REV]] Avatar',
        ],
        'item' => [
            'label' => '[[MT-REV]] Item',
        ],
    ],
];
