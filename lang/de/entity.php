<?php

declare(strict_types=1);

/*
 * Terminologie der Körperschaft pro Profil (Issue #6): wie das Theme die Körperschaft, ihre Ämter und Dienste nennt.
 *
 * Ein Profil ist ein GESCHLOSSENER Satz von dreizehn Begriffen, in jeder Sprache und jedem Profil gleich (der
 * Paritätstest prüft das). Jeder Begriff ist eine fertig gebildete Form (`of` = «der Gemeinde», `to` = «der Gemeinde»):
 * Komponenten setzen nie Artikel und Nomen zusammen, weil sich Artikel und Fälle mit Sprache und Genus ändern.
 *
 * Der NAME der Körperschaft («Comune di ...», «Birkirkara Local Council») sind Mandantendaten
 * (`config/local/<tenant>/ente.php`, Schlüssel `name`), keine Terminologie.
 *
 * Für Malta bleibt der offizielle englische Name «Local Council» stehen: eine gängige deutsche Entsprechung ist nicht
 * belegt (Eintrag im Rapport als zu klären).
 *
 * @see docs/contracts/i18n-entity-terminology.md
 * @see docs/adr/0011-profili-paese-ente-e-terminologia.md
 */
return [
    'profiles' => [
        // Ausweichprofil: neutral, ohne länderspezifisches institutionelles Modell.
        'generic' => [
            'name' => 'Örtliche Verwaltung',
            'name_plural' => 'Örtliche Verwaltungen',
            'of' => 'der örtlichen Verwaltung',
            'to' => 'der örtlichen Verwaltung',
            'your' => 'Ihre örtliche Verwaltung',
            'offices' => 'Ämter der örtlichen Verwaltung',
            'services' => 'Dienste der örtlichen Verwaltung',
            'administration' => 'Verwaltung',
            'head' => 'Leitung der Verwaltung',
            'contact_cta' => 'Örtliche Verwaltung kontaktieren',
            'reports_of' => 'Meldungen der örtlichen Verwaltung',
            'portal' => 'Digitales Portal der örtlichen Verwaltung',
            'territory' => 'Zuständigkeitsgebiet',
        ],
        // Italien.
        'comune' => [
            'name' => 'Gemeinde',
            'name_plural' => 'Gemeinden',
            'of' => 'der Gemeinde',
            'to' => 'der Gemeinde',
            'your' => 'Ihre Gemeinde',
            'offices' => 'Gemeindeämter',
            'services' => 'Gemeindedienste',
            'administration' => 'Gemeindeverwaltung',
            'head' => 'Bürgermeister',
            'contact_cta' => 'Gemeinde kontaktieren',
            'reports_of' => 'Meldungen der Gemeinde',
            'portal' => 'Digitales Gemeindeportal',
            'territory' => 'Gemeindegebiet',
        ],
        // Malta.
        'local_council' => [
            'name' => 'Local Council',
            'name_plural' => 'Local Councils',
            'of' => 'des Local Council',
            'to' => 'dem Local Council',
            'your' => 'Ihr Local Council',
            'offices' => 'Büros des Local Council',
            'services' => 'Dienste des Local Council',
            'administration' => 'Verwaltung des Local Council',
            'head' => 'Bürgermeister',
            'contact_cta' => 'Local Council kontaktieren',
            'reports_of' => 'Meldungen des Local Council',
            'portal' => 'Digitales Portal des Local Council',
            'territory' => 'Ortschaft',
        ],
    ],
];
