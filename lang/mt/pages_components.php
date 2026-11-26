<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): pages_components. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'blog' => [
        'keyboard_help' => [
            'help' => '[[MT-REV]] Tab to move around • Enter to confirm',
        ],
        'navigation' => [
            'label' => '[[MT-REV]] Navigation',
        ],
        'wcag' => [
            'label' => '[[MT-REV]] WCAG 2.1 AA compliant',
        ],
        'accessibility' => [
            'label' => 'Aċċessibbiltà',
        ],
        'accessibility_nav' => [
            'label' => '[[MT-REV]] Accessibility and navigation',
        ],
        'categories' => [
            'label' => '[[MT-REV]] Categories',
        ],
        'categories_tags' => [
            'label' => '[[MT-REV]] Categories and tags',
        ],
        'pagination' => [
            'label' => 'Paġinazzjoni',
        ],
        'recent_posts' => [
            'label' => '[[MT-REV]] Recent articles',
        ],
        'featured_post' => [
            'help' => '[[MT-REV]] The redevelopment project approved by the Municipality turns the heart of the city into a liveable, sustainable space accessible to everyone.',
            'title' => '[[MT-REV]] New pedestrian square in the historic centre',
        ],
        'featured' => [
            'label' => '[[MT-REV]] Featured',
        ],
        'featured_image' => [
            'label' => '[[MT-REV]] Featured blog',
        ],
        'intro' => [
            'help' => '[[MT-REV]] News, events and updates from the Municipality to stay informed about projects, initiatives and services for citizens.',
        ],
        'title' => [
            'label' => '[[MT-REV]] Blog and news',
        ],
    ],
];
