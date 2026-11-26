<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): contact_point_type_enum. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'values' => [
        'email' => [
            'label' => 'Email',
        ],
        'pec' => [
            'label' => '[[MT-REV]] Certified email (PEC)',
        ],
        'phone' => [
            'label' => 'Telefon',
        ],
        'fax' => [
            'label' => '[[MT-REV]] Fax',
        ],
        'mobile' => [
            'label' => '[[MT-REV]] Mobile',
        ],
        'whatsapp' => [
            'label' => 'WhatsApp',
        ],
        'telegram' => [
            'label' => 'Telegram',
        ],
        'address' => [
            'label' => '[[MT-REV]] Physical address',
        ],
        'website' => [
            'label' => '[[MT-REV]] Website',
        ],
        'social_facebook' => [
            'label' => 'Facebook',
        ],
        'social_twitter' => [
            'label' => 'Twitter/X',
        ],
        'social_linkedin' => [
            'label' => 'LinkedIn',
        ],
        'social_youtube' => [
            'label' => 'YouTube',
        ],
        'social_instagram' => [
            'label' => 'Instagram',
        ],
        'appointment_url' => [
            'label' => '[[MT-REV]] Appointment booking',
        ],
        'other' => [
            'label' => '[[MT-REV]] Other',
        ],
    ],
];
