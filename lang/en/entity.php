<?php

declare(strict_types=1);

/*
 * Entity terminology per profile (issue #6): how the theme names the body, its offices and its services.
 *
 * A profile is a CLOSED set of thirteen terms, identical in every language and every profile (the parity test checks it).
 * Each term is an already composed form (`of` = "of the municipality", `to` = "to the municipality"): components never
 * concatenate an article and a noun, because articles and prepositions change with the language and the gender.
 *
 * The entity NAME ("Comune di ...", "Birkirkara Local Council") is tenant data (`config/local/<tenant>/ente.php`, key `name`),
 * not terminology. Legal references do not live here.
 *
 * @see docs/contracts/i18n-entity-terminology.md
 * @see docs/adr/0011-profili-paese-ente-e-terminologia.md
 */
return [
    'profiles' => [
        // Fallback profile: neutral, no country-specific institutional model.
        'generic' => [
            'name' => 'Local authority',
            'name_plural' => 'Local authorities',
            'of' => 'of the local authority',
            'to' => 'to the local authority',
            'your' => 'your local authority',
            'offices' => 'Local authority offices',
            'services' => 'Local authority services',
            'administration' => 'Local authority administration',
            'head' => 'Head of the authority',
            'contact_cta' => 'Contact the local authority',
            'reports_of' => 'local authority reports',
            'portal' => 'Local authority digital portal',
            'territory' => 'area of responsibility',
        ],
        // Italy.
        'comune' => [
            'name' => 'Municipality',
            'name_plural' => 'Municipalities',
            'of' => 'of the municipality',
            'to' => 'to the municipality',
            'your' => 'your municipality',
            'offices' => 'Municipal offices',
            'services' => 'Municipal services',
            'administration' => 'Municipal administration',
            'head' => 'Mayor',
            'contact_cta' => 'Contact the municipality',
            'reports_of' => 'municipality reports',
            'portal' => 'Municipality digital portal',
            'territory' => 'municipal area',
        ],
        // Malta.
        'local_council' => [
            'name' => 'Local Council',
            'name_plural' => 'Local Councils',
            'of' => 'of the Local Council',
            'to' => 'to the Local Council',
            'your' => 'your Local Council',
            'offices' => 'Local Council offices',
            'services' => 'Local Council services',
            'administration' => 'Local Council administration',
            'head' => 'Mayor',
            'contact_cta' => 'Contact the Local Council',
            'reports_of' => 'Local Council reports',
            'portal' => 'Local Council digital portal',
            'territory' => 'locality',
        ],
    ],
];
