<?php

namespace Belsignum\PowermailCountry\ViewHelpers;

use Belsignum\PowermailCountry\Domain\Model\Field;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class OptionValueFieldViewHelper extends AbstractViewHelper
{
	protected const FORMAT_FIELD_NAMES = [
		0 => 'isoCodeA2',
		1 => 'isoCodeA3',
		2 => 'shortNameEn'
	];


	/**
	 * @return void
	 */
	public function initializeArguments()
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
		/** @var Field $field */
		$format = $this->arguments['format'];

		return static::FORMAT_FIELD_NAMES[$format];
	}
}
