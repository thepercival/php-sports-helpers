<?php
declare(strict_types=1);

namespace SportsHelpers\Tests\Sport\Variant;

use PHPUnit\Framework\TestCase;
use SportsHelpers\GameMode;
use SportsHelpers\Sport\Variant\AllInOneGame as AllInOneGameSportVariant;

class AllInOneGameTest extends TestCase
{
    public function testCreation(): void
    {
        $sportVariant = new AllInOneGameSportVariant(1);
        self::assertSame(GameMode::ALL_IN_ONE_GAME, $sportVariant->getGameMode());
        self::assertSame(1, $sportVariant->getNrOfGames());
    }

    // 1,2  3,4     5,1     2,3     4,5     1,2     3,4     5,1     2,3     4,5     1,2     3,4     5
//    public function testGetNrOfNotAgainstGames(): void
//    {
//        $sportVariant = new AllInOneGameSportVariant(1);
//        self::assertSame(13, $sportVariant->getNrOfGames(5));
//    }
//
//    public function testGetNrOfNotAgainstGameRounds(): void
//    {
//        $sportVariant = new AllInOneGameSportVariant(2);
//        self::assertSame(5, $sportVariant->getNrOfGameRounds(3));
//    }
//
//    public function testNrOfGamesPerPlaceTogether(): void
//    {
//        $sportVariant = new AllInOneGameSportVariant(3);
//        self::assertSame(3, $sportVariant->getNrOfGamesPerPlace(5));
//    }
}
