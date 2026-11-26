<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): flow_report. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'shared' => [
        'attach_photos_optional' => [
            'label' => '[[MT-REV]] Attach photos (optional)',
        ],
        'active' => [
            'label' => '[[MT-REV]] Active',
        ],
        'brief_description_of_the_problem' => [
            'placeholder' => '[[MT-REV]] Brief description of the problem',
        ],
        'category' => [
            'label' => 'Kategorija',
        ],
        'confirmed' => [
            'label' => 'Ikkonfermat',
        ],
        'contact_the_municipality' => [
            'label' => '[[MT-REV]] Contact the municipality',
        ],
        'describe_the_problem_you_encountered_in' => [
            'placeholder' => '[[MT-REV]] Describe the problem you encountered in as much detail as possible...',
        ],
        'detailed_description' => [
            'label' => '[[MT-REV]] Detailed description',
        ],
        'address_or_description_of_the_place' => [
            'placeholder' => '[[MT-REV]] Address or description of the place',
        ],
        'place_of_the_service_issue' => [
            'label' => '[[MT-REV]] Place of the service issue',
        ],
        'max_100_characters' => [
            'label' => '[[MT-REV]] Max 100 characters',
        ],
        'png_jpg_up_to_10mb' => [
            'label' => '[[MT-REV]] PNG, JPG up to 10MB',
        ],
        'service_issue_report' => [
            'label' => '[[MT-REV]] Service issue report',
        ],
        'select_a_category' => [
            'label' => '[[MT-REV]] Select a category',
        ],
        'report_title' => [
            'label' => '[[MT-REV]] Report title',
        ],
        'report_details' => [
            'title' => '[[MT-REV]] Report details',
        ],
        'public_lighting' => [
            'label' => '[[MT-REV]] Public lighting',
        ],
        'waste_and_cleaning' => [
            'label' => '[[MT-REV]] Waste and cleaning',
        ],
        'roads_and_pavements' => [
            'label' => '[[MT-REV]] Roads and pavements',
        ],
        'public_transport' => [
            'label' => 'Trasport pubbliku',
        ],
        'public_green_spaces' => [
            'label' => '[[MT-REV]] Public green spaces',
        ],
    ],
    'riepilogo' => [
        'general_data' => [
            'label' => '[[MT-REV]] General Data',
        ],
        'images' => [
            'label' => 'Immaġini',
        ],
        'address' => [
            'label' => 'Indirizz',
        ],
        'edit' => [
            'label' => '[[MT-REV]] Edit',
        ],
        'report' => [
            'label' => 'Rapport',
        ],
        'step' => [
            'label' => '[[MT-REV]] Step',
        ],
        'type_of_service_issue' => [
            'label' => '[[MT-REV]] Type of service issue',
        ],
        'title' => [
            'label' => 'Titlu',
        ],
    ],
    'dati' => [
        'describe_the_service_issue' => [
            'placeholder' => '[[MT-REV]] Describe the service issue',
        ],
        'describe_the_service_issue_you_encountered' => [
            'label' => '[[MT-REV]] Describe the service issue you encountered',
        ],
        'supported_formats_jpg_png_pdf_max' => [
            'message' => '[[MT-REV]] Supported formats: JPG, PNG, PDF. Max 10MB.',
        ],
        'the_author_s_details_are_pre' => [
            'label' => '[[MT-REV]] The author\'s details are pre-filled from the digital identity',
        ],
        'required_information' => [
            'label' => '[[MT-REV]] REQUIRED INFORMATION',
        ],
        'indicate_the_place_of_the_service' => [
            'label' => '[[MT-REV]] Indicate the place of the service issue',
        ],
        'max_200_characters' => [
            'label' => '[[MT-REV]] Max 200 characters',
        ],
        'no_file_selected' => [
            'label' => '[[MT-REV]] No file selected',
        ],
        'select_the_type_of_service_issue' => [
            'label' => '[[MT-REV]] Select the type of service issue',
        ],
        'report_title' => [
            'placeholder' => '[[MT-REV]] Report title',
        ],
    ],
    'conferma' => [
        'enter_a_maximum_of_200_characters' => [
            'placeholder' => '[[MT-REV]] Enter a maximum of 200 characters',
        ],
        'rate_the_service' => [
            'label' => '[[MT-REV]] Rate the service',
        ],
    ],
    'privacy' => [
        'description' => [
            'message' => '[[MT-REV]] :entity processes the personal data you freely provide under Article 13 of Regulation (EU) 2016/679 (GDPR) and applicable local-government law.',
            'entity_fallback' => '[[MT-REV]] The organisation',
        ],
        'link_label' => [
            'label' => '[[MT-REV]] privacy notice',
        ],
        'accept_label' => [
            'label' => '[[MT-REV]] I have read and understood the privacy notice',
        ],
        'for_details_on_how_personal_data' => [
            'message' => '[[MT-REV]] For details on how personal data is processed, see the',
        ],
    ],
];
