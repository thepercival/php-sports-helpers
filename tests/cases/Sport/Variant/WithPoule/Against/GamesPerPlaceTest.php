<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\Sport\Variant\WithPoule\Against;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Against\Side;
use SportsHelpers\Sport\Variant\Against\GamesPerPlace as AgainstSportGppVariant;
use SportsHelpers\Sport\Variant\WithPoule\Against\GamesPerPlace as AgainstGppWithPoule;

class GamesPerPlaceTest extends TestCase
{
    public function testTotalNrOfGames(): void
    {
        $sportVariant = new AgainstSportGppVariant(1, 2, 1);
        $variantWithPoule = new AgainstGppWithPoule(3, $sportVariant);
        self::assertSame(1, $variantWithPoule->getTotalNrOfGames());
        $variantWithPoule = new AgainstGppWithPoule(4, $sportVariant);
        self::assertSame(1, $variantWithPoule->getTotalNrOfGames());
        $variantWithPoule = new AgainstGppWithPoule(5, $sportVariant);
        self::assertSame(1, $variantWithPoule->getTotalNrOfGames());
        $variantWithPoule = new AgainstGppWithPoule(6, $sportVariant);
        self::assertSame(2, $variantWithPoule->getTotalNrOfGames());
        $variantWithPoule = new AgainstGppWithPoule(7, $sportVariant);
        self::assertSame(2, $variantWithPoule->getTotalNrOfGames());

        $sportVariant = new AgainstSportGppVariant(2, 2, 2);
        $variantWithPoule = new AgainstGppWithPoule(4, $sportVariant);
        self::assertSame(2, $variantWithPoule->getTotalNrOfGames());
        $variantWithPoule = new AgainstGppWithPoule(5, $sportVariant);
        self::assertSame(2, $variantWithPoule->getTotalNrOfGames());
        $variantWithPoule = new AgainstGppWithPoule(6, $sportVariant);
        self::assertSame(3, $variantWithPoule->getTotalNrOfGames());
    }

    public function testNrOfGamesPerPlaceOneH2H(): void
    {
        $sportVariant = new AgainstSportGppVariant(1, 2, 1);
        $variantWithPoule = new AgainstGppWithPoule(3, $sportVariant);
        self::assertSame(3, $variantWithPoule->getNrOfGamesPerPlaceOneH2h());
        $variantWithPoule = new AgainstGppWithPoule(4, $sportVariant);
        self::assertSame(9, $variantWithPoule->getNrOfGamesPerPlaceOneH2h());
        $variantWithPoule = new AgainstGppWithPoule(5, $sportVariant);
        self::assertSame(18, $variantWithPoule->getNrOfGamesPerPlaceOneH2h());

        $sportVariant = new AgainstSportGppVariant(2, 2, 1);
        $variantWithPoule = new AgainstGppWithPoule(4, $sportVariant);
        self::assertSame(3, $variantWithPoule->getNrOfGamesPerPlaceOneH2h());
        $variantWithPoule = new AgainstGppWithPoule(5, $sportVariant);
        self::assertSame(12, $variantWithPoule->getNrOfGamesPerPlaceOneH2h());
        $variantWithPoule = new AgainstGppWithPoule(6, $sportVariant);
        self::assertSame(30, $variantWithPoule->getNrOfGamesPerPlaceOneH2h());
        $variantWithPoule = new AgainstGppWithPoule(7, $sportVariant);
        self::assertSame(60, $variantWithPoule->getNrOfGamesPerPlaceOneH2h());
        $variantWithPoule = new AgainstGppWithPoule(8, $sportVariant);
        self::assertSame(105, $variantWithPoule->getNrOfGamesPerPlaceOneH2h());
    }

