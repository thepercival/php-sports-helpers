<?php

namespace SportsHelpers\Tests\Sport;

use PHPUnit\Framework\TestCase;
use SportsHelpers\GameMode;
use SportsHelpers\Sport\GameAmountVariant as SportGameAmountVariant;

class GameAmountVariantTest extends TestCase
{
    public function testCreation(): void
    {
        $sportConfig = new SportGameAmountVariant(GameMode::AGAINST, 2, 2, 1);
        self::assertSame(2, $sportConfig->getNrOfFields());
        self::assertSame(2, $sportConfig->getNrOfGamePlaces());
        self::assertSame(1, $sportConfig->getGameAmount());
    }

    public function testToArray(): void
    {
        $sportConfig = new SportGameAmountVariant(GameMode::AGAINST, 2, 2, 1);
        self::assertSame(["gameMode" => GameMode::AGAINST, "nrOfFields" => 2, "nrOfGamePlaces" => 2, "gameAmount" => 1 ], $sportConfig->toArray());
    }

    public function testGetNrOfAgainstGames3Teams(): void
    {
        $sportConfig = new SportGameAmountVariant(GameMode::AGAINST, 2, 2, 1);
        self::assertSame(3, $sportConfig->getNrOfGames(3));
    }

    public function testGetNrOfAgainstGames3TeamsGameAmount2(): void
    {
        $sportConfig = new SportGameAmountVariant(GameMode::AGAINST, 2, 2, 2);
        self::assertSame(6, $sportConfig->getNrOfGames(3));
    }

    // 1,2 3,4 5,1 2,3 4,5 1,2 3,4 5,1 2,3 4,5 1,2 3,4 5
    public function testGetNrOfNotAgainstGames(): void
    {
        $sportConfig = new SportGameAmountVariant(GameMode::TOGETHER, 2, 2, 5);
        self::assertSame(13, $sportConfig->getNrOfGames(5));
    }

    public function testGetNrOfAgainstGames5TeamsGameAmount2(): void
    {
        $sportConfig = new SportGameAmountVariant(GameMode::AGAINST, 2, 2, 2);
        self::assertSame(20, $sportConfig->getNrOfGames(5));
    }

    public function testGetNrOfAgainstGames5TeamsGamePlaces4(): void
    {
        $sportConfig = new SportGameAmountVariant(GameMode::AGAINST, 4, 2, 1);
        self::assertSame(15, $sportConfig->getNrOfGames(5));
    }

    public function testGetNrOfAgainstGames6TeamsGamePlaces4(): void
    {
        $sportConfig = new SportGameAmountVariant(GameMode::AGAINST, 4, 2, 1);
        self::assertSame(45, $sportConfig->getNrOfGames(6));
    }

    public function testGetNrOfAgainstGames7TeamsGamePlaces4(): void
    {
        $sportConfig = new SportGameAmountVariant(GameMode::AGAINST, 4, 2, 1);
        self::assertSame(105, $sportConfig->getNrOfGames(7));
    }

    public function testGetNrOfAgainstGames8TeamsGamePlaces4(): void
    {
        $sportConfig = new SportGameAmountVariant(GameMode::AGAINST, 4, 2, 1);
        self::assertSame(210, $sportConfig->getNrOfGames(8));
    }

    // ( (8 boven 3) * (5 boven 3)) / 2 = (56 * 10 ) / 2 = 280
    public function testGetNrOfAgainstGames8TeamsGamePlaces6(): void
    {
        $sportConfig = new SportGameAmountVariant(GameMode::AGAINST, 6, 2, 1);
        self::assertSame(280, $sportConfig->getNrOfGames(8));
    }

    public function testGetNrOfNotAgainstGameRounds(): void
    {
        $sportConfig = new SportGameAmountVariant(GameMode::TOGETHER, 2, 2, 5);
        self::assertSame(5, $sportConfig->getNrOfGameRounds(3));
    }

    public function testGetNrOfAgainstGameRoundsEvenPlaces(): void
    {
        $sportConfig = new SportGameAmountVariant(GameMode::AGAINST, 2, 2, 5);
        self::assertSame(15, $sportConfig->getNrOfGameRounds(4));
    }

    public function testGetNrOfAgainstGameRoundsOddPlaces(): void
    {
        $sportConfig = new SportGameAmountVariant(GameMode::AGAINST, 2, 2, 5);
        self::assertSame(25, $sportConfig->getNrOfGameRounds(5));
    }

    public function testGetNrOfAgainstGameRoundsOddPlaces4GamePlaces(): void
    {
        $sportConfig = new SportGameAmountVariant(GameMode::AGAINST, 4, 2, 1);
        self::assertSame(15, $sportConfig->getNrOfGameRounds(5));
    }

    public function testNrOfGamesPerPlace(): void
    {
        $sportConfig = new SportGameAmountVariant(GameMode::AGAINST, 2, 2, 1);
        self::assertSame(4, $sportConfig->getNrOfGamesPerPlace(5));
    }

    public function testNrOfGamesPerPlaceTogether(): void
    {
        $sportConfig = new SportGameAmountVariant(GameMode::TOGETHER, 2, 2, 3);
        self::assertSame(3, $sportConfig->getNrOfGamesPerPlace(5));
    }
}
