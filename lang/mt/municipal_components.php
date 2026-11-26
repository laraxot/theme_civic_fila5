<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): municipal_components. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'breadcrumb' => [
        'back_to' => [
            'label' => '[[MT-REV]] Back to :title',
        ],
        'previous_page' => [
            'label' => '[[MT-REV]] previous page',
        ],
        'mobile_nav' => [
            'label' => '[[MT-REV]] Mobile navigation',
        ],
    ],
    'hero' => [
        'scroll' => [
            'label' => '[[MT-REV]] Scroll to see the content',
        ],
        'sidebar' => [
            'title' => [
                'label' => '[[MT-REV]] Quick access',
            ],
            'region' => [
                'label' => '[[MT-REV]] Quick links',
            ],
        ],
        'suggestions' => [
            'tenders' => [
                'label' => '[[MT-REV]] Calls for tenders',
            ],
            'building' => [
                'label' => '[[MT-REV]] Building',
            ],
            'taxes' => [
                'label' => 'Taxxi',
            ],
            'registry' => [
                'label' => '[[MT-REV]] Registry office',
            ],
            'title' => [
                'label' => '[[MT-REV]] Frequent searches:',
            ],
            'region' => [
                'label' => '[[MT-REV]] Search suggestions',
            ],
        ],
        'search' => [
            'help' => '[[MT-REV]] Press Enter or click the button to search',
            'placeholder' => '[[MT-REV]] Search services, information, documents...',
            'label' => '[[MT-REV]] Search services, information, documents',
        ],
        'search_submit' => [
            'label' => '[[MT-REV]] Start search',
        ],
        'search_region' => [
            'label' => '[[MT-REV]] Site search',
        ],
        'background_image' => [
            'label' => '[[MT-REV]] Background image :title',
        ],
        'section' => [
            'label' => '[[MT-REV]] Homepage main section',
        ],
    ],
    'office_map' => [
        'directions' => [
            'label' => '[[MT-REV]] Directions',
        ],
        'empty' => [
            'message' => '[[MT-REV]] No office found',
        ],
        'loading' => [
            'message' => '[[MT-REV]] Loading map...',
        ],
        'view_list' => [
            'label' => 'Lista',
        ],
        'category' => [
            'label' => 'Kategorija',
        ],
        'count' => [
            'label' => '[[MT-REV]] offices',
        ],
        'subtitle' => [
            'help' => '[[MT-REV]] Find the municipal offices and their contacts',
        ],
        'title' => [
            'label' => '[[MT-REV]] Offices and contacts',
        ],
    ],
    'service_card' => [
        'unavailable' => [
            'label' => '[[MT-REV]] Service temporarily unavailable',
        ],
        'available_soon' => [
            'label' => '[[MT-REV]] Available soon',
        ],
        'access' => [
            'label' => '[[MT-REV]] Access the service',
        ],
        'deadline' => [
            'label' => '[[MT-REV]] Deadline:',
        ],
        'under_maintenance' => [
            'label' => '[[MT-REV]] Service under maintenance',
        ],
        'categories' => [
            'label' => '[[MT-REV]] Service categories',
        ],
        'featured_badge' => [
            'label' => '[[MT-REV]] Featured',
        ],
        'featured' => [
            'label' => '[[MT-REV]] Featured service',
        ],
        'status_maintenance' => [
            'label' => '[[MT-REV]] Maintenance',
        ],
        'status' => [
            'label' => '[[MT-REV]] Service status:',
        ],
        'status_coming_soon' => [
            'label' => 'Dalwaqt',
        ],
    ],
    'service_form' => [
        'support' => [
            'label' => '[[MT-REV]] For assistance contact:',
        ],
        'new_request' => [
            'label' => '[[MT-REV]] New request',
        ],
        'case_number' => [
            'label' => '[[MT-REV]] Case number:',
        ],
        'success' => [
            'message' => '[[MT-REV]] Your request has been submitted successfully. You will shortly receive a confirmation email.',
        ],
        'submitting' => [
            'message' => '[[MT-REV]] Submitting...',
        ],
        'privacy_link' => [
            'label' => '[[MT-REV]] Read the privacy notice',
        ],
        'consent' => [
            'label' => '[[MT-REV]] I consent to the processing of my personal data pursuant to the GDPR and privacy legislation.',
        ],
        'summary_request_type' => [
            'label' => '[[MT-REV]] Request type:',
        ],
        'summary_phone' => [
            'label' => 'Telefon:',
        ],
        'summary_email' => [
            'label' => 'Email:',
        ],
        'summary_full_name' => [
            'label' => '[[MT-REV]] First and last name:',
        ],
        'summary_data' => [
            'label' => '[[MT-REV]] Data entered:',
        ],
        'summary' => [
            'title' => '[[MT-REV]] Summary and confirmation',
        ],
        'attachments' => [
            'help' => '[[MT-REV]] Max 5 files, 10MB in total',
            'label' => '[[MT-REV]] Attachments (optional)',
        ],
        'description' => [
            'placeholder' => '[[MT-REV]] Describe your request in detail...',
            'label' => 'Deskrizzjoni',
        ],
        'request_type_document' => [
            'label' => '[[MT-REV]] Document request',
        ],
        'request_type_issue' => [
            'label' => '[[MT-REV]] Problem report',
        ],
        'request_type_appointment' => [
            'label' => '[[MT-REV]] Appointment booking',
        ],
        'request_type_info' => [
            'label' => 'Informazzjoni',
        ],
        'request_type' => [
            'placeholder' => '[[MT-REV]] Select type...',
            'label' => '[[MT-REV]] Request type',
        ],
        'request' => [
            'title' => '[[MT-REV]] Request details',
        ],
        'address' => [
            'label' => 'Indirizz',
        ],
        'phone' => [
            'label' => 'Telefon',
        ],
        'email' => [
            'label' => 'Email',
        ],
        'last_name' => [
            'label' => '[[MT-REV]] Last name',
        ],
        'first_name' => [
            'label' => '[[MT-REV]] First name',
        ],
        'applicant' => [
            'title' => '[[MT-REV]] Applicant details',
        ],
        'progress_step' => [
            'label' => '[[MT-REV]] Step',
        ],
    ],
    'tenders' => [
        'results' => [
            'label' => 'riżultati',
        ],
        'shown' => [
            'label' => '[[MT-REV]] Showing',
        ],
        'info' => [
            'label' => '[[MT-REV]] Info',
        ],
        'download' => [
            'label' => 'Niżżel',
        ],
        'document' => [
            'label' => '[[MT-REV]] Document',
        ],
        'empty' => [
            'message' => '[[MT-REV]] No call or notice found',
        ],
        'reset' => [
            'label' => '[[MT-REV]] Reset',
        ],
        'status' => [
            'label' => '[[MT-REV]] Status',
        ],
        'type' => [
            'label' => '[[MT-REV]] Type',
        ],
        'search' => [
            'placeholder' => '[[MT-REV]] Search by title, description or reference...',
        ],
        'guide' => [
            'title' => '[[MT-REV]] User guide',
        ],
        'out_of' => [
            'label' => '[[MT-REV]] out of',
        ],
        'total' => [
            'label' => '[[MT-REV]] total',
        ],
        'subtitle' => [
            'help' => '[[MT-REV]] Opportunities and administrative procedures of the municipality',
        ],
    ],
    'transparency' => [
        'empty' => [
            'message' => '[[MT-REV]] No documents available in this section',
        ],
        'view' => [
            'label' => '[[MT-REV]] View',
        ],
        'updated' => [
            'label' => '[[MT-REV]] Updated:',
        ],
    ],
];