    public function testAllPlacesSameNrOfGamesAssignable(): void
    {
        $sportVariant = new AgainstSportGppVariant(2, 2, 4);
        $againstWithPoule = new AgainstGppWithPoule(5, $sportVariant);
        self::assertTrue($againstWithPoule->allPlacesSameNrOfGamesAssignable());

        $sportVariant = new AgainstSportGppVariant(1, 1, 1);
        $againstWithPoule = new AgainstGppWithPoule(5, $sportVariant);
        self::assertFalse($againstWithPoule->allPlacesSameNrOfGamesAssignable());

        $sportVariant = new AgainstSportGppVariant(1, 1, 1);
        $againstWithPoule = new AgainstGppWithPoule(11, $sportVariant);
        self::assertFalse($againstWithPoule->allPlacesSameNrOfGamesAssignable());

        $sportVariant = new AgainstSportGppVariant(1, 1, 2);
        $againstWithPoule = new AgainstGppWithPoule(11, $sportVariant);
        self::assertTrue($againstWithPoule->allPlacesSameNrOfGamesAssignable());

        $sportVariant = new AgainstSportGppVariant(1, 1, 9);
        $againstWithPoule = new AgainstGppWithPoule(10, $sportVariant);
        self::assertTrue($againstWithPoule->allPlacesSameNrOfGamesAssignable());
    }

    public function testAllPlacesSameNrOfAgainstAssignable(): void
    {
        $sportVariant = new AgainstSportGppVariant(2, 2, 6);
        $againstWithPoule = new AgainstGppWithPoule(6, $sportVariant);
        self::assertFalse($againstWithPoule->allAgainstSameNrOfGamesAssignable());
    }

    public function testAllWithSameNrOfGamesAssignable(): void
    {
        $sportVariant = new AgainstSportGppVariant(1, 2, 2);
        $variantWithPoule = new AgainstGppWithPoule(3, $sportVariant);
        self::assertFalse($variantWithPoule->allWithSameNrOfGamesAssignable(Side::Home));
        $variantWithPoule = new AgainstGppWithPoule(4, $sportVariant);
        self::assertFalse($variantWithPoule->allWithSameNrOfGamesAssignable(Side::Home));
        $variantWithPoule = new AgainstGppWithPoule(5, $sportVariant);
        self::assertFalse($variantWithPoule->allWithSameNrOfGamesAssignable(Side::Home));

        $sportVariant = new AgainstSportGppVariant(1, 2, 3);
        $variantWithPoule = new AgainstGppWithPoule(3, $sportVariant);
        self::assertFalse($variantWithPoule->allWithSameNrOfGamesAssignable(Side::Home));
        $variantWithPoule = new AgainstGppWithPoule(4, $sportVariant);
        self::assertFalse($variantWithPoule->allWithSameNrOfGamesAssignable(Side::Home));
        $variantWithPoule = new AgainstGppWithPoule(5, $sportVariant);
        self::assertFalse($variantWithPoule->allWithSameNrOfGamesAssignable(Side::Home));
        $variantWithPoule = new AgainstGppWithPoule(6, $sportVariant);
        self::assertFalse($variantWithPoule->allWithSameNrOfGamesAssignable(Side::Home));
        $variantWithPoule = new AgainstGppWithPoule(7, $sportVariant);
        self::assertFalse($variantWithPoule->allWithSameNrOfGamesAssignable(Side::Home));

        $sportVariant = new AgainstSportGppVariant(1, 2, 9);
        $variantWithPoule = new AgainstGppWithPoule(3, $sportVariant);
        self::assertFalse($variantWithPoule->allWithSameNrOfGamesAssignable(Side::Home));
        $variantWithPoule = new AgainstGppWithPoule(4, $sportVariant);
        self::assertFalse($variantWithPoule->allWithSameNrOfGamesAssignable(Side::Home));
        $variantWithPoule = new AgainstGppWithPoule(5, $sportVariant);
        self::assertTrue($variantWithPoule->allWithSameNrOfGamesAssignable(Side::Home));

        {
            $sportVariant = new AgainstSportGppVariant(2, 2, 2);
            $variantWithPoule = new AgainstGppWithPoule(4, $sportVariant);
            self::assertFalse($variantWithPoule->allWithSameNrOfGamesAssignable(Side::Home));

            $sportVariant = new AgainstSportGppVariant(2, 2, 3);
            $variantWithPoule = new AgainstGppWithPoule(4, $sportVariant);
            self::assertFalse($variantWithPoule->allWithSameNrOfGamesAssignable(Side::Home));

            $sportVariant = new AgainstSportGppVariant(2, 2, 6);
            $variantWithPoule = new AgainstGppWithPoule(4, $sportVariant);
            self::assertTrue($variantWithPoule->allWithSameNrOfGamesAssignable(Side::Home));
        }

        $sportVariant = new AgainstSportGppVariant(2, 2, 12);
        $variantWithPoule = new AgainstGppWithPoule(4, $sportVariant);
        self::assertTrue($variantWithPoule->allWithSameNrOfGamesAssignable(Side::Home));

        $sportVariant = new AgainstSportGppVariant(2, 2, 24);
        $variantWithPoule = new AgainstGppWithPoule(5, $sportVariant);
        self::assertTrue($variantWithPoule->allWithSameNrOfGamesAssignable(Side::Home));
        $variantWithPoule = new AgainstGppWithPoule(6, $sportVariant);
        self::assertFalse($variantWithPoule->allWithSameNrOfGamesAssignable(Side::Home));
    }

