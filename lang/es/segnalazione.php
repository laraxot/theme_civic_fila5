<?php

declare(strict_types=1);

/*
 * Catalogo `es`: segnalazione. Struttura e chiavi come `en`; i testi sono tradotti, non ereditati.
 * @see docs/contracts/i18n-catalog-parity.md
 */
return [
    'next' => 'Siguiente',
    'back' => 'Atrás',
    'submit' => 'Enviar',
    'required' => 'obligatorio',
    'max_chars' => 'Máx. :max caracteres',
    'privacy' => [
        'title' => 'Política de privacidad',
        'description' => 'Lee la política antes de continuar',
        'details' => 'Para más información sobre el tratamiento de los datos personales, consulta la ',
        'link_label' => 'política de privacidad.',
        'accept_label' => 'He leído y comprendido la política de privacidad',
    ],
    'dati' => [
        'title' => 'Detalles de la incidencia',
        'place_label' => 'Lugar de la incidencia de servicio',
        'place_placeholder' => 'Ej.: Via Roma 1, Florencia',
        'details_label' => 'Detalles de la incidencia de servicio',
        'type_label' => 'Tipo de incidencia de servicio*',
        'type_select' => 'Seleccionar...',
        'types' => [
            'verde' => 'Zonas verdes públicas y mobiliario urbano',
            'illuminazione' => 'Alumbrado público',
            'strade' => 'Mantenimiento de calles',
            'rifiuti' => 'Gestión de residuos',
            'altro' => 'Otro',
        ],
        'title_label' => 'Título',
        'title_placeholder' => 'Breve descripción del problema',
        'description_label' => 'Descripción*',
        'description_placeholder' => 'Describe la incidencia de servicio...',
        'images_label' => 'Imágenes',
        'images_hint' => 'Selecciona una o más imágenes',
        'no_file' => 'Ningún archivo seleccionado',
    ],
    'riepilogo' => [
        'title' => 'Resumen de la incidencia',
        'warning_title' => 'Atención',
        'warning_text' => 'La información facilitada tiene valor de declaración. Comprueba que sea correcta.',
        'disservizio_section' => 'Incidencia de servicio',
        'contacts_section' => 'Contactos',
        'terms_label' => 'Confirmo que la información es veraz y acepto las',
        'terms_link' => 'condiciones del servicio',
        'submit_label' => 'Enviar incidencia',
    ],
    'conferma' => [
        'title' => 'Incidencia enviada',
        'subtitle' => 'Gracias, hemos recibido tu <strong>incidencia :code.</strong>',
        'visibility' => 'Será visible en la <a href=":url" class="t-primary">lista de todas las incidencias</a> una vez que la administración se haga cargo de ella.',
        'email_sent' => 'Hemos enviado el resumen al correo electrónico:<br><strong>:email</strong>',
        'download_receipt' => 'Descargar el recibo (PDF 100KB)',
        'consult_request' => 'Consultar la solicitud',
        'in_area' => 'en tu área personal',
        'related_services' => 'Servicios relacionados',
    ],
    'elenco' => [
        'title' => 'Lista de incidencias',
        'subtitle' => 'En los últimos 12 meses se han resuelto :count incidencias.',
        'results' => ':count Resultados',
        'map_tab' => 'Mapa',
        'list_tab' => 'Lista',
        'make_report_title' => 'Comunicar una incidencia',
        'make_report_text' => 'Si quieres añadir una incidencia, puedes hacerlo después de autenticarte con tus credenciales SPID o CIE.',
        'make_report_btn' => 'Comunicar una incidencia',
        'load_more' => 'Cargar más incidencias',
        'rating_question' => '¿Qué tan fácil fue usar este servicio?',
        'rating_legend' => 'Valora de 1 a 5 estrellas',
    ],
    'filters' => [
        'legend' => [
            'label' => 'Categoría',
        ],
    ],
    'filter' => [
        'button' => [
            'label' => 'Filtrar',
        ],
        'remove' => [
            'label' => 'Quitar todos los filtros',
        ],
    ],
    'results' => [
        'count' => [
            'text' => ':count Resultados',
        ],
        'empty' => 'Ninguna incidencia coincide con los filtros seleccionados.',
    ],
    'card' => [
        'type' => [
            'label' => 'Tipo de incidencia',
        ],
        'expand' => [
            'button' => [
                'label' => 'Mostrar todo',
            ],
        ],
        'address' => [
            'label' => 'Dirección',
        ],
        'detail' => [
            'label' => 'Detalles',
        ],
        'images' => [
            'label' => 'Imágenes',
        ],
        'no_images' => [
            'label' => 'No hay imágenes disponibles',
        ],
        'edit' => [
            'label' => 'Modificar',
        ],
    ],
    'map' => [
        'image' => [
            'alt' => 'Mapa de las incidencias públicas',
        ],
        'cta' => [
            'title' => 'Comunicar una incidencia',
            'text' => 'Comunica una incidencia al Ayuntamiento después de iniciar sesión.',
            'button' => 'Comunicar una incidencia',
        ],
    ],
    'contacts' => [
        'title' => 'Contacta con el Ayuntamiento',
        'faq' => 'Leer las preguntas frecuentes',
        'assistance' => 'Solicitar asistencia',
        'phone' => 'Llama al número gratuito 05 0505',
        'appointment' => 'Reservar cita',
    ],
];
