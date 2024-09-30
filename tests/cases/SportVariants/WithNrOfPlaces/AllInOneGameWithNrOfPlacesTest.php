<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\SportVariants\WithNrOfPlaces;

use PHPUnit\Framework\TestCase;
use SportsHelpers\GameMode;
use SportsHelpers\SportVariants\AgainstOneVsOne;
use SportsHelpers\SportVariants\AllInOneGame;
use SportsHelpers\SportVariants\Single;
use SportsHelpers\SportVariants\WithNrOfPlaces\AgainstWithNrOfPlaces;
use SportsHelpers\SportVariants\WithNrOfPlaces\AllInOneGameWithNrOfPlaces;

class AllInOneGameWithNrOfPlacesTest extends TestCase
{
    public function testGameMode(): void
    {
        $allInOneGame = new AllInOneGame( 1);
        self::assertSame(GameMode::AllInOneGame, $allInOneGame->getGameMode());
    }

    public function testGetSportVariant(): void
    {
        $allInOneGame = new AllInOneGame(1);
        $allInOneGameWithNrOfPlaces = new AllInOneGameWithNrOfPlaces(4, $allInOneGame);
        self::assertSame($allInOneGame, $allInOneGameWithNrOfPlaces->getSportVariant());
    }
}
