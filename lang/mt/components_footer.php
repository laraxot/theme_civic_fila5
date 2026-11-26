<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): components_footer. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'contacts' => [
        'urp_short' => [
            'label' => '[[MT-REV]] Public Relations Office (URP):',
        ],
        'urp' => [
            'label' => '[[MT-REV]] Public Relations Office',
        ],
        'pec' => [
            'label' => '[[MT-REV]] Certified Email',
        ],
        'urp_full' => [
            'label' => '[[MT-REV]] URP - Public Relations Office',
        ],
        'tax_code_vat' => [
            'label' => '[[MT-REV]] Tax code / VAT no.:',
        ],
        'toll_free' => [
            'label' => '[[MT-REV]] Toll-free number:',
        ],
        'sms_whatsapp' => [
            'label' => '[[MT-REV]] SMS and WhatsApp:',
        ],
        'switchboard_single' => [
            'label' => '[[MT-REV]] Single switchboard:',
        ],
        'switchboard' => [
            'label' => '[[MT-REV]] Switchboard:',
        ],
    ],
    'eu' => [
        'logo_alt' => [
            'label' => '[[MT-REV]] European Union logo',
        ],
    ],
    'admin' => [
        'governing_bodies' => [
            'label' => '[[MT-REV]] Governing bodies',
        ],
        'administrative_areas' => [
            'label' => '[[MT-REV]] Administrative areas',
        ],
        'offices' => [
            'label' => 'Uffiċċji',
        ],
        'bodies_foundations' => [
            'label' => '[[MT-REV]] Bodies and foundations',
        ],
        'politicians' => [
            'label' => '[[MT-REV]] Politicians',
        ],
        'staff' => [
            'label' => '[[MT-REV]] Administrative staff',
        ],
        'documents_data' => [
            'label' => 'Dokumenti u dejta',
        ],
    ],
    'services' => [
        'heading_lower' => [
            'label' => '[[MT-REV]] Service categories',
        ],
        'registry_civil' => [
            'label' => '[[MT-REV]] Registry and civil status',
        ],
        'culture_leisure' => [
            'label' => '[[MT-REV]] Culture and leisure',
        ],
        'work_life' => [
            'label' => '[[MT-REV]] Working life',
        ],
        'business_commerce' => [
            'label' => '[[MT-REV]] Businesses and commerce',
        ],
        'public_procurement' => [
            'label' => '[[MT-REV]] Public procurement',
        ],
        'land_registry_planning' => [
            'label' => '[[MT-REV]] Land registry and urban planning',
        ],
        'tourism' => [
            'label' => 'Turiżmu',
        ],
        'mobility_transport' => [
            'label' => '[[MT-REV]] Mobility and transport',
        ],
        'education_training' => [
            'label' => '[[MT-REV]] Education and training',
        ],
        'justice_security' => [
            'label' => '[[MT-REV]] Justice and public safety',
        ],
        'taxes_finance_fines' => [
            'label' => '[[MT-REV]] Taxes, finance and fines',
        ],
        'environment' => [
            'label' => 'Ambjent',
        ],
        'health_welfare' => [
            'label' => '[[MT-REV]] Health, wellbeing and care',
        ],
        'permits' => [
            'label' => '[[MT-REV]] Permits',
        ],
        'agriculture_fishing' => [
            'label' => '[[MT-REV]] Agriculture and fishing',
        ],
        'heading' => [
            'label' => '[[MT-REV]] Service categories',
        ],
        'registry' => [
            'label' => '[[MT-REV]] Registry office',
        ],
        'culture' => [
            'label' => '[[MT-REV]] Culture',
        ],
        'businesses' => [
            'label' => '[[MT-REV]] Businesses',
        ],
        'procurement' => [
            'label' => '[[MT-REV]] Procurement',
        ],
        'land_registry' => [
            'label' => '[[MT-REV]] Land registry',
        ],
        'mobility' => [
            'label' => '[[MT-REV]] Mobility',
        ],
        'education' => [
            'label' => 'Edukazzjoni',
        ],
        'justice' => [
            'label' => '[[MT-REV]] Justice',
        ],
        'taxes' => [
            'label' => 'Taxxi',
        ],
        'health' => [
            'label' => '[[MT-REV]] Health',
        ],
        'agriculture' => [
            'label' => '[[MT-REV]] Agriculture',
        ],
    ],
    'news' => [
        'news' => [
            'label' => 'Aħbarijiet',
        ],
        'press_releases' => [
            'label' => 'Stqarrijiet għall-istampa',
        ],
        'notices' => [
            'label' => 'Avviżi',
        ],
    ],
    'live' => [
        'places' => [
            'label' => '[[MT-REV]] Places',
        ],
        'events' => [
            'label' => 'Avvenimenti',
        ],
        'heading_lower' => [
            'label' => '[[MT-REV]] Living in the municipality',
        ],
    ],
    'help' => [
        'read_faq' => [
            'label' => 'Aqra l-FAQ',
        ],
        'appointment_booking' => [
            'label' => '[[MT-REV]] Book an appointment',
        ],
        'report_issue' => [
            'label' => '[[MT-REV]] Report a service issue',
        ],
        'support_request' => [
            'label' => '[[MT-REV]] Support request',
        ],
        'faq' => [
            'label' => 'FAQ',
        ],
        'appointment' => [
            'label' => 'Appuntament',
        ],
    ],
    'legal' => [
        'transparent_administration' => [
            'label' => '[[MT-REV]] Transparent administration',
        ],
        'privacy_short' => [
            'label' => 'Privatezza',
        ],
        'rights_reserved' => [
            'label' => '[[MT-REV]] . All rights reserved.',
        ],
    ],
    'newsletter' => [
        'email' => [
            'placeholder' => 'L-email tiegħek',
        ],
        'title' => [
            'label' => 'Newsletter',
        ],
        'intro' => [
            'text' => '[[MT-REV]] Stay up to date with the latest news',
        ],
        'subscribe' => [
            'label' => 'Abbona',
        ],
    ],
    'social' => [
        'follow_us_social' => [
            'label' => '[[MT-REV]] Follow us on social media',
        ],
    ],
    'sponsors' => [
        'disclosure' => [
            'text' => '[[MT-REV]] Partners and supporters support this public service transparently, without commercial tracking or special privileges.',
        ],
        'logo_alt' => [
            'label' => '[[MT-REV]] Partner logo :partner',
        ],
        'title' => [
            'label' => '[[MT-REV]] Partners and Supporters',
        ],
        'description' => [
            'text' => '[[MT-REV]] Thanks to our partners and supporters who make this service possible.',
        ],
    ],
    'institutional' => [
        'quick_links' => [
            'label' => '[[MT-REV]] Quick links',
        ],
    ],
    'ads' => [
        'desktop' => [
            'label' => '[[MT-REV]] Space for sale - Desktop',
        ],
        'tablet' => [
            'label' => '[[MT-REV]] Space for sale - Tablet',
        ],
        'mobile' => [
            'label' => '[[MT-REV]] Space for sale - Mobile',
        ],
    ],
];
