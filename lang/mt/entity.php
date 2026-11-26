<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): entity. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'profiles' => [
        'generic' => [
            'name' => '[[MT-REV]] Local authority',
            'name_plural' => '[[MT-REV]] Local authorities',
            'of' => '[[MT-REV]] of the local authority',
            'to' => '[[MT-REV]] to the local authority',
            'your' => '[[MT-REV]] your local authority',
            'offices' => '[[MT-REV]] Local authority offices',
            'services' => '[[MT-REV]] Local authority services',
            'administration' => '[[MT-REV]] Local authority administration',
            'head' => '[[MT-REV]] Head of the authority',
            'contact_cta' => '[[MT-REV]] Contact the local authority',
            'reports_of' => '[[MT-REV]] local authority reports',
            'portal' => '[[MT-REV]] Local authority digital portal',
            'territory' => '[[MT-REV]] area of responsibility',
        ],
        'comune' => [
            'name' => '[[MT-REV]] Municipality',
            'name_plural' => '[[MT-REV]] Municipalities',
            'of' => '[[MT-REV]] of the municipality',
            'to' => '[[MT-REV]] to the municipality',
            'your' => '[[MT-REV]] your municipality',
            'offices' => '[[MT-REV]] Municipal offices',
            'services' => '[[MT-REV]] Municipal services',
            'administration' => '[[MT-REV]] Municipal administration',
            'head' => '[[MT-REV]] Mayor',
            'contact_cta' => '[[MT-REV]] Contact the municipality',
            'reports_of' => '[[MT-REV]] municipality reports',
            'portal' => '[[MT-REV]] Municipality digital portal',
            'territory' => '[[MT-REV]] municipal area',
        ],
        'local_council' => [
            'name' => 'Kunsill Lokali',
            'name_plural' => 'Kunsilli Lokali',
            'of' => 'tal-Kunsill Lokali',
            'to' => 'lill-Kunsill Lokali',
            'your' => 'il-Kunsill Lokali tiegħek',
            'offices' => 'Uffiċċji tal-Kunsill Lokali',
            'services' => 'Servizzi tal-Kunsill Lokali',
            'administration' => 'Amministrazzjoni tal-Kunsill Lokali',
            'head' => '[[MT-REV]] Mayor',
            'contact_cta' => '[[MT-REV]] Contact the Local Council',
            'reports_of' => '[[MT-REV]] Local Council reports',
            'portal' => '[[MT-REV]] Local Council digital portal',
            'territory' => 'lokalità',
        ],
    ],
];
