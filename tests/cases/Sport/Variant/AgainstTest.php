<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\Sport\Variant;

use PHPUnit\Framework\TestCase;
use SportsHelpers\GameMode;
use SportsHelpers\Sport\Variant\Against as AgainstSportVariant;
use SportsHelpers\Sport\Variant\Against\H2h as AgainstSportH2hVariant;
use SportsHelpers\Sport\Variant\Against\GamesPerPlace as AgainstSportGppVariant;
use SportsHelpers\Sport\VariantWithPoule;

class AgainstTest extends TestCase
{
    public function testH2hCreation(): void
    {
        $sportVariant = new AgainstSportH2hVariant(1, 2, 1);
        self::assertSame(GameMode::Against, $sportVariant->getGameMode());
        self::assertSame(1, $sportVariant->getNrOfHomePlaces());
        self::assertSame(2, $sportVariant->getNrOfAwayPlaces());
        self::assertSame(1, $sportVariant->getNrOfH2H());
    }

    public function testGppCreation(): void
    {
        $sportVariant = new AgainstSportGppVariant(1, 2, 1);
        self::assertSame(GameMode::Against, $sportVariant->getGameMode());
        self::assertSame(1, $sportVariant->getNrOfHomePlaces());
        self::assertSame(2, $sportVariant->getNrOfAwayPlaces());
        self::assertSame(1, $sportVariant->getNrOfGamesPerPlace());
    }

    public function testTotalNrOfGames(): void
    {
        $sportVariant1VS1 = new AgainstSportH2hVariant(1, 1, 1);
        self::assertSame(1, $sportVariant1VS1->getTotalNrOfGames(2));
        self::assertSame(3, $sportVariant1VS1->getTotalNrOfGames(3));
        self::assertSame(6, $sportVariant1VS1->getTotalNrOfGames(4));
        self::assertSame(10, $sportVariant1VS1->getTotalNrOfGames(5));

        $sportVariant1VS2 = new AgainstSportGppVariant(1, 2, 1);
        $variantWithPoule = new VariantWithPoule($sportVariant1VS2, 3);
        self::assertSame(1, $variantWithPoule->getTotalNrOfGames());
        $variantWithPoule = new VariantWithPoule($sportVariant1VS2, 4);
        self::assertSame(1, $variantWithPoule->getTotalNrOfGames());
        $variantWithPoule = new VariantWithPoule($sportVariant1VS2, 5);
        self::assertSame(1, $variantWithPoule->getTotalNrOfGames());
        $variantWithPoule = new VariantWithPoule($sportVariant1VS2, 6);
        self::assertSame(2, $variantWithPoule->getTotalNrOfGames());
        $variantWithPoule = new VariantWithPoule($sportVariant1VS2, 7);
        self::assertSame(2, $variantWithPoule->getTotalNrOfGames());

        $sportVariant2VS2GPP2 = new AgainstSportGppVariant(2, 2, 2);
        $variantWithPoule = new VariantWithPoule($sportVariant2VS2GPP2, 4);
        self::assertSame(2, $variantWithPoule->getTotalNrOfGames());
        $variantWithPoule = new VariantWithPoule($sportVariant2VS2GPP2, 5);
        self::assertSame(2, $variantWithPoule->getTotalNrOfGames());
        $variantWithPoule = new VariantWithPoule($sportVariant2VS2GPP2, 6);
        self::assertSame(3, $variantWithPoule->getTotalNrOfGames());
    }

