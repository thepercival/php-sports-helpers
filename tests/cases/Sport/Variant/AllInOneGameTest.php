<?php
declare(strict_types=1);

namespace SportsHelpers\Tests\Sport\Variant;

use PHPUnit\Framework\TestCase;
use SportsHelpers\GameMode;
use SportsHelpers\Sport\Variant\Against as AgainstSportVariant;
use SportsHelpers\Sport\Variant\AllInOneGame as AllInOneGameSportVariant;

class AllInOneGameTest extends TestCase
{
    public function testCreation(): void
    {
        $sportVariant = new AllInOneGameSportVariant(1);
        self::assertSame(GameMode::ALL_IN_ONE_GAME, $sportVariant->getGameMode());
        self::assertSame(1, $sportVariant->getNrOfGamesPerPlace());
    }

    public function testTotalNrOfGames(): void
    {
        $sportVariant = new AllInOneGameSportVariant(3);
        self::assertSame(3, $sportVariant->getTotalNrOfGames(5));
        self::assertSame(3, $sportVariant->getTotalNrOfGames(6));
    }

    public function testTotalNrOfGamesPerPlace(): void
    {
        $sportVariant = new AllInOneGameSportVariant(3);
        self::assertSame(3, $sportVariant->getTotalNrOfGamesPerPlace(5));
        self::assertSame(3, $sportVariant->getTotalNrOfGamesPerPlace(6));
    }

    public function testAllPlacesParticipateInGameRound(): void
    {
        $sportVariant = new AllInOneGameSportVariant(3);
        self::assertTrue($sportVariant->allPlacesParticipateInGameRound(5));
        self::assertTrue($sportVariant->allPlacesParticipateInGameRound(6));
    }

    public function testToPersistVariant(): void
    {
        $sportVariant = new AllInOneGameSportVariant(1);
        $persistVariant = $sportVariant->toPersistVariant();
        self::assertSame(0, $persistVariant->getNrOfHomePlaces());
        self::assertSame(0, $persistVariant->getNrOfAwayPlaces());
        self::assertSame(0, $persistVariant->getNrOfGamePlaces());
        self::assertSame(0, $persistVariant->getNrOfH2H());
        self::assertSame(1, $persistVariant->getNrOfGamesPerPlace());
    }

    public function testToString(): void
    {
        $sportVariant = new AllInOneGameSportVariant(1);
        self::assertGreaterThan(0, strlen((string)$sportVariant));
    }
}
