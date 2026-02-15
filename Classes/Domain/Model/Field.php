<?php
declare(strict_types=1);

namespace Belsignum\PowermailCountry\Domain\Model;

/**
 * Class Field
 */
class Field extends \In2code\Powermail\Domain\Model\Field
{
    protected int $format = 0;

    protected int $limit = 0;

    protected bool $showCounty = false;

    protected string $territories = '';

    public function getFormat(): int
    {
        return $this->format;
    }

    public function setFormat(int $format): void
    {
        $this->format = $format;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    public function getShowCounty(): bool
    {
        return $this->showCounty;
    }

    public function setShowCounty(bool $showCounty): void
    {
        $this->showCounty = $showCounty;
    }

    public function getTerritories(): string
    {
        return $this->territories;
    }

    public function setTerritories(string $territories): void
    {
        $this->territories = $territories;
    }
}
