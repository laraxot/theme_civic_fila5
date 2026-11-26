<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): consenso. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'title' => '[[MT-REV]] Privacy notice and consent',
    'intro' => '[[MT-REV]] To submit a report we process the data you send. You can continue only if you consent. The data is processed to answer the report and for as long as needed to meet legal obligations.',
    'points' => [
        0 => '[[MT-REV]] Data processed: first name, last name, email address and the location of the issue.',
        1 => '[[MT-REV]] Purpose: to answer the report and send updates on its status.',
        2 => '[[MT-REV]] Legal basis: your consent. You can withdraw it at any time.',
        3 => '[[MT-REV]] Recipients: staff of the office handling the report. We do not share data with third parties.',
        4 => '[[MT-REV]] Retention: for the period required by law.',
    ],
    'link' => '/en/privacy',
    'link_label' => '[[MT-REV]] Read the full privacy notice',
    'opens_new_window' => '[[MT-REV]] opens in a new window',
    'label' => '[[MT-REV]] I have read the privacy notice and consent to the processing of my personal data for the handling of this report.',
    'error' => '[[MT-REV]] To submit a report you must consent to data processing.',
    'action' => 'Kompli',
];
