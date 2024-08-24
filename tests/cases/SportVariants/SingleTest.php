<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\SportVariants;

use PHPUnit\Framework\TestCase;
use SportsHelpers\GameMode;
use SportsHelpers\Sport\Variant\WithNrOfPlaces\Single as SingleWithNrOfPlaces;
use SportsHelpers\SportVariants\Single as SingleSportVariant;

class SingleTest extends TestCase
{
    public function testCreation(): void
    {
        $sportVariant = new SingleSportVariant(3, 2);
        self::assertSame(GameMode::Single, $sportVariant->getGameMode());
        self::assertSame(3, $sportVariant->getNrOfGamePlaces());
        self::assertSame(2, $sportVariant->getNrOfGamesPerPlace());
    }

    public function testTotalNrOfGames(): void
    {
        $sportVariant = new SingleSportVariant(3, 2);
        $variantWithNrOfPlaces = new SingleWithNrOfPlaces(9, $sportVariant);
        self::assertSame(6, $variantWithNrOfPlaces->getTotalNrOfGames());
        $variantWithNrOfPlaces = new SingleWithNrOfPlaces(10, $sportVariant);
        self::assertSame(7, $variantWithNrOfPlaces->getTotalNrOfGames());
    }

//    public function testTotalNrOfGamesPerPlace(): void
//    {
//        $sportVariant = new SingleSportVariant(3, 2);
//        self::assertSame(2, $sportVariant->getTotalNrOfGamesPerPlace(9));
//        self::assertSame(2, $sportVariant->getTotalNrOfGamesPerPlace(10));
//    }
//
//    public function testAllPlacesParticipateInGameRound(): void
//    {
//        $sportVariant = new SingleSportVariant(3, 2);
//        self::assertFalse($sportVariant->allPlacesParticipateInGameRound(5));
//        self::assertTrue($sportVariant->allPlacesParticipateInGameRound(6));
//    }

    public function testToPersistVariant(): void
    {
        $sportVariant = new SingleSportVariant(3, 2);
        $persistVariant = $sportVariant->toPersistVariant();
        self::assertSame(0, $persistVariant->getNrOfHomePlaces());
        self::assertSame(0, $persistVariant->getNrOfAwayPlaces());
        self::assertSame(3, $persistVariant->getNrOfGamePlaces());
        self::assertSame(0, $persistVariant->getNrOfH2H());
    }

    public function testToString(): void
    {
        $sportVariant = new SingleSportVariant(3, 2);
        self::assertGreaterThan(0, strlen((string)$sportVariant));
    }

    // @TODO CDK MOVE TO PLANNING
//    public function testMaxNrOfGamesSimultaneously(): void
//    {
//        $withPoule = new SingleWithPoule(5, new SingleSportVariant(2, 4));
//
//        $selfRefereeInfo = new SelfRefereeInfo(SelfReferee::SamePoule, 2);
//        $maxNrOfGamesSimultaneously = $withPoule->getMaxNrOfGamesSimultaneously($selfRefereeInfo);
//        self::assertSame(2, $maxNrOfGamesSimultaneously);
//
//        $selfRefereeInfo = new SelfRefereeInfo(SelfReferee::SamePoule, 1);
//        $maxNrOfGamesSimultaneously = $withPoule->getMaxNrOfGamesSimultaneously($selfRefereeInfo);
//        self::assertSame(1, $maxNrOfGamesSimultaneously);
//    }
}
