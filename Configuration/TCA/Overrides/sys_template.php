<?php
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
defined('TYPO3') || die('Access denied.');

/**
 * Include TypoScript
 */
ExtensionManagementUtility::addStaticFile(
    'powermail_country',
    'Configuration/TypoScript/',
    'Main Template'
);
