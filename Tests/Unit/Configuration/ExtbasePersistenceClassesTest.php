<?php

declare(strict_types=1);

namespace Belsignum\PowermailCountry\Tests\Unit\Configuration;

use Belsignum\PowermailCountry\Domain\Model\Field as CountryField;
use In2code\Powermail\Domain\Model\Field as PowermailField;
use PHPUnit\Framework\TestCase;

final class ExtbasePersistenceClassesTest extends TestCase
{
    /**
     * @var array<class-string, array<string, mixed>>
     */
    private array $classesConfiguration;

    protected function setUp(): void
    {
        parent::setUp();

        $this->classesConfiguration = require dirname(__DIR__, 3) . '/Configuration/Extbase/Persistence/Classes.php';
    }

    public function testPowermailFieldIsNotMappedToCountryFieldSubclass(): void
    {
        self::assertArrayNotHasKey(PowermailField::class, $this->classesConfiguration);
    }

    public function testCountryFieldKeepsCountryRecordTypeMapping(): void
    {
        self::assertSame(
            'country',
            $this->classesConfiguration[CountryField::class]['recordType'] ?? null
        );
    }
}
