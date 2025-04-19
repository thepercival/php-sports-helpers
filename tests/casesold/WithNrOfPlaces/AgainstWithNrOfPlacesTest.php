<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\Sports\WithNrOfPlaces;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Sports\AgainstSportOneVsOne;
use SportsHelpers\Sports\AgainstSportOneVsTwo;
use SportsHelpers\Sports\AgainstSportTwoVsTwo;
use SportsHelpers\Sports\WithNrOfPlaces\AgainstOneVsOneSportWithNrOfPlaces;

class AgainstWithNrOfPlacesTest extends TestCase
{
//    public function testGameMode(): void
//    {
//        $againstOneVsOne = new AgainstSportOneVsOne(1);
//        self::assertSame(GameMode::Against, $againstOneVsOne->getGameMode());
//    }

    public function testCreateException(): void
    {
        self::expectException(\Exception::class);
        new AgainstOneVsOneSportWithNrOfPlaces(1, new AgainstSportOneVsOne());
    }

//    public function testGetSportVariant(): void
//    {
//        $againstOneVsOne = new AgainstSportOneVsOne(1);
//        $againstOneVsOneWithNrOfPlaces = new AgainstSportWithNrOfPlaces(4, $againstOneVsOne);
//        self::assertSame($againstOneVsOne, $againstOneVsOneWithNrOfPlaces->getSportVariant());
//    }

//    public function testCalcNrOfGamesPerCycle(): void
//    {
//        $variantWithNrOfPlaces = new AgainstSportWithNrOfPlaces(2, new AgainstSportOneVsOne());
//        self::assertSame(1, $variantWithNrOfPlaces->calcTotalNrOfGames(1, 0));
//        $variantWithNrOfPlaces2 = new AgainstSportWithNrOfPlaces(3, new AgainstSportOneVsOne());
//        self::assertSame(3, $variantWithNrOfPlaces2->calcTotalNrOfGames(1, 0));
//        $variantWithNrOfPlaces3 = new AgainstSportWithNrOfPlaces(4, new AgainstSportOneVsOne());
//        self::assertSame(6, $variantWithNrOfPlaces3->calcTotalNrOfGames(1, 0));
//        $variantWithNrOfPlaces4 = new AgainstSportWithNrOfPlaces(5, new AgainstSportOneVsOne());
//        self::assertSame(10, $variantWithNrOfPlaces4->calcTotalNrOfGames(1, 0));
//    }

//    public function testCalcTotalNrOfGames(): void
//    {
//        $againstOneVsOneWithNrOfPlaces = new AgainstSportWithNrOfPlaces(2, new AgainstSportOneVsOne());
//        self::assertSame(1, $againstOneVsOneWithNrOfPlaces->calcTotalNrOfGames(1,0));
//        $againstOneVsOneWithNrOfPlaces2 = new AgainstSportWithNrOfPlaces(3, new AgainstSportOneVsOne());
//        self::assertSame(3, $againstOneVsOneWithNrOfPlaces2->calcTotalNrOfGames(1, 0));
//        $againstOneVsOneWithNrOfPlaces3 = new AgainstSportWithNrOfPlaces(4, new AgainstSportOneVsOne());
//        self::assertSame(6, $againstOneVsOneWithNrOfPlaces3->calcTotalNrOfGames(1, 0));
//        $againstOneVsOneWithNrOfPlaces4 = new AgainstSportWithNrOfPlaces(5, new AgainstSportOneVsOne());
//        self::assertSame(10, $againstOneVsOneWithNrOfPlaces4->calcTotalNrOfGames(1, 0));
//    }

//    public function testGetTotalNrOfGamePlaces(): void
//    {
//        $againstOneVsOne = new AgainstSportOneVsOne(1);
//        $variantWithNrOfPlaces = new AgainstSportWithNrOfPlaces(2, $againstOneVsOne);
//        self::assertSame(2, $variantWithNrOfPlaces->getTotalNrOfGamePlaces());
//        $variantWithNrOfPlaces = new AgainstSportWithNrOfPlaces(3, $againstOneVsOne);
//        self::assertSame(6, $variantWithNrOfPlaces->getTotalNrOfGamePlaces());
//    }
//
//    public function testAllPlacesPlaySimultaneously(): void
//    {
//        $againstOneVsOne = new AgainstSportOneVsOne(1);
//        $variantWithNrOfPlaces = new AgainstSportWithNrOfPlaces(2, $againstOneVsOne);
//        self::assertTrue($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());
//
//        $variantWithNrOfPlaces = new AgainstSportWithNrOfPlaces(3, $againstOneVsOne);
//        self::assertFalse($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());
//
//        $variantWithNrOfPlaces = new AgainstSportWithNrOfPlaces(4, $againstOneVsOne);
//        self::assertTrue($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());
//
//        $variantWithNrOfPlaces = new AgainstSportWithNrOfPlaces(5, $againstOneVsOne);
//        self::assertFalse($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());
//    }
//
//    public function testTotalNrOfGamesPerPlace(): void
//    {
//        $sportVariant = new AgainstSportOneVsOne( 1);
//        $variantWithNrOfPlaces = new AgainstSportWithNrOfPlaces(2, $sportVariant);
//        self::assertSame(1, $variantWithNrOfPlaces->getTotalNrOfGamesPerPlace());
//        $variantWithNrOfPlaces = new AgainstSportWithNrOfPlaces(3, $sportVariant);
//        self::assertSame(2, $variantWithNrOfPlaces->getTotalNrOfGamesPerPlace());
//        $variantWithNrOfPlaces = new AgainstSportWithNrOfPlaces(4, $sportVariant);
//        self::assertSame(3, $variantWithNrOfPlaces->getTotalNrOfGamesPerPlace());
//        $variantWithNrOfPlaces = new AgainstSportWithNrOfPlaces(5, $sportVariant);
//        self::assertSame(4, $variantWithNrOfPlaces->getTotalNrOfGamesPerPlace());
//    }
//
//    public function testToPersistVariant(): void
//    {
//        $againstOneVsOne = new AgainstSportOneVsTwo( 3);
//        $persist = $againstOneVsOne->toPersistVariant();
//        self::assertSame(GameMode::Against, $persist->getGameMode());
//        self::assertSame(1, $persist->getNrOfHomePlaces());
//        self::assertSame(2, $persist->getNrOfAwayPlaces());
//        self::assertSame(3, $persist->getNrOfCycles());
//    }
//
//    public function testGetMaxNrOfGamesSimultaneously() : void
//    {
//        $sportVariant = new AgainstSportOneVsOne( 1);
//        $variantWithNrOfPlaces = new AgainstSportWithNrOfPlaces(5, $sportVariant);
//        self::assertSame(2, $variantWithNrOfPlaces->getMaxNrOfGamesSimultaneously());
//    }

    // @TODO CDK MOVE TO PLANNING
//    public function testMaxNrOfGamesSimultaneously(): void
//    {
//        $WithNrOfPlaces = new AgainstH2hWithNrOfPlaces(5, new AgainstH2h(1, 1 , 1));
//
//        $selfRefereeInfo = new SelfRefereeInfo(SelfReferee::SamePoule, 2);
//        $maxNrOfGamesSimultaneously = $WithNrOfPlaces->getMaxNrOfGamesSimultaneously($selfRefereeInfo);
//        self::assertSame(2, $maxNrOfGamesSimultaneously);
//
//        $selfRefereeInfo = new SelfRefereeInfo(SelfReferee::SamePoule, 1);
//        $maxNrOfGamesSimultaneously = $WithNrOfPlaces->getMaxNrOfGamesSimultaneously($selfRefereeInfo);
//        self::assertSame(1, $maxNrOfGamesSimultaneously);
//    }
}
