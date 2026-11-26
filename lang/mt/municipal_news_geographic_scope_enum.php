<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): municipal_news_geographic_scope_enum. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'values' => [
        'municipal' => [
            'label' => '[[MT-REV]] Municipal',
        ],
        'district' => [
            'label' => '[[MT-REV]] District/Borough',
        ],
        'regional' => [
            'label' => '[[MT-REV]] Regional',
        ],
        'national' => [
            'label' => '[[MT-REV]] National',
        ],
        'european' => [
            'label' => '[[MT-REV]] European',
        ],
        'international' => [
            'label' => '[[MT-REV]] International',
        ],
    ],
];
