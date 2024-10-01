<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\SportVariants\Helpers;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Against\AgainstSide;
use SportsHelpers\GameMode;
use SportsHelpers\SportVariants\AgainstOneVsOne;
use SportsHelpers\SportVariants\AgainstOneVsTwo;
use SportsHelpers\SportVariants\AgainstTwoVsTwo;
use SportsHelpers\SportVariants\AllInOneGame;
use SportsHelpers\SportVariants\Helpers\MinNrOfPlacesCalculator;
use SportsHelpers\SportVariants\Helpers\SportVariantWithNrOfPlacesCreator;
use SportsHelpers\SportVariants\Single;

class  MinNrOfPlacesCalculatorTest extends TestCase
{
    public function testGetMinNrOfPlacesPerPoule_ZeroSports(): void
    {
        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->calculateMinNrOfPlacesPerPoule([]);
        self::assertSame(2, $minNrOfPlacesPerPoule);
    }

    public function testGetMinNrOfPlacesPerPoule_Single(): void
    {
        $single = new Single(1, 1);
        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->calculateMinNrOfPlacesPerPoule([$single]);
        self::assertSame(2, $minNrOfPlacesPerPoule);
    }
}
