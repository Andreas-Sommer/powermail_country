<?php
declare(strict_types = 1);

use In2code\Powermail\Domain\Model\Field as PowermailField;

return [
	PowermailField::class => [
		'subclasses' => [
			\Belsignum\PowermailCountry\Domain\Model\Field::class,
		],
	],
	\Belsignum\PowermailCountry\Domain\Model\Field::class => [
		'tableName' => 'tx_powermail_domain_model_field',
		'recordType' => 'country',
		'properties' => [
			'format' => [
				'fieldName' => 'tx_powermailcountry_format'
			],
			'limit' => [
				'fieldName' => 'tx_powermailcountry_limit'
			],
			'showCounty' => [
				'fieldName' => 'tx_powermailcountry_show_county'
			],
			'territories' => [
				'fieldName' => 'tx_powermailcountry_territories'
			],
		],
	],
];
