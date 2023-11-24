<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\Sport\Variant\Against;

use PHPUnit\Framework\TestCase;
use SportsHelpers\GameMode;
use SportsHelpers\Sport\Variant\Against\GamesPerPlace as AgainstSportGppVariant;
use SportsHelpers\Sport\Variant\Against\GamesPerPlace as AgainstGppVariant;
use SportsHelpers\Sport\Variant\WithPoule\Against\GamesPerPlace as AgainstGppWithPoule;

class GamesPerPlaceTest extends TestCase
{
    public function testCreation(): void
    {
        $sportVariant = new AgainstSportGppVariant(1, 2, 1);
        self::assertSame(GameMode::Against, $sportVariant->getGameMode());
        self::assertSame(1, $sportVariant->getNrOfHomePlaces());
        self::assertSame(2, $sportVariant->getNrOfAwayPlaces());
        self::assertSame(1, $sportVariant->getNrOfGamesPerPlace());
    }

    public function testNrOfGamesOneH2H(): void
    {
        $sportVariant = new AgainstSportGppVariant(1, 2, 1);
        self::assertSame(3, $sportVariant->getNrOfGamesOneH2h(3));
        self::assertSame(12, $sportVariant->getNrOfGamesOneH2h(4));
        self::assertSame(30, $sportVariant->getNrOfGamesOneH2h(5));
        self::assertSame(60, $sportVariant->getNrOfGamesOneH2h(6));

        $sportVariant = new AgainstSportGppVariant(2, 2, 1);
        self::assertSame(3, $sportVariant->getNrOfGamesOneH2h(4));
        self::assertSame(15, $sportVariant->getNrOfGamesOneH2h(5));
        self::assertSame(45, $sportVariant->getNrOfGamesOneH2h(6));
        self::assertSame(105, $sportVariant->getNrOfGamesOneH2h(7));
        self::assertSame(210, $sportVariant->getNrOfGamesOneH2h(8));
        self::assertSame(378, $sportVariant->getNrOfGamesOneH2h(9));

        self::assertSame(1485, $sportVariant->getNrOfGamesOneH2h(12));
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
        $sportVariant = new AgainstGppVariant(1, 1, 1);
        $persistVariant = $sportVariant->toPersistVariant();
        self::assertSame(1, $persistVariant->getNrOfHomePlaces());
        self::assertSame(1, $persistVariant->getNrOfAwayPlaces());
        self::assertSame(0, $persistVariant->getNrOfGamePlaces());
        self::assertSame(0, $persistVariant->getNrOfH2H());
    }

    public function testGetNrOfGamesPerPlace(): void
    {
        $sportVariant = new AgainstSportGppVariant(1, 2, 2);
        self::assertSame(2, $sportVariant->getNrOfGamesPerPlace());
        self::assertSame(2, $sportVariant->getNrOfGamesPerPlace());

        $sportVariant = new AgainstSportGppVariant(2, 2, 2);
        self::assertSame(2, $sportVariant->getNrOfGamesPerPlace());
    }

    public function testToString(): void
    {
        $sportVariant = new AgainstSportGppVariant(1, 2, 3);
        self::assertGreaterThan(0, strlen((string)$sportVariant));
    }


}
