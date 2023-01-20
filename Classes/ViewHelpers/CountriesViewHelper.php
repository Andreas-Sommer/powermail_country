<?php

namespace Belsignum\PowermailCountry\ViewHelpers;

use In2code\Powermail\Domain\Model\Field;
use In2code\Powermail\Utility\ObjectUtility;
use SJBR\StaticInfoTables\Domain\Model\Territory;
use SJBR\StaticInfoTables\Domain\Repository\CountryRepository;
use SJBR\StaticInfoTables\Domain\Repository\TerritoryRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class CountriesViewHelper extends AbstractViewHelper
{

	/**
	 * @var CountryRepository
	 */
	protected $countryRepository;

	public function initialize()
	{
		parent::initialize();
		$this->countryRepository = ObjectUtility::getObjectManager()->get(CountryRepository::class);
	}

	/**
	 * @return void
	 */
	public function initializeArguments()
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

		switch($field->getLimit())
		{
			case 0:
			default:
				$countries = $this->countryRepository
					->findAll()->toArray();
				break;
			case 1:
				$countries = $this->countryRepository
					->findByEuMember(true)->toArray();
				break;
			case 2:
				$countries = $this->countryRepository
					->findByUnMember(true)->toArray();
				break;
			case 3:
				/** @var TerritoryRepository $territoryRepository */
				$territoryRepository = GeneralUtility::makeInstance(TerritoryRepository::class);
				$territories = $territoryRepository
					->findAllByUidInList($field->getTerritories())->toArray();
				$countries = $this->findByTerritories($territories);
				break;
		}

		// Hook post country collection generation
		if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['powermail_countries']['postCountryCollectionGeneration']))
		{
			foreach ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['powermail_countries']['postCountryCollectionGeneration'] as $classRef) {
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
	public function findByTerritories(array $territories)
	{
		$countries = [];
		/**
		 * @var int $_
		 * @var Territory $territory
		 */
		foreach ($territories as $_ => $territory)
		{
			$countries[] = $this->countryRepository
				->findByTerritory($territory)->toArray();
		}

		return array_merge(...$countries);
	}

}
