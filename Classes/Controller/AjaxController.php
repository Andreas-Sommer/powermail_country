<?php
declare(strict_types=1);

/*
 * Copyright (c) 2024 Andreas Sommer <sommer@belsignum.com>, belsignum UG
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 */

namespace Belsignum\PowermailCountry\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class AjaxController extends ActionController
{
    public function countyAction(string $isoCode): ResponseInterface
    {
        $strLength = strlen($isoCode);
        $counties = $this->getCounties($isoCode, $strLength);

        return $this->jsonResponse(json_encode([
            'status' => 'ok',
            'isoCode' => $isoCode,
            'counties' => $counties,
        ], JSON_THROW_ON_ERROR));
    }

    protected function getCounties(string $isoCode, int $strLength): array
    {
        $counties = $this->getCountriesByTypoScriptMapping($isoCode);
        if (!empty($counties)) {
            // mapping is found and prioritised
            return $counties;
        }

        if ($strLength < 2 || $strLength > 3) {
            // Country code does not match TypoScript mapping
            // and length does not match country_zones specification
            return [];
        }

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('static_country_zones');
        $statement = $queryBuilder
            ->select('zn_code', 'zn_name_local')
            ->from('static_country_zones')
            ->where(
                $queryBuilder->expr()->eq(
                    $strLength === 2 ? 'zn_country_iso_2' : 'zn_country_iso_3',
                    $queryBuilder->createNamedParameter($isoCode, \PDO::PARAM_STR)
                )
            )->orderBy('zn_name_local')->executeQuery();
        while ($row = $statement->fetchAssociative()) {
            if ((bool)($this->settings['force_zone_name_as_value'] ?? false)) {
                $row['zn_code'] = $row['zn_name_local'];
            }
            $counties[$row['zn_code']] = $row['zn_name_local'];
        }
        return $counties;
    }

    protected function getCountriesByTypoScriptMapping(string $isoCode): array
    {
        $isoCode = str_replace(' ', '-', $isoCode);
        $countryZones = $this->settings['mapping']['country_zones'][strtoupper($isoCode)] ?? [];

        if ((bool)($this->settings['force_zone_name_as_value'] ?? false)) {
            $data = [];
            foreach ($countryZones as $zoneName) {
                $data[$zoneName] = $zoneName;
            }
            $countryZones = $data;
        }

        return $countryZones;
    }
}
