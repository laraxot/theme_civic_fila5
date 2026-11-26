<?php

declare(strict_types=1);

/*
 * Terminologia dell'ente per profilo (issue #6): come il tema chiama l'ente, i suoi uffici e i suoi servizi.
 *
 * Un profilo e' un insieme CHIUSO di tredici termini, uguale in ogni lingua e in ogni profilo (il test di parita'
 * lo verifica). Ogni termine e' una forma gia' composta (`of` = «del Comune», `to` = «al Comune»): i componenti non
 * concatenano mai articolo e nome, perche' articoli e preposizioni cambiano con la lingua e con il genere.
 *
 * Il NOME dell'ente («Comune di ...», «Birkirkara Local Council») e' un dato del tenant (`config/local/<tenant>/ente.php`,
 * chiave `name`), non terminologia. Una voce non applicabile a un Paese si toglie dal profilo SOLO insieme alle altre
 * lingue; i riferimenti normativi non stanno qui.
 *
 * @see docs/contracts/i18n-entity-terminology.md
 * @see docs/adr/0011-profili-paese-ente-e-terminologia.md
 */
return [
    'profiles' => [
        // Profilo di ripiego: neutro, senza modello istituzionale di un Paese.
        'generic' => [
            'name' => 'Ente locale',
            'name_plural' => 'Enti locali',
            'of' => 'dell’ente locale',
            'to' => 'all’ente locale',
            'your' => 'il tuo ente locale',
            'offices' => 'Uffici dell’ente',
            'services' => 'Servizi dell’ente',
            'administration' => 'Amministrazione dell’ente',
            'head' => 'Responsabile dell’ente',
            'contact_cta' => 'Contatta l’ente',
            'reports_of' => 'segnalazioni dell’ente',
            'portal' => 'Portale digitale dell’ente',
            'territory' => 'territorio di competenza',
        ],
        // Italia.
        'comune' => [
            'name' => 'Comune',
            'name_plural' => 'Comuni',
            'of' => 'del Comune',
            'to' => 'al Comune',
            'your' => 'il tuo Comune',
            'offices' => 'Uffici comunali',
            'services' => 'Servizi comunali',
            'administration' => 'Amministrazione comunale',
            'head' => 'Sindaco',
            'contact_cta' => 'Contatta il Comune',
            'reports_of' => 'segnalazioni del Comune',
            'portal' => 'Portale digitale del Comune',
            'territory' => 'territorio comunale',
        ],
        // Malta.
        'local_council' => [
            'name' => 'Consiglio locale',
            'name_plural' => 'Consigli locali',
            'of' => 'del Consiglio locale',
            'to' => 'al Consiglio locale',
            'your' => 'il tuo Consiglio locale',
            'offices' => 'Uffici del Consiglio locale',
            'services' => 'Servizi del Consiglio locale',
            'administration' => 'Amministrazione del Consiglio locale',
            'head' => 'Sindaco',
            'contact_cta' => 'Contatta il Consiglio locale',
            'reports_of' => 'segnalazioni del Consiglio locale',
            'portal' => 'Portale digitale del Consiglio locale',
            'territory' => 'località',
        ],
    ],
];
