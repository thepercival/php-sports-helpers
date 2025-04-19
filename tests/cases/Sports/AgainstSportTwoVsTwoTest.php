<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\Sports;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Sports\AgainstTwoVsTwo;

class  AgainstSportTwoVsTwoTest extends TestCase
{
    public function testCreation(): void
    {
        $sportVariant = new AgainstTwoVsTwo();
        self::assertSame(2, $sportVariant->nrOfHomePlaces);
        self::assertSame(2, $sportVariant->nrOfAwayPlaces);
    }

//    public function testGetNrOfAgainstCombinationsPerGame(): void
//    {
//        $sportVariant = new AgainstSportTwoVsTwo(1);
//        self::assertSame(4, $sportVariant->getNrOfAgainstCombinationsPerGame());
//    }
//
//    public function testNrOfGamesForSingleCycle(): void
//    {
//        $sportVariant1VS1 = new AgainstSportTwoVsTwo( 1);
//        self::assertSame(3, $sportVariant1VS1->getNrOfGamesForSingleCycle(4));
//        self::assertSame(15, $sportVariant1VS1->getNrOfGamesForSingleCycle(5));
//        self::assertSame(45, $sportVariant1VS1->getNrOfGamesForSingleCycle(6));
//        self::assertSame(105, $sportVariant1VS1->getNrOfGamesForSingleCycle(7));
//        self::assertSame(210, $sportVariant1VS1->getNrOfGamesForSingleCycle(8));
//        self::assertSame(378, $sportVariant1VS1->getNrOfGamesForSingleCycle(9));
//        self::assertSame(630, $sportVariant1VS1->getNrOfGamesForSingleCycle(10));
//    }
//
//    public function testToPersistVariant(): void
//    {
//        $sportVariant = new AgainstSportTwoVsTwo( 1);
//        $persistVariant = $sportVariant->toPersistVariant();
//        self::assertSame(2, $persistVariant->getNrOfHomePlaces());
//        self::assertSame(2, $persistVariant->getNrOfAwayPlaces());
//        self::assertSame(0, $persistVariant->getNrOfGamePlaces());
//        self::assertSame(1, $persistVariant->getNrOfCycles());
//    }
//
//    public function testToString(): void
//    {
//        $sportVariant = new AgainstSportTwoVsTwo( 3);
//        self::assertGreaterThan(0, strlen((string)$sportVariant));
//    }
}
