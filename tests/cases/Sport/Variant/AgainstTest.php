<?php
declare(strict_types=1);

namespace SportsHelpers\Tests\Sport\Variant;

use PHPUnit\Framework\TestCase;
use SportsHelpers\GameMode;
use SportsHelpers\Sport\Variant\Against as AgainstSportVariant;

class AgainstTest extends TestCase
{
    public function testCreation(): void
    {
        $sportVariant = new AgainstSportVariant(1, 2, 0, 1);
        self::assertSame(GameMode::AGAINST, $sportVariant->getGameMode());
        self::assertSame(1, $sportVariant->getNrOfHomePlaces());
        self::assertSame(2, $sportVariant->getNrOfAwayPlaces());
        self::assertSame(0, $sportVariant->getNrOfH2H());
        self::assertSame(1, $sportVariant->getNrOfGamesPerPlace());
    }

    public function testWrong1VS1(): void
    {
        self::expectException(\Exception::class);
        new AgainstSportVariant(1, 1, 0, 1);
    }

    public function testWrongMixed(): void
    {
        self::expectException(\Exception::class);
        new AgainstSportVariant(2, 2, 1, 0);
    }

    public function testTotalNrOfGames(): void
    {
        $sportVariant1VS1 = new AgainstSportVariant(1, 1, 1, 0);
        self::assertSame(1, $sportVariant1VS1->getTotalNrOfGames(2));
        self::assertSame(3, $sportVariant1VS1->getTotalNrOfGames(3));
        self::assertSame(6, $sportVariant1VS1->getTotalNrOfGames(4));
        self::assertSame(10, $sportVariant1VS1->getTotalNrOfGames(5));

        $sportVariant1VS2 = new AgainstSportVariant(1, 2, 0, 1);
        self::assertSame(1, $sportVariant1VS2->getTotalNrOfGames(3));
        self::assertSame(2, $sportVariant1VS2->getTotalNrOfGames(4));
        self::assertSame(2, $sportVariant1VS2->getTotalNrOfGames(5));
        self::assertSame(2, $sportVariant1VS2->getTotalNrOfGames(6));
        self::assertSame(3, $sportVariant1VS2->getTotalNrOfGames(7));

        $sportVariant2VS2GPP2 = new AgainstSportVariant(2, 2, 0, 2);
        self::assertSame(2, $sportVariant2VS2GPP2->getTotalNrOfGames(4));
        self::assertSame(3, $sportVariant2VS2GPP2->getTotalNrOfGames(5));
        self::assertSame(3, $sportVariant2VS2GPP2->getTotalNrOfGames(6));
    }

    public function testNrOfGamesOneH2H(): void
    {
        $sportVariant1VS1 = new AgainstSportVariant(1, 1, 1, 0);
        self::assertSame(1, $sportVariant1VS1->getNrOfGamesOneH2H(2));
        self::assertSame(3, $sportVariant1VS1->getNrOfGamesOneH2H(3));
        self::assertSame(6, $sportVariant1VS1->getNrOfGamesOneH2H(4));
        self::assertSame(10, $sportVariant1VS1->getNrOfGamesOneH2H(5));

        $sportVariant1VS2 = new AgainstSportVariant(1, 2, 0, 1);
        self::assertSame(3, $sportVariant1VS2->getNrOfGamesOneH2H(3));
        self::assertSame(12, $sportVariant1VS2->getNrOfGamesOneH2H(4));
        self::assertSame(30, $sportVariant1VS2->getNrOfGamesOneH2H(5));
        self::assertSame(60, $sportVariant1VS2->getNrOfGamesOneH2H(6));

        $sportVariant1VS2 = new AgainstSportVariant(2, 2, 0, 1);
        self::assertSame(3, $sportVariant1VS2->getNrOfGamesOneH2H(4));
        self::assertSame(15, $sportVariant1VS2->getNrOfGamesOneH2H(5));
        self::assertSame(45, $sportVariant1VS2->getNrOfGamesOneH2H(6));
        self::assertSame(105, $sportVariant1VS2->getNrOfGamesOneH2H(7));
        self::assertSame(210, $sportVariant1VS2->getNrOfGamesOneH2H(8));
        self::assertSame(378, $sportVariant1VS2->getNrOfGamesOneH2H(9));
    }

