<?php
declare(strict_types = 1);

return [
	\Belsignum\PowermailCountry\Domain\Model\Field::class => [
		'tableName' => 'tx_powermail_domain_model_field',
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
