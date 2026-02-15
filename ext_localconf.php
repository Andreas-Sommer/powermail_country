<?php

// Prevent Script from beeing called directly
defined('TYPO3') || die('Access denied.');

// encapsulate all locally defined variables
(function () {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\In2code\Powermail\Domain\Model\Field::class] = [
        'className' => \Belsignum\PowermailCountry\Domain\Model\Field::class,
    ];

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'PowermailCountry',
        'Ajax',
        [
            \Belsignum\PowermailCountry\Controller\AjaxController::class => 'county'
        ],
        [
            \Belsignum\PowermailCountry\Controller\AjaxController::class => 'county'
        ]
    );
})();
