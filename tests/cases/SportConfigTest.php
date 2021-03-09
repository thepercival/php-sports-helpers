<?php

namespace SportsHelpers\Tests;

use SportsHelpers\GameCalculatorDep;
use SportsHelpers\GameMode;
use SportsHelpers\SportBase;
use SportsHelpers\SportConfig;

class SportConfigTest extends \PHPUnit\Framework\TestCase
{
    public function testCreation()
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 2);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(2, $sportConfig->getNrOfFields());
        self::assertSame(2, $sportConfig->getNrOfGamePlaces());
        self::assertSame(1, $sportConfig->getGameAmount());
    }

    public function testSport()
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 2);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame($sport, $sportConfig->getSport());
    }

    public function testToArray()
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 2);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(["gameMode" => GameMode::AGAINST, "nrOfFields" => 2, "nrOfGamePlaces" => 2, "gameAmount" => 1 ], $sportConfig->toArray());
    }

    public function testGetNrOfAgainstGames3Teams()
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 2);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(3, $sportConfig->getNrOfGames(3));
    }

    public function testGetNrOfAgainstGames3TeamsGameAmount2()
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 2);
        $gameAmount = 2;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(6, $sportConfig->getNrOfGames(3));
    }

    /**
     * 1,2 3,4 5,1 2,3 4,5 1,2 3,4 5,1 2,3 4,5 1,2 3,4 5
     */
    public function testGetNrOfNotAgainstGames()
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::TOGETHER, 2);
        $gameAmount = 5;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(13, $sportConfig->getNrOfGames(5));
    }

    public function testGetNrOfAgainstGames5TeamsGameAmount2()
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 2);
        $gameAmount = 2;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(20, $sportConfig->getNrOfGames(5));
    }

    public function testGetNrOfAgainstGames5TeamsGamePlaces4()
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 4);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(15, $sportConfig->getNrOfGames(5));
    }

    public function testGetNrOfAgainstGames6TeamsGamePlaces4()
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 4);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(45, $sportConfig->getNrOfGames(6));
    }

    public function testGetNrOfAgainstGames7TeamsGamePlaces4()
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 4);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(105, $sportConfig->getNrOfGames(7));
    }

    public function testGetNrOfAgainstGames8TeamsGamePlaces4()
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 4);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(210, $sportConfig->getNrOfGames(8));
    }

    /**
     * ( (8 boven 3) * (5 boven 3)) / 2 = (56 * 10 ) / 2 = 280
     */
    public function testGetNrOfAgainstGames8TeamsGamePlaces6()
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 6);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(280, $sportConfig->getNrOfGames(8));
    }

    public function testGetNrOfNotAgainstGameRounds()
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::TOGETHER, 2);
        $gameAmount = 5;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(5, $sportConfig->getNrOfGameRounds(3));
    }

    public function testGetNrOfAgainstGameRoundsEvenPlaces()
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 2);
        $gameAmount = 5;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(15, $sportConfig->getNrOfGameRounds(4));
    }

    public function testGetNrOfAgainstGameRoundsOddPlaces()
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 2);
        $gameAmount = 5;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(25, $sportConfig->getNrOfGameRounds(5));
    }

    public function testGetNrOfAgainstGameRoundsOddPlaces4GamePlaces()
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 4);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(15, $sportConfig->getNrOfGameRounds(5));
    }

    public function testNrOfGamesPerPlace()
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 2);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(4, $sportConfig->getNrOfGamesPerPlace(5));
    }

    public function testNrOfGamesPerPlaceTogether()
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::TOGETHER, 2);
        $gameAmount = 3;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(3, $sportConfig->getNrOfGamesPerPlace(5));
    }
}
