<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): appointment_form. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'booking' => [
        'confirm' => [
            'loading' => '[[MT-REV]] Confirming...',
            'label' => '[[MT-REV]] Confirm Booking',
        ],
        'consent' => [
            'and_privacy' => '[[MT-REV]] and the',
            'privacy' => '[[MT-REV]] privacy notice',
            'intro' => '[[MT-REV]] By confirming, you accept the',
            'terms' => '[[MT-REV]] terms of service',
        ],
        'important' => [
            'label' => '[[MT-REV]] Important:',
            'message' => '[[MT-REV]] Bring the required documents with you and present the confirmation code at the office.',
        ],
        'summary' => [
            'documents' => [
                'label' => '[[MT-REV]] Documents:',
            ],
            'requester' => [
                'label' => '[[MT-REV]] Requester:',
            ],
            'time' => [
                'label' => '[[MT-REV]] Time:',
            ],
            'date' => [
                'label' => '[[MT-REV]] Date:',
            ],
            'office' => [
                'label' => '[[MT-REV]] Office:',
            ],
            'service' => [
                'label' => '[[MT-REV]] Service:',
            ],
            'title' => '[[MT-REV]] Booking Summary',
        ],
        'emergency_contact' => [
            'placeholder' => '[[MT-REV]] Reference name and phone number',
            'label' => '[[MT-REV]] Emergency contact (optional)',
        ],
        'notes' => [
            'placeholder' => '[[MT-REV]] Any notes or additional information...',
            'label' => '[[MT-REV]] Additional notes (optional)',
        ],
        'required_documents' => [
            'title' => '[[MT-REV]] Required Documents',
        ],
        'person_found' => [
            'label' => '[[MT-REV]] Data found:',
        ],
        'tax_code' => [
            'placeholder' => '[[MT-REV]] Enter tax code',
            'label' => '[[MT-REV]] Person\'s Tax Code',
        ],
        'requester_other' => [
            'label' => '[[MT-REV]] For another person',
        ],
        'requester_self' => [
            'label' => '[[MT-REV]] For myself',
        ],
        'requester' => [
            'title' => '[[MT-REV]] Who is requesting the appointment?',
        ],
        'selected_time' => [
            'label' => '[[MT-REV]] Selected time: :time',
        ],
        'minutes' => [
            'label' => '[[MT-REV]] minutes',
        ],
        'select_time' => [
            'title' => '[[MT-REV]] Select the Time',
        ],
        'selected_date' => [
            'label' => '[[MT-REV]] Selected date: :date',
        ],
        'select_date' => [
            'title' => '[[MT-REV]] Select the Date',
        ],
        'select_office' => [
            'title' => '[[MT-REV]] Select the Office',
        ],
        'select_service' => [
            'title' => '[[MT-REV]] Select the Service',
        ],
        'new_booking' => [
            'label' => '[[MT-REV]] New Booking',
        ],
        'my_bookings' => [
            'label' => '[[MT-REV]] My Bookings',
        ],
        'confirmed' => [
            'keep_code' => '[[MT-REV]] Keep this code for future reference.',
            'email_notice' => '[[MT-REV]] You will receive a confirmation email with all the details.',
            'message' => '[[MT-REV]] Your booking has been successfully registered.',
            'title' => '[[MT-REV]] Booking Confirmed!',
        ],
        'confirmation_code' => [
            'label' => '[[MT-REV]] Confirmation Code:',
        ],
        'progress' => [
            'label' => '[[MT-REV]] Step :current of :total',
        ],
        'title' => [
            'label' => '[[MT-REV]] Appointment Booking',
        ],
    ],
];
