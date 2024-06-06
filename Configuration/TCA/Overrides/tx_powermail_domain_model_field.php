<?php
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use In2code\Powermail\Domain\Model\Field;

/**
 * additional fields
 */
$tmp_powermail_country = [
	'tx_powermailcountry_format' => [
		'label' => 'LLL:EXT:powermail_country/Resources/Private/Language/locallang_db.xlf:' . Field::TABLE_NAME . '.format',
		'config' => [
			'type' => 'radio',
			'default' => '0',
			'items' => [
				['LLL:EXT:powermail_country/Resources/Private/Language/locallang_db.xlf:' . Field::TABLE_NAME . '.country_code.a2', '0'],
				['LLL:EXT:powermail_country/Resources/Private/Language/locallang_db.xlf:' . Field::TABLE_NAME . '.country_code.a3', '1'],
			]
		]
	],
	'tx_powermailcountry_limit' => [
		'label' => 'LLL:EXT:powermail_country/Resources/Private/Language/locallang_db.xlf:' . Field::TABLE_NAME . '.limitation',
		'onChange' => 'reload',
		'config' => [
			'type' => 'radio',
			'default' => '0',
			'items' => [
				['LLL:EXT:powermail_country/Resources/Private/Language/locallang_db.xlf:' . Field::TABLE_NAME . '.limitation.no_limit', '0'],
				['LLL:EXT:powermail_country/Resources/Private/Language/locallang_db.xlf:' . Field::TABLE_NAME . '.limitation.eu', '1'],
				['LLL:EXT:powermail_country/Resources/Private/Language/locallang_db.xlf:' . Field::TABLE_NAME . '.limitation.un', '2'],
				['LLL:EXT:powermail_country/Resources/Private/Language/locallang_db.xlf:' . Field::TABLE_NAME . '.limitation.territories', '3']
			]
		]
	],
    'tx_powermailcountry_show_county' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:powermail_country/Resources/Private/Language/locallang_db.xlf:' . Field::TABLE_NAME . '.show_county',
        'config' => [
            'type' => 'check',
            'items' => [
                // label, value
                ['LLL:EXT:powermail_country/Resources/Private/Language/locallang_db.xlf:' . Field::TABLE_NAME . '.show_county', 1],
            ],
        ],
    ],
	'tx_powermailcountry_territories' => [
		'exclude' => 0,
		'label' => 'LLL:EXT:powermail_country/Resources/Private/Language/locallang_db.xlf:' . Field::TABLE_NAME . '.territories',
		'displayCond' => 'FIELD:tx_powermailcountry_limit:=:3',
		'config' => [
			'type' => 'select',
			'renderType' => 'selectSingleBox',
			'foreign_table' => 'static_territories',
			'minitems' => 1,
			'multiple' => true,
		],
	]
];

ExtensionManagementUtility::addTCAcolumns(
	Field::TABLE_NAME,
	$tmp_powermail_country
);

/**
 * Palette
 */
$GLOBALS['TCA'][Field::TABLE_NAME]['palettes']['country_configuration'] = [
	'showitem' => 'tx_powermailcountry_format, tx_powermailcountry_limit, tx_powermailcountry_show_county, --linebreak--, tx_powermailcountry_territories',
	'canNotCollapse' => 1
];

/**
 * Fieldtype country
 */
$typeCountry = 'pages, title, type, ' .
    '--div--;LLL:EXT:powermail/Resources/Private/Language/locallang_db.xlf:' . Field::TABLE_NAME . '.sheet1, ' .
    '--palette--;LLL:EXT:powermail/Resources/Private/Language/locallang_db.xlf:' .
        Field::TABLE_NAME . '.validation_title;21, ' .
    '--palette--;LLL:EXT:powermail/Resources/Private/Language/locallang_db.xlf:' .
        Field::TABLE_NAME . '.prefill_title;31, ' .
    '--palette--;Layout;43, ' .
	'description, ' .
	'--palette--;LLL:EXT:powermail_country/Resources/Private/Language/locallang_db.xlf:' . Field::TABLE_NAME . '.config;country_configuration, ' .
    '--palette--;LLL:EXT:powermail/Resources/Private/Language/locallang_db.xlf:' .
        Field::TABLE_NAME . '.marker_title;5, ' .
    '--div--;LLL:EXT:powermail/Resources/Private/Language/locallang_db.xlf:tabs.access, ' .
    'sys_language_uid, l10n_parent, l10n_diffsource, hidden, starttime, endtime';


$GLOBALS['TCA'][Field::TABLE_NAME]['types']['country']['showitem'] = $typeCountry;
