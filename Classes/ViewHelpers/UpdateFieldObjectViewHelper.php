<?php

namespace Belsignum\PowermailCountry\ViewHelpers;

use In2code\Powermail\Domain\Model\Field;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class UpdateFieldObjectViewHelper extends AbstractViewHelper
{
	/**
	 * @return void
	 */
	public function initializeArguments()
	{
		parent::initializeArguments();
		$this->registerArgument('field', Field::class, 'Field object', true);
        $this->registerArgument('values', 'array', 'Field values to update', true);
    }
	public function render(): Field
	{
		/** @var Field $field */
		$field = $this->arguments['field'];
        $values = $this->arguments['values'];

        foreach ($values as $name => $value)
        {
            $field->_setProperty($name, $value);
        }

		return $field;
	}
}
