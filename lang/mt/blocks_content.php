<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): blocks_content. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'confirmation' => [
        'we_have_sent_the_summary_to_colon' => [
            'label' => '[[MT-REV]] We have sent the summary to the email address:',
        ],
        'tax_code_colon' => [
            'label' => '[[MT-REV]] Tax code:',
        ],
        'details_colon' => [
            'label' => '[[MT-REV]] Details:',
        ],
        'attached_image' => [
            'label' => '[[MT-REV]] Attached image',
        ],
        'images_colon' => [
            'label' => '[[MT-REV]] Images:',
        ],
        'address_colon' => [
            'label' => 'Indirizz:',
        ],
        'read_terms_and_conditions' => [
            'label' => '[[MT-REV]] Read terms and conditions',
        ],
        'name_colon' => [
            'label' => '[[MT-REV]] Name:',
        ],
        'type_colon' => [
            'label' => '[[MT-REV]] Type:',
        ],
        'title_colon' => [
            'label' => '[[MT-REV]] Title:',
        ],
        'rate_the_service_from_one_to' => [
            'label' => '[[MT-REV]] Rate the service from one to five stars',
        ],
        'cancel' => [
            'label' => 'Ikkanċella',
        ],
        'confirm_and_submit' => [
            'label' => '[[MT-REV]] Confirm and submit',
        ],
        'request_saved_successfully' => [
            'message' => '[[MT-REV]] Request saved successfully',
        ],
        'summary' => [
            'title' => '[[MT-REV]] Summary',
        ],
    ],
    'service' => [
        'access_the_service' => [
            'label' => '[[MT-REV]] Access the service',
        ],
    ],
    'access_method_card' => [
        'access_to_services' => [
            'label' => '[[MT-REV]] Access to services',
        ],
    ],
    'feedback_section' => [
        'other' => [
            'label' => '[[MT-REV]] Other',
        ],
        'positive_aspects' => [
            'label' => '[[MT-REV]] Positive aspects',
        ],
        'complete' => [
            'label' => '[[MT-REV]] Complete',
        ],
        'unclear_progress' => [
            'label' => '[[MT-REV]] Unclear progress',
        ],
        'describe_your_experience' => [
            'placeholder' => '[[MT-REV]] Describe your experience...',
        ],
        'details_max_200_characters' => [
            'label' => '[[MT-REV]] Details (max 200 characters)',
        ],
        'difficulties_encountered' => [
            'label' => '[[MT-REV]] Difficulties encountered',
        ],
        'incomplete_information' => [
            'label' => '[[MT-REV]] Incomplete information',
        ],
        'clear_instructions' => [
            'label' => '[[MT-REV]] Clear instructions',
        ],
        'unclear_instructions' => [
            'label' => '[[MT-REV]] Unclear instructions',
        ],
        'progress_tracking' => [
            'label' => '[[MT-REV]] Progress tracking',
        ],
        'no_technical_issues' => [
            'label' => '[[MT-REV]] No technical issues',
        ],
        'technical_issues' => [
            'label' => '[[MT-REV]] Technical issues',
        ],
        'rate_stars' => [
            'label' => '[[MT-REV]] Rate :count stars',
        ],
    ],
    'article' => [
        'topics' => [
            'label' => '[[MT-REV]] Topics',
        ],
        'share' => [
            'label' => 'Aqsam',
        ],
        'contact_the_municipality' => [
            'label' => '[[MT-REV]] Contact the municipality',
        ],
        'for_information_you_can_contact_the' => [
            'message' => '[[MT-REV]] For information, you can contact the municipal offices.',
        ],
        'go_to_contacts' => [
            'label' => '[[MT-REV]] Go to contacts',
        ],
        'view_actions' => [
            'label' => '[[MT-REV]] View actions',
        ],
    ],
    'shared' => [
        'breadcrumb' => [
            'label' => '[[MT-REV]] Breadcrumb',
        ],
        'loading' => [
            'message' => '[[MT-REV]] Loading...',
        ],
        'booking_code_colon' => [
            'label' => '[[MT-REV]] Booking code:',
        ],
        'comments' => [
            'label' => '[[MT-REV]] Comments',
        ],
        'what_to_bring' => [
            'label' => '[[MT-REV]] What to bring',
        ],
        'appointment_details' => [
            'label' => '[[MT-REV]] Appointment Details',
        ],
        'appointment_details_2' => [
            'label' => '[[MT-REV]] Appointment details',
        ],
        'appointment_details_3' => [
            'label' => '[[MT-REV]] Appointment details',
        ],
        'featured_events' => [
            'label' => '[[MT-REV]] Featured events',
        ],
        'need_help' => [
            'label' => 'Għandek bżonn għajnuna?',
        ],
        'sample_image' => [
            'label' => '[[MT-REV]] Sample image',
        ],
        'featured' => [
            'label' => '[[MT-REV]] Featured',
        ],
        'page_index' => [
            'label' => '[[MT-REV]] Page index',
        ],
        'read_more' => [
            'label' => 'Aqra aktar',
        ],
        'read_all' => [
            'label' => '[[MT-REV]] Read all',
        ],
        'hours_mon_fri_9_00_17' => [
            'label' => '[[MT-REV]] Hours: Mon-Fri 9:00-17:00 | Sat 9:00-13:00',
        ],
        'select' => [
            'message' => 'Agħżel...',
        ],
        'go_to_the_page' => [
            'label' => '[[MT-REV]] Go to the page',
        ],
        'view_all_articles' => [
            'label' => '[[MT-REV]] View All Articles',
        ],
        'random_image' => [
            'label' => '[[MT-REV]] random image',
        ],
        'access_the_services' => [
            'title' => '[[MT-REV]] Access the services',
        ],
        'appointment_confirmed' => [
            'title' => '[[MT-REV]] Appointment Confirmed',
        ],
        'recent_articles' => [
            'title' => '[[MT-REV]] Recent Articles',
        ],
        'your_appointment_has_been_confirmed' => [
            'message' => '[[MT-REV]] Your appointment has been confirmed.',
        ],
        'use_your_credentials_to_access_the' => [
            'help' => '[[MT-REV]] Use your credentials to access the reserved area',
        ],
    ],
    'services' => [
        'call_the_toll_free_number' => [
            'label' => '[[MT-REV]] Call the toll-free number',
        ],
        'read_the_faq' => [
            'label' => 'Aqra l-FAQ',
        ],
        'appointment_booking' => [
            'label' => '[[MT-REV]] Appointment booking',
        ],
        'electronic_id_card_issuance' => [
            'label' => '[[MT-REV]] Electronic ID card issuance',
        ],
        'issuance_of_polling_card' => [
            'label' => '[[MT-REV]] Issuance of polling card',
        ],
        'report_a_service_issue_or_a' => [
            'label' => '[[MT-REV]] Report a service issue or a problem in the area',
        ],
        'all_contacts' => [
            'label' => '[[MT-REV]] All contacts',
        ],
    ],
    'contact_section' => [
        'how_can_we_help_you' => [
            'label' => '[[MT-REV]] How can we help you?',
        ],
        'quick_links' => [
            'label' => '[[MT-REV]] Quick links',
        ],
        'appointments' => [
            'label' => 'Appuntamenti',
        ],
        'appointment' => [
            'label' => 'Appuntament',
        ],
        'assistance' => [
            'label' => '[[MT-REV]] Assistance',
        ],
        'connectivity_voucher' => [
            'label' => '[[MT-REV]] Connectivity voucher',
        ],
        'change_of_residence' => [
            'label' => '[[MT-REV]] Change of residence',
        ],
        'toll_free_number_05_0505' => [
            'label' => '[[MT-REV]] Toll-free number 05 0505',
        ],
        'taxes' => [
            'label' => 'Taxxi',
        ],
        'polling_card' => [
            'label' => '[[MT-REV]] Polling card',
        ],
    ],
    'catalog_page' => [
        'contents' => [
            'label' => '[[MT-REV]] Contents',
        ],
        'explore_all_the_news' => [
            'label' => '[[MT-REV]] Explore all the news',
        ],
        'featured_places' => [
            'label' => '[[MT-REV]] Featured places',
        ],
        'for_information_contact_the_municipality_through' => [
            'message' => '[[MT-REV]] For information, contact the municipality through the available channels.',
        ],
        'find_the_municipal_service_you_need' => [
            'label' => '[[MT-REV]] Find the municipal service you need',
        ],
    ],
    'events_calendar' => [
        'sun' => [
            'label' => '[[MT-REV]] SUN',
        ],
        'thu' => [
            'label' => '[[MT-REV]] THU',
        ],
        'mon' => [
            'label' => '[[MT-REV]] MON',
        ],
        'tue' => [
            'label' => '[[MT-REV]] TUE',
        ],
        'wed' => [
            'label' => '[[MT-REV]] WED',
        ],
        'sat' => [
            'label' => '[[MT-REV]] SAT',
        ],
        'fri' => [
            'label' => '[[MT-REV]] FRI',
        ],
        'event' => [
            'label' => '[[MT-REV]] Event',
        ],
        'exhibition' => [
            'label' => '[[MT-REV]] Exhibition',
        ],
        'meeting' => [
            'label' => '[[MT-REV]] Meeting',
        ],
        'visit' => [
            'label' => '[[MT-REV]] Visit',
        ],
    ],
    'default' => [
        'frequently_asked_questions' => [
            'label' => 'Mistoqsijiet frekwenti',
        ],
        'faq' => [
            'label' => 'FAQ',
        ],
        'submit' => [
            'label' => 'Ibgħat',
        ],
        'access_methods' => [
            'label' => '[[MT-REV]] Access methods',
        ],
        'form' => [
            'title' => '[[MT-REV]] Form',
        ],
    ],
    'mappa_static' => [
        'the_map_centres_on_where_you' => [
            'message' => '[[MT-REV]] The map centres on where you are now (browser permission). It works on http, https and locally without configuration.',
        ],
        'lat_colon' => [
            'label' => '[[MT-REV]] Lat:',
        ],
        'lng_colon' => [
            'label' => '[[MT-REV]] Lng:',
        ],
        'location_of_the_damage' => [
            'label' => '[[MT-REV]] Location of the damage',
        ],
        'current_position_or_reference_point' => [
            'label' => '[[MT-REV]] ↳ Current position or reference point',
        ],
        'damage_to_be_repaired' => [
            'label' => '[[MT-REV]] Damage to be repaired',
        ],
    ],
    'popular_posts' => [
        'no_popular_articles_at_the_moment' => [
            'message' => '[[MT-REV]] No popular articles at the moment.',
        ],
        'popular_articles' => [
            'title' => '[[MT-REV]] Popular Articles',
        ],
    ],
    'list' => [
        'no_events_available' => [
            'label' => '[[MT-REV]] No events available',
        ],
    ],
    'resources' => [
        'no_categories_available' => [
            'label' => '[[MT-REV]] No categories available',
        ],
        'no_resources_in_this_category' => [
            'label' => '[[MT-REV]] No resources in this category',
        ],
    ],
    'categories' => [
        'no_categories_available' => [
            'message' => '[[MT-REV]] No categories available.',
        ],
    ],
    'search_bar' => [
        '2026_regulations' => [
            'label' => '[[MT-REV]] 2026 regulations',
        ],
        'popular_colon' => [
            'label' => '[[MT-REV]] Popular:',
        ],
        'radiation_protection' => [
            'label' => '[[MT-REV]] Radiation protection',
        ],
        'safety' => [
            'label' => '[[MT-REV]] Safety',
        ],
    ],
    'sections' => [
        'learn_more' => [
            'label' => '[[MT-REV]] Learn more',
        ],
    ],
    'detail' => [
        'back_to_events' => [
            'label' => '[[MT-REV]] Back to events',
        ],
    ],
    'homepage' => [
        'the_whole_administration' => [
            'label' => '[[MT-REV]] The whole administration',
        ],
    ],
    'category_filter' => [
        'all' => [
            'label' => 'Kollha',
        ],
    ],
    'sites' => [
        'visit_the_site' => [
            'label' => '[[MT-REV]] Visit the site',
        ],
    ],
    404 => [
        'whooops' => [
            'message' => '[[MT-REV]] Whooops!',
        ],
    ],
    'event_card' => [
        'view_event_details' => [
            'label' => '[[MT-REV]] View event details: :title',
        ],
    ],
    'news_card' => [
        'read_article' => [
            'label' => '[[MT-REV]] Read the article: :title',
        ],
        'read_full_article' => [
            'label' => '[[MT-REV]] Read the full article: :title',
        ],
    ],
    'geo_static_map' => [
        'map_with_pin' => [
            'label' => '[[MT-REV]] Map with pin at :label',
        ],
    ],
    'categories_grid' => [
        'contents_count' => [
            'label' => '[[MT-REV]] :count items',
        ],
    ],
    'related' => [
        'show_more' => [
            'label' => '[[MT-REV]] See :count more',
        ],
        'related_content' => [
            'title' => '[[MT-REV]] Related content',
        ],
    ],
    'file_upload' => [
        'max_size' => [
            'label' => '[[MT-REV]] Maximum size: :size',
        ],
        'allowed_types' => [
            'label' => '[[MT-REV]] Allowed types: :types',
        ],
    ],
    'company_data' => [
        'company_data' => [
            'title' => '[[MT-REV]] Company Data',
        ],
        'legal_and_contact_information' => [
            'help' => '[[MT-REV]] Legal and contact information',
        ],
    ],
    'sidebar' => [
        'filter' => [
            'title' => 'Iffiltra',
        ],
    ],
    'assistance' => [
        'enter_your_details' => [
            'title' => '[[MT-REV]] Enter your details',
        ],
    ],
    'tags' => [
        'tags' => [
            'title' => '[[MT-REV]] Tags',
        ],
    ],
];
