<?php

namespace SportsHelpers\Tests;

use SportsHelpers\GameCalculatorDep;
use SportsHelpers\SportBase;
use SportsHelpers\SportConfig;

class SportConfigTest extends \PHPUnit\Framework\TestCase
{
    public function testCreation()
    {
        $nrOfFields = 2;
        $sport = new SportBase( 2 );
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(2, $sportConfig->getNrOfFields() );
        self::assertSame(2, $sportConfig->getNrOfGamePlaces() );
        self::assertSame(1, $sportConfig->getGameAmount() );
    }

    public function testSport()
    {
        $nrOfFields = 2;
        $sport = new SportBase( 2 );
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame($sport, $sportConfig->getSport() );
    }

    public function testToArray()
    {
        $nrOfFields = 2;
        $sport = new SportBase( 2 );
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(["nrOfFields" => 2, "nrOfGamePlaces" => 2, "gameAmount" => 1 ], $sportConfig->toArray() );
    }

    public function testGetNrOfAgainstEachOtherGames3Teams()
    {
        $nrOfFields = 2;
        $sport = new SportBase( 2 );
        $gameMode = SportConfig::GAMEMODE_AGAINSTEACHOTHER;
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(3, $sportConfig->getNrOfGames($gameMode, 3) );
    }

    public function testGetNrOfAgainstEachOtherGames3TeamsGameAmount2()
    {
        $nrOfFields = 2;
        $sport = new SportBase( 2 );
        $gameMode = SportConfig::GAMEMODE_AGAINSTEACHOTHER;
        $gameAmount = 2;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(6, $sportConfig->getNrOfGames($gameMode, 3) );
    }

    /**
     * 1,2 3,4 5,1 2,3 4,5 1,2 3,4 5,1 2,3 4,5 1,2 3,4 5
     */
    public function testGetNrOfNotAgainstEachOtherGames()
    {
        $nrOfFields = 2;
        $sport = new SportBase( 2 );
        $gameMode = SportConfig::GAMEMODE_TOGETHER;
        $gameAmount = 5;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(13, $sportConfig->getNrOfGames($gameMode, 5) );
    }

    public function testGetNrOfAgainstEachOtherGames5TeamsGameAmount2()
    {
        $nrOfFields = 2;
        $sport = new SportBase( 2 );
        $gameMode = SportConfig::GAMEMODE_AGAINSTEACHOTHER;
        $gameAmount = 2;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(20, $sportConfig->getNrOfGames($gameMode, 5) );
    }

    public function testGetNrOfAgainstEachOtherGames5TeamsGamePlaces4()
    {
        $nrOfFields = 2;
        $sport = new SportBase( 4 );
        $gameMode = SportConfig::GAMEMODE_AGAINSTEACHOTHER;
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(15, $sportConfig->getNrOfGames($gameMode, 5) );
    }

    public function testGetNrOfAgainstEachOtherGames6TeamsGamePlaces4()
    {
        $nrOfFields = 2;
        $sport = new SportBase( 4 );
        $gameMode = SportConfig::GAMEMODE_AGAINSTEACHOTHER;
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(45, $sportConfig->getNrOfGames($gameMode, 6) );
    }

    public function testGetNrOfAgainstEachOtherGames7TeamsGamePlaces4()
    {
        $nrOfFields = 2;
        $sport = new SportBase( 4 );
        $gameMode = SportConfig::GAMEMODE_AGAINSTEACHOTHER;
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(105, $sportConfig->getNrOfGames($gameMode, 7) );
    }

    public function testGetNrOfAgainstEachOtherGames8TeamsGamePlaces4()
    {
        $nrOfFields = 2;
        $sport = new SportBase( 4 );
        $gameMode = SportConfig::GAMEMODE_AGAINSTEACHOTHER;
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(210, $sportConfig->getNrOfGames($gameMode, 8) );
    }

    /**
     * ( (8 boven 3) * (5 boven 3)) / 2 = (56 * 10 ) / 2 = 280
     */
    public function testGetNrOfAgainstEachOtherGames8TeamsGamePlaces6()
    {
        $nrOfFields = 2;
        $sport = new SportBase( 6 );
        $gameMode = SportConfig::GAMEMODE_AGAINSTEACHOTHER;
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(280, $sportConfig->getNrOfGames($gameMode, 8) );
    }

    public function testGetNrOfNotAgainstEachOtherGameRounds()
    {
        $nrOfFields = 2;
        $sport = new SportBase( 2 );
        $gameMode = SportConfig::GAMEMODE_TOGETHER;
        $gameAmount = 5;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(5, $sportConfig->getNrOfGameRounds($gameMode, 3) );
    }

    public function testGetNrOfAgainstEachOtherGameRoundsEvenPlaces()
    {
        $nrOfFields = 2;
        $sport = new SportBase( 2 );
        $gameMode = SportConfig::GAMEMODE_AGAINSTEACHOTHER;
        $gameAmount = 5;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(15, $sportConfig->getNrOfGameRounds($gameMode, 4) );
    }

    public function testGetNrOfAgainstEachOtherGameRoundsOddPlaces()
    {
        $nrOfFields = 2;
        $sport = new SportBase( 2 );
        $gameMode = SportConfig::GAMEMODE_AGAINSTEACHOTHER;
        $gameAmount = 5;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(25, $sportConfig->getNrOfGameRounds($gameMode, 5) );
    }

    public function testGetNrOfAgainstEachOtherGameRoundsOddPlaces4GamePlaces()
    {
        $nrOfFields = 2;
        $sport = new SportBase( 4 );
        $gameMode = SportConfig::GAMEMODE_AGAINSTEACHOTHER;
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(15, $sportConfig->getNrOfGameRounds($gameMode, 5) );
    }

    public function testNrOfGamesPerPlace()
    {
        $nrOfFields = 2;
        $sport = new SportBase( 2 );
        $gameMode = SportConfig::GAMEMODE_AGAINSTEACHOTHER;
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(4, $sportConfig->getNrOfGamesPerPlace($gameMode, 5) );
    }

    public function testNrOfGamesPerPlaceTogether()
    {
        $nrOfFields = 2;
        $sport = new SportBase( 2 );
        $gameMode = SportConfig::GAMEMODE_TOGETHER;
        $gameAmount = 3;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        self::assertSame(3, $sportConfig->getNrOfGamesPerPlace($gameMode, 5 ) );
    }
}
