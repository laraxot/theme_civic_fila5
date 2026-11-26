<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): components_municipal. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'accessibility' => [
        'non_accessible_intro' => [
            'text' => '[[MT-REV]] The following content is not fully accessible:',
        ],
        'preparation' => [
            'title' => '[[MT-REV]] Preparation of the statement',
        ],
        'report_intro' => [
            'text' => '[[MT-REV]] To report accessibility problems or request information:',
        ],
        'agid_form' => [
            'label' => '[[MT-REV]] AGID form',
        ],
        'report_to_agid' => [
            'label' => '[[MT-REV]] Report to AGID',
        ],
        'response_time' => [
            'text' => '[[MT-REV]] We commit to responding to reports within 15 working days.',
        ],
        'improvement' => [
            'title' => '[[MT-REV]] Improvement process',
        ],
        'in_progress' => [
            'label' => '[[MT-REV]] Accessibility in progress',
        ],
        'statement_intro' => [
            'text' => '[[MT-REV]] Accessibility statement of the institutional website of :municipality pursuant to Legislative Decree No. 82 of 7 March 2005 and subsequent amendments.',
        ],
        'compliance_line' => [
            'text' => '[[MT-REV]] :level with the WCAG 2.1 level AA guidelines',
        ],
        'last_update' => [
            'text' => '[[MT-REV]] Last updated: :date',
        ],
        'preparation_text' => [
            'text' => '[[MT-REV]] This statement was prepared on :date. It is based on a self-assessment carried out with automated tools and manual tests conducted by the municipality staff.',
        ],
        'improvement_text' => [
            'text' => '[[MT-REV]] :municipality is committed to continuously improving the accessibility of its website. Non-accessible content will be progressively brought in line with the guidelines.',
        ],
        'partially_compliant' => [
            'label' => '[[MT-REV]] Partially compliant',
        ],
        'issue_pdf' => [
            'label' => '[[MT-REV]] PDF documents not fully accessible',
        ],
        'issue_video' => [
            'label' => '[[MT-REV]] Some videos without subtitles',
        ],
        'issue_maps' => [
            'label' => '[[MT-REV]] Interactive maps with limited keyboard accessibility',
        ],
    ],
    'albo' => [
        'search' => [
            'placeholder' => '[[MT-REV]] Search by title or description...',
        ],
        'subtitle' => [
            'text' => '[[MT-REV]] Official publications of the municipality - Art. 32 Legislative Decree 33/2013',
        ],
        'publications' => [
            'label' => '[[MT-REV]] publications',
        ],
        'all' => [
            'label' => 'Kollha',
        ],
        'empty' => [
            'message' => '[[MT-REV]] No publications found',
        ],
        'shown' => [
            'label' => '[[MT-REV]] Shown',
        ],
        'results' => [
            'label' => 'riżultati',
        ],
    ],
];
