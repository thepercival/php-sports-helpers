<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\Sports;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Sports\AgainstOneVsTwo;

class  AgainstSportOneVsTwoTest extends TestCase
{
    public function testCreation(): void
    {
        $sportVariant = new AgainstOneVsTwo();
        self::assertSame(1, $sportVariant->nrOfHomePlaces);
        self::assertSame(2, $sportVariant->nrOfAwayPlaces);
    }

//    public function testNrOfGamesOneH2h(): void
//    {
//        $sportVariant1VS1 = new AgainstSportOneVsTwo( 1);
//        self::assertSame(3, $sportVariant1VS1->getNrOfGamesForSingleCycle(3));
//        self::assertSame(12, $sportVariant1VS1->getNrOfGamesForSingleCycle(4));
//        self::assertSame(30, $sportVariant1VS1->getNrOfGamesForSingleCycle(5));
//        self::assertSame(60, $sportVariant1VS1->getNrOfGamesForSingleCycle(6));
//    }

//    public function testIsMixed(): void
//    {
//        $sportVariant1VS1 = new AgainstSportH2hVariant(1, 1, 1);
//        self::assertFalse($sportVariant1VS1->isMixed());
//
//        $sportVariant1VS2 = new AgainstSportGppVariant(1, 2, 1);
//        self::assertTrue($sportVariant1VS2->isMixed());
//
//        $sportVariant2VS2 = new AgainstSportGppVariant(2, 2, 11);
//        self::assertTrue($sportVariant2VS2->isMixed());
//    }

//    public function testGetNrOfAgainstCombinationsPerGame(): void
//    {
//        $sportVariant = new AgainstSportOneVsTwo(1);
//        self::assertSame(2, $sportVariant->getNrOfAgainstCombinationsPerGame());
//    }
//
//    public function testToPersistVariant(): void
//    {
//        $sportVariant = new AgainstSportOneVsTwo( 1);
//        $persistVariant = $sportVariant->toPersistVariant();
//        self::assertSame(1, $persistVariant->getNrOfHomePlaces());
//        self::assertSame(2, $persistVariant->getNrOfAwayPlaces());
//        self::assertSame(0, $persistVariant->getNrOfGamePlaces());
//        self::assertSame(1, $persistVariant->getNrOfCycles());
//    }
//
//    public function testToString(): void
//    {
//        $sportVariant = new AgainstSportOneVsTwo( 3);
//        self::assertGreaterThan(0, strlen((string)$sportVariant));
//    }
}
