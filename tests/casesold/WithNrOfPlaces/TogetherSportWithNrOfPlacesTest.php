<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\Sports\WithNrOfPlaces;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Sports\TogetherSport;
use SportsHelpers\Sports\WithNrOfPlaces\TogetherSportWithNrOfPlaces;

class TogetherSportWithNrOfPlacesTest extends TestCase
{
    public function testTotalNrOfGamesWithGamePlaces(): void
    {
        $togetherSport = new TogetherSport(2);
        $togetherSportWithNrOfPlaces = new TogetherSportWithNrOfPlaces(9, $togetherSport, 3);
        self::assertSame(14, $togetherSportWithNrOfPlaces->calcTotalNrOfGames() );

        $togetherSport2 = new TogetherSport(2);
        $togetherSportWithNrOfPlaces2 = new TogetherSportWithNrOfPlaces(10, $togetherSport2, 3);
        self::assertSame(15, $togetherSportWithNrOfPlaces2->calcTotalNrOfGames() );
    }

    public function testGetTotalNrOfGamesWithoutGamePlaces(): void
    {
        $togetherSport = new TogetherSport(null);
        $togetherSportWithNrOfPlaces = new TogetherSportWithNrOfPlaces(4, $togetherSport, 3);
        self::assertSame(3, $togetherSportWithNrOfPlaces->calcTotalNrOfGames());
    }

//    public function testGetTotalNrOfGamesPerPlace(): void
//    {
//        $togetherSport = new TogetherSport(3, 2);
//        $togetherSportWithNrOfPlaces = new TogetherSportWithNrOfPlaces(9, $togetherSport);
//        self::assertSame(2, $togetherSportWithNrOfPlaces->getTotalNrOfGamesPerPlace());
//    }

//    public function testGetMaxNrOfGamesSimultaneously(): void
//    {
//        $togetherSport = new TogetherSport(3, 2);
//        $togetherSportWithNrOfPlaces = new TogetherSportWithNrOfPlaces(10, $togetherSport);
//        self::assertSame(4, $togetherSportWithNrOfPlaces->getMaxNrOfGamesSimultaneously());
//
//        $togetherSport2 = new TogetherSport(3, 2);
//        $togetherSportWithNrOfPlaces2 = new TogetherSportWithNrOfPlaces(11, $togetherSport2);
//        self::assertSame(4, $togetherSportWithNrOfPlaces2->getMaxNrOfGamesSimultaneously());
//
//        $togetherSport3 = new TogetherSport(3, 2);
//        $togetherSportWithNrOfPlaces3 = new TogetherSportWithNrOfPlaces(12, $togetherSport3);
//        self::assertSame(4, $togetherSportWithNrOfPlaces3->getMaxNrOfGamesSimultaneously());
//    }
//
//    public function testGetMaxNrOfGamePlacesSimultaneously(): void
//    {
//        $togetherSport = new TogetherSport(3, 2);
//        $singleWithNrOfPlaces = new TogetherSportWithNrOfPlaces(10, $togetherSport);
//        self::assertSame(10, $singleWithNrOfPlaces->getMaxNrOfGamePlacesSimultaneously());
//
//        $togetherSport2 = new TogetherSport(3, 2);
//        $singleWithNrOfPlaces2 = new TogetherSportWithNrOfPlaces(11, $togetherSport2);
//        self::assertSame(11, $singleWithNrOfPlaces2->getMaxNrOfGamePlacesSimultaneously());
//
//        $togetherSport3 = new TogetherSport(3, 2);
//        $togetherSportWithNrOfPlaces3 = new TogetherSportWithNrOfPlaces(12, $togetherSport3);
//        self::assertSame(12, $togetherSportWithNrOfPlaces3->getMaxNrOfGamePlacesSimultaneously());
//
//        $togetherSport4 = new TogetherSport(3, 2);
//        $togetherSportWithNrOfPlaces4 = new TogetherSportWithNrOfPlaces(2, $togetherSport4);
//        self::assertSame(2, $togetherSportWithNrOfPlaces4->getMaxNrOfGamePlacesSimultaneously());
//    }

//    public function testGetTotalNrOfGamePlaces(): void
//    {
//        $allInOneGame = new AllInOneGame(3);
//        $allInOneGameWithNrOfPlaces = new AllInOneGameSportWithNrOfPlaces(4, $allInOneGame);
//        self::assertSame(12, $allInOneGameWithNrOfPlaces->getTotalNrOfGamePlaces());
//    }
//
//    public function testGetTotalNrOfGamesPerPlace(): void
//    {
//        $allInOneGame = new AllInOneGame(3);
//        $allInOneGameWithNrOfPlaces = new AllInOneGameSportWithNrOfPlaces(4, $allInOneGame);
//        self::assertSame(3, $allInOneGameWithNrOfPlaces->getTotalNrOfGamesPerPlace());
//    }
//
//    public function testGetNrOfGamePlaces(): void
//    {
//        $allInOneGame = new AllInOneGame(3);
//        $allInOneGameWithNrOfPlaces = new AllInOneGameSportWithNrOfPlaces(4, $allInOneGame);
//        self::assertSame(4, $allInOneGameWithNrOfPlaces->getNrOfGamePlaces());
//    }
//
//    public function testGetNrOfGamesSimultaneously(): void
//    {
//        $allInOneGame = new AllInOneGame(3);
//        $allInOneGameWithNrOfPlaces = new AllInOneGameSportWithNrOfPlaces(4, $allInOneGame);
//        self::assertSame(1, $allInOneGameWithNrOfPlaces->getNrOfGamesSimultaneously());
//    }
}
