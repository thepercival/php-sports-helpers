<?php

namespace SportsHelpers\Tests\Sport\Variant;

use PHPUnit\Framework\TestCase;
use SportsHelpers\GameMode;
use SportsHelpers\Sport\Variant\Single as SingleSportVariant;

class SingleTest extends TestCase
{
    public function testCreation(): void
    {
        $sportConfig = new SingleSportVariant(1, 2);
        self::assertSame(GameMode::SINGLE, $sportConfig->getGameMode());
        self::assertSame(1, $sportConfig->getNrOfGamePlaces());
        self::assertSame(2, $sportConfig->getNrOfGamesPerPlace());
    }

    // 1,2  3,4     5,1     2,3     4,5     1,2     3,4     5,1     2,3     4,5     1,2     3,4     5
    public function testGetNrOfNotAgainstGames(): void
    {
        $sportVariant = new SingleSportVariant(2, 5);
        self::assertSame(13, $sportVariant->getTotalNrOfGames(5));
    }

    public function testGetNrOfNotAgainstGameRounds(): void
    {
        $sportVariant = new SingleSportVariant(2, 5);
        self::assertSame(8, $sportVariant->getMaxNrOfGameRounds(3));
    }

    public function testGetNrOfGameRoundsUnrounded(): void
    {
        $sportVariant = new SingleSportVariant(3, 5);
        self::assertSame(7, $sportVariant->getMaxNrOfGameRounds(4));
    }

    public function testGetNrOfGameRoundsRounded(): void
    {
        $sportVariant = new SingleSportVariant(2, 5);
        self::assertSame(5, $sportVariant->getMaxNrOfGameRounds(4));
    }

    public function testNrOfGamesPerPlaceTogether(): void
    {
        $sportVariant = new SingleSportVariant(2, 3);
        self::assertSame(3, $sportVariant->getTotalNrOfGamesPerPlace(5));
    }
}
