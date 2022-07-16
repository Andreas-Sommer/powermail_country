<?php

// Prevent Script from beeing called directly
defined('TYPO3_MODE') or die();

// encapsulate all locally defined variables
(function ()
{
	TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\Container\Container::class)
				  ->registerImplementation(\In2code\Powermail\Domain\Model\Field::class, \Belsignum\PowermailCountry\Domain\Model\Field::class);
})();
