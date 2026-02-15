<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Powermail Country',
    'description' => 'Improve Country selection based on static_info_tables with Powermail',
    'category' => 'plugin',
    'author' => 'Andreas Sommer',
    'author_email' => 'sommer@belsignum.com',
    'state' => 'stable',
    'version' => '12.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-12.4.99',
			'powermail' => '12.4.0-12.9.99',
			'static_info_tables' => '12.4.4-12.9.99'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
