<?php

declare(strict_types=1);

namespace SportsHelpers\Tests;

use PHPUnit\Framework\TestCase;
use SportsHelpers\PouleStructure;
use SportsHelpers\SportVariants\AgainstH2h;

class PouleStructureTest extends TestCase
{

    public function testConstructor(): void
    {
        self::expectException(\Exception::class);
        new PouleStructure();
    }


    public function testNrOfPoules(): void
    {
        $pouleStructure = new PouleStructure(3, 2);
        self::assertSame(2, $pouleStructure->getNrOfPoules());
    }

    public function testSort(): void
    {
        $pouleStructure = new PouleStructure(2, 3);
        self::assertSame(3, $pouleStructure->toArray()[0]);
        self::assertSame(2, $pouleStructure->toArray()[1]);
    }

    public function testNrOfPlaces(): void
    {
        $pouleStructure = new PouleStructure(3, 2);
        self::assertSame(5, $pouleStructure->getNrOfPlaces());
    }

    public function testBiggestPoule(): void
    {
        $pouleStructure = new PouleStructure(3, 3, 2);
        self::assertSame(3, $pouleStructure->getBiggestPoule());
    }

    public function testSmallestPoule(): void
    {
        $pouleStructure = new PouleStructure(3, 3, 2);
        self::assertSame(2, $pouleStructure->getSmallestPoule());
    }

    public function testAlmostBalanced(): void
    {
        $pouleStructure = new PouleStructure(3, 2);
        self::assertTrue($pouleStructure->isAlmostBalanced());
    }

    public function testNotAlmostBalanced(): void
    {
        $pouleStructure = new PouleStructure(4, 2);
        self::assertFalse($pouleStructure->isAlmostBalanced());
    }

    public function testBalanced(): void
    {
        $pouleStructure = new PouleStructure(2, 2);
        self::assertTrue($pouleStructure->isBalanced());
    }

    public function testNotBalanced(): void
    {
        $pouleStructure = new PouleStructure(3, 2);
        self::assertFalse($pouleStructure->isBalanced());
    }

    public function testNrOfPoulesByNrOfPlaces(): void
    {
        $pouleStructure = new PouleStructure(3, 2, 2);
        $nrOfPoulesByNrOfPlaces = $pouleStructure->getNrOfPoulesByNrOfPlaces();
        self::assertSame(1, $nrOfPoulesByNrOfPlaces[3]);
        self::assertSame(2, $nrOfPoulesByNrOfPlaces[2]);
    }

    public function testTotalNrOfGames(): void
    {
        $sport = new AgainstH2h(1, 1, 1);
        $pouleStructure = new PouleStructure(3, 2, 2);
        self::assertSame(5, $pouleStructure->getTotalNrOfGames([$sport]));
    }



    public function testToString(): void
    {
        $pouleStructure = new PouleStructure(3, 2, 2);
        self::assertSame("3,2,2", (string)$pouleStructure);
    }



//    public function testMaxNrOfGamePlaces()
//    {
//        $sportHelpers = [
//            new SportConfig( 1, 2, false ),
//            new SportConfig( 1, 3, false ),
//        ];
//        $gameCalculator = new GameCalculator();
//        $maxNrOfGamePlaces = $gameCalculator->getMaxNrOfGamePlaces( $sportHelpers, false);
//        self::assertSame(3, $maxNrOfGamePlaces);
//
//        $sportHelpers = [
//            new SportConfig( 1, 2, true ),
//            new SportConfig( 1, 3, true ),
//        ];
//        $gameCalculator = new GameCalculator();
//        $maxNrOfGamePlaces = $gameCalculator->getMaxNrOfGamePlaces( $sportHelpers, false);
//        self::assertSame(4, $maxNrOfGamePlaces);
//    }
}
