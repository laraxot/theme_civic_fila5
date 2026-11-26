<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): faq. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'meta' => [
        'title' => 'Mistoqsijiet frekwenti',
        'description' => '[[MT-REV]] Answers about the FixCity reporting service.',
        'breadcrumb' => 'Mistoqsijiet frekwenti',
    ],
    'intro' => '[[MT-REV]] Practical information about submitting a report, checking updates and protecting your data.',
    'items' => [
        0 => [
            'question' => '[[MT-REV]] How do I submit a report?',
            'answer' => '[[MT-REV]] Sign in to your account, open the reporting service and complete the required steps. You can review the summary before submitting.',
        ],
        1 => [
            'question' => '[[MT-REV]] Do I need an account to submit a report?',
            'answer' => '[[MT-REV]] Yes. If you are not signed in, the site takes you to the sign-in page before you continue.',
        ],
        2 => [
            'question' => '[[MT-REV]] How can I browse reports?',
            'answer' => '[[MT-REV]] You can explore the list and map of reports made public by the municipality. Some details are visible only to the owner or authorised staff.',
        ],
        3 => [
            'question' => '[[MT-REV]] How do I track a case?',
            'answer' => '[[MT-REV]] Enter the tracking code you received after submitting on the tracking page. Cases linked to your account are also available in your personal area.',
        ],
        4 => [
            'question' => '[[MT-REV]] Where can I find information about data processing?',
            'answer' => '[[MT-REV]] Read the privacy notice published for this service. If the notice is unavailable, the form does not allow a report to be submitted.',
        ],
    ],
    'links' => [
        'service' => '[[MT-REV]] Open the reporting service',
        'reports' => '[[MT-REV]] Browse reports',
        'tracking' => '[[MT-REV]] Open tracking',
        'privacy' => '[[MT-REV]] Read the privacy notice',
    ],
    'navigation' => [
        'label' => '[[MT-REV]] Related pages',
        'home' => 'Lura lejn il-paġna ewlenija',
    ],
    'search' => [
        'label' => '[[MT-REV]] Search questions',
        'placeholder' => 'Fittex',
        'submit' => 'Fittex',
        'empty' => '[[MT-REV]] No questions match your search.',
        'results' => '[[MT-REV]] Questions found: :count',
        'load_more' => '[[MT-REV]] Load more questions',
    ],
    'feedback' => [
        'title' => '[[MT-REV]] How clear is the information on this page?',
        'rating_label' => '[[MT-REV]] Rate the clarity of this page from one to five stars',
        'rate' => '[[MT-REV]] Rate',
        'out_of' => '[[MT-REV]] stars out of 5',
        'next' => 'Li jmiss',
        'back' => 'Lura',
        'positive_title' => '[[MT-REV]] Which aspects did you find most useful?',
        'negative_title' => '[[MT-REV]] Where did you experience the most difficulty?',
        'positive_options' => [
            0 => '[[MT-REV]] The instructions were clear',
            1 => '[[MT-REV]] The instructions were complete',
            2 => '[[MT-REV]] I always knew what to do next',
            3 => '[[MT-REV]] Other',
        ],
        'negative_options' => [
            0 => '[[MT-REV]] The instructions were unclear',
            1 => '[[MT-REV]] The instructions were incomplete',
            2 => '[[MT-REV]] I did not always know what to do next',
            3 => '[[MT-REV]] Other',
        ],
        'details_title' => '[[MT-REV]] Would you like to add more details?',
        'details_label' => 'Dettalji',
        'thanks' => '[[MT-REV]] Thank you. Your feedback will help us improve the service.',
    ],
    'contacts' => [
        'aria_label' => '[[MT-REV]] Contact options',
        'title' => '[[MT-REV]] Contact the municipality',
        'city_title' => '[[MT-REV]] Problems in the city',
        'report' => 'Ibgħat rapport',
        'track' => '[[MT-REV]] Track a report',
        'login' => '[[MT-REV]] Sign in to your personal area',
        'city_report' => 'Irrapporta problema',
    ],
];
