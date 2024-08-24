<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\Sport\Variant\NrOfPlaces\Against;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Sport\Variant\WithNrOfPlaces\Against\GamesPerPlace as AgainstGppWithNrOfPlaces;
use SportsHelpers\SportVariants\AgainstGpp as AgainstSportGppVariant;

class GamesPerPlaceTest extends TestCase
{
    public function testTotalNrOfGames(): void
    {
        $sportVariant = new AgainstSportGppVariant(1, 2, 1);
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(3, $sportVariant);
        self::assertSame(1, $variantWithNrOfPlaces->getTotalNrOfGames());
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(4, $sportVariant);
        self::assertSame(1, $variantWithNrOfPlaces->getTotalNrOfGames());
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(5, $sportVariant);
        self::assertSame(1, $variantWithNrOfPlaces->getTotalNrOfGames());
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(6, $sportVariant);
        self::assertSame(2, $variantWithNrOfPlaces->getTotalNrOfGames());
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(7, $sportVariant);
        self::assertSame(2, $variantWithNrOfPlaces->getTotalNrOfGames());

        $sportVariant = new AgainstSportGppVariant(2, 2, 2);
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(4, $sportVariant);
        self::assertSame(2, $variantWithNrOfPlaces->getTotalNrOfGames());
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(5, $sportVariant);
        self::assertSame(2, $variantWithNrOfPlaces->getTotalNrOfGames());
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(6, $sportVariant);
        self::assertSame(3, $variantWithNrOfPlaces->getTotalNrOfGames());
    }

    public function testNrOfGamesPerPlaceOneH2H(): void
    {
        $sportVariant = new AgainstSportGppVariant(1, 2, 1);
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(3, $sportVariant);
        self::assertSame(3, $variantWithNrOfPlaces->getNrOfGamesPerPlaceOneH2h());
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(4, $sportVariant);
        self::assertSame(9, $variantWithNrOfPlaces->getNrOfGamesPerPlaceOneH2h());
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(5, $sportVariant);
        self::assertSame(18, $variantWithNrOfPlaces->getNrOfGamesPerPlaceOneH2h());

        $sportVariant = new AgainstSportGppVariant(2, 2, 1);
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(4, $sportVariant);
        self::assertSame(3, $variantWithNrOfPlaces->getNrOfGamesPerPlaceOneH2h());
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(5, $sportVariant);
        self::assertSame(12, $variantWithNrOfPlaces->getNrOfGamesPerPlaceOneH2h());
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(6, $sportVariant);
        self::assertSame(30, $variantWithNrOfPlaces->getNrOfGamesPerPlaceOneH2h());
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(7, $sportVariant);
        self::assertSame(60, $variantWithNrOfPlaces->getNrOfGamesPerPlaceOneH2h());
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(8, $sportVariant);
        self::assertSame(105, $variantWithNrOfPlaces->getNrOfGamesPerPlaceOneH2h());
    }

    public function testAllPlacesSameNrOfGamesAssignable(): void
    {
        $sportVariant = new AgainstSportGppVariant(2, 2, 4);
        $againstWithNrOfPlaces = new AgainstGppWithNrOfPlaces(5, $sportVariant);
        self::assertTrue($againstWithNrOfPlaces->allPlacesSameNrOfGamesAssignable());

        $sportVariant = new AgainstSportGppVariant(1, 1, 1);
        $againstWithNrOfPlaces = new AgainstGppWithNrOfPlaces(5, $sportVariant);
        self::assertFalse($againstWithNrOfPlaces->allPlacesSameNrOfGamesAssignable());

        $sportVariant = new AgainstSportGppVariant(1, 1, 1);
        $againstWithNrOfPlaces = new AgainstGppWithNrOfPlaces(11, $sportVariant);
        self::assertFalse($againstWithNrOfPlaces->allPlacesSameNrOfGamesAssignable());

        $sportVariant = new AgainstSportGppVariant(1, 1, 2);
        $againstWithNrOfPlaces = new AgainstGppWithNrOfPlaces(11, $sportVariant);
        self::assertTrue($againstWithNrOfPlaces->allPlacesSameNrOfGamesAssignable());

        $sportVariant = new AgainstSportGppVariant(1, 1, 9);
        $againstWithNrOfPlaces = new AgainstGppWithNrOfPlaces(10, $sportVariant);
        self::assertTrue($againstWithNrOfPlaces->allPlacesSameNrOfGamesAssignable());
    }

    public function testAllPlacesSameNrOfAgainstAssignable(): void
    {
        $sportVariant = new AgainstSportGppVariant(2, 2, 6);
        $againstWithNrOfPlaces = new AgainstGppWithNrOfPlaces(6, $sportVariant);
        self::assertFalse($againstWithNrOfPlaces->allAgainstSameNrOfGamesAssignable());

        {
            $sportVariant = new AgainstSportGppVariant(2, 2, 6);
            $againstWithNrOfPlaces = new AgainstGppWithNrOfPlaces(4, $sportVariant);
            self::assertTrue($againstWithNrOfPlaces->allAgainstSameNrOfGamesAssignable());

            $sportVariant = new AgainstSportGppVariant(2, 2, 8);
            $againstWithNrOfPlaces = new AgainstGppWithNrOfPlaces(4, $sportVariant);
            self::assertFalse($againstWithNrOfPlaces->allAgainstSameNrOfGamesAssignable());

            $sportVariant = new AgainstSportGppVariant(2, 2, 10);
            $againstWithNrOfPlaces = new AgainstGppWithNrOfPlaces(4, $sportVariant);
            self::assertFalse($againstWithNrOfPlaces->allAgainstSameNrOfGamesAssignable());

            $sportVariant = new AgainstSportGppVariant(2, 2, 24);
            $againstWithNrOfPlaces = new AgainstGppWithNrOfPlaces(4, $sportVariant);
            self::assertTrue($againstWithNrOfPlaces->allAgainstSameNrOfGamesAssignable());
        }
    }

