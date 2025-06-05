<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\Sports\Calculators;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Sports\Calculators\MinNrOfPlacesCalculator;
use SportsHelpers\Sports\TogetherSport;

final class MinNrOfPlacesCalculatorTest extends TestCase
{
    public function testGetMinNrOfPlacesPerPoule_ZeroSports(): void
    {
        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->calculateMinNrOfPlacesPerPoule([]);
        self::assertSame(2, $minNrOfPlacesPerPoule);
    }

    public function testGetMinNrOfPlacesPerPoule_Single(): void
    {
        $sports = [ new TogetherSport(1) ];
        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->calculateMinNrOfPlacesPerPoule($sports);
        self::assertSame(2, $minNrOfPlacesPerPoule);
    }
}
