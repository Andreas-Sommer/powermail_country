<?php
declare(strict_types=1);

namespace Belsignum\PowermailCountry\ViewHelpers;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class OptionLabelFieldViewHelper extends AbstractViewHelper
{
    public function render(): string
    {
        $language = $GLOBALS['TYPO3_REQUEST']->getAttribute('language')->getTwoLetterIsoCode();
        $extKey = "static_info_tables_{$language}";
        if (ExtensionManagementUtility::isLoaded($extKey)) {
            $labelFieldName = 'shortName' . ucfirst((string) $language);
        } else {
            $labelFieldName = 'shortNameEn';
        }
        return $labelFieldName;
    }
}
