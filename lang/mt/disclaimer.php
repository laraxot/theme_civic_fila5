<?php

declare(strict_types=1);

/*
 * Maltese catalogue (`mt`): disclaimer. BOZZA, non rivista da un madrelingua (docs/adr/0010-catalogo-maltese-bozza-e-revisione.md).
 * Chiavi e struttura come `en` (riferimento). Un testo che comincia per `[[MT-REV]] ` non e' tradotto o non e' sicuro: dopo il
 * marcatore c'e' il testo inglese. Elenco: `php tests/Unit/I18n/Support/lang-parity-report.php --pending=mt` (da `laravel/Themes/Civic`).
 */
return [
    'title' => '[[MT-REV]] Disclaimer',
    'subtitle' => '[[MT-REV]] Terms of use and limitation of liability',
    'purpose' => '[[MT-REV]] Purpose of the service',
    'purpose_text' => '[[MT-REV]] The site provides services and information for citizens. Use of the site is at the user\'s own risk: contents are provided as-is and do not constitute professional or legal advice.',
    'legal_notices' => '[[MT-REV]] Legal notices',
    'ownership' => '[[MT-REV]] Data controller',
    'ownership_text' => '[[MT-REV]] The site is managed by {{ institution }}. For personal data, see the privacy notice; for cookies, the cookie policy.',
    'ip_rights' => '[[MT-REV]] Intellectual property',
    'ip_rights_text' => '[[MT-REV]] Texts, images, logos and emblems are protected by copyright and belong to their respective owners. Content published by the institution is reusable under the indicated licence, with attribution.',
    'restrictions' => '[[MT-REV]] Prohibited uses',
    'restriction_personal' => '[[MT-REV]] Personal, non-commercial use',
    'restriction_no_copy' => '[[MT-REV]] Do not copy, distribute or create derivative works without authorisation',
    'restriction_no_derivative' => '[[MT-REV]] Do not use trademarks or logos in a way that suggests an affiliation',
    'restriction_illegal' => '[[MT-REV]] Do not use the site for unlawful or harmful purposes',
    'limitation_liability' => '[[MT-REV]] Limitation of liability',
    'limitation_text' => '[[MT-REV]] The institution is not liable for damages arising from the use of the site or the inability to use it, to the extent permitted by law. This clause does not exclude liability that the law does not permit to be excluded.',
    'external_links' => '[[MT-REV]] Third-party links',
    'external_links_text' => '[[MT-REV]] The site may contain links to external sites that the institution does not control. A link does not imply approval; the institution is not responsible for the content of third-party sites.',
    'changes' => '[[MT-REV]] Changes',
    'changes_text' => '[[MT-REV]] The institution may modify these terms at any time. The version in force is the one published on this page.',
    'governing_law' => '[[MT-REV]] Applicable law',
    'governing_law_text' => '[[MT-REV]] These terms are governed by Italian law. Any dispute relating to the service shall be subject to the competent Italian court.',
    'contact' => 'Kuntatt',
    'last_updated' => '[[MT-REV]] Last updated: {{ date }}',
];
