<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\Sport\Variant\NrOfPlaces\Against;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Against\Side;
use SportsHelpers\Sport\Variant\Against\GamesPerPlace as AgainstSportGppVariant;
use SportsHelpers\Sport\Variant\WithNrOfPlaces\Against\EquallyAssignCalculator;

class EquallyAssignCalculatorTest extends TestCase
{
    public function testEqualAgainst4Places(): void
    {
        $calculator = new EquallyAssignCalculator();

        $againstGppVariants = [
            new AgainstSportGppVariant(2, 2, 6),
            new AgainstSportGppVariant(2, 2, 8),
            new AgainstSportGppVariant(2, 2, 10),
        ];
        // 6 vs (4a2)
        // per game 4 versuses
        // 24 games is de eerste balanced
        // dat is 24 games per place

        self::assertTrue($calculator->assignAgainstSportsEqually(4, $againstGppVariants));
    }

    public function testEqualAgainst5Places(): void
    {
        $calculator = new EquallyAssignCalculator();

        $againstGppVariants = [
            new AgainstSportGppVariant(2, 2, 4),
            new AgainstSportGppVariant(2, 2, 4),
            new AgainstSportGppVariant(2, 2, 4),
            new AgainstSportGppVariant(2, 2, 4),
        ];
        // 10 vs (5a2)
        // per game 4 versuses
        // 20 games is de eerste balanced
        // dat is 16 games per place

        self::assertTrue($calculator->assignAgainstSportsEqually(5, $againstGppVariants));
    }

    public function testEqualWith5Places(): void
    {
        $calculator = new EquallyAssignCalculator();

        $againstGppVariants = [
            new AgainstSportGppVariant(2, 2, 4),
            new AgainstSportGppVariant(2, 2, 4),
        ];
        // 10 vs (5a2)
        // per game 2 with
        // 10 games is de eerste balanced
        // dat is 8 games per place

        self::assertTrue($calculator->assignWithSportsEqually(5, $againstGppVariants));
    }

}
