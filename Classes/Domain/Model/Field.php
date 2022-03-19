<?php
declare(strict_types=1);
namespace Belsignum\PowermailCountry\Domain\Model;

/**
 * Class Field
 */
class Field extends \In2code\Powermail\Domain\Model\Field
{
    /**
     * @var int
     */
    protected $format = 0;

    /**
     * @var int
     */
    protected $limit = 0;

    /**
     * @var string
     */
    protected $territories = '';

	/**
	 * @return int
	 */
	public function getFormat(): int
	{
		return $this->format;
	}

	/**
	 * @param int $format
	 */
	public function setFormat(int $format): void
	{
		$this->format = $format;
	}

	/**
	 * @return int
	 */
	public function getLimit(): int
	{
		return $this->limit;
	}

	/**
	 * @param int $limit
	 */
	public function setLimit(int $limit): void
	{
		$this->limit = $limit;
	}

	/**
	 * @return string
	 */
	public function getTerritories(): string
	{
		return $this->territories;
	}

	/**
	 * @param string $territories
	 */
	public function setTerritories(string $territories): void
	{
		$this->territories = $territories;
	}

}
