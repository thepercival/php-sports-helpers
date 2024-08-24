<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\Sport\Variant\WithNrOfPlaces\Against;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Sport\Variant\WithNrOfPlaces\Against\H2h as AgainstH2hWithNrOfPlaces;
use SportsHelpers\SportVariants\AgainstH2h as AgainstSportH2hVariant;

class H2hTest extends TestCase
{
    public function testTotalNrOfGames(): void
    {
        $sportVariant = new AgainstSportH2hVariant(1, 1, 1);
        $variantWithNrOfPlaces = new AgainstH2hWithNrOfPlaces(2, $sportVariant);
        self::assertSame(1, $variantWithNrOfPlaces->getTotalNrOfGames());
        $variantWithNrOfPlaces = new AgainstH2hWithNrOfPlaces(3, $sportVariant);
        self::assertSame(3, $variantWithNrOfPlaces->getTotalNrOfGames());
        $variantWithNrOfPlaces = new AgainstH2hWithNrOfPlaces(4, $sportVariant);
        self::assertSame(6, $variantWithNrOfPlaces->getTotalNrOfGames());
        $variantWithNrOfPlaces = new AgainstH2hWithNrOfPlaces(5, $sportVariant);
        self::assertSame(10, $variantWithNrOfPlaces->getTotalNrOfGames());
    }

    public function testAllPlacesPlaySimultaneously(): void
    {
        $sportVariant = new AgainstSportH2hVariant(1, 1, 1);

        $variantWithNrOfPlaces = new AgainstH2hWithNrOfPlaces(2, $sportVariant);
        self::assertTrue($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());

        $variantWithNrOfPlaces = new AgainstH2hWithNrOfPlaces(3, $sportVariant);
        self::assertFalse($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());

        $variantWithNrOfPlaces = new AgainstH2hWithNrOfPlaces(4, $sportVariant);
        self::assertTrue($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());

        $variantWithNrOfPlaces = new AgainstH2hWithNrOfPlaces(5, $sportVariant);
        self::assertFalse($variantWithNrOfPlaces->canAllPlacesPlaySimultaneously());
    }

    public function testTotalNrOfGamesPerPlace(): void
    {
        $sportVariant = new AgainstSportH2hVariant(1, 1, 1);
        $variantWithNrOfPlaces = new AgainstH2hWithNrOfPlaces(2, $sportVariant);
        self::assertSame(1, $variantWithNrOfPlaces->getTotalNrOfGamesPerPlace());
        $variantWithNrOfPlaces = new AgainstH2hWithNrOfPlaces(3, $sportVariant);
        self::assertSame(2, $variantWithNrOfPlaces->getTotalNrOfGamesPerPlace());
        $variantWithNrOfPlaces = new AgainstH2hWithNrOfPlaces(4, $sportVariant);
        self::assertSame(3, $variantWithNrOfPlaces->getTotalNrOfGamesPerPlace());
        $variantWithNrOfPlaces = new AgainstH2hWithNrOfPlaces(5, $sportVariant);
        self::assertSame(4, $variantWithNrOfPlaces->getTotalNrOfGamesPerPlace());
    }

    // @TODO CDK MOVE TO PLANNING
//    public function testMaxNrOfGamesSimultaneously(): void
//    {
//        $WithNrOfPlaces = new AgainstH2hWithNrOfPlaces(5, new AgainstH2h(1, 1 , 1));
//
//        $selfRefereeInfo = new SelfRefereeInfo(SelfReferee::SamePoule, 2);
//        $maxNrOfGamesSimultaneously = $WithNrOfPlaces->getMaxNrOfGamesSimultaneously($selfRefereeInfo);
//        self::assertSame(2, $maxNrOfGamesSimultaneously);
//
//        $selfRefereeInfo = new SelfRefereeInfo(SelfReferee::SamePoule, 1);
//        $maxNrOfGamesSimultaneously = $WithNrOfPlaces->getMaxNrOfGamesSimultaneously($selfRefereeInfo);
//        self::assertSame(1, $maxNrOfGamesSimultaneously);
//    }
}
