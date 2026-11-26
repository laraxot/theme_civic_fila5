<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): public_document_type_enum. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'values' => [
        'statute' => [
            'label' => '[[MT-REV]] Statute',
        ],
        'regulation' => [
            'label' => '[[MT-REV]] Regulation',
        ],
        'ordinance' => [
            'label' => '[[MT-REV]] Ordinance',
        ],
        'directive' => [
            'label' => '[[MT-REV]] Directive',
        ],
        'deliberation' => [
            'label' => '[[MT-REV]] Deliberation',
        ],
        'determination' => [
            'label' => '[[MT-REV]] Determination',
        ],
        'decree' => [
            'label' => '[[MT-REV]] Decree',
        ],
        'resolution' => [
            'label' => '[[MT-REV]] Resolution',
        ],
        'circular' => [
            'label' => '[[MT-REV]] Circular',
        ],
        'instruction' => [
            'label' => '[[MT-REV]] Instruction',
        ],
        'plan' => [
            'label' => '[[MT-REV]] Plan',
        ],
        'program' => [
            'label' => '[[MT-REV]] Programme',
        ],
        'budget' => [
            'label' => 'Baġit',
        ],
        'report' => [
            'label' => 'Rapport',
        ],
        'contract' => [
            'label' => '[[MT-REV]] Contract',
        ],
        'agreement' => [
            'label' => '[[MT-REV]] Agreement',
        ],
        'concession' => [
            'label' => '[[MT-REV]] Concession',
        ],
        'authorization' => [
            'label' => '[[MT-REV]] Authorization',
        ],
        'permit' => [
            'label' => '[[MT-REV]] Permit',
        ],
        'license' => [
            'label' => '[[MT-REV]] License',
        ],
        'transparency_act' => [
            'label' => '[[MT-REV]] Transparency act',
        ],
        'publication_notice' => [
            'label' => '[[MT-REV]] Publication notice',
        ],
        'selection_notice' => [
            'label' => '[[MT-REV]] Selection notice',
        ],
        'tender_notice' => [
            'label' => '[[MT-REV]] Tender notice',
        ],
        'form' => [
            'label' => '[[MT-REV]] Forms',
        ],
        'guide' => [
            'label' => '[[MT-REV]] Guide',
        ],
        'manual' => [
            'label' => '[[MT-REV]] Manual',
        ],
        'procedure' => [
            'label' => '[[MT-REV]] Procedure',
        ],
        'specification' => [
            'label' => '[[MT-REV]] Specifications',
        ],
        'minutes' => [
            'label' => '[[MT-REV]] Minutes',
        ],
        'opinion' => [
            'label' => '[[MT-REV]] Opinion',
        ],
        'certificate' => [
            'label' => '[[MT-REV]] Certificate',
        ],
        'other' => [
            'label' => '[[MT-REV]] Other',
        ],
    ],
];
