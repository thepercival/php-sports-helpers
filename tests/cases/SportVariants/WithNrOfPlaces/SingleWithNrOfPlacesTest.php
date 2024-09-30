<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\SportVariants\WithNrOfPlaces;

use PHPUnit\Framework\TestCase;
use SportsHelpers\SportVariants\Single;
use SportsHelpers\SportVariants\WithNrOfPlaces\SingleWithNrOfPlaces;

class SingleWithNrOfPlacesTest extends TestCase
{
    public function testGetSportVariant(): void
    {
        $single = new Single(1, 1);
        $singleWithNrOfPlaces = new SingleWithNrOfPlaces(4, $single);
        self::assertSame($single, $singleWithNrOfPlaces->getSportVariant());
    }

    public function testTotalNrOfGames(): void
    {
        $sportVariant = new Single(3, 2);
        $variantWithNrOfPlaces = new SingleWithNrOfPlaces(9, $sportVariant);
        self::assertSame(6, $variantWithNrOfPlaces->getTotalNrOfGames());
        $variantWithNrOfPlaces = new SingleWithNrOfPlaces(10, $sportVariant);
        self::assertSame(7, $variantWithNrOfPlaces->getTotalNrOfGames());
    }

    public function testGetTotalNrOfGamesPerPlace(): void
    {
        $sportVariant = new Single(3, 2);
        $singleWithNrOfPlaces = new SingleWithNrOfPlaces(9, $sportVariant);
        self::assertSame(2, $singleWithNrOfPlaces->getTotalNrOfGamesPerPlace());
    }

    public function testGetMaxNrOfGamesSimultaneously(): void
    {
        $sportVariant = new Single(3, 2);
        $singleWithNrOfPlaces = new SingleWithNrOfPlaces(10, $sportVariant);
        self::assertSame(4, $singleWithNrOfPlaces->getMaxNrOfGamesSimultaneously());

        $sportVariant = new Single(3, 2);
        $singleWithNrOfPlaces = new SingleWithNrOfPlaces(11, $sportVariant);
        self::assertSame(4, $singleWithNrOfPlaces->getMaxNrOfGamesSimultaneously());

        $sportVariant = new Single(3, 2);
        $singleWithNrOfPlaces = new SingleWithNrOfPlaces(12, $sportVariant);
        self::assertSame(4, $singleWithNrOfPlaces->getMaxNrOfGamesSimultaneously());
    }

    public function testGetMaxNrOfGamePlacesSimultaneously(): void
    {
        $sportVariant = new Single(3, 2);
        $singleWithNrOfPlaces = new SingleWithNrOfPlaces(10, $sportVariant);
        self::assertSame(10, $singleWithNrOfPlaces->getMaxNrOfGamePlacesSimultaneously());

        $sportVariant = new Single(3, 2);
        $singleWithNrOfPlaces = new SingleWithNrOfPlaces(11, $sportVariant);
        self::assertSame(11, $singleWithNrOfPlaces->getMaxNrOfGamePlacesSimultaneously());

        $sportVariant = new Single(3, 2);
        $singleWithNrOfPlaces = new SingleWithNrOfPlaces(12, $sportVariant);
        self::assertSame(12, $singleWithNrOfPlaces->getMaxNrOfGamePlacesSimultaneously());

        $sportVariant = new Single(3, 2);
        $singleWithNrOfPlaces = new SingleWithNrOfPlaces(2, $sportVariant);
        self::assertSame(2, $singleWithNrOfPlaces->getMaxNrOfGamePlacesSimultaneously());
    }
}
