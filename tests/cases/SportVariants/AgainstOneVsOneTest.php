<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\SportVariants;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Against\AgainstSide;
use SportsHelpers\GameMode;
use SportsHelpers\SportVariants\AgainstOneVsOne;
use SportsHelpers\SportVariants\AgainstOneVsTwo;

class  AgainstOneVsOneTest extends TestCase
{
    public function testCreation(): void
    {
        $sportVariant = new AgainstOneVsOne(1);
        self::assertSame(GameMode::Against, $sportVariant->getGameMode());
        self::assertSame(1, $sportVariant->nrOfHomePlaces);
        self::assertSame(1, $sportVariant->nrOfAwayPlaces);
        self::assertSame(1, $sportVariant->nrOfCycles);
    }

    public function testGetNrOfSidePlaces(): void
    {
        $sportVariant = new AgainstOneVsOne(1);
        self::assertSame(1, $sportVariant->getNrOfSidePlaces(AgainstSide::Home));
        self::assertSame(1, $sportVariant->getNrOfSidePlaces(AgainstSide::Away));
    }

    public function testHasMultipleSidePlaces(): void
    {
        $sportVariant = new AgainstOneVsOne(1);
        self::assertFalse($sportVariant->hasMultipleSidePlaces());
    }

    public function testGetNrOfAgainstCombinationsPerGame(): void
    {
        $sportVariant = new AgainstOneVsOne(1);
        self::assertSame(1, $sportVariant->getNrOfAgainstCombinationsPerGame());
    }


    public function testNrOfGamesOneH2h(): void
    {
        $sportVariant1VS1 = new AgainstOneVsOne( 1);
        self::assertSame(1, $sportVariant1VS1->getNrOfGamesForSingleCycle(2));
        self::assertSame(3, $sportVariant1VS1->getNrOfGamesForSingleCycle(3));
        self::assertSame(6, $sportVariant1VS1->getNrOfGamesForSingleCycle(4));
        self::assertSame(10, $sportVariant1VS1->getNrOfGamesForSingleCycle(5));
        self::assertSame(15, $sportVariant1VS1->getNrOfGamesForSingleCycle(6));
    }


    public function testToPersistVariant(): void
    {
        $sportVariant = new AgainstOneVsOne( 1);
        $persistVariant = $sportVariant->toPersistVariant();
        self::assertSame(1, $persistVariant->getNrOfHomePlaces());
        self::assertSame(1, $persistVariant->getNrOfAwayPlaces());
        self::assertSame(0, $persistVariant->getNrOfGamePlaces());
        self::assertSame(1, $persistVariant->getNrOfCycles());
    }

    public function testToString(): void
    {
        $sportVariant = new AgainstOneVsOne( 3);
        self::assertGreaterThan(0, strlen((string)$sportVariant));
    }
}
