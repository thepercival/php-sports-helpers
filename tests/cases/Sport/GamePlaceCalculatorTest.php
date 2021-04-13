<?php

namespace SportsHelpers\Tests\Sport;

use PHPUnit\Framework\TestCase;
use SportsHelpers\GameMode;
use SportsHelpers\Sport\GamePlaceCalculator;
use SportsHelpers\Sport\GameAmountVariant as SportGameAmountVariant;

final class GamePlaceCalculatorTest extends TestCase
{
    public function testNrOfGamePlaces(): void
    {
        $sportConfigService = new GamePlaceCalculator();

        self::assertSame(3, $sportConfigService->getNrOfGamePlaces(2, true));
        self::assertSame(2, $sportConfigService->getNrOfGamePlaces(2, false));
    }

    public function testMaxNrOfGamePlaces(): void
    {
        $sport1 = new SportGameAmountVariant(GameMode::AGAINST, 2, 2, 1);
        $sport2 = new SportGameAmountVariant(GameMode::AGAINST, 3, 2, 1);

        $sportConfigService = new GamePlaceCalculator();
        self::assertSame(4, $sportConfigService->getMaxNrOfGamePlaces([$sport1,$sport2], true));
    }

    public function testNrGamesPerPlace(): void
    {
        $nrOfPlaces = 5;
        $totalNrOfGames = 0;

        $sport1 = new SportGameAmountVariant(GameMode::AGAINST, 2, 2, 1);
        $totalNrOfGames += $sport1->getNrOfGamesPerPlace($nrOfPlaces);

        $sport2 = new SportGameAmountVariant(GameMode::AGAINST, 3, 2, 1);
        $totalNrOfGames += $sport2->getNrOfGamesPerPlace($nrOfPlaces);

        $sportConfigService = new GamePlaceCalculator();
        self::assertSame($totalNrOfGames, $sportConfigService->getNrOfGamesPerPlace(
            $nrOfPlaces,
            [$sport1,$sport2]
        ));
    }
}