    public function testAllPlacesPlaySimultaneously(): void
    {
        $sportVariant = new AgainstSportGppVariant(1, 2, 1);
        {
            $variantWithPoule = new AgainstGppWithPoule(3, $sportVariant);
            self::assertTrue($variantWithPoule->canAllPlacesPlaySimultaneously());

            $variantWithPoule = new AgainstGppWithPoule(4, $sportVariant);
            self::assertFalse($variantWithPoule->canAllPlacesPlaySimultaneously());

            $variantWithPoule = new AgainstGppWithPoule(5, $sportVariant);
            self::assertFalse($variantWithPoule->canAllPlacesPlaySimultaneously());

            $variantWithPoule = new AgainstGppWithPoule(6, $sportVariant);
            self::assertTrue($variantWithPoule->canAllPlacesPlaySimultaneously());

            $variantWithPoule = new AgainstGppWithPoule(7, $sportVariant);
            self::assertFalse($variantWithPoule->canAllPlacesPlaySimultaneously());
        }

        $sportVariant = new AgainstSportGppVariant(2, 2, 1);
        {
            $variantWithPoule = new AgainstGppWithPoule(4, $sportVariant);
            self::assertTrue($variantWithPoule->canAllPlacesPlaySimultaneously());

            $variantWithPoule = new AgainstGppWithPoule(5, $sportVariant);
            self::assertFalse($variantWithPoule->canAllPlacesPlaySimultaneously());

            $variantWithPoule = new AgainstGppWithPoule(6, $sportVariant);
            self::assertFalse($variantWithPoule->canAllPlacesPlaySimultaneously());

            $variantWithPoule = new AgainstGppWithPoule(7, $sportVariant);
            self::assertFalse($variantWithPoule->canAllPlacesPlaySimultaneously());

            $variantWithPoule = new AgainstGppWithPoule(8, $sportVariant);
            self::assertTrue($variantWithPoule->canAllPlacesPlaySimultaneously());

            $variantWithPoule = new AgainstGppWithPoule(9, $sportVariant);
            self::assertFalse($variantWithPoule->canAllPlacesPlaySimultaneously());
        }

        $sportVariant = new AgainstSportGppVariant(2, 2, 3);
        {
            $variantWithPoule = new AgainstGppWithPoule(6, $sportVariant);
            self::assertFalse($variantWithPoule->canAllPlacesPlaySimultaneously());

            $variantWithPoule = new AgainstGppWithPoule(7, $sportVariant);
            self::assertFalse($variantWithPoule->canAllPlacesPlaySimultaneously());

            $variantWithPoule = new AgainstGppWithPoule(8, $sportVariant);
            self::assertTrue($variantWithPoule->canAllPlacesPlaySimultaneously());
        }

        $sportVariant = new AgainstSportGppVariant(2, 2, 4);
        {
            $variantWithPoule = new AgainstGppWithPoule(5, $sportVariant);
            self::assertFalse($variantWithPoule->canAllPlacesPlaySimultaneously());

            $variantWithPoule = new AgainstGppWithPoule(6, $sportVariant);
            self::assertFalse($variantWithPoule->canAllPlacesPlaySimultaneously());

            $variantWithPoule = new AgainstGppWithPoule(7, $sportVariant);
            self::assertFalse($variantWithPoule->canAllPlacesPlaySimultaneously());

            $variantWithPoule = new AgainstGppWithPoule(8, $sportVariant);
            self::assertTrue($variantWithPoule->canAllPlacesPlaySimultaneously());
        }
    }
}
