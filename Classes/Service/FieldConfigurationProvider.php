<?php

declare(strict_types=1);

namespace Belsignum\PowermailCountry\Service;

use In2code\Powermail\Domain\Model\Field;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

final class FieldConfigurationProvider
{
    /**
     * @return array{format: int, limit: int, showCounty: bool, territories: string}
     */
    public function getConfiguration(Field $field): array
    {
        // Country settings live on Powermail field rows, but regular fields must keep the base Powermail model.
        $row = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable(Field::TABLE_NAME)
            ->select(
                [
                    'tx_powermailcountry_format',
                    'tx_powermailcountry_limit',
                    'tx_powermailcountry_show_county',
                    'tx_powermailcountry_territories',
                ],
                Field::TABLE_NAME,
                ['uid' => (int)$field->getUid()]
            )
            ->fetchAssociative();

        return [
            'format' => (int)($row['tx_powermailcountry_format'] ?? 0),
            'limit' => (int)($row['tx_powermailcountry_limit'] ?? 0),
            'showCounty' => (bool)($row['tx_powermailcountry_show_county'] ?? false),
            'territories' => (string)($row['tx_powermailcountry_territories'] ?? ''),
        ];
    }
}
