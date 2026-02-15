<?php
declare(strict_types=1);

namespace Belsignum\PowermailCountry\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class OptionValueFieldViewHelper extends AbstractViewHelper
{
    protected const FORMAT_FIELD_NAMES = [
        0 => 'isoCodeA2',
        1 => 'isoCodeA3',
        2 => 'shortNameEn',
    ];

    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('format', 'int', 'Format key', true);
    }

    /**
     * Get option value field name
     *
     * @return string
     */
    public function render(): string
    {
        $format = (int)$this->arguments['format'];

        return static::FORMAT_FIELD_NAMES[$format] ?? static::FORMAT_FIELD_NAMES[0];
    }
}