    public function testIsMixed(): void
    {
        $sportVariant1VS1 = new AgainstSportVariant(1, 1, 1, 0);
        self::assertFalse($sportVariant1VS1->isMixed());

        $sportVariant1VS2 = new AgainstSportVariant(1, 2, 0, 1);
        self::assertTrue($sportVariant1VS2->isMixed());

        $sportVariant2VS2 = new AgainstSportVariant(2, 2, 0, 11);
        self::assertTrue($sportVariant2VS2->isMixed());
    }

    public function testAllPlacesParticipateInGameRound(): void
    {
        $sportVariant1VS1 = new AgainstSportVariant(1, 1, 1, 0);
        self::assertTrue($sportVariant1VS1->allPlacesParticipateInGameRound(2));
        self::assertFalse($sportVariant1VS1->allPlacesParticipateInGameRound(3));
        self::assertTrue($sportVariant1VS1->allPlacesParticipateInGameRound(4));
        self::assertFalse($sportVariant1VS1->allPlacesParticipateInGameRound(5));

        $sportVariant1VS2 = new AgainstSportVariant(1, 2, 0, 1);
        self::assertTrue($sportVariant1VS2->allPlacesParticipateInGameRound(3));
        self::assertFalse($sportVariant1VS2->allPlacesParticipateInGameRound(4));
        self::assertFalse($sportVariant1VS2->allPlacesParticipateInGameRound(5));
        self::assertTrue($sportVariant1VS2->allPlacesParticipateInGameRound(6));
        self::assertFalse($sportVariant1VS2->allPlacesParticipateInGameRound(7));

        $sportVariant2VS2 = new AgainstSportVariant(2, 2, 0, 1);
        self::assertFalse($sportVariant2VS2->allPlacesParticipateInGameRound(3));
        self::assertTrue($sportVariant2VS2->allPlacesParticipateInGameRound(4));
        self::assertFalse($sportVariant2VS2->allPlacesParticipateInGameRound(5));
        self::assertFalse($sportVariant2VS2->allPlacesParticipateInGameRound(6));
        self::assertFalse($sportVariant2VS2->allPlacesParticipateInGameRound(7));
        self::assertTrue($sportVariant2VS2->allPlacesParticipateInGameRound(8));
        self::assertFalse($sportVariant2VS2->allPlacesParticipateInGameRound(9));
    }

