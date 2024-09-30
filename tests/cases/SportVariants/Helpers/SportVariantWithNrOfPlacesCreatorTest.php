<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\SportVariants\Helpers;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Against\AgainstSide;
use SportsHelpers\GameMode;
use SportsHelpers\SportVariants\AgainstOneVsOne;
use SportsHelpers\SportVariants\AgainstOneVsTwo;
use SportsHelpers\SportVariants\AgainstTwoVsTwo;
use SportsHelpers\SportVariants\AllInOneGame;
use SportsHelpers\SportVariants\Helpers\SportVariantWithNrOfPlacesCreator;
use SportsHelpers\SportVariants\Single;

class  SportVariantWithNrOfPlacesCreatorTest extends TestCase
{
    public function testCreateSingleWithNrOfPlaces(): void
    {
        $nrOfPlaces = 4;
        $single = new Single(1, 1);
        $singleWithNrOfPlaces = (new SportVariantWithNrOfPlacesCreator())->createWithNrOfPlaces(
            $nrOfPlaces, $single);

        self::assertSame($nrOfPlaces, $singleWithNrOfPlaces->getNrOfPlaces());
    }

    public function testCreateListWithNrOfPlaces(): void
    {
        $sportVariants = [
            new Single(1, 1), new AllInOneGame(1), new AgainstTwoVsTwo(1)
        ];
        $variantsWithNrOfPlaces = (new SportVariantWithNrOfPlacesCreator())->createListWithNrOfPlaces(
            4, $sportVariants);
        self::assertCount(3, $variantsWithNrOfPlaces);
    }
}
