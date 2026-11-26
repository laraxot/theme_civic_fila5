<?php

declare(strict_types=1);

/*
 * Catalogo `de`: ticket. Struttura e chiavi come `en`; i testi sono tradotti, non ereditati.
 * @see docs/contracts/i18n-catalog-parity.md
 */
return [
    'next' => 'Weiter',
    'back' => 'Zurück',
    'submit' => 'Senden',
    'required' => 'erforderlich',
    'max_chars' => 'Max. :max Zeichen',
    'privacy' => [
        'title' => 'Datenschutzerklärung',
        'description' => 'Lesen Sie die Datenschutzerklärung, bevor Sie fortfahren',
        'details' => 'Details zur Verarbeitung personenbezogener Daten finden Sie in der ',
        'link_label' => 'Datenschutzerklärung.',
        'accept_label' => 'Ich habe die Datenschutzerklärung gelesen und verstanden',
    ],
    'dati' => [
        'title' => 'Meldungsdetails',
        'place_label' => 'Ort des Problems',
        'place_placeholder' => 'z. B.: Via Roma 1, Florenz',
        'details_label' => 'Problemdetails',
        'type_label' => 'Problemart*',
        'type_select' => 'Auswählen...',
        'types' => [
            'verde' => 'Öffentliche Grünflächen und Stadtmobiliar',
            'illuminazione' => 'Öffentliche Beleuchtung',
            'strade' => 'Straßeninstandhaltung',
            'rifiuti' => 'Abfallwirtschaft',
            'altro' => 'Sonstiges',
        ],
        'title_label' => 'Titel',
        'title_placeholder' => 'Kurze Beschreibung des Problems',
        'description_label' => 'Beschreibung*',
        'description_placeholder' => 'Beschreiben Sie das Problem...',
        'images_label' => 'Bilder',
        'images_hint' => 'Wählen Sie ein oder mehrere Bilder aus',
        'no_file' => 'Keine Datei ausgewählt',
    ],
    'riepilogo' => [
        'title' => 'Zusammenfassung der Meldung',
        'warning_title' => 'Achtung',
        'warning_text' => 'Die gemachten Angaben haben Erklärungscharakter. Bitte prüfen Sie, ob sie korrekt sind.',
        'disservizio_section' => 'Problem',
        'contacts_section' => 'Kontakte',
        'terms_label' => 'Ich bestätige, dass die Angaben wahrheitsgemäß sind, und akzeptiere die',
        'terms_link' => 'Nutzungsbedingungen',
        'submit_label' => 'Meldung senden',
    ],
    'conferma' => [
        'title' => 'Meldung gesendet',
        'subtitle' => 'Vielen Dank, wir haben Ihre <strong>Meldung :code</strong> erhalten.',
        'visibility' => 'Sie wird in der <a href=":url" class="t-primary">Liste aller Meldungen</a> sichtbar sein, sobald sie von der Verwaltung übernommen wurde.',
        'email_sent' => 'Wir haben die Zusammenfassung an die E-Mail-Adresse gesendet:<br><strong>:email</strong>',
        'download_receipt' => 'Empfangsbestätigung herunterladen (PDF 100KB)',
        'consult_request' => 'Anfrage einsehen',
        'in_area' => 'in Ihrem persönlichen Bereich',
        'related_services' => 'Zugehörige Dienste',
    ],
    'elenco' => [
        'title' => 'Meldungsliste',
        'subtitle' => 'In den letzten 12 Monaten wurden :count Meldungen gelöst.',
        'results' => ':count Ergebnisse',
        'map_tab' => 'Karte',
        'list_tab' => 'Liste',
        'make_report_title' => 'Meldung abgeben',
        'make_report_text' => 'Wenn Sie eine Meldung hinzufügen möchten, können Sie dies tun, nachdem Sie sich mit Ihren SPID- oder CIE-Zugangsdaten angemeldet haben.',
        'make_report_btn' => 'Problem melden',
        'load_more' => 'Weitere Meldungen laden',
        'rating_question' => 'Wie einfach war die Nutzung dieses Dienstes?',
        'rating_legend' => 'Bewerten Sie mit 1 bis 5 Sternen',
    ],
    'contacts' => [
        'title' => 'Gemeinde kontaktieren',
        'faq' => 'FAQ lesen',
        'assistance' => 'Hilfe anfordern',
        'phone' => 'Rufen Sie die gebührenfreie Nummer 05 0505 an',
        'appointment' => 'Termin buchen',
    ],
];
