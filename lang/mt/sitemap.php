<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): sitemap. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'meta' => [
        'title' => '[[MT-REV]] Site map',
        'description' => '[[MT-REV]] Explore FixCity public pages and services.',
        'breadcrumb' => '[[MT-REV]] Site map',
    ],
    'intro' => '[[MT-REV]] Find public pages and available tasks quickly.',
    'groups' => [
        0 => [
            'title' => 'Rapporti',
            'links' => [
                0 => [
                    'label' => 'Irrapporta problema',
                    'path' => '/tickets/create',
                ],
                1 => [
                    'label' => '[[MT-REV]] Report list and map',
                    'path' => '/tickets',
                ],
                2 => [
                    'label' => '[[MT-REV]] Track a report',
                    'path' => '/tickets/track',
                ],
                3 => [
                    'label' => '[[MT-REV]] My cases',
                    'path' => '/area-personale/pratiche',
                ],
            ],
        ],
        1 => [
            'title' => 'Informazzjoni',
            'links' => [
                0 => [
                    'label' => 'Mistoqsijiet frekwenti',
                    'path' => '/domande-frequenti',
                ],
                1 => [
                    'label' => 'Privatezza',
                    'path' => '/privacy',
                ],
                2 => [
                    'label' => '[[MT-REV]] Legal notices',
                    'path' => '/note-legali',
                ],
                3 => [
                    'label' => 'Politika dwar il-cookies',
                    'path' => '/cookie-policy',
                ],
                4 => [
                    'label' => 'Aċċessibbiltà',
                    'path' => '/accessibilita',
                ],
            ],
        ],
        2 => [
            'title' => '[[MT-REV]] Account',
            'links' => [
                0 => [
                    'label' => 'Idħol',
                    'path' => '/auth/login',
                ],
                1 => [
                    'label' => 'Oħloq kont',
                    'path' => '/auth/register',
                ],
            ],
        ],
    ],
];