    public function testNrOfGamesOneH2H(): void
    {
        $sportVariant1VS1 = new AgainstSportH2hVariant(1, 1, 1);
        self::assertSame(1, $sportVariant1VS1->getNrOfGamesOneH2H(2));
        self::assertSame(3, $sportVariant1VS1->getNrOfGamesOneH2H(3));
        self::assertSame(6, $sportVariant1VS1->getNrOfGamesOneH2H(4));
        self::assertSame(10, $sportVariant1VS1->getNrOfGamesOneH2H(5));

        $sportVariant1VS2 = new AgainstSportGppVariant(1, 2, 1);
        self::assertSame(3, $sportVariant1VS2->getNrOfGamesOneH2H(3));
        self::assertSame(12, $sportVariant1VS2->getNrOfGamesOneH2H(4));
        self::assertSame(30, $sportVariant1VS2->getNrOfGamesOneH2H(5));
        self::assertSame(60, $sportVariant1VS2->getNrOfGamesOneH2H(6));

        $sportVariant1VS2 = new AgainstSportGppVariant(2, 2, 1);
        self::assertSame(3, $sportVariant1VS2->getNrOfGamesOneH2H(4));
        self::assertSame(15, $sportVariant1VS2->getNrOfGamesOneH2H(5));
        self::assertSame(45, $sportVariant1VS2->getNrOfGamesOneH2H(6));
        self::assertSame(105, $sportVariant1VS2->getNrOfGamesOneH2H(7));
        self::assertSame(210, $sportVariant1VS2->getNrOfGamesOneH2H(8));
        self::assertSame(378, $sportVariant1VS2->getNrOfGamesOneH2H(9));
    }

//    public function testIsMixed(): void
//    {
//        $sportVariant1VS1 = new AgainstSportH2hVariant(1, 1, 1);
//        self::assertFalse($sportVariant1VS1->isMixed());
//
//        $sportVariant1VS2 = new AgainstSportGppVariant(1, 2, 1);
//        self::assertTrue($sportVariant1VS2->isMixed());
//
//        $sportVariant2VS2 = new AgainstSportGppVariant(2, 2, 11);
//        self::assertTrue($sportVariant2VS2->isMixed());
//    }

    public function testAllPlacesParticipateInGameRound(): void
    {
        $sportVariant1VS1 = new AgainstSportH2hVariant(1, 1, 1);
        self::assertTrue($sportVariant1VS1->canAllPlacesPlaySimultaneously(2));
        self::assertFalse($sportVariant1VS1->canAllPlacesPlaySimultaneously(3));
        self::assertTrue($sportVariant1VS1->canAllPlacesPlaySimultaneously(4));
        self::assertFalse($sportVariant1VS1->canAllPlacesPlaySimultaneously(5));

        $sportVariant1VS2 = new AgainstSportGppVariant(1, 2, 1);
        self::assertTrue($sportVariant1VS2->canAllPlacesPlaySimultaneously(3));
        self::assertFalse($sportVariant1VS2->canAllPlacesPlaySimultaneously(4));
        self::assertFalse($sportVariant1VS2->canAllPlacesPlaySimultaneously(5));
        self::assertTrue($sportVariant1VS2->canAllPlacesPlaySimultaneously(6));
        self::assertFalse($sportVariant1VS2->canAllPlacesPlaySimultaneously(7));

        $sportVariant2VS2 = new AgainstSportGppVariant(2, 2, 1);
        self::assertFalse($sportVariant2VS2->canAllPlacesPlaySimultaneously(3));
        self::assertTrue($sportVariant2VS2->canAllPlacesPlaySimultaneously(4));
        self::assertFalse($sportVariant2VS2->canAllPlacesPlaySimultaneously(5));
        self::assertFalse($sportVariant2VS2->canAllPlacesPlaySimultaneously(6));
        self::assertFalse($sportVariant2VS2->canAllPlacesPlaySimultaneously(7));
        self::assertTrue($sportVariant2VS2->canAllPlacesPlaySimultaneously(8));
        self::assertFalse($sportVariant2VS2->canAllPlacesPlaySimultaneously(9));
    }

    public function testGetMaxTotalNrOfGamesPerPlace(): void
    {
        $sportVariant1VS1 = new AgainstSportH2hVariant(1, 1, 1);
        self::assertSame(1, $sportVariant1VS1->getTotalNrOfGamesPerPlace(2));
        self::assertSame(2, $sportVariant1VS1->getTotalNrOfGamesPerPlace(3));
        self::assertSame(3, $sportVariant1VS1->getTotalNrOfGamesPerPlace(4));
        self::assertSame(4, $sportVariant1VS1->getTotalNrOfGamesPerPlace(5));

        $sportVariant1VS2 = new AgainstSportGppVariant(1, 2, 2);
        self::assertSame(2, $sportVariant1VS2->getNrOfGamesPerPlace());
        self::assertSame(2, $sportVariant1VS2->getNrOfGamesPerPlace());

        $sportVariant2VS2 = new AgainstSportGppVariant(2, 2, 2);
        self::assertSame(2, $sportVariant2VS2->getNrOfGamesPerPlace());
    }


    public function testToPersistVariant(): void
    {
        $sportVariant = new AgainstSportH2hVariant(1, 1, 1);
        $persistVariant = $sportVariant->toPersistVariant();
        self::assertSame(1, $persistVariant->getNrOfHomePlaces());
        self::assertSame(1, $persistVariant->getNrOfAwayPlaces());
        self::assertSame(0, $persistVariant->getNrOfGamePlaces());
        self::assertSame(1, $persistVariant->getNrOfH2H());
        self::assertSame(0, $persistVariant->getNrOfGamePlaces());
    }

