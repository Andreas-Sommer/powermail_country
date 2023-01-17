<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Powermail Country',
    'description' => 'Improve Country selection based on static_info_tables with Powermail',
    'category' => 'plugin',
    'author' => 'Andreas Sommer',
    'author_email' => 'sommer@belsignum.com',
    'state' => 'beta',
    'version' => '11.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-11.5.99',
			'powermail' => '8.0.0-10.9.99',
			'static_info_tables' => '6.9.6-11.5.99'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
