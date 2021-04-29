<?php

namespace SportsHelpers\Tests\Sport\Variant;

use PHPUnit\Framework\TestCase;
use SportsHelpers\GameMode;
use SportsHelpers\Sport\Variant\Against as AgainstSportVariant;

class AgainstTest extends TestCase
{
    public function testCreation(): void
    {
        $sportVariant = new AgainstSportVariant(1, 2, 0, 3);
        self::assertSame(GameMode::AGAINST, $sportVariant->getGameMode());
        self::assertSame(1, $sportVariant->getNrOfHomePlaces());
        self::assertSame(2, $sportVariant->getNrOfAwayPlaces());
        self::assertSame(0, $sportVariant->getNrOfH2H());
        self::assertSame(3, $sportVariant->getNrOfPartials());
    }

    public function testTotalNrOfGames4Places3GamePlacesMixed(): void
    {
        $nrOfPlaces = 4;
        $sportVariant = new AgainstSportVariant(2, 1, 0, 6);
        self::assertSame(24, $sportVariant->getTotalNrOfGames($nrOfPlaces));
    }

    public function testTotalNrOfGames4Places3GamePlaces(): void
    {
        $nrOfPlaces = 4;
        $sportVariant = new AgainstSportVariant(1, 1, 2, 0);
        self::assertSame(12, $sportVariant->getTotalNrOfGames($nrOfPlaces));
    }

    public function testNrOfAgainstGames3TeamsH2H2(): void
    {
        $nrOfPlaces = 3;
        $sportVariant = new AgainstSportVariant(1, 1, 2, 0);
        self::assertSame(6, $sportVariant->getTotalNrOfGames($nrOfPlaces));
    }

    public function testNrOfGamesPerPartial(): void
    {
        $nrOfPlaces = 3;
        $sportVariant = new AgainstSportVariant(1, 2, 0, 1);
        self::assertSame(1, $sportVariant->getNrOfGamesPerPartial($nrOfPlaces));
    }

    public function testNrOfGamesPerPartial2(): void
    {
        $nrOfPlaces = 6;
        $sportVariant = new AgainstSportVariant(2, 2, 0, 1);
        self::assertSame(3, $sportVariant->getNrOfGamesPerPartial($nrOfPlaces));
    }

    public function testNrOfAgainstGames3TeamsPartials2(): void
    {
        $nrOfPlaces = 3;
        $sportVariant = new AgainstSportVariant(1, 2, 0, 2);
        self::assertSame(2, $sportVariant->getTotalNrOfGames($nrOfPlaces));
    }

    public function testGetNrOfAgainstGames5TeamsGameAmount2(): void
    {
        $sportVariant = new AgainstSportVariant(1, 1, 2, 0);
        self::assertSame(20, $sportVariant->getTotalNrOfGames(5));
    }

    public function testGetNrOfAgainstGames5TeamsGamePlaces4(): void
    {
        $sportVariant = new AgainstSportVariant(2, 2, 0, 2);
        self::assertSame(10, $sportVariant->getTotalNrOfGames(5));
    }

    public function testGetNrOfAgainstGames6TeamsGamePlaces4(): void
    {
        $sportVariant = new AgainstSportVariant(2, 2, 0, 15);
        self::assertSame(45, $sportVariant->getTotalNrOfGames(6));
    }

    public function testGetNrOfAgainstGames7TeamsGamePlaces4(): void
    {
        $nrOfGamesPerPartial = 7;
        $sportVariant = new AgainstSportVariant(2, 2, 0, 105 / $nrOfGamesPerPartial);
        self::assertSame(105, $sportVariant->getTotalNrOfGames(7));
    }

    public function testGetNrOfAgainstGames8TeamsGamePlaces4(): void
    {
        $nrOfGamesPerPartial = 2;
        $sportVariant = new AgainstSportVariant(2, 2, 0, 210 / $nrOfGamesPerPartial);
        self::assertSame(210, $sportVariant->getTotalNrOfGames(8));
    }

    // ( (8 boven 3) * (5 boven 3)) / 2 = (56 * 10 ) / 2 = 280
    public function testGetNrOfAgainstGames8TeamsGamePlaces6(): void
    {
        $nrOfGamesPerPartial = 4;
        $sportVariant = new AgainstSportVariant(3, 3, 0, 280 / $nrOfGamesPerPartial);
        self::assertSame(280, $sportVariant->getTotalNrOfGames(8));
    }

    public function testGetNrOfAgainstGameRoundsEvenPlaces(): void
    {
        $sportVariant = new AgainstSportVariant(1, 1, 5, 0);
        self::assertSame(15, $sportVariant->getNrOfGameRounds(4));
    }

    public function testGetNrOfAgainstGameRoundsOddPlaces(): void
    {
        $sportVariant = new AgainstSportVariant(1, 1, 5, 0);
        self::assertSame(25, $sportVariant->getNrOfGameRounds(5));
    }

    public function testGetNrOfAgainstGameRoundsOddPlaces4GamePlaces(): void
    {
        $sportVariant = new AgainstSportVariant(2, 2, 0, 3);
        self::assertSame(15, $sportVariant->getNrOfGameRounds(5));
    }

    public function testNrOfGamesPerPlace(): void
    {
        $sportVariant = new AgainstSportVariant(1, 1, 1, 0);
        self::assertSame(4, $sportVariant->getTotalNrOfGamesPerPlace(5));
    }

    public function testNrOfGamesPerPlace2(): void
    {
        $sportVariant = new AgainstSportVariant(1, 2, 0, 3);
        self::assertSame(9, $sportVariant->getTotalNrOfGamesPerPlace(4));
    }

    public function testNrOfGamesPerPlace3(): void
    {
        $sportVariant = new AgainstSportVariant(1, 2, 0, 6);
        self::assertSame(18, $sportVariant->getTotalNrOfGamesPerPlace(4));
    }

    public function testNrOfPartialsPerH2H(): void
    {
        $sportVariant = new AgainstSportVariant(2, 2, 0, 1);
        self::assertSame(3, $sportVariant->getNrOfPartialsPerH2H(5));
    }
}
