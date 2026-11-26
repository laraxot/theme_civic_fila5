<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): service_report. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'meta' => [
        'title' => '[[MT-REV]] Report a local issue',
        'description' => '[[MT-REV]] Learn how to submit a report to the municipality.',
        'breadcrumb' => '[[MT-REV]] Report a local issue',
    ],
    'breadcrumb' => [
        'aria' => '[[MT-REV]] Breadcrumb',
        'home' => 'Paġna ewlenija',
        'services' => 'Servizzi',
        'current' => '[[MT-REV]] Report a local issue',
    ],
    'eyebrow' => '[[MT-REV]] Digital service',
    'hero' => [
        'title' => '[[MT-REV]] Report a local issue',
        'description' => '[[MT-REV]] Tell the municipality about a problem in a public place and help it respond more quickly and transparently.',
    ],
    'sections' => [
        'who' => [
            'title' => '[[MT-REV]] Who can use it',
            'body' => '[[MT-REV]] Anyone who wants to report a problem or issue in the municipal area.',
        ],
        'how' => [
            'title' => '[[MT-REV]] How it works',
            'steps' => [
                'one' => '[[MT-REV]] Sign in or create an account.',
                'two' => '[[MT-REV]] Read the privacy notice published by the municipality and complete the required step.',
                'three' => '[[MT-REV]] Choose the issue type, describe it and specify the location; you can attach a photo.',
                'four' => '[[MT-REV]] Review the summary and submit the report.',
                'five' => '[[MT-REV]] Receive a tracking code and follow updates in your personal area.',
            ],
        ],
    ],
    'details' => [
        'aria' => '[[MT-REV]] Service information',
        'requirements' => [
            'title' => '[[MT-REV]] What you need',
            'body' => '[[MT-REV]] A clear description, the location and, if useful, a photograph.',
        ],
        'outcome' => [
            'title' => '[[MT-REV]] What you get',
            'body' => '[[MT-REV]] A tracking code to follow updates about your report.',
        ],
        'duration' => [
            'title' => '[[MT-REV]] Time required',
            'body' => '[[MT-REV]] Submitting a report takes a few minutes. Response times depend on the issue.',
        ],
        'cost' => [
            'title' => '[[MT-REV]] Cost',
            'body' => '[[MT-REV]] The service is free.',
        ],
    ],
    'access' => [
        'title' => '[[MT-REV]] Open the service',
        'body' => '[[MT-REV]] Sign in to submit a report.',
        'cta' => '[[MT-REV]] Start a report',
        'all_reports' => '[[MT-REV]] All reports',
        'note' => '[[MT-REV]] You can follow its status from your personal area.',
    ],
];
