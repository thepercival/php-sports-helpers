<?php

namespace SportsHelpers\Tests\Sport;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Sport\GamePlaceCalculator;
use SportsHelpers\Sport\Variant\Against as AgainstSportVariant;
use SportsHelpers\Sport\Variant\Against\GamesPerPlace as AgainstSportGppVariant;
use SportsHelpers\Sport\Variant\Against\H2h as AgainstSportH2hVariant;
use SportsHelpers\Sport\VariantWithPoule;

final class VariantWithPouleTest extends TestCase
{
    public function testAllPlacesParticipateInOneGameRound(): void
    {
        $sportVariant1VS1 = new AgainstSportH2hVariant(1, 1, 1);
        $variantWithPoule = new VariantWithPoule($sportVariant1VS1, 3);
        self::assertFalse($variantWithPoule->canAllPlacesPlaySimultaneously());

        $sportVariant2VS2GPP3 = new AgainstSportGppVariant(2, 2, 3);
        $variantWithPoule = new VariantWithPoule($sportVariant2VS2GPP3, 3);
        self::assertFalse($variantWithPoule->canAllPlacesPlaySimultaneously());

        $variantWithPoule = new VariantWithPoule($sportVariant2VS2GPP3, 6);
        self::assertFalse($variantWithPoule->canAllPlacesPlaySimultaneously());

        $variantWithPoule = new VariantWithPoule($sportVariant2VS2GPP3, 7);
        self::assertFalse($variantWithPoule->canAllPlacesPlaySimultaneously());

        $variantWithPoule = new VariantWithPoule($sportVariant2VS2GPP3, 8);
        self::assertTrue($variantWithPoule->canAllPlacesPlaySimultaneously());

        $sportVariant2VS2GPP4 = new AgainstSportGppVariant(2, 2, 4);
        $variantWithPoule = new VariantWithPoule($sportVariant2VS2GPP4, 5);
        self::assertFalse($variantWithPoule->canAllPlacesPlaySimultaneously());

        $variantWithPoule = new VariantWithPoule($sportVariant2VS2GPP4, 6);
        self::assertFalse($variantWithPoule->canAllPlacesPlaySimultaneously());

        $variantWithPoule = new VariantWithPoule($sportVariant2VS2GPP4, 7);
        self::assertFalse($variantWithPoule->canAllPlacesPlaySimultaneously());

        $variantWithPoule = new VariantWithPoule($sportVariant2VS2GPP4, 8);
        self::assertTrue($variantWithPoule->canAllPlacesPlaySimultaneously());
    }


}
