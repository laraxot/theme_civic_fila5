<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): home. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'meta' => [
        'description' => '[[MT-REV]] Browse open reports in the area and filter results by category.',
    ],
    'heading' => [
        'title' => 'Rapporti',
    ],
    'hero' => [
        'title' => '[[MT-REV]] Seen a problem in your city?',
        'subtitle' => '[[MT-REV]] Pothole, broken light, dumped waste: report it in a few steps. The public map shows open work and your case code tracks the fix.',
        'cta_create' => 'Irrapporta problema',
        'cta_practices' => '[[MT-REV]] My cases',
        'cta_login' => '[[MT-REV]] Access personal area',
        'trust' => '[[MT-REV]] Free · Case code · Public map',
        'cta_register' => 'Oħloq kont',
        'signal_eyebrow' => '[[MT-REV]] Civic engagement',
        'signal_heading' => '[[MT-REV]] Your voice matters',
        'signal_body' => '[[MT-REV]] Every report helps the city understand priorities and make interventions visible.',
    ],
    'how' => [
        'title' => '[[MT-REV]] How it works',
        'intro' => '[[MT-REV]] Three clear steps: describe it, mark the place, follow updates from your personal area.',
        'steps_label' => '[[MT-REV]] Three steps to submit a report',
        'step1_title' => '[[MT-REV]] Describe the issue',
        'step1_body' => '[[MT-REV]] Explain what happened and choose the most suitable category.',
        'step2_title' => '[[MT-REV]] Set the location',
        'step2_body' => '[[MT-REV]] Add the location and useful details for the intervention.',
        'step3_title' => '[[MT-REV]] Follow updates',
        'step3_body' => '[[MT-REV]] Check the status of your report after submitting it.',
    ],
    'map' => [
        'caption' => '[[MT-REV]] Public reports on the map',
        'cta_list' => '[[MT-REV]] Browse the list',
        'details' => 'Dettalji',
        'type' => '[[MT-REV]] Report type',
        'address' => 'Indirizz',
        'description' => 'Deskrizzjoni',
        'not_available' => '[[MT-REV]] Information unavailable',
        'back_to_map' => '[[MT-REV]] Back to map',
    ],
    'list' => [
        'title' => '[[MT-REV]] Reports list',
        'subtitle' => '[[MT-REV]] Browse public reports and filter by category or keyword.',
        'breadcrumb_current' => 'Rapporti',
        'breadcrumb_aria' => '[[MT-REV]] Breadcrumb',
        'filters_aria' => '[[MT-REV]] Report filters',
        'search_label' => '[[MT-REV]] Search by description',
        'search_placeholder' => '[[MT-REV]] e.g. lighting',
        'category_legend' => 'Kategorija',
        'no_categories' => '[[MT-REV]] No categories available.',
        'clear_filters' => '[[MT-REV]] Clear all filters',
        'results' => '[[MT-REV]] :count results among the 100 most recent public reports.',
        'view_mode_aria' => '[[MT-REV]] View mode',
        'map' => 'Mappa',
        'list' => 'Lista',
        'map_aria' => '[[MT-REV]] Map of public reports',
        'list_aria' => '[[MT-REV]] Public reports',
        'empty' => '[[MT-REV]] No public reports available.',
        'empty_title' => '[[MT-REV]] No results',
        'empty_hint' => '[[MT-REV]] Try changing the search or clearing the filters.',
        'clear_filters_short' => '[[MT-REV]] Clear filters',
        'category_prefix' => '[[MT-REV]] Category: :name',
        'cta_heading' => '[[MT-REV]] Seen a problem in your city?',
        'cta_body' => '[[MT-REV]] Report it to the municipality: public map and status updates on your request.',
        'cta_button' => 'Irrapporta problema',
        'track_eyebrow' => '[[MT-REV]] Already reported a problem?',
        'track_heading' => '[[MT-REV]] Follow your report',
        'track_body' => '[[MT-REV]] Enter the code you received to check the status of your case.',
        'track_button' => '[[MT-REV]] Track a report',
        'track_secondary' => 'Ibgħat rapport',
        'track' => '[[MT-REV]] Track',
    ],
];
