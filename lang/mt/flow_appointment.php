<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): flow_appointment. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'conferma' => [
        'add_to_calendar' => [
            'label' => '[[MT-REV]] Add to calendar',
        ],
        'appointment_booked_successfully' => [
            'message' => '[[MT-REV]] Appointment booked successfully!',
        ],
        'booking_code' => [
            'label' => '[[MT-REV]] Booking code',
        ],
        'arrive_at_the_office_10_minutes' => [
            'message' => '[[MT-REV]] Arrive at the office 10 minutes before your booked time and bring a valid ID document.',
        ],
        'you_will_receive_a_confirmation_by' => [
            'label' => '[[MT-REV]] You will receive a confirmation by email',
        ],
        'remember_colon' => [
            'label' => '[[MT-REV]] Remember:',
        ],
        'print_confirmation' => [
            'label' => '[[MT-REV]] Print confirmation',
        ],
    ],
    'riepilogo' => [
        'confirm_appointment' => [
            'label' => '[[MT-REV]] Confirm appointment',
        ],
        'personal_details' => [
            'label' => '[[MT-REV]] Personal details',
        ],
        'appointment_details' => [
            'label' => '[[MT-REV]] Appointment details',
        ],
        'notes' => [
            'label' => '[[MT-REV]] Notes',
        ],
        'appointment_summary' => [
            'title' => '[[MT-REV]] Appointment summary',
        ],
    ],
    'dettagli' => [
        'enter_any_useful_information' => [
            'placeholder' => '[[MT-REV]] Enter any useful information...',
        ],
        'reason_for_the_visit' => [
            'label' => '[[MT-REV]] Reason for the visit',
        ],
        'additional_notes_optional' => [
            'label' => '[[MT-REV]] Additional notes (optional)',
        ],
        'select_a_reason' => [
            'label' => '[[MT-REV]] Select a reason',
        ],
        'general_information' => [
            'label' => '[[MT-REV]] General information',
        ],
        'enter_the_details_of_your_request' => [
            'help' => '[[MT-REV]] Enter the details of your request',
        ],
        'administrative_procedure' => [
            'label' => '[[MT-REV]] Administrative procedure',
        ],
        'certificate_request' => [
            'label' => '[[MT-REV]] Certificate request',
        ],
    ],
    'richiedente_autenticato' => [
        'edit_details' => [
            'label' => '[[MT-REV]] Edit details',
        ],
        'your_details' => [
            'title' => '[[MT-REV]] Your details',
        ],
        'check_your_personal_details' => [
            'help' => '[[MT-REV]] Check your personal details',
        ],
    ],
    'shared' => [
        'reason' => [
            'label' => '[[MT-REV]] Reason',
        ],
        'time' => [
            'label' => '[[MT-REV]] Time',
        ],
        'office' => [
            'label' => 'Uffiċċju',
        ],
    ],
    'ufficio' => [
        'no_office_available' => [
            'label' => '[[MT-REV]] No office available',
        ],
        'office_selection' => [
            'label' => '[[MT-REV]] Office selection',
        ],
        'choose_the_office_you_will_visit' => [
            'help' => '[[MT-REV]] Choose the office you will visit',
        ],
        'select_the_office' => [
            'title' => '[[MT-REV]] Select the office',
        ],
    ],
    'ufficio_luogo' => [
        'no_venue_available' => [
            'label' => '[[MT-REV]] No venue available',
        ],
        'venue_selection' => [
            'label' => '[[MT-REV]] Venue selection',
        ],
        'choose_the_venue_closest_to_you' => [
            'help' => '[[MT-REV]] Choose the venue closest to you',
        ],
        'select_venue' => [
            'title' => '[[MT-REV]] Select venue',
        ],
    ],
    'data_orario' => [
        'available_times' => [
            'label' => '[[MT-REV]] Available times',
        ],
        'choose_the_day_and_time_of' => [
            'help' => '[[MT-REV]] Choose the day and time of your appointment',
        ],
        'select_date_and_time' => [
            'title' => '[[MT-REV]] Select date and time',
        ],
    ],
    'summary' => [
        'consent_terms_privacy' => [
            'message' => '[[MT-REV]] I have read and accept the :terms and the :privacy',
        ],
    ],
    'richiedente' => [
        'enter_your_personal_details' => [
            'help' => '[[MT-REV]] Enter your personal details',
        ],
    ],
];
