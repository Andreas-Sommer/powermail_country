<?php
declare(strict_types=1);

namespace Belsignum\PowermailCountry\ViewHelpers;

use Belsignum\PowermailCountry\Domain\Model\Field;
use SJBR\StaticInfoTables\Domain\Model\Territory;
use SJBR\StaticInfoTables\Domain\Repository\CountryRepository;
use SJBR\StaticInfoTables\Domain\Repository\TerritoryRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class CountriesViewHelper extends AbstractViewHelper
{
    protected CountryRepository $countryRepository;

    public function initialize(): void
    {
        parent::initialize();
        $this->countryRepository = GeneralUtility::makeInstance(CountryRepository::class);
    }

    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('field', Field::class, 'Field object', true);
    }

    /**
     * Get array with countries
     *
     * @return array
     */
    public function render(): array
    {
        /** @var Field $field */
        $field = $this->arguments['field'];

        switch ($field->getLimit())
        {
            case 0:
            default:
                $countries = $this->countryRepository->findAll()->toArray();
                break;
            case 1:
                $countries = $this->countryRepository->findBy(['euMember' => true])->toArray();
                break;
            case 2:
                $countries = $this->countryRepository->findBy(['unMember' => true])->toArray();
                break;
            case 3:
                /** @var TerritoryRepository $territoryRepository */
                $territoryRepository = GeneralUtility::makeInstance(TerritoryRepository::class);
                $territories = $territoryRepository->findAllByUidInList($field->getTerritories())->toArray();
                $countries = $this->findByTerritories($territories);
                break;
        }

        // Hook post country collection generation
        if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['powermail_countries']['postCountryCollectionGeneration'] ?? null))
        {
            foreach ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['powermail_countries']['postCountryCollectionGeneration'] as $classRef)
            {
                $procObj = GeneralUtility::makeInstance($classRef);
                $countries = $procObj->postCountryCollectionProcess($countries, $this);
            }
        }

        return $countries;
    }

    /**
     * @param Territory[] $territories
     *
     * @return array
     */
    public function findByTerritories(array $territories): array
    {
        $countries = [];
        /**
         * @var int $_
         * @var Territory $territory
         */
        foreach ($territories as $_ => $territory)
        {
            $countries[] = $this->countryRepository->findByTerritory($territory)->toArray();
        }

        if ($countries === [])
        {
            return [];
        }

        return array_merge(...$countries);
    }
}
