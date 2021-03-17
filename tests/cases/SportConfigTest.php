<?php

namespace SportsHelpers\Tests;

use PHPUnit\Framework\TestCase;
use SportsHelpers\GameMode;
use SportsHelpers\SportBase;
use SportsHelpers\SportConfig;

class SportConfigTest extends TestCase
{
    public function testCreation(): void
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 2);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(2, $sportConfig->getNrOfFields());
        self::assertSame(2, $sportConfig->getNrOfGamePlaces());
        self::assertSame(1, $sportConfig->getGameAmount());
    }

    public function testSport(): void
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 2);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame($sport, $sportConfig->getSport());
    }

    public function testToArray(): void
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 2);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(["gameMode" => GameMode::AGAINST, "nrOfFields" => 2, "nrOfGamePlaces" => 2, "gameAmount" => 1 ], $sportConfig->toArray());
    }

    public function testGetNrOfAgainstGames3Teams(): void
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 2);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(3, $sportConfig->getNrOfGames(3));
    }

    public function testGetNrOfAgainstGames3TeamsGameAmount2(): void
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 2);
        $gameAmount = 2;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(6, $sportConfig->getNrOfGames(3));
    }

    // 1,2 3,4 5,1 2,3 4,5 1,2 3,4 5,1 2,3 4,5 1,2 3,4 5
    public function testGetNrOfNotAgainstGames(): void
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::TOGETHER, 2);
        $gameAmount = 5;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(13, $sportConfig->getNrOfGames(5));
    }

    public function testGetNrOfAgainstGames5TeamsGameAmount2(): void
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 2);
        $gameAmount = 2;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(20, $sportConfig->getNrOfGames(5));
    }

    public function testGetNrOfAgainstGames5TeamsGamePlaces4(): void
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 4);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(15, $sportConfig->getNrOfGames(5));
    }

    public function testGetNrOfAgainstGames6TeamsGamePlaces4(): void
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 4);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(45, $sportConfig->getNrOfGames(6));
    }

    public function testGetNrOfAgainstGames7TeamsGamePlaces4(): void
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 4);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(105, $sportConfig->getNrOfGames(7));
    }

    public function testGetNrOfAgainstGames8TeamsGamePlaces4(): void
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 4);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(210, $sportConfig->getNrOfGames(8));
    }

    // ( (8 boven 3) * (5 boven 3)) / 2 = (56 * 10 ) / 2 = 280
    public function testGetNrOfAgainstGames8TeamsGamePlaces6(): void
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 6);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(280, $sportConfig->getNrOfGames(8));
    }

    public function testGetNrOfNotAgainstGameRounds(): void
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::TOGETHER, 2);
        $gameAmount = 5;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(5, $sportConfig->getNrOfGameRounds(3));
    }

    public function testGetNrOfAgainstGameRoundsEvenPlaces(): void
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 2);
        $gameAmount = 5;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(15, $sportConfig->getNrOfGameRounds(4));
    }

    public function testGetNrOfAgainstGameRoundsOddPlaces(): void
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 2);
        $gameAmount = 5;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(25, $sportConfig->getNrOfGameRounds(5));
    }

    public function testGetNrOfAgainstGameRoundsOddPlaces4GamePlaces(): void
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 4);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(15, $sportConfig->getNrOfGameRounds(5));
    }

    public function testNrOfGamesPerPlace(): void
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 2);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(4, $sportConfig->getNrOfGamesPerPlace(5));
    }

    public function testNrOfGamesPerPlaceTogether(): void
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::TOGETHER, 2);
        $gameAmount = 3;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(3, $sportConfig->getNrOfGamesPerPlace(5));
    }
}
