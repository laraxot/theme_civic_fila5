<?php

declare(strict_types=1);

/*
 * Terminología de la entidad por perfil (issue #6): cómo el tema nombra a la entidad, sus oficinas y sus servicios.
 *
 * Un perfil es un conjunto CERRADO de trece términos, igual en cada idioma y en cada perfil (el test de paridad lo
 * comprueba). Cada término es una forma ya compuesta (`of` = «del Ayuntamiento», `to` = «al Ayuntamiento»): los
 * componentes nunca concatenan artículo y nombre, porque artículos y preposiciones cambian con el idioma y el género.
 *
 * El NOMBRE de la entidad («Comune di ...», «Birkirkara Local Council») es un dato del tenant
 * (`config/local/<tenant>/ente.php`, clave `name`), no terminología.
 *
 * Para Malta se mantiene el nombre oficial inglés «Local Council»: no consta un equivalente español establecido
 * (anotado en el informe como pendiente de decidir).
 *
 * @see docs/contracts/i18n-entity-terminology.md
 * @see docs/adr/0011-profili-paese-ente-e-terminologia.md
 */
return [
    'profiles' => [
        // Perfil de respaldo: neutro, sin el modelo institucional de un país.
        'generic' => [
            'name' => 'Administración local',
            'name_plural' => 'Administraciones locales',
            'of' => 'de la administración local',
            'to' => 'a la administración local',
            'your' => 'tu administración local',
            'offices' => 'Oficinas de la administración local',
            'services' => 'Servicios de la administración local',
            'administration' => 'Administración',
            'head' => 'Responsable de la administración',
            'contact_cta' => 'Contactar con la administración local',
            'reports_of' => 'incidencias de la administración local',
            'portal' => 'Portal digital de la administración local',
            'territory' => 'ámbito de competencia',
        ],
        // Italia.
        'comune' => [
            'name' => 'Ayuntamiento',
            'name_plural' => 'Ayuntamientos',
            'of' => 'del Ayuntamiento',
            'to' => 'al Ayuntamiento',
            'your' => 'tu Ayuntamiento',
            'offices' => 'Oficinas municipales',
            'services' => 'Servicios municipales',
            'administration' => 'Administración municipal',
            'head' => 'Alcalde',
            'contact_cta' => 'Contactar con el Ayuntamiento',
            'reports_of' => 'incidencias del Ayuntamiento',
            'portal' => 'Portal digital del Ayuntamiento',
            'territory' => 'término municipal',
        ],
        // Malta.
        'local_council' => [
            'name' => 'Local Council',
            'name_plural' => 'Local Councils',
            'of' => 'del Local Council',
            'to' => 'al Local Council',
            'your' => 'tu Local Council',
            'offices' => 'Oficinas del Local Council',
            'services' => 'Servicios del Local Council',
            'administration' => 'Administración del Local Council',
            'head' => 'Alcalde',
            'contact_cta' => 'Contactar con el Local Council',
            'reports_of' => 'incidencias del Local Council',
            'portal' => 'Portal digital del Local Council',
            'territory' => 'localidad',
        ],
    ],
];
