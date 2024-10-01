<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\SportVariants\WithNrOfPlaces;

use PHPUnit\Framework\TestCase;
use SportsHelpers\GameMode;
use SportsHelpers\SportVariants\AgainstOneVsOne;
use SportsHelpers\SportVariants\AllInOneGame;
use SportsHelpers\SportVariants\Single;
use SportsHelpers\SportVariants\WithNrOfPlaces\AgainstWithNrOfPlaces;
use SportsHelpers\SportVariants\WithNrOfPlaces\AllInOneGameWithNrOfPlaces;

class AllInOneGameWithNrOfPlacesTest extends TestCase
{
    public function testGameMode(): void
    {
        $allInOneGame = new AllInOneGame( 1);
        self::assertSame(GameMode::AllInOneGame, $allInOneGame->getGameMode());
    }

    public function testGetSportVariant(): void
    {
        $allInOneGame = new AllInOneGame(1);
        $allInOneGameWithNrOfPlaces = new AllInOneGameWithNrOfPlaces(4, $allInOneGame);
        self::assertSame($allInOneGame, $allInOneGameWithNrOfPlaces->getSportVariant());
    }

    public function testGetTotalNrOfGames(): void
    {
        $allInOneGame = new AllInOneGame(3);
        $allInOneGameWithNrOfPlaces = new AllInOneGameWithNrOfPlaces(4, $allInOneGame);
        self::assertSame(3, $allInOneGameWithNrOfPlaces->getTotalNrOfGames());
    }

    public function testGetTotalNrOfGamePlaces(): void
    {
        $allInOneGame = new AllInOneGame(3);
        $allInOneGameWithNrOfPlaces = new AllInOneGameWithNrOfPlaces(4, $allInOneGame);
        self::assertSame(12, $allInOneGameWithNrOfPlaces->getTotalNrOfGamePlaces());
    }

    public function testGetTotalNrOfGamesPerPlace(): void
    {
        $allInOneGame = new AllInOneGame(3);
        $allInOneGameWithNrOfPlaces = new AllInOneGameWithNrOfPlaces(4, $allInOneGame);
        self::assertSame(3, $allInOneGameWithNrOfPlaces->getTotalNrOfGamesPerPlace());
    }

    public function testGetNrOfGamePlaces(): void
    {
        $allInOneGame = new AllInOneGame(3);
        $allInOneGameWithNrOfPlaces = new AllInOneGameWithNrOfPlaces(4, $allInOneGame);
        self::assertSame(4, $allInOneGameWithNrOfPlaces->getNrOfGamePlaces());
    }

    public function testGetNrOfGamesSimultaneously(): void
    {
        $allInOneGame = new AllInOneGame(3);
        $allInOneGameWithNrOfPlaces = new AllInOneGameWithNrOfPlaces(4, $allInOneGame);
        self::assertSame(1, $allInOneGameWithNrOfPlaces->getNrOfGamesSimultaneously());
    }
}
