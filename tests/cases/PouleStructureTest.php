<?php

namespace SportsHelpers\Tests;

use SportsHelpers\GameMode;
use SportsHelpers\PouleStructure;
use SportsHelpers\SportBase;
use SportsHelpers\SportConfig;

class PouleStructureTest extends \PHPUnit\Framework\TestCase
{
    public function testNrOfPoules()
    {
        $pouleStructure = new PouleStructure([3,2]);
        self::assertSame(2, $pouleStructure->getNrOfPoules());
    }

    public function testSort()
    {
        $pouleStructure = new PouleStructure([2,3]);
        self::assertSame(3, $pouleStructure->toArray()[0]);
        self::assertSame(2, $pouleStructure->toArray()[1]);
    }

    public function testNrOfPlaces()
    {
        $pouleStructure = new PouleStructure([3,2]);
        self::assertSame(5, $pouleStructure->getNrOfPlaces());
    }

    public function testBiggestPoule()
    {
        $pouleStructure = new PouleStructure([3,3,2]);
        self::assertSame(3, $pouleStructure->getBiggestPoule());
    }

    public function testSmallestPoule()
    {
        $pouleStructure = new PouleStructure([3,3,2]);
        self::assertSame(2, $pouleStructure->getSmallestPoule());
    }

    public function testAlmostBalanced()
    {
        $pouleStructure = new PouleStructure([3,2]);
        self::assertTrue($pouleStructure->isAlmostBalanced());
    }

    public function testNotAlmostBalanced()
    {
        $pouleStructure = new PouleStructure([4,2]);
        self::assertFalse($pouleStructure->isAlmostBalanced());
    }

    public function testBalanced()
    {
        $pouleStructure = new PouleStructure([2,2]);
        self::assertTrue($pouleStructure->isBalanced());
    }

    public function testNotBalanced()
    {
        $pouleStructure = new PouleStructure([3,2]);
        self::assertFalse($pouleStructure->isBalanced());
    }

    public function testNrOfPoulesByNrOfPlaces()
    {
        $pouleStructure = new PouleStructure([3,2,2]);
        $nrOfPoulesByNrOfPlaces = $pouleStructure->getNrOfPoulesByNrOfPlaces();
        self::assertSame(1, $nrOfPoulesByNrOfPlaces[3]);
        self::assertSame(2, $nrOfPoulesByNrOfPlaces[2]);
    }

    public function testNrOfGames()
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 2);
        $gameAmount = 1;
        $sportConfig = new SportConfig($sport, $nrOfFields, $gameAmount);
        $pouleStructure = new PouleStructure([3,2,2]);
        self::assertSame(5, $pouleStructure->getNrOfGames([$sportConfig]));
    }

    public function testToString()
    {
        $pouleStructure = new PouleStructure([3,2,2]);
        self::assertSame("3,2,2", (string)$pouleStructure);
    }



//    public function testMaxNrOfGamePlaces()
//    {
//        $sportConfigHelpers = [
//            new SportConfig( 1, 2, false ),
//            new SportConfig( 1, 3, false ),
//        ];
//        $gameCalculator = new GameCalculator();
//        $maxNrOfGamePlaces = $gameCalculator->getMaxNrOfGamePlaces( $sportConfigHelpers, false);
//        self::assertSame(3, $maxNrOfGamePlaces);
//
//        $sportConfigHelpers = [
//            new SportConfig( 1, 2, true ),
//            new SportConfig( 1, 3, true ),
//        ];
//        $gameCalculator = new GameCalculator();
//        $maxNrOfGamePlaces = $gameCalculator->getMaxNrOfGamePlaces( $sportConfigHelpers, false);
//        self::assertSame(4, $maxNrOfGamePlaces);
//    }
}
