<?php

declare(strict_types=1);

namespace Belsignum\PowermailCountry\ViewHelpers;

use Belsignum\PowermailCountry\Service\FieldConfigurationProvider;
use In2code\Powermail\Domain\Model\Field;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

final class FieldConfigurationViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('field', Field::class, 'Field object', true);
    }

    /**
     * @return array{format: int, limit: int, showCounty: bool, territories: string}
     */
    public function render(): array
    {
        return GeneralUtility::makeInstance(FieldConfigurationProvider::class)
            ->getConfiguration($this->arguments['field']);
    }
}
