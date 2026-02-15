<?php
declare(strict_types=1);

namespace Belsignum\PowermailCountry\ViewHelpers;

use In2code\Powermail\Domain\Model\Field;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class UpdateFieldObjectViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('field', Field::class, 'Field object', true);
        $this->registerArgument('values', 'array', 'Field values to update', true);
    }

    public function render(): Field
    {
        /** @var Field $field */
        $field = $this->arguments['field'];
        /** @var array<string, mixed> $values */
        $values = $this->arguments['values'];

        foreach ($values as $name => $value) {
            $setterName = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', (string)$name)));
            if (!method_exists($field, $setterName)) {
                continue;
            }
            $field->{$setterName}($value);
        }

        return $field;
    }
}