    public function testGetMaxTotalNrOfGamesPerPlace(): void
    {
        $sportVariant1VS1 = new AgainstSportVariant(1, 1, 1, 0);
        self::assertSame(1, $sportVariant1VS1->getTotalNrOfGamesPerPlace(2));
        self::assertSame(2, $sportVariant1VS1->getTotalNrOfGamesPerPlace(3));
        self::assertSame(3, $sportVariant1VS1->getTotalNrOfGamesPerPlace(4));
        self::assertSame(4, $sportVariant1VS1->getTotalNrOfGamesPerPlace(5));

        $sportVariant1VS2 = new AgainstSportVariant(1, 2, 0, 2);
        self::assertSame(2, $sportVariant1VS2->getTotalNrOfGamesPerPlace(3));
        self::assertSame(2, $sportVariant1VS2->getTotalNrOfGamesPerPlace(4));
        self::assertSame(2, $sportVariant1VS2->getTotalNrOfGamesPerPlace(5));

        $sportVariant2VS2 = new AgainstSportVariant(2, 2, 0, 2);
        self::assertSame(2, $sportVariant2VS2->getTotalNrOfGamesPerPlace(3));
        self::assertSame(2, $sportVariant2VS2->getTotalNrOfGamesPerPlace(4));
        self::assertSame(2, $sportVariant2VS2->getTotalNrOfGamesPerPlace(5));
    }

//    public function testNrOfGamesPerPartial2GamePlaces(): void
//    {
//        $sportVariant = new AgainstSportVariant(1, 1, 1, 0);
//        self::assertSame(1, $sportVariant->getNrOfGamesOnePartial(2));
//        self::assertSame(3, $sportVariant->getNrOfGamesOnePartial(3));
//        self::assertSame(4, $sportVariant->getNrOfGamesOnePartial(4));
//        self::assertSame(5, $sportVariant->getNrOfGamesOnePartial(5));
//        self::assertSame(6, $sportVariant->getNrOfGamesOnePartial(6));
//        self::assertSame(7, $sportVariant->getNrOfGamesOnePartial(7));
//        self::assertSame(8, $sportVariant->getNrOfGamesOnePartial(8));
//    }
//
//    public function testNrOfGamesPerPartial3GamePlaces(): void
//    {
//        $sportVariant = new AgainstSportVariant(1, 2, 0, 1);
//        self::assertSame(3, $sportVariant->getNrOfGamesOnePartial(3));
//        self::assertSame(4, $sportVariant->getNrOfGamesOnePartial(4));
//    }
//
//    public function testNrOfGamesPerPartial4GamePlaces(): void
//    {
//        $sportVariant = new AgainstSportVariant(2, 2, 0, 1);
//        self::assertSame(1, $sportVariant->getNrOfGamesOnePartial(4));
//        self::assertSame(5, $sportVariant->getNrOfGamesOnePartial(5));
//    }
//
//    public function testNrOfGamesPerPartial6GamePlaces(): void
//    {
//        $sportVariant = new AgainstSportVariant(3, 3, 0, 1);
//        self::assertSame(1, $sportVariant->getNrOfGamesOnePartial(6));
//        self::assertSame(7, $sportVariant->getNrOfGamesOnePartial(7));
//    }

//    public function testNrOfOfGameRounds2GamePlaces(): void
//    {
//        $sportVariant = new AgainstSportVariant(1, 1, 1, 0);
//        self::assertSame(3, $sportVariant->getNrOfGameRounds(4));
//    }
//
//    public function testNrOfOfGameRounds3GamePlaces(): void
//    {
//        $sportVariant = new AgainstSportVariant(1, 2, 1, 0);
//        self::assertSame(30, $sportVariant->getNrOfGameRounds(5));
//
//        $sportVariant = new AgainstSportVariant(1, 2, 1, 0);
//        self::assertSame(30, $sportVariant->getNrOfGameRounds(6));
//    }

    public function testToPersistVariant(): void
    {
        $sportVariant = new AgainstSportVariant(1, 1, 1, 0);
        $persistVariant = $sportVariant->toPersistVariant();
        self::assertSame(1, $persistVariant->getNrOfHomePlaces());
        self::assertSame(1, $persistVariant->getNrOfAwayPlaces());
        self::assertSame(0, $persistVariant->getNrOfGamePlaces());
        self::assertSame(1, $persistVariant->getNrOfH2H());
        self::assertSame(0, $persistVariant->getNrOfGamePlaces());
    }

    public function testNrOfGamesPerPlaceOneH2H(): void
    {
        $sportVariant1VS2 = new AgainstSportVariant(1, 2, 0, 1);
        self::assertSame(3, $sportVariant1VS2->getNrOfGamesPerPlaceOneH2H(3));
        self::assertSame(9, $sportVariant1VS2->getNrOfGamesPerPlaceOneH2H(4));
        self::assertSame(18, $sportVariant1VS2->getNrOfGamesPerPlaceOneH2H(5));

        $sportVariant2VS2 = new AgainstSportVariant(2, 2, 0, 1);
        self::assertSame(3, $sportVariant2VS2->getNrOfGamesPerPlaceOneH2H(4));
        self::assertSame(12, $sportVariant2VS2->getNrOfGamesPerPlaceOneH2H(5));
        self::assertSame(30, $sportVariant2VS2->getNrOfGamesPerPlaceOneH2H(6));
        self::assertSame(60, $sportVariant2VS2->getNrOfGamesPerPlaceOneH2H(7));
        self::assertSame(105, $sportVariant2VS2->getNrOfGamesPerPlaceOneH2H(8));
    }

