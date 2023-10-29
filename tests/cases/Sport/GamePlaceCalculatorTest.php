<?php

namespace SportsHelpers\Tests\Sport;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Sport\GamePlaceCalculator;
use SportsHelpers\Sport\Variant\Against\H2h as AgainstH2hSportVariant;
use SportsHelpers\Sport\Variant\Against\GamesPerPlace as AgainstGppSportVariant;
use SportsHelpers\Sport\Variant\WithPoule\Against\H2h as AgainstH2hWithPoule;
use SportsHelpers\Sport\Variant\WithPoule\Against\GamesPerPlace as AgainstGppWithPoule;

final class GamePlaceCalculatorTest extends TestCase
{
    // @TODO CDK MOVE TO PLANNING
    public function testNrOfGamePlaces(): void
    {
        // $calculator = new GamePlaceCalculator();
        self::expectNotToPerformAssertions();
//        self::assertSame(3, $calculator->getNrOfGamePlaces(2, true));
//        self::assertSame(2, $calculator->getNrOfGamePlaces(2, false));
    }

//    public function testMaxNrOfGamePlaces(): void
//    {
//        $sport1 = new SportGameAmountVariant(GameMode::AGAINST, 1, 1, 2, 1);
//        $sport2 = new SportGameAmountVariant(GameMode::AGAINST, 1, 2, 2, 1);
//
//        $sportConfigService = new GamePlaceCalculator();
//        self::assertSame(4, $sportConfigService->getMaxNrOfGamePlaces([$sport1,$sport2], true));
//    }

// @TODO CDK MOVE TO PLANNING
//    public function testNrGamesPerPlace(): void
//    {
//        $nrOfPlaces = 5;
//        $totalNrOfGames = 0;
//
//        $sportVariant1 = new AgainstH2hSportVariant(1, 1, 1);
//        $againstWithPoule1 = new AgainstH2hWithPoule($nrOfPlaces, $sportVariant1);
//
//        $totalNrOfGames += $againstWithPoule1->getTotalNrOfGamesPerPlace();
//
//        $sportVariant2 = new AgainstGppSportVariant(1, 2, 1);
//        $againstWithPoule2 = new AgainstGppWithPoule($nrOfPlaces, $sportVariant2);
//        $totalNrOfGames += $sportVariant2->getNrOfGamesPerPlace();
//
//        $calculator = new GamePlaceCalculator();
//        self::assertSame(
//            $totalNrOfGames,
//            $calculator->getMaxNrOfGamesPerPlace(
//                [$againstWithPoule1, $againstWithPoule2]
//            )
//        );
//    }
}
