<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): accessibility. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'high_contrast_toggle' => '[[MT-REV]] Toggle high contrast',
    'contrast' => '[[MT-REV]] Contrast',
    'home' => 'Paġna ewlenija',
    'page' => [
        'title' => [
            'text' => 'Dikjarazzjoni dwar l-aċċessibbiltà',
        ],
    ],
    'title' => [
        'text' => 'Dikjarazzjoni dwar l-aċċessibbiltà',
        'label' => 'Dikjarazzjoni dwar l-aċċessibbiltà',
    ],
    'lead' => '[[MT-REV]] Statement made under art. 3-quater of Italian Law no. 4 of 9 January 2004.',
    'incomplete' => [
        'title' => '[[MT-REV]] Statement not complete yet',
        'intro' => '[[MT-REV]] The municipality still has to provide the following information before the service goes live. Until then this statement is not valid.',
    ],
    'scope' => [
        'title' => '[[MT-REV]] Scope of the statement',
        'commitment' => '[[MT-REV]] :entity is committed to making this website accessible, in accordance with Italian Law no. 4 of 9 January 2004, which transposes Directive (EU) 2016/2102.',
        'text' => '[[MT-REV]] This statement applies to the website :url (public pages and the citizen’s personal area).',
    ],
    'status' => [
        'title' => '[[MT-REV]] Compliance status',
        'compliant' => '[[MT-REV]] This website is compliant with the accessibility requirements of Italian Law no. 4 of 9 January 2004.',
        'partially_compliant' => '[[MT-REV]] This website is partially compliant with the accessibility requirements of Italian Law no. 4 of 9 January 2004, due to the cases of non-compliance listed below.',
        'non_compliant' => '[[MT-REV]] This website is not compliant with the accessibility requirements of Italian Law no. 4 of 9 January 2004. The cases of non-compliance are listed below.',
        'pending' => '[[MT-REV]] Not determined yet: the municipality will indicate the status after the accessibility evaluation.',
        'reference' => '[[MT-REV]] Technical reference: standard UNI CEI EN 301 549 V3.2.1 (clause 9), which requires level AA of WCAG 2.1, as provided by the AgID guidelines on the accessibility of IT tools.',
    ],
    'content' => [
        'title' => '[[MT-REV]] Inaccessible content',
        'non_accessible' => '[[MT-REV]] Parts that do not comply with the law',
        'disproportionate_burden' => '[[MT-REV]] Disproportionate burden',
        'out_of_scope' => '[[MT-REV]] Content outside the scope of the law',
        'reason' => '[[MT-REV]] Reason',
        'none' => '[[MT-REV]] The municipality declares no inaccessible content.',
        'pending' => '[[MT-REV]] To be provided by the municipality.',
    ],
    'drafting' => [
        'title' => '[[MT-REV]] Preparation of the statement',
        'method' => '[[MT-REV]] Evaluation method',
        'methods' => [
            'self' => '[[MT-REV]] Self-assessment',
            'third_party' => '[[MT-REV]] Third-party assessment',
        ],
        'evaluation_date' => '[[MT-REV]] Evaluation date',
        'published_at' => '[[MT-REV]] Publication date',
        'updated_at' => '[[MT-REV]] Last update',
        'pending' => '[[MT-REV]] Not provided yet',
        'agid' => '[[MT-REV]] Statement completed on the AgID platform',
        'verified' => '[[MT-REV]] What has been verified',
        'not_verified' => '[[MT-REV]] What has not been verified',
    ],
    'feedback' => [
        'title' => '[[MT-REV]] Feedback and contacts',
        'intro' => '[[MT-REV]] To report an accessibility problem on this site or ask for information, use the form below.',
        'jump' => '[[MT-REV]] Report an accessibility problem',
        'email' => '[[MT-REV]] You can also write to',
        'pending' => '[[MT-REV]] The address for reports will be provided by the municipality.',
        'officer' => '[[MT-REV]] Accessibility officer',
    ],
    'procedure' => [
        'title' => '[[MT-REV]] Enforcement procedure',
        'text' => '[[MT-REV]] If you get no reply within thirty days, or the reply is not satisfactory, you can start the enforcement procedure before the digital ombudsman at AgID (Law 4/2004, art. 3-quinquies).',
        'link' => '[[MT-REV]] Enforcement procedure (AgID)',
    ],
];
