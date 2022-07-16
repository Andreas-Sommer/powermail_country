<?php
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
defined('TYPO3_MODE') || die();

/**
 * Include TypoScript
 */
ExtensionManagementUtility::addStaticFile(
    'powermail_country',
    'Configuration/TypoScript/',
    'Main Template'
);
