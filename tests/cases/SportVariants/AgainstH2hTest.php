<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\SportVariants;

use PHPUnit\Framework\TestCase;
use SportsHelpers\GameMode;
use SportsHelpers\SportVariants\AgainstGpp as AgainstSportGppVariant;
use SportsHelpers\SportVariants\AgainstH2h as AgainstSportH2hVariant;

class  AgainstH2hTest extends TestCase
{
    public function testCreation(): void
    {
        $sportVariant = new AgainstSportH2hVariant(1, 2, 1);
        self::assertSame(GameMode::Against, $sportVariant->getGameMode());
        self::assertSame(1, $sportVariant->nrOfHomePlaces);
        self::assertSame(2, $sportVariant->nrOfAwayPlaces);
        self::assertSame(1, $sportVariant->nrOfH2h);
    }

    public function testNrOfGamesOneH2h(): void
    {
        $sportVariant1VS1 = new AgainstSportH2hVariant(1, 1, 1);
        self::assertSame(1, $sportVariant1VS1->getNrOfGamesOneH2h(2));
        self::assertSame(3, $sportVariant1VS1->getNrOfGamesOneH2h(3));
        self::assertSame(6, $sportVariant1VS1->getNrOfGamesOneH2h(4));
        self::assertSame(10, $sportVariant1VS1->getNrOfGamesOneH2h(5));
        self::assertSame(15, $sportVariant1VS1->getNrOfGamesOneH2h(6));
    }

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



    public function testToPersistVariant(): void
    {
        $sportVariant = new AgainstSportH2hVariant(1, 1, 1);
        $persistVariant = $sportVariant->toPersistVariant();
        self::assertSame(1, $persistVariant->getNrOfHomePlaces());
        self::assertSame(1, $persistVariant->getNrOfAwayPlaces());
        self::assertSame(0, $persistVariant->getNrOfGamePlaces());
        self::assertSame(1, $persistVariant->getNrOfH2h());
    }

    public function testToString(): void
    {
        $sportVariant = new AgainstSportGppVariant(1, 2, 3);
        self::assertGreaterThan(0, strlen((string)$sportVariant));
    }


}
