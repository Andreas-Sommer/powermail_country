<?php
defined('TYPO3_MODE') || die();

/**
 * Include TypoScript
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'powermail_country',
    'Configuration/TypoScript/',
    'Main Template'
);
