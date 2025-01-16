<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\SportVariants;

use PHPUnit\Framework\TestCase;
use SportsHelpers\GameMode;
use SportsHelpers\SportVariants\AllInOneGame as AllInOneGameSportVariant;

class AllInOneGameTest extends TestCase
{
    public function testCreation(): void
    {
        $sportVariant = new AllInOneGameSportVariant(1);
        self::assertSame(GameMode::AllInOneGame, $sportVariant->getGameMode());
        self::assertSame(1, $sportVariant->nrOfCycles);
    }

//    public function testTotalNrOfGames(): void
//    {
//        $sportVariant = new AllInOneGameSportVariant(3);
//        self::assertSame(3, $sportVariant->getTotalNrOfGames(5));
//        self::assertSame(3, $sportVariant->getTotalNrOfGames(6));
//    }
//
//    public function testTotalNrOfGamesPerPlace(): void
//    {
//        $sportVariant = new AllInOneGameSportVariant(3);
//        self::assertSame(3, $sportVariant->getTotalNrOfGamesPerPlace(5));
//        self::assertSame(3, $sportVariant->getTotalNrOfGamesPerPlace(6));
//    }


    public function testToPersistVariant(): void
    {
        $sportVariant = new AllInOneGameSportVariant(1);
        $persistVariant = $sportVariant->toPersistVariant();
        self::assertSame(0, $persistVariant->getNrOfHomePlaces());
        self::assertSame(0, $persistVariant->getNrOfAwayPlaces());
        self::assertSame(0, $persistVariant->getNrOfGamePlaces());
        self::assertSame(1, $persistVariant->getNrOfCycles());
        // self::assertSame(1, $persistVariant->getNrOfGamesPerPlace());
    }

    public function testToString(): void
    {
        $sportVariant = new AllInOneGameSportVariant(1);
        self::assertGreaterThan(0, strlen((string)$sportVariant));
    }
}