    public function testMustBeEquallyAssigned(): void
    {
        $sportVariant1VS1 = new AgainstSportVariant(1, 1, 1, 0);
        self::assertTrue($sportVariant1VS1->mustBeEquallyAssigned(3));

        $sportVariant2VS2GPP3 = new AgainstSportVariant(2, 2, 0, 3);
        self::assertFalse($sportVariant2VS2GPP3->mustBeEquallyAssigned(5));
        self::assertFalse($sportVariant2VS2GPP3->mustBeEquallyAssigned(6));
        self::assertFalse($sportVariant2VS2GPP3->mustBeEquallyAssigned(7));
        self::assertTrue($sportVariant2VS2GPP3->mustBeEquallyAssigned(8));

        $sportVariant2VS2GPP4 = new AgainstSportVariant(2, 2, 0, 4);
        self::assertTrue($sportVariant2VS2GPP4->mustBeEquallyAssigned(5));
        self::assertTrue($sportVariant2VS2GPP4->mustBeEquallyAssigned(6));
        self::assertTrue($sportVariant2VS2GPP4->mustBeEquallyAssigned(7));
        self::assertTrue($sportVariant2VS2GPP4->mustBeEquallyAssigned(8));
    }

    public function testHomeAwayMustBeEquallyAssigned(): void
    {
        $sportVariant1VS1 = new AgainstSportVariant(1, 1, 1, 0);
        self::assertTrue($sportVariant1VS1->homeAwayMustBeQuallyAssigned());

        $sportVariant1VS2 = new AgainstSportVariant(1, 2, 0, 1);
        self::assertFalse($sportVariant1VS2->homeAwayMustBeQuallyAssigned());

        $sportVariant2VS2 = new AgainstSportVariant(2, 2, 0, 1);
        self::assertFalse($sportVariant2VS2->homeAwayMustBeQuallyAssigned());
    }

    public function testWithAgainstMustBeEquallyAssigned(): void
    {
        $sportVariant1VS1 = new AgainstSportVariant(1, 1, 1, 0);
        self::assertTrue($sportVariant1VS1->withAgainstMustBeEquallyAssigned(3));
        self::assertTrue($sportVariant1VS1->withAgainstMustBeEquallyAssigned(4));
        self::assertTrue($sportVariant1VS1->withAgainstMustBeEquallyAssigned(5));

        $sportVariant1VS2HGPP2 = new AgainstSportVariant(1, 2, 0, 2);
        self::assertFalse($sportVariant1VS2HGPP2->withAgainstMustBeEquallyAssigned(3));
        self::assertFalse($sportVariant1VS2HGPP2->withAgainstMustBeEquallyAssigned(4));
        self::assertFalse($sportVariant1VS2HGPP2->withAgainstMustBeEquallyAssigned(5));

        $sportVariant1VS2HGPP3 = new AgainstSportVariant(1, 2, 0, 3);
        self::assertTrue($sportVariant1VS2HGPP3->withAgainstMustBeEquallyAssigned(3));
        self::assertFalse($sportVariant1VS2HGPP3->withAgainstMustBeEquallyAssigned(4));
        self::assertFalse($sportVariant1VS2HGPP3->withAgainstMustBeEquallyAssigned(5));
        self::assertFalse($sportVariant1VS2HGPP3->withAgainstMustBeEquallyAssigned(6));
        self::assertFalse($sportVariant1VS2HGPP3->withAgainstMustBeEquallyAssigned(7));

        $sportVariant1VS2HGPP4 = new AgainstSportVariant(1, 2, 0, 9);
        self::assertTrue($sportVariant1VS2HGPP4->withAgainstMustBeEquallyAssigned(3));
        self::assertTrue($sportVariant1VS2HGPP4->withAgainstMustBeEquallyAssigned(4));
        self::assertFalse($sportVariant1VS2HGPP4->withAgainstMustBeEquallyAssigned(5));

        $sportVariant2VS2GPP4 = new AgainstSportVariant(2, 2, 0, 12);
        self::assertTrue($sportVariant2VS2GPP4->withAgainstMustBeEquallyAssigned(4));
        self::assertTrue($sportVariant2VS2GPP4->withAgainstMustBeEquallyAssigned(5));
        self::assertFalse($sportVariant2VS2GPP4->withAgainstMustBeEquallyAssigned(6));
    }

    public function testToString(): void
    {
        $sportVariant = new AgainstSportVariant(1, 2, 0, 3);
        self::assertGreaterThan(0, strlen((string)$sportVariant));
    }
}
