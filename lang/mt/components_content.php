<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): components_content. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'topic' => [
        'managed_by' => [
            'label' => '[[MT-REV]] This topic is managed by:',
        ],
        'visit_site_colon' => [
            'label' => '[[MT-REV]] Visit the site:',
        ],
        'explore' => [
            'label' => '[[MT-REV]] Explore topic',
        ],
        'explore_short' => [
            'label' => '[[MT-REV]] Explore',
        ],
        'subtitle' => [
            'text' => '[[MT-REV]] Information and related services',
        ],
    ],
    'hero' => [
        'signal_eyebrow' => [
            'label' => '[[MT-REV]] CIVIC COMMITMENT',
        ],
        'eyebrow' => [
            'label' => '[[MT-REV]] DIGITAL SERVICES OF THE MUNICIPALITY',
        ],
        'heading' => [
            'title' => '[[MT-REV]] Reports and services for your community',
        ],
        'intro' => [
            'text' => '[[MT-REV]] Tell us what is not working, say where, and follow the updates in a simple and transparent way.',
        ],
        'view_reports' => [
            'label' => '[[MT-REV]] View reports',
        ],
        'municipality_name' => [
            'label' => '[[MT-REV]] Municipality name',
        ],
    ],
    'nav' => [
        'entity_site' => [
            'label' => '[[MT-REV]] Go to the organisation\'s website',
        ],
        'entity_site_short' => [
            'label' => '[[MT-REV]] Organisation site',
        ],
        'parent_entity' => [
            'label' => '[[MT-REV]] Parent organisation',
        ],
    ],
    'news' => [
        'reading_time_suffix' => [
            'label' => '[[MT-REV]] read',
        ],
        'empty' => [
            'message' => '[[MT-REV]] No news available',
        ],
        'read' => [
            'label' => '[[MT-REV]] Read: :title',
        ],
        'read_item' => [
            'label' => '[[MT-REV]] Read the news item: :title',
        ],
        'latest' => [
            'title' => '[[MT-REV]] Latest news',
        ],
    ],
    'resources' => [
        'empty' => [
            'message' => '[[MT-REV]] No resources available',
        ],
    ],
    'sidebar' => [
        'operating_system' => [
            'label' => '[[MT-REV]] Operating system',
        ],
    ],
    'sponsor' => [
        'section' => [
            'label' => '[[MT-REV]] Sponsors section',
        ],
        'empty' => [
            'message' => '[[MT-REV]] No sponsors configured.',
        ],
        'title' => [
            'label' => '[[MT-REV]] Sponsors',
        ],
        'subtitle' => [
            'label' => '[[MT-REV]] Our partners',
        ],
    ],
    'thematic' => [
        'visit_site' => [
            'label' => '[[MT-REV]] Visit the site',
        ],
    ],
    'video' => [
        'unsupported' => [
            'message' => '[[MT-REV]] Your browser does not support the video tag.',
        ],
        'transcript' => [
            'label' => '[[MT-REV]] Transcript',
        ],
    ],
    'services' => [
        'empty' => [
            'message' => '[[MT-REV]] No services available',
        ],
        'go_to_service' => [
            'label' => '[[MT-REV]] Go to the service',
        ],
    ],
    'service' => [
        'share' => [
            'label' => 'Aqsam',
        ],
        'see_actions' => [
            'label' => '[[MT-REV]] See actions',
        ],
        'page_index_caps' => [
            'label' => '[[MT-REV]] PAGE INDEX',
        ],
        'topics_colon' => [
            'label' => '[[MT-REV]] Topics:',
        ],
        'related' => [
            'title' => '[[MT-REV]] Related content',
        ],
    ],
    'topics' => [
        'featured' => [
            'title' => '[[MT-REV]] Featured topics',
        ],
        'show_all' => [
            'label' => 'Uri kollox',
        ],
    ],
];
