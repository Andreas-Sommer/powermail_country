<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Powermail Country',
    'description' => 'Improve Country selection based on static_info_tables with Powermail',
    'category' => 'plugin',
    'author' => 'Andreas Sommer',
    'author_email' => 'sommer@belsignum.com',
    'state' => 'beta',
    'version' => '10.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-10.4.99',
			'powermail' => '8.0.0-8.9.99',
			'static_info_tables' => '6.9.6'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