    public function testNrOfGamesPerPlaceOneH2H(): void
    {
        $sportVariant1VS2 = new AgainstSportGppVariant(1, 2, 1);
        self::assertSame(3, $sportVariant1VS2->getNrOfGamesPerPlaceOneH2H(3));
        self::assertSame(9, $sportVariant1VS2->getNrOfGamesPerPlaceOneH2H(4));
        self::assertSame(18, $sportVariant1VS2->getNrOfGamesPerPlaceOneH2H(5));

        $sportVariant2VS2 = new AgainstSportGppVariant(2, 2, 1);
        self::assertSame(3, $sportVariant2VS2->getNrOfGamesPerPlaceOneH2H(4));
        self::assertSame(12, $sportVariant2VS2->getNrOfGamesPerPlaceOneH2H(5));
        self::assertSame(30, $sportVariant2VS2->getNrOfGamesPerPlaceOneH2H(6));
        self::assertSame(60, $sportVariant2VS2->getNrOfGamesPerPlaceOneH2H(7));
        self::assertSame(105, $sportVariant2VS2->getNrOfGamesPerPlaceOneH2H(8));
    }


    public function testEqualNrOfHomePlaces(): void
    {
        $sportVariant1VS2HGPP2 = new AgainstSportGppVariant(1, 2, 2);
        self::assertFalse($sportVariant1VS2HGPP2->equalNrOfHomePlaces(3));
        self::assertFalse($sportVariant1VS2HGPP2->equalNrOfHomePlaces(4));
        self::assertFalse($sportVariant1VS2HGPP2->equalNrOfHomePlaces(5));

        $sportVariant1VS2HGPP3 = new AgainstSportGppVariant(1, 2, 3);
        self::assertTrue($sportVariant1VS2HGPP3->equalNrOfHomePlaces(3));
        self::assertFalse($sportVariant1VS2HGPP3->equalNrOfHomePlaces(4));
        self::assertFalse($sportVariant1VS2HGPP3->equalNrOfHomePlaces(5));
        self::assertFalse($sportVariant1VS2HGPP3->equalNrOfHomePlaces(6));
        self::assertFalse($sportVariant1VS2HGPP3->equalNrOfHomePlaces(7));

        $sportVariant1VS2HGPP9 = new AgainstSportGppVariant(1, 2, 9);
        self::assertTrue($sportVariant1VS2HGPP9->equalNrOfHomePlaces(3));
        self::assertTrue($sportVariant1VS2HGPP9->equalNrOfHomePlaces(4));
        self::assertFalse($sportVariant1VS2HGPP9->equalNrOfHomePlaces(5));

        $sportVariant2VS2GPP12 = new AgainstSportGppVariant(2, 2, 12);
        self::assertTrue($sportVariant2VS2GPP12->equalNrOfHomePlaces(4));

        $sportVariant2VS2GPP24 = new AgainstSportGppVariant(2, 2, 24);
        self::assertTrue($sportVariant2VS2GPP24->equalNrOfHomePlaces(5));
        self::assertFalse($sportVariant2VS2GPP24->equalNrOfHomePlaces(6));
    }

//    public function testNrOfGameRounds(): void
//    {
//        $sportVariant1VS1 = new AgainstSportH2hVariant(1, 1, 1);
//        self::assertEquals(3, $sportVariant1VS1->getNrOfGameRounds(4));
//        self::assertEquals(5, $sportVariant1VS1->getNrOfGameRounds(6));
//    }

    public function testToString(): void
    {
        $sportVariant = new AgainstSportGppVariant(1, 2, 3);
        self::assertGreaterThan(0, strlen((string)$sportVariant));
    }

    public function testAllPlacesPlaySameNrOfGames(): void
    {
        $sportVariant = new AgainstSportGppVariant(2, 2, 4);
        self::assertTrue($sportVariant->allPlacesPlaySameNrOfGames(5));

        $sportVariant = new AgainstSportGppVariant(1, 1, 1);
        self::assertFalse($sportVariant->allPlacesPlaySameNrOfGames(5));

        $sportVariant = new AgainstSportGppVariant(1, 1, 1);
        self::assertFalse($sportVariant->allPlacesPlaySameNrOfGames(11));

        $sportVariant = new AgainstSportGppVariant(1, 1, 2);
        self::assertTrue($sportVariant->allPlacesPlaySameNrOfGames(11));
    }
}
