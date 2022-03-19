<?php

namespace Belsignum\PowermailCountry\ViewHelpers;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class OptionLabelFieldViewHelper extends AbstractViewHelper
{
	/**
	 * Get option label field name
	 *
	 * @return string
	 */
	public function render(): string
	{
		$language = $GLOBALS['TYPO3_REQUEST']->getAttribute('language')->getTwoLetterIsoCode();
		$extKey = "static_info_tables_{$language}";
		if(ExtensionManagementUtility::isLoaded($extKey))
		{
			$labelFieldName = 'shortName' . ucfirst($language);
		}
		else
		{
			$labelFieldName = 'shortNameEn';
		}
		return $labelFieldName;
	}
}
