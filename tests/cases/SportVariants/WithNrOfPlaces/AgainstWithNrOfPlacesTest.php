<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\SportVariants\WithNrOfPlaces;

use PHPUnit\Framework\TestCase;
use SportsHelpers\GameMode;
use SportsHelpers\SportVariants\AgainstOneVsOne;
use SportsHelpers\SportVariants\AgainstOneVsTwo;
use SportsHelpers\SportVariants\Single;
use SportsHelpers\SportVariants\WithNrOfPlaces\AgainstWithNrOfPlaces;

class AgainstWithNrOfPlacesTest extends TestCase
{
    public function testGameMode(): void
    {
        $againstOneVsOne = new AgainstOneVsOne(1);
        self::assertSame(GameMode::Against, $againstOneVsOne->getGameMode());
    }

    public function testTotalNrOfGames(): void
    {
        $againstOneVsOne = new AgainstOneVsOne(1);
        $variantWithNrOfPlaces = new AgainstWithNrOfPlaces(2, $againstOneVsOne);
        self::assertSame(1, $variantWithNrOfPlaces->getTotalNrOfGames());
        $variantWithNrOfPlaces = new AgainstWithNrOfPlaces(3, $againstOneVsOne);
        self::assertSame(3, $variantWithNrOfPlaces->getTotalNrOfGames());
        $variantWithNrOfPlaces = new AgainstWithNrOfPlaces(4, $againstOneVsOne);
        self::assertSame(6, $variantWithNrOfPlaces->getTotalNrOfGames());
        $variantWithNrOfPlaces = new AgainstWithNrOfPlaces(5, $againstOneVsOne);
        self::assertSame(10, $variantWithNrOfPlaces->getTotalNrOfGames());
    }

    public function testAllPlacesPlaySimultaneously(): void
    {
        $againstOneVsOne = new AgainstOneVsOne(1);
        $variantWithNrOfPlaces = new AgainstWithNrOfPlaces(2, $againstOneVsOne);
        self::assertTrue($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());

        $variantWithNrOfPlaces = new AgainstWithNrOfPlaces(3, $againstOneVsOne);
        self::assertFalse($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());

        $variantWithNrOfPlaces = new AgainstWithNrOfPlaces(4, $againstOneVsOne);
        self::assertTrue($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());

        $variantWithNrOfPlaces = new AgainstWithNrOfPlaces(5, $againstOneVsOne);
        self::assertFalse($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());
    }

    public function testTotalNrOfGamesPerPlace(): void
    {
        $sportVariant = new AgainstOneVsOne( 1);
        $variantWithNrOfPlaces = new AgainstWithNrOfPlaces(2, $sportVariant);
        self::assertSame(1, $variantWithNrOfPlaces->getTotalNrOfGamesPerPlace());
        $variantWithNrOfPlaces = new AgainstWithNrOfPlaces(3, $sportVariant);
        self::assertSame(2, $variantWithNrOfPlaces->getTotalNrOfGamesPerPlace());
        $variantWithNrOfPlaces = new AgainstWithNrOfPlaces(4, $sportVariant);
        self::assertSame(3, $variantWithNrOfPlaces->getTotalNrOfGamesPerPlace());
        $variantWithNrOfPlaces = new AgainstWithNrOfPlaces(5, $sportVariant);
        self::assertSame(4, $variantWithNrOfPlaces->getTotalNrOfGamesPerPlace());
    }

    public function testToPersistVariant(): void
    {
        $againstOneVsOne = new AgainstOneVsTwo( 3);
        $persist = $againstOneVsOne->toPersistVariant();
        self::assertSame(GameMode::Against, $persist->getGameMode());
        self::assertSame(1, $persist->getNrOfHomePlaces());
        self::assertSame(2, $persist->getNrOfAwayPlaces());
        self::assertSame(3, $persist->getNrOfCycles());
    }

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
