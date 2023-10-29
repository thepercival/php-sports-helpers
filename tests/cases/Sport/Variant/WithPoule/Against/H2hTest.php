<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\Sport\Variant\WithPoule\Against;

use PHPUnit\Framework\TestCase;
use SportsHelpers\SelfReferee;
use SportsHelpers\SelfRefereeInfo;
use SportsHelpers\Sport\Variant\Against\H2h as AgainstH2h;
use SportsHelpers\Sport\Variant\Against\H2h as AgainstSportH2hVariant;
use SportsHelpers\Sport\Variant\WithPoule\Against\H2h as AgainstH2hWithPoule;

class H2hTest extends TestCase
{
    public function testTotalNrOfGames(): void
    {
        $sportVariant = new AgainstSportH2hVariant(1, 1, 1);
        $variantWithPoule = new AgainstH2hWithPoule(2, $sportVariant);
        self::assertSame(1, $variantWithPoule->getTotalNrOfGames());
        $variantWithPoule = new AgainstH2hWithPoule(3, $sportVariant);
        self::assertSame(3, $variantWithPoule->getTotalNrOfGames());
        $variantWithPoule = new AgainstH2hWithPoule(4, $sportVariant);
        self::assertSame(6, $variantWithPoule->getTotalNrOfGames());
        $variantWithPoule = new AgainstH2hWithPoule(5, $sportVariant);
        self::assertSame(10, $variantWithPoule->getTotalNrOfGames());
    }

    public function testAllPlacesPlaySimultaneously(): void
    {
        $sportVariant = new AgainstSportH2hVariant(1, 1, 1);

        $variantWithPoule = new AgainstH2hWithPoule(2, $sportVariant);
        self::assertTrue($variantWithPoule->canAllPlacesPlaySimultaneously());

        $variantWithPoule = new AgainstH2hWithPoule(3, $sportVariant);
        self::assertFalse($variantWithPoule->canAllPlacesPlaySimultaneously());

        $variantWithPoule = new AgainstH2hWithPoule(4, $sportVariant);
        self::assertTrue($variantWithPoule->canAllPlacesPlaySimultaneously());

        $variantWithPoule = new AgainstH2hWithPoule(5, $sportVariant);
        self::assertFalse($variantWithPoule->canAllPlacesPlaySimultaneously());
    }

    public function testTotalNrOfGamesPerPlace(): void
    {
        $sportVariant = new AgainstSportH2hVariant(1, 1, 1);
        $variantWithPoule = new AgainstH2hWithPoule(2, $sportVariant);
        self::assertSame(1, $variantWithPoule->getTotalNrOfGamesPerPlace());
        $variantWithPoule = new AgainstH2hWithPoule(3, $sportVariant);
        self::assertSame(2, $variantWithPoule->getTotalNrOfGamesPerPlace());
        $variantWithPoule = new AgainstH2hWithPoule(4, $sportVariant);
        self::assertSame(3, $variantWithPoule->getTotalNrOfGamesPerPlace());
        $variantWithPoule = new AgainstH2hWithPoule(5, $sportVariant);
        self::assertSame(4, $variantWithPoule->getTotalNrOfGamesPerPlace());
    }

    // @TODO CDK MOVE TO PLANNING
//    public function testMaxNrOfGamesSimultaneously(): void
//    {
//        $withPoule = new AgainstH2hWithPoule(5, new AgainstH2h(1, 1 , 1));
//
//        $selfRefereeInfo = new SelfRefereeInfo(SelfReferee::SamePoule, 2);
//        $maxNrOfGamesSimultaneously = $withPoule->getMaxNrOfGamesSimultaneously($selfRefereeInfo);
//        self::assertSame(2, $maxNrOfGamesSimultaneously);
//
//        $selfRefereeInfo = new SelfRefereeInfo(SelfReferee::SamePoule, 1);
//        $maxNrOfGamesSimultaneously = $withPoule->getMaxNrOfGamesSimultaneously($selfRefereeInfo);
//        self::assertSame(1, $maxNrOfGamesSimultaneously);
//    }
}
