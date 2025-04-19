<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\Sports;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Sports\TogetherSport;

class TogetherSportTest extends TestCase
{
    public function testCreation(): void
    {
        $sportVariant = new TogetherSport(3);
        self::assertSame(3, $sportVariant->getNrOfGamePlaces());
    }

    public function testCreationAllInOneGame(): void
    {
        $sportVariant = new TogetherSport(null);
        self::assertSame(null, $sportVariant->getNrOfGamePlaces());
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

//    public function testToPersistVariant(): void
//    {
//        $sportVariant = new SingleSportVariant(3, 2);
//        $persistVariant = $sportVariant->toPersistVariant();
//        self::assertSame(0, $persistVariant->getNrOfHomePlaces());
//        self::assertSame(0, $persistVariant->getNrOfAwayPlaces());
//        self::assertSame(3, $persistVariant->getNrOfGamePlaces());
//        self::assertSame(0, $persistVariant->getNrOfCycles());
//    }

//    public function testToString(): void
//    {
//        $sportVariant = new SingleSportVariant(3, 2);
//        self::assertGreaterThan(0, strlen((string)$sportVariant));
//    }
//
//    public function testToJson(): void
//    {
//        $single = new SingleSportVariant(3, 2);
//        $serializedSingle = json_decode( $single->toJson(), true );
//        self::assertIsArray($serializedSingle);
//        self::assertCount(2, $serializedSingle);
//        self::assertTrue(array_key_exists('nrOfGamesPerPlace', $serializedSingle));
//        self::assertTrue(array_key_exists('nrOfGamePlaces', $serializedSingle));
//    }

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
