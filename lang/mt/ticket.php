<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): ticket. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'next' => 'Li jmiss',
    'back' => 'Lura',
    'submit' => 'Ibgħat',
    'required' => '[[MT-REV]] required',
    'max_chars' => '[[MT-REV]] Max :max characters',
    'privacy' => [
        'title' => 'Politika tal-Privatezza',
        'description' => '[[MT-REV]] Read the policy before proceeding',
        'details' => '[[MT-REV]] For details on personal data processing, see the ',
        'link_label' => '[[MT-REV]] privacy policy.',
        'accept_label' => '[[MT-REV]] I have read and understood the privacy policy',
    ],
    'dati' => [
        'title' => '[[MT-REV]] Report Details',
        'place_label' => '[[MT-REV]] Issue Location',
        'place_placeholder' => '[[MT-REV]] E.g.: Via Roma 1, Florence',
        'details_label' => '[[MT-REV]] Issue Details',
        'type_label' => '[[MT-REV]] Issue Type*',
        'type_select' => 'Agħżel...',
        'types' => [
            'verde' => '[[MT-REV]] Public greenery and urban furniture',
            'illuminazione' => '[[MT-REV]] Public lighting',
            'strade' => '[[MT-REV]] Road maintenance',
            'rifiuti' => 'Ġestjoni tal-iskart',
            'altro' => '[[MT-REV]] Other',
        ],
        'title_label' => 'Titlu',
        'title_placeholder' => '[[MT-REV]] Brief description of the problem',
        'description_label' => '[[MT-REV]] Description*',
        'description_placeholder' => '[[MT-REV]] Describe the issue...',
        'images_label' => 'Immaġini',
        'images_hint' => '[[MT-REV]] Select one or more images',
        'no_file' => '[[MT-REV]] No file selected',
    ],
    'riepilogo' => [
        'title' => '[[MT-REV]] Report Summary',
        'warning_title' => '[[MT-REV]] Warning',
        'warning_text' => '[[MT-REV]] The information provided has declarative value. Please verify that it is correct.',
        'disservizio_section' => '[[MT-REV]] Issue',
        'contacts_section' => 'Kuntatti',
        'terms_label' => '[[MT-REV]] I confirm that the information is truthful and accept the',
        'terms_link' => '[[MT-REV]] terms of service',
        'submit_label' => '[[MT-REV]] Submit report',
    ],
    'conferma' => [
        'title' => '[[MT-REV]] Report Submitted',
        'subtitle' => '[[MT-REV]] Thank you, we have received your <strong>report :code.</strong>',
        'visibility' => '[[MT-REV]] It will be visible on the <a href=":url" class="t-primary">list of all reports</a> once taken charge by the administration.',
        'email_sent' => '[[MT-REV]] We have sent the summary to the email:<br><strong>:email</strong>',
        'download_receipt' => '[[MT-REV]] Download receipt (PDF 100KB)',
        'consult_request' => '[[MT-REV]] Consult the request',
        'in_area' => '[[MT-REV]] in your reserved area',
        'related_services' => '[[MT-REV]] Related Services',
    ],
    'elenco' => [
        'title' => '[[MT-REV]] Reports List',
        'subtitle' => '[[MT-REV]] In the last 12 months, :count reports have been resolved.',
        'results' => ':count Riżultati',
        'map_tab' => 'Mappa',
        'list_tab' => 'Lista',
        'make_report_title' => '[[MT-REV]] Make a Report',
        'make_report_text' => '[[MT-REV]] If you want to add a report, you can do so after authenticating with your SPID or CIE credentials.',
        'make_report_btn' => '[[MT-REV]] Report Issue',
        'load_more' => '[[MT-REV]] Load more reports',
        'rating_question' => '[[MT-REV]] How easy was it to use this service?',
        'rating_legend' => '[[MT-REV]] Rate from 1 to 5 stars',
    ],
    'contacts' => [
        'title' => '[[MT-REV]] Contact the Municipality',
        'faq' => '[[MT-REV]] Read FAQs',
        'assistance' => '[[MT-REV]] Request Assistance',
        'phone' => '[[MT-REV]] Call toll-free number 05 0505',
        'appointment' => '[[MT-REV]] Book Appointment',
    ],
];
