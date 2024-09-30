<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\SportVariants;

use PHPUnit\Framework\TestCase;
use SportsHelpers\GameMode;
use SportsHelpers\SportVariants\AgainstTwoVsTwo;

class  AgainstTwoVsTwoTest extends TestCase
{
    public function testCreation(): void
    {
        $sportVariant = new AgainstTwoVsTwo(1);
        self::assertSame(GameMode::Against, $sportVariant->getGameMode());
        self::assertSame(2, $sportVariant->nrOfHomePlaces);
        self::assertSame(2, $sportVariant->nrOfAwayPlaces);
        self::assertSame(1, $sportVariant->nrOfCycles);
    }

    public function testGetNrOfAgainstCombinationsPerGame(): void
    {
        $sportVariant = new AgainstTwoVsTwo(1);
        self::assertSame(4, $sportVariant->getNrOfAgainstCombinationsPerGame());
    }

    public function testNrOfGamesForSingleCycle(): void
    {
        $sportVariant1VS1 = new AgainstTwoVsTwo( 1);
        self::assertSame(3, $sportVariant1VS1->getNrOfGamesForSingleCycle(4));
        self::assertSame(15, $sportVariant1VS1->getNrOfGamesForSingleCycle(5));
        self::assertSame(45, $sportVariant1VS1->getNrOfGamesForSingleCycle(6));
        self::assertSame(105, $sportVariant1VS1->getNrOfGamesForSingleCycle(7));
        self::assertSame(210, $sportVariant1VS1->getNrOfGamesForSingleCycle(8));
        self::assertSame(378, $sportVariant1VS1->getNrOfGamesForSingleCycle(9));
        self::assertSame(630, $sportVariant1VS1->getNrOfGamesForSingleCycle(10));
    }

    public function testToPersistVariant(): void
    {
        $sportVariant = new AgainstTwoVsTwo( 1);
        $persistVariant = $sportVariant->toPersistVariant();
        self::assertSame(2, $persistVariant->getNrOfHomePlaces());
        self::assertSame(2, $persistVariant->getNrOfAwayPlaces());
        self::assertSame(0, $persistVariant->getNrOfGamePlaces());
        self::assertSame(1, $persistVariant->getNrOfCycles());
    }

    public function testToString(): void
    {
        $sportVariant = new AgainstTwoVsTwo( 3);
        self::assertGreaterThan(0, strlen((string)$sportVariant));
    }
}
