<?php

// Prevent Script from beeing called directly
defined('TYPO3') || die('Access denied.');

// encapsulate all locally defined variables
(function () {
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
