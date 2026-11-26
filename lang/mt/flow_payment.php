<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): flow_payment. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'riepilogo' => [
        'warning_colon' => [
            'label' => '[[MT-REV]] Warning:',
        ],
        'payment_details' => [
            'label' => '[[MT-REV]] Payment details',
        ],
        'make_payment' => [
            'label' => '[[MT-REV]] Make payment',
        ],
        'the_payment_is_irrevocable_make_sure' => [
            'message' => '[[MT-REV]] The payment is irrevocable. Make sure all the details are correct before confirming.',
        ],
        'total_to_pay' => [
            'label' => '[[MT-REV]] Total to pay',
        ],
        'payment_regulations' => [
            'label' => '[[MT-REV]] payment regulations',
        ],
        'payment_summary' => [
            'title' => '[[MT-REV]] Payment summary',
        ],
    ],
    'pagamento' => [
        'bank_transfer' => [
            'label' => '[[MT-REV]] Bank transfer',
        ],
        'credit_card' => [
            'label' => '[[MT-REV]] Credit card',
        ],
        'reference_colon' => [
            'label' => '[[MT-REV]] Reference:',
        ],
        'first_name_and_surname' => [
            'placeholder' => '[[MT-REV]] First name and surname',
        ],
        'card_number' => [
            'label' => '[[MT-REV]] Card number',
        ],
        'payment_with_pagopa' => [
            'label' => '[[MT-REV]] Payment with pagoPA',
        ],
        'payment_via_online_banking' => [
            'label' => '[[MT-REV]] Payment via online banking',
        ],
        'you_will_receive_the_bank_details' => [
            'message' => '[[MT-REV]] You will receive the bank details for the transfer by email. The payment must be made within 5 working days.',
        ],
        'expiry' => [
            'label' => '[[MT-REV]] Expiry',
        ],
        'cardholder' => [
            'label' => '[[MT-REV]] Cardholder',
        ],
        'you_will_be_redirected_to_the' => [
            'message' => '[[MT-REV]] You will be redirected to the pagoPA payment system to complete the transaction securely.',
        ],
        'payment_data' => [
            'title' => '[[MT-REV]] Payment data',
        ],
        'enter_the_payment_details' => [
            'help' => '[[MT-REV]] Enter the payment details',
        ],
    ],
    'conferma' => [
        'transaction_code' => [
            'label' => '[[MT-REV]] Transaction code',
        ],
        'amount_paid' => [
            'label' => '[[MT-REV]] Amount paid',
        ],
        'send_receipt_by_email' => [
            'label' => '[[MT-REV]] Send receipt by email',
        ],
        'the_payment_receipt_is_available_in' => [
            'message' => '[[MT-REV]] The payment receipt is available in the "My payments" section of your personal area.',
        ],
        'payment_completed_successfully' => [
            'message' => '[[MT-REV]] Payment completed successfully!',
        ],
        'you_will_receive_the_receipt_by' => [
            'label' => '[[MT-REV]] You will receive the receipt by email',
        ],
        'download_receipt' => [
            'label' => '[[MT-REV]] Download receipt',
        ],
        'payment_made' => [
            'title' => '[[MT-REV]] Payment made',
        ],
    ],
    'shared' => [
        'payment_method' => [
            'label' => '[[MT-REV]] Payment method',
        ],
        'service' => [
            'label' => '[[MT-REV]] Service',
        ],
    ],
    'servizio' => [
        'no_service_available' => [
            'label' => '[[MT-REV]] No service available',
        ],
        'service_selection' => [
            'label' => '[[MT-REV]] Service selection',
        ],
        'choose_the_service_you_want_to' => [
            'help' => '[[MT-REV]] Choose the service you want to pay for',
        ],
        'select_service' => [
            'title' => '[[MT-REV]] Select service',
        ],
    ],
    'summary' => [
        'consent_terms_rules' => [
            'message' => '[[MT-REV]] I have read and accept the :terms and the :rules',
        ],
    ],
];