    public function testGetNrOfPossibleWithCombinations(): void
    {
        $sportVariant = new AgainstSportGppVariant(1, 2, 9);
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(3, $sportVariant);
        self::assertTrue($variantWithNrOfPlaces->allWithSameNrOfGamesAssignable());
    }

    public function testAllWithSameNrOfGamesAssignable(): void
    {
        $sportVariant = new AgainstSportGppVariant(1, 2, 2);
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(3, $sportVariant);
        self::assertFalse($variantWithNrOfPlaces->allWithSameNrOfGamesAssignable());
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(4, $sportVariant);
        self::assertFalse($variantWithNrOfPlaces->allWithSameNrOfGamesAssignable());
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(5, $sportVariant);
        self::assertFalse($variantWithNrOfPlaces->allWithSameNrOfGamesAssignable());

        $sportVariant = new AgainstSportGppVariant(1, 2, 3);
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(3, $sportVariant);
        self::assertTrue($variantWithNrOfPlaces->allWithSameNrOfGamesAssignable());
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(4, $sportVariant);
        self::assertFalse($variantWithNrOfPlaces->allWithSameNrOfGamesAssignable());
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(5, $sportVariant);
        self::assertFalse($variantWithNrOfPlaces->allWithSameNrOfGamesAssignable());
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(6, $sportVariant);
        self::assertFalse($variantWithNrOfPlaces->allWithSameNrOfGamesAssignable());
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(7, $sportVariant);
        self::assertFalse($variantWithNrOfPlaces->allWithSameNrOfGamesAssignable());

        $sportVariant = new AgainstSportGppVariant(1, 2, 9);
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(3, $sportVariant);
        self::assertTrue($variantWithNrOfPlaces->allWithSameNrOfGamesAssignable());
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(4, $sportVariant);
        self::assertFalse($variantWithNrOfPlaces->allWithSameNrOfGamesAssignable());
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(5, $sportVariant);
        self::assertTrue($variantWithNrOfPlaces->allWithSameNrOfGamesAssignable());

        {
            $sportVariant = new AgainstSportGppVariant(2, 2, 2);
            $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(4, $sportVariant);
            self::assertFalse($variantWithNrOfPlaces->allWithSameNrOfGamesAssignable());

            $sportVariant = new AgainstSportGppVariant(2, 2, 3);
            $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(4, $sportVariant);
            self::assertTrue($variantWithNrOfPlaces->allWithSameNrOfGamesAssignable());

            $sportVariant = new AgainstSportGppVariant(2, 2, 6);
            $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(4, $sportVariant);
            self::assertTrue($variantWithNrOfPlaces->allWithSameNrOfGamesAssignable());
        }

        $sportVariant = new AgainstSportGppVariant(2, 2, 12);
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(4, $sportVariant);
        self::assertTrue($variantWithNrOfPlaces->allWithSameNrOfGamesAssignable());

        $sportVariant = new AgainstSportGppVariant(2, 2, 24);
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(5, $sportVariant);
        self::assertTrue($variantWithNrOfPlaces->allWithSameNrOfGamesAssignable());
        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(6, $sportVariant);
        self::assertFalse($variantWithNrOfPlaces->allWithSameNrOfGamesAssignable());
    }

    public function testAllPlacesPlaySimultaneously(): void
    {
        $sportVariant = new AgainstSportGppVariant(1, 2, 1);
        {
            $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(3, $sportVariant);
            self::assertTrue($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());

            $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(4, $sportVariant);
            self::assertFalse($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());

            $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(5, $sportVariant);
            self::assertFalse($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());

            $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(6, $sportVariant);
            self::assertTrue($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());

            $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(7, $sportVariant);
            self::assertFalse($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());
        }

        $sportVariant = new AgainstSportGppVariant(2, 2, 1);
        {
            $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(4, $sportVariant);
            self::assertTrue($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());

            $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(5, $sportVariant);
            self::assertFalse($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());

            $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(6, $sportVariant);
            self::assertFalse($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());

            $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(7, $sportVariant);
            self::assertFalse($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());

            $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(8, $sportVariant);
            self::assertTrue($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());

            $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(9, $sportVariant);
            self::assertFalse($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());
        }

        $sportVariant = new AgainstSportGppVariant(2, 2, 3);
        {
            $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(6, $sportVariant);
            self::assertFalse($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());

            $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(7, $sportVariant);
            self::assertFalse($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());

            $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(8, $sportVariant);
            self::assertTrue($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());
        }

        $sportVariant = new AgainstSportGppVariant(2, 2, 4);
        {
            $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(5, $sportVariant);
            self::assertFalse($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());

            $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(6, $sportVariant);
            self::assertFalse($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());

            $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(7, $sportVariant);
            self::assertFalse($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());

            $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(8, $sportVariant);
            self::assertTrue($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());
        }
    }

    // @TODO CDK MOVE TO PLANNING
//    public function testGetMaxNrOfGamesSimultaneously(): void {
//        $variantWithNrOfPlaces = new AgainstGppWithNrOfPlaces(8, $sportVariant);
//        $refereeInfoo = new RefereeInfo
//        self::assertSame(2, $variantWithNrOfPlaces->getMaxNrOfGamesSimultaneously($refereeInfoo));
//
//    }
}
