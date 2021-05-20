<?php

namespace SportsHelpers\Tests\Sport;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Sport\GamePlaceCalculator;
use SportsHelpers\Sport\Variant\Against as AgainstSportVariant;

final class GamePlaceCalculatorTest extends TestCase
{
    public function testNrOfGamePlaces(): void
    {
        $calculator = new GamePlaceCalculator();

        self::assertSame(3, $calculator->getNrOfGamePlaces(2, true));
        self::assertSame(2, $calculator->getNrOfGamePlaces(2, false));
    }

//    public function testMaxNrOfGamePlaces(): void
//    {
//        $sport1 = new SportGameAmountVariant(GameMode::AGAINST, 1, 1, 2, 1);
//        $sport2 = new SportGameAmountVariant(GameMode::AGAINST, 1, 2, 2, 1);
//
//        $sportConfigService = new GamePlaceCalculator();
//        self::assertSame(4, $sportConfigService->getMaxNrOfGamePlaces([$sport1,$sport2], true));
//    }

    public function testNrGamesPerPlace(): void
    {
        $nrOfPlaces = 5;
        $totalNrOfGames = 0;

        $sport1 = new AgainstSportVariant(1, 1, 1, 0);
        $totalNrOfGames += $sport1->getTotalNrOfGamesPerPlace($nrOfPlaces);

        $sport2 = new AgainstSportVariant(1, 2, 0, 1);
        $totalNrOfGames += $sport2->getTotalNrOfGamesPerPlace($nrOfPlaces);

        $calculator = new GamePlaceCalculator();
        self::assertSame($totalNrOfGames, $calculator->getMaxNrOfGamesPerPlace(
            $nrOfPlaces,
            [$sport1,$sport2]
        ));
    }
}
