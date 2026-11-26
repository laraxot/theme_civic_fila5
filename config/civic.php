<?php

declare(strict_types=1);
use Themes\Civic\Filters\ActiveMenuFilter;
use Themes\Civic\Filters\GateMenuFilter;
use Themes\Civic\Filters\HrefMenuFilter;

return [
    /*
    | Civic's host may replace this configuration per tenant. Keep country,
    | language and presentation formats together so views do not encode them.
    */
    'default_country' => 'IT',
    'fallback_locale' => 'en',
    'supported_locales' => ['it', 'en', 'de', 'es', 'mt'],

    'countries' => [
        'IT' => [
            'locales' => ['it', 'en', 'de', 'es'],
            'entity' => [
                'singular' => 'Comune',
                'plural' => 'Comuni',
            ],
            // Profilo di terminologia in lang/<locale>/entity.php (`profiles.comune`).
            'entity_profile' => 'comune',
            'formats' => [
                'date' => 'dd/MM/yyyy',
                'address_format' => '{street}, {postcode} {locality} ({province}), {country}',
                'address_order' => ['street', 'postcode', 'locality', 'province', 'country'],
                'postcode_pattern' => '/^\d{5}$/',
                // Il CAP e' una stringa (lo zero iniziale conta): niente int.
                'postcode_normalize' => null,
                'phone_country_code' => '+39',
                // Numero nazionale: fisso `0…` (6-11 cifre) o mobile `3XX…` (10 cifre).
                'phone_pattern' => '/^(0\d{5,10}|3\d{9})$/',
                // Raggruppamento visuale non dichiarato: attende verifica dal piano
                // di numerazione (ADR 0012, conseguenza d).
                'phone_groups' => null,
            ],
        ],
        'MT' => [
            'locales' => ['en', 'mt'],
            'entity' => [
                'singular' => 'Local Council',
                'plural' => 'Local Councils',
            ],
            // Profilo di terminologia in lang/<locale>/entity.php (`profiles.local_council`).
            'entity_profile' => 'local_council',
            'formats' => [
                'date' => 'dd/MM/yyyy',
                'address_format' => '{street}, {locality} {postcode}, {country}',
                'address_order' => ['street', 'postcode', 'locality', 'country'],
                'postcode_pattern' => '/^[A-Z]{3}\s\d{4}$/i',
                // `vlt1117` → `VLT 1117`: maiuscole e spazio fra lettere e cifre.
                'postcode_normalize' => 'uppercase_space',
                'phone_country_code' => '+356',
                // Numero nazionale maltese: 8 cifre; prefisso 2 fisso, 7/9 mobile,
                // 8 non geografico (da confermare col MCA — ADR 0012).
                'phone_pattern' => '/^[2-9]\d{7}$/',
                // Raggruppamento visuale non dichiarato: attende verifica dal piano
                // di numerazione maltese o libphonenumber (ADR 0012, conseguenza d).
                'phone_groups' => null,
            ],
        ],
    ],

    'blog' => [
        'parity' => [
            'feedback' => [
                'title' => 'Quanto sono chiare le informazioni su questa pagina?',
                'legend' => 'Valuta da 1 a 5 stelle la pagina',
                'star_label' => 'Valuta %d stelle su 5',
                'thanks' => 'Grazie, il tuo parere ci aiuterà a migliorare il servizio!',
                'positive' => ['question' => 'Quali sono stati gli aspetti che hai preferito?', 'answers' => ['Le indicazioni erano chiare', 'Le indicazioni erano complete', 'Capivo sempre che stavo procedendo correttamente', 'Non ho avuto problemi tecnici', 'Altro']],
                'negative' => ['question' => 'Dove hai incontrato le maggiori difficoltà?', 'answers' => ['A volte le indicazioni non erano chiare', 'A volte le indicazioni non erano complete', 'A volte non capivo se stavo procedendo correttamente', 'Ho avuto problemi tecnici', 'Altro']],
                'detail' => ['question' => 'Vuoi aggiungere altri dettagli?', 'label' => 'Dettaglio', 'help' => 'Inserire massimo 200 caratteri'],
                'back' => 'Indietro',
                'next' => 'Avanti',
            ],
            'contacts' => [
                'main' => ['title' => 'Contatta il comune', 'items' => [
                    ['icon' => 'it-help-circle', 'label' => 'Leggi le domande frequenti', 'url' => '/domande-frequenti'],
                    ['icon' => 'it-mail', 'label' => 'Richiedi assistenza', 'url' => '/contatti', 'element' => 'contacts'],
                    ['icon' => 'it-hearing', 'label' => 'Chiama il numero verde :value', 'ente' => 'toll_free'],
                    ['icon' => 'it-calendar', 'label' => 'Prenota appuntamento', 'url' => '/servizi', 'element' => 'appointment-booking'],
                ]],
                'problems' => ['title' => 'Problemi in città', 'items' => [['icon' => 'it-map-marker-circle', 'label' => 'Segnala disservizio', 'url' => '/tickets/create']]],
            ],
        ],
    ],
    'events' => [
        'parity' => [
            'title' => 'Vivere il comune',
            'hero' => [
                'text' => 'Tutti gli eventi, le iniziative e i luoghi d’interesse per scoprire e vivere il territorio comunale.',
                'image' => ['file' => 'roma-colosseo.png', 'title' => 'Colosseo, Roma', 'alt' => 'Colosseo di Roma'],
                'caption' => 'Colosseo, Roma. Foto di Griffin Wooldridge.',
            ],
            'card' => ['read_more' => 'Leggi di più', 'read_more_aria' => 'Leggi di più sulla pagina di %s', 'read_more_hidden' => ''],
            'locations' => [
                ['image' => ['file' => 'luoghi-castello-1.png', 'title' => 'Il castello normanno', 'alt' => 'Il castello normanno'], 'title' => 'Il castello normanno', 'text' => 'Scopri la storia e i luoghi di interesse del territorio.'],
                ['image' => ['file' => 'luoghi-castello-2.png', 'title' => 'Il castello normanno', 'alt' => 'Il castello normanno'], 'title' => 'Il castello normanno', 'text' => 'Scopri il programma degli eventi dell’estate.'],
                ['image' => ['file' => 'luoghi-castello-3.png', 'title' => 'Il castello normanno', 'alt' => 'Il castello normanno'], 'title' => 'Il castello normanno', 'text' => 'Un luogo da vivere e conoscere.'],
                ['image' => ['file' => 'luoghi-gipsoteca.png', 'title' => 'La Gipsoteca canoviana', 'alt' => 'La Gipsoteca canoviana'], 'title' => 'La Gipsoteca canoviana', 'text' => 'Modelli in gesso e bozzetti dello scultore Antonio Canova.'],
                ['image' => ['file' => 'luoghi-tomba.png', 'title' => 'Tomba Brion', 'alt' => 'Tomba Brion'], 'title' => 'Tomba Brion', 'text' => 'Un luogo affascinante e ricco di simbologia.'],
                ['image' => ['file' => 'luoghi-castello-4.png', 'title' => 'Il castello normanno', 'alt' => 'Il castello normanno'], 'title' => 'Il castello normanno', 'text' => 'Un itinerario per scoprire il territorio.'],
            ],
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Civic Theme Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration file per il tema Civic Bootstrap Italia
    | Basato sul tema ufficiale italia/design-laravel-theme
    |
    */

    /*
    |--------------------------------------------------------------------------
    | App Information
    |--------------------------------------------------------------------------
    */
    'app' => [
        'name' => env('CIVIC_APP_NAME', config('app.name', 'Applicazione PA')),
        'tagline' => env('CIVIC_TAGLINE', 'Servizi digitali per i cittadini'),
        'description' => env('CIVIC_DESCRIPTION', 'Ente di appartenenza'),
        'version' => env('CIVIC_VERSION', '1.0.0'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Brand Configuration
    |--------------------------------------------------------------------------
    */
    'brand' => [
        'logo' => [
            'type' => env('CIVIC_LOGO_TYPE', 'icon'), // 'icon', 'image', 'text'
            'source' => env('CIVIC_LOGO_SOURCE', 'heroicon-o-building-office'),
            'alt' => env('CIVIC_LOGO_ALT', 'Logo istituzionale'),
            'width' => env('CIVIC_LOGO_WIDTH', 40),
            'height' => env('CIVIC_LOGO_HEIGHT', 40),
        ],
        'colors' => [
            'primary' => env('CIVIC_PRIMARY_COLOR', '#0066CC'),
            'secondary' => env('CIVIC_SECONDARY_COLOR', '#5A6772'),
            'success' => env('CIVIC_SUCCESS_COLOR', '#00B373'),
            'warning' => env('CIVIC_WARNING_COLOR', '#FFB400'),
            'danger' => env('CIVIC_DANGER_COLOR', '#D9364F'),
        ],
        'favicon' => env('CIVIC_FAVICON', '/favicon.ico'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Layout Configuration
    |--------------------------------------------------------------------------
    */
    'layout' => [
        'slim_header' => [
            'enabled' => env('CIVIC_SLIM_HEADER', true),
            'light_theme' => env('CIVIC_SLIM_HEADER_LIGHT', false),
            'show_owner' => env('CIVIC_SHOW_OWNER', true),
        ],
        'header' => [
            'small' => env('CIVIC_SMALL_HEADER', true),
            'sticky' => env('CIVIC_STICKY_HEADER', true),
            'show_search' => env('CIVIC_SHOW_SEARCH', true),
            'show_social' => env('CIVIC_SHOW_SOCIAL', true),
        ],
        'footer' => [
            'show_social' => env('CIVIC_FOOTER_SHOW_SOCIAL', true),
            'show_newsletter' => env('CIVIC_SHOW_NEWSLETTER', false),
            'show_contacts' => env('CIVIC_SHOW_CONTACTS', true),
            'show_address' => env('CIVIC_SHOW_ADDRESS', true),
        ],
        'breadcrumbs' => [
            'enabled' => env('CIVIC_BREADCRUMBS', true),
            'show_home' => env('CIVIC_BREADCRUMBS_HOME', true),
            'separator' => env('CIVIC_BREADCRUMBS_SEPARATOR', '/'),
        ],
        'back_to_top' => env('CIVIC_BACK_TO_TOP', true),
        'cookiebar' => env('CIVIC_COOKIEBAR', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Configuration
    |--------------------------------------------------------------------------
    */
    'auth' => [
        'enabled' => env('CIVIC_AUTH_ENABLED', true),
        'login' => [
            'route' => env('CIVIC_LOGIN_ROUTE', 'login'),
            'text' => 'Accedi',
            'icon' => 'heroicon-o-arrow-right-on-rectangle',
        ],
        'logout' => [
            'route' => env('CIVIC_LOGOUT_ROUTE', 'logout'),
            'method' => env('CIVIC_LOGOUT_METHOD', 'post'),
            'text' => 'Esci',
            'icon' => 'heroicon-o-arrow-left-on-rectangle',
        ],
        'register' => [
            'enabled' => env('CIVIC_REGISTER_ENABLED', true),
            'route' => env('CIVIC_REGISTER_ROUTE', 'register'),
            'text' => 'Registrati',
        ],
        'spid' => [
            'enabled' => env('CIVIC_SPID_ENABLED', false),
            'button_size' => env('CIVIC_SPID_BUTTON_SIZE', 'medium'), // small, medium, large
            'route' => env('CIVIC_SPID_ROUTE', 'spid.login'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes Configuration
    |--------------------------------------------------------------------------
    */
    'routes' => [
        'home' => [
            'route' => env('CIVIC_HOME_ROUTE', 'home'),
            'url' => env('CIVIC_HOME_URL', '/'),
        ],
        'search' => [
            'enabled' => env('CIVIC_SEARCH_ENABLED', true),
            'route' => env('CIVIC_SEARCH_ROUTE', 'search'),
            'placeholder' => 'Cerca nel sito...',
        ],
        'newsletter' => [
            'enabled' => env('CIVIC_NEWSLETTER_ENABLED', false),
            'route' => env('CIVIC_NEWSLETTER_ROUTE', 'newsletter'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Configuration
    |--------------------------------------------------------------------------
    */
    'menu' => [
        'slim_header' => [
            [
                'text' => 'Amministrazione Trasparente',
                'url' => '/amministrazione-trasparente',
                'icon' => 'heroicon-o-eye',
            ],
            [
                'text' => 'Contatti',
                'url' => '/contatti',
                'icon' => 'heroicon-o-phone',
            ],
        ],

        'header' => [
            [
                'text' => 'Home',
                'route' => 'home',
                'icon' => 'heroicon-o-home',
                'active_urls' => ['/', 'home'],
            ],
            [
                'text' => 'Servizi',
                'url' => '/servizi',
                'icon' => 'heroicon-o-cog-6-tooth',
                'dropdown' => [
                    [
                        'text' => 'Certificati anagrafici',
                        'url' => '/servizi/certificati',
                        'icon' => 'heroicon-o-document-text',
                    ],
                    [
                        'text' => 'Tributi e pagamenti',
                        'url' => '/servizi/tributi',
                        'icon' => 'heroicon-o-credit-card',
                    ],
                    [
                        'text' => 'Pratiche edilizie',
                        'url' => '/servizi/pratiche-edilizie',
                        'icon' => 'heroicon-o-building-office-2',
                    ],
                    '-',
                    [
                        'text' => 'Tutti i servizi',
                        'url' => '/servizi',
                        'icon' => 'heroicon-o-squares-2x2',
                    ],
                ],
            ],
            [
                'text' => 'Amministrazione',
                'url' => '/amministrazione',
                'icon' => 'heroicon-o-user-group',
                'megamenu' => [
                    [
                        'Organi di Governo',
                        [
                            'text' => 'Sindaco',
                            'url' => '/amministrazione/sindaco',
                            'icon' => 'heroicon-o-user',
                        ],
                        [
                            'text' => 'Giunta Comunale',
                            'url' => '/amministrazione/giunta',
                            'icon' => 'heroicon-o-users',
                        ],
                        [
                            'text' => 'Consiglio Comunale',
                            'url' => '/amministrazione/consiglio',
                            'icon' => 'heroicon-o-building-library',
                        ],
                    ],
                    [
                        'Uffici e Servizi',
                        [
                            'text' => 'Segreteria',
                            'url' => '/uffici/segreteria',
                            'icon' => 'heroicon-o-clipboard-document-list',
                        ],
                        [
                            'text' => 'Ufficio Tributi',
                            'url' => '/uffici/tributi',
                            'icon' => 'heroicon-o-calculator',
                        ],
                        [
                            'text' => 'Anagrafe',
                            'url' => '/uffici/anagrafe',
                            'icon' => 'heroicon-o-identification',
                        ],
                        [
                            'text' => 'URP',
                            'url' => '/uffici/urp',
                            'icon' => 'heroicon-o-chat-bubble-left-right',
                        ],
                    ],
                ],
            ],
            [
                'text' => 'Notizie',
                'url' => '/notizie',
                'icon' => 'heroicon-o-newspaper',
            ],
            [
                'text' => 'Eventi',
                'url' => '/eventi',
                'icon' => 'heroicon-o-calendar-days',
            ],
        ],

        'footer' => [
            [
                [
                    'text' => 'Amministrazione',
                    'url' => '/amministrazione',
                ],
                [
                    'text' => 'Sindaco',
                    'url' => '/amministrazione/sindaco',
                ],
                [
                    'text' => 'Giunta e Consiglio',
                    'url' => '/amministrazione/organi',
                ],
                [
                    'text' => 'Aree tematiche',
                    'url' => '/aree-tematiche',
                ],
                [
                    'text' => 'Documenti e dati',
                    'url' => '/documenti',
                ],
            ],
            [
                [
                    'text' => 'Servizi',
                    'url' => '/servizi',
                ],
                [
                    'text' => 'Certificati',
                    'url' => '/servizi/certificati',
                ],
                [
                    'text' => 'Pratiche online',
                    'url' => '/servizi/pratiche',
                ],
                [
                    'text' => 'Pagamenti',
                    'url' => '/servizi/pagamenti',
                ],
                [
                    'text' => 'Segnalazioni',
                    'url' => '/servizi/segnalazioni',
                ],
            ],
            [
                [
                    'text' => 'Vivere il comune',
                    'url' => '/vivere-comune',
                ],
                [
                    'text' => 'Luoghi',
                    'url' => '/luoghi',
                ],
                [
                    'text' => 'Eventi',
                    'url' => '/eventi',
                ],
                [
                    'text' => 'Associazioni',
                    'url' => '/associazioni',
                ],
                [
                    'text' => 'Trasporti',
                    'url' => '/trasporti',
                ],
            ],
        ],

        'footer_bar' => [
            [
                'text' => 'Privacy policy',
                'url' => '/privacy',
            ],
            [
                'text' => 'Note legali',
                'url' => '/note-legali',
            ],
            [
                'text' => 'Dichiarazione di accessibilità',
                'url' => '/accessibilita',
            ],
            [
                'text' => 'Mappa del sito',
                'url' => '/mappa-sito',
            ],
            [
                'text' => 'RSS',
                'url' => '/feed',
                'external' => true,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Contact Information
    |--------------------------------------------------------------------------
    */
    'contact' => [
        'address' => env('CIVIC_ADDRESS', 'Via Roma 1<br>00100 Roma (RM)'),
        'phone' => env('CIVIC_PHONE', '+39 06 12345678'),
        'fax' => env('CIVIC_FAX'),
        'email' => env('CIVIC_EMAIL', 'info@comune.esempio.it'),
        'pec' => env('CIVIC_PEC', 'protocollo@pec.comune.esempio.it'),
        'cf_piva' => env('CIVIC_CF_PIVA', '12345678901'),
        'ipa_code' => env('CIVIC_IPA_CODE', 'c_a123'),
        'urp' => [
            'enabled' => env('CIVIC_URP_ENABLED', true),
            'phone' => env('CIVIC_URP_PHONE'),
            'email' => env('CIVIC_URP_EMAIL'),
            'hours' => env('CIVIC_URP_HOURS', 'Lun-Ven: 9:00-12:00, 15:00-17:00'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Social Media Links
    |--------------------------------------------------------------------------
    */
    'social' => [
        'facebook' => env('CIVIC_FACEBOOK'),
        'twitter' => env('CIVIC_TWITTER'),
        'youtube' => env('CIVIC_YOUTUBE'),
        'instagram' => env('CIVIC_INSTAGRAM'),
        'linkedin' => env('CIVIC_LINKEDIN'),
        'telegram' => env('CIVIC_TELEGRAM'),
        'whatsapp' => env('CIVIC_WHATSAPP'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Filtri applicati agli elementi del menu prima del rendering
    |
    */
    'menu_filters' => [
        HrefMenuFilter::class,
        ActiveMenuFilter::class,
        GateMenuFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Integrations
    |--------------------------------------------------------------------------
    */
    'integrations' => [
        'analytics' => [
            'google_tag_id' => env('CIVIC_GOOGLE_TAG_ID'),
            'matomo_url' => env('CIVIC_MATOMO_URL'),
            'matomo_site_id' => env('CIVIC_MATOMO_SITE_ID'),
        ],
        'maps' => [
            'provider' => env('CIVIC_MAPS_PROVIDER', 'osm'), // 'google', 'osm', 'mapbox'
            'api_key' => env('CIVIC_MAPS_API_KEY'),
            'default_zoom' => env('CIVIC_MAPS_ZOOM', 15),
        ],
        'recaptcha' => [
            'enabled' => env('CIVIC_RECAPTCHA_ENABLED', false),
            'site_key' => env('CIVIC_RECAPTCHA_SITE_KEY'),
            'secret_key' => env('CIVIC_RECAPTCHA_SECRET_KEY'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Performance Settings
    |--------------------------------------------------------------------------
    */
    'performance' => [
        'cdn_enabled' => env('CIVIC_CDN_ENABLED', false),
        'lazy_loading' => env('CIVIC_LAZY_LOADING', true),
        'preload_critical_css' => env('CIVIC_PRELOAD_CSS', true),
        'minify_html' => env('CIVIC_MINIFY_HTML', false),
        'cache_menu' => env('CIVIC_CACHE_MENU', true),
        'cache_ttl' => env('CIVIC_CACHE_TTL', 3600), // secondi
    ],

    /*
    |--------------------------------------------------------------------------
    | SEO Configuration
    |--------------------------------------------------------------------------
    */
    'seo' => [
        'meta' => [
            'description' => env('CIVIC_META_DESCRIPTION', 'Sito ufficiale del Comune - Servizi digitali per i cittadini'),
            'keywords' => env('CIVIC_META_KEYWORDS', 'comune, servizi, cittadini, pubblica amministrazione'),
            'author' => env('CIVIC_META_AUTHOR', 'Comune'),
            'robots' => env('CIVIC_META_ROBOTS', 'index, follow'),
        ],
        'og' => [
            'enabled' => env('CIVIC_OG_ENABLED', true),
            'image' => env('CIVIC_OG_IMAGE', '/images/og-image.jpg'),
            'locale' => env('CIVIC_OG_LOCALE', 'it_IT'),
        ],
        'schema' => [
            'enabled' => env('CIVIC_SCHEMA_ENABLED', true),
            'organization_type' => env('CIVIC_SCHEMA_ORG_TYPE', 'GovernmentOrganization'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Accessibility
    |--------------------------------------------------------------------------
    */
    'accessibility' => [
        'skip_links' => env('CIVIC_SKIP_LINKS', true),
        'high_contrast' => env('CIVIC_HIGH_CONTRAST', false),
        'font_size_controls' => env('CIVIC_FONT_SIZE_CONTROLS', false),
        'keyboard_navigation' => env('CIVIC_KEYBOARD_NAV', true),
        'screen_reader_content' => env('CIVIC_SCREEN_READER', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Development & Debug
    |--------------------------------------------------------------------------
    */
    'debug' => [
        'show_menu_debug' => env('CIVIC_DEBUG_MENU', false),
        'show_component_info' => env('CIVIC_DEBUG_COMPONENTS', false),
        'log_menu_build' => env('CIVIC_LOG_MENU', false),
    ],
];
