<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): flow_assistance. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'dettagli' => [
        'attach_documents_optional' => [
            'label' => '[[MT-REV]] Attach documents (optional)',
        ],
        'describe_your_problem_or_request_in' => [
            'placeholder' => '[[MT-REV]] Describe your problem or request in detail...',
        ],
        'minimum_20_characters' => [
            'label' => '[[MT-REV]] Minimum 20 characters',
        ],
        'subject_of_your_request' => [
            'placeholder' => '[[MT-REV]] Subject of your request',
        ],
        'pdf_doc_docx_up_to_10mb' => [
            'label' => '[[MT-REV]] PDF, DOC, DOCX up to 10MB',
        ],
        'select_a_type' => [
            'label' => '[[MT-REV]] Select a type',
        ],
        'describe_the_problem_you_need_help' => [
            'help' => '[[MT-REV]] Describe the problem you need help with',
        ],
        'information_about_a_service' => [
            'label' => '[[MT-REV]] Information about a service',
        ],
        'information_request' => [
            'label' => '[[MT-REV]] Information request',
        ],
        'problem_report' => [
            'label' => '[[MT-REV]] Problem report',
        ],
        'technical_support' => [
            'label' => '[[MT-REV]] Technical support',
        ],
    ],
    'conferma' => [
        'request_code' => [
            'label' => '[[MT-REV]] Request code',
        ],
        'submit_another_request' => [
            'label' => '[[MT-REV]] Submit another request',
        ],
        'you_will_receive_a_confirmation_email' => [
            'message' => '[[MT-REV]] You will receive a confirmation email with your request code. You can track the status of the reply through the portal.',
        ],
        'assistance_request_sent' => [
            'message' => '[[MT-REV]] Assistance request sent!',
        ],
        'we_will_reply_within_2_working' => [
            'label' => '[[MT-REV]] We will reply within 2 working days',
        ],
        'type' => [
            'label' => '[[MT-REV]] Type',
        ],
        'request_sent' => [
            'title' => '[[MT-REV]] Request sent',
        ],
    ],
    'riepilogo' => [
        'applicant_details' => [
            'label' => '[[MT-REV]] Applicant details',
        ],
        'request_details' => [
            'label' => '[[MT-REV]] Request details',
        ],
        'request_summary' => [
            'title' => '[[MT-REV]] Request summary',
        ],
    ],
    'shared' => [
        'message' => [
            'label' => '[[MT-REV]] Message',
        ],
        'subject' => [
            'label' => '[[MT-REV]] Subject',
        ],
        'request_type' => [
            'label' => '[[MT-REV]] Request type',
        ],
    ],
    'summary' => [
        'consent_privacy_terms' => [
            'message' => '[[MT-REV]] I have read and accept the :privacy and the :terms',
        ],
    ],
    'dati' => [
        'enter_your_details_for_the_assistance' => [
            'help' => '[[MT-REV]] Enter your details for the assistance request',
        ],
    ],
];
