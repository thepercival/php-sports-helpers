<?php

namespace SportsHelpers\Tests\Sport;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Sport\GamePlaceCalculator;
use SportsHelpers\Sport\Variant\Against\H2h as AgainstH2hSportVariant;
use SportsHelpers\Sport\Variant\Against\GamesPerPlace as AgainstGppSportVariant;

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

        $sport1 = new AgainstH2hSportVariant(1, 1, 1);
        $totalNrOfGames += $sport1->getTotalNrOfGamesPerPlace($nrOfPlaces);

        $sport2 = new AgainstGppSportVariant(1, 2, 1);
        $totalNrOfGames += $sport2->getNrOfGamesPerPlace();

        $calculator = new GamePlaceCalculator();
        self::assertSame(
            $totalNrOfGames,
            $calculator->getMaxNrOfGamesPerPlace(
                $nrOfPlaces,
                [$sport1, $sport2]
            )
        );
    }
}
