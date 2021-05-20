<?php
declare(strict_types=1);

namespace SportsHelpers\Tests\Sport\Variant;

use PHPUnit\Framework\TestCase;
use SportsHelpers\GameMode;
use SportsHelpers\Sport\Variant\Single as SingleSportVariant;

class SingleTest extends TestCase
{
    public function testCreation(): void
    {
        $sportVariant = new SingleSportVariant(3, 2);
        self::assertSame(GameMode::SINGLE, $sportVariant->getGameMode());
        self::assertSame(3, $sportVariant->getNrOfGamePlaces());
        self::assertSame(2, $sportVariant->getNrOfGamesPerPlace());
    }

    public function testTotalNrOfGames(): void
    {
        $sportVariant = new SingleSportVariant(3, 2);
        self::assertSame(6, $sportVariant->getTotalNrOfGames(9));
        self::assertSame(7, $sportVariant->getTotalNrOfGames(10));
    }

    public function testTotalNrOfGamesPerPlace(): void
    {
        $sportVariant = new SingleSportVariant(3, 2);
        self::assertSame(2, $sportVariant->getTotalNrOfGamesPerPlace(9));
        self::assertSame(2, $sportVariant->getTotalNrOfGamesPerPlace(10));
    }

    public function testAllPlacesParticipateInGameRound(): void
    {
        $sportVariant = new SingleSportVariant(3, 2);
        self::assertFalse($sportVariant->allPlacesParticipateInGameRound(5));
        self::assertTrue($sportVariant->allPlacesParticipateInGameRound(6));
    }

    public function testToPersistVariant(): void
    {
        $sportVariant = new SingleSportVariant(3, 2);
        $persistVariant = $sportVariant->toPersistVariant();
        self::assertSame(0, $persistVariant->getNrOfHomePlaces());
        self::assertSame(0, $persistVariant->getNrOfAwayPlaces());
        self::assertSame(3, $persistVariant->getNrOfGamePlaces());
        self::assertSame(0, $persistVariant->getNrOfH2H());
        self::assertSame(2, $persistVariant->getNrOfGamesPerPlace());
    }

    public function testToString(): void
    {
        $sportVariant = new SingleSportVariant(3, 2);
        self::assertGreaterThan(0, strlen((string)$sportVariant));
    }
}
