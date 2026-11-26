<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): services. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'meta' => [
        'title' => '[[MT-REV]] Services for your city',
        'description' => '[[MT-REV]] Report a local issue, browse public reports or track a request.',
        'breadcrumb' => 'Servizzi',
    ],
    'hero' => [
        'title' => '[[MT-REV]] Services for your city',
        'subtitle' => '[[MT-REV]] Submit a report, browse public reports or track a request using its tracking code.',
        'search_label' => '[[MT-REV]] Search available tasks',
        'search_placeholder' => '[[MT-REV]] Search tasks...',
    ],
    'nav' => [
        'aria' => '[[MT-REV]] Available tasks',
        'report' => 'Ibgħat rapport',
        'browse' => '[[MT-REV]] Browse reports',
        'track' => '[[MT-REV]] Track a request',
    ],
    'featured' => [
        'title' => '[[MT-REV]] What you can do',
        'subtitle' => '[[MT-REV]] Choose a task to open an available Fixcity journey.',
    ],
    'card' => [
        'featured' => '[[MT-REV]] Featured',
        'access' => '[[MT-REV]] Open service',
        'access_aria' => '[[MT-REV]] Open service: :title',
        'status' => [
            'active' => '[[MT-REV]] Available',
            'inactive' => '[[MT-REV]] Unavailable',
            'maintenance' => '[[MT-REV]] Under maintenance',
        ],
    ],
    'tasks' => [
        'report_title' => '[[MT-REV]] Report an issue',
        'report_body' => '[[MT-REV]] Describe a problem in a public place and send it to the responsible office.',
        'report_auth_note' => '[[MT-REV]] Sign in to your account to submit a report.',
        'report_action' => 'Ibgħat rapport',
        'browse_title' => '[[MT-REV]] Explore the map and list',
        'browse_body' => '[[MT-REV]] Browse public reports and see work in progress across the city.',
        'browse_action' => '[[MT-REV]] Open reports',
        'track_title' => '[[MT-REV]] Track a report',
        'track_body' => '[[MT-REV]] Check for updates with the tracking code received after submission.',
        'track_action' => '[[MT-REV]] Open tracking',
    ],
    'results' => [
        'singular' => '[[MT-REV]] task available',
        'plural' => '[[MT-REV]] tasks available',
        'empty' => '[[MT-REV]] No tasks match your search. Try different words.',
    ],
    'categories' => [
        'title' => '[[MT-REV]] Report categories',
        'subtitle' => '[[MT-REV]] Choose the type of problem you want to report or browse reports already made public.',
        'actions' => [
            'aria' => '[[MT-REV]] Report actions',
            'report' => 'Irrapporta problema',
            'browse' => '[[MT-REV]] Browse reports',
        ],
        'directory' => [
            'title' => '[[MT-REV]] Explore by category',
            'subcategories' => '[[MT-REV]] Subcategories',
            'empty' => '[[MT-REV]] Categories are not available yet. You can still browse public reports.',
        ],
        'items' => [
            'reports' => [
                'title' => '[[MT-REV]] Public reports',
                'description' => '[[MT-REV]] Browse reports made public by the municipality and see intervention updates.',
            ],
        ],
    ],
];
