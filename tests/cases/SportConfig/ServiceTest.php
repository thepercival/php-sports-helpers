<?php

namespace SportsHelpers\Tests\SportConfig;

use PHPUnit\Framework\TestCase;
use SportsHelpers\GameMode;
use SportsHelpers\SportConfig;
use SportsHelpers\SportConfig\Service as SportConfigService;

final class ServiceTest extends TestCase
{
    public function testNrOfGamePlaces(): void
    {
        $sportConfigService = new SportConfigService();

        self::assertSame(3, $sportConfigService->getNrOfGamePlaces(2, true));
        self::assertSame(2, $sportConfigService->getNrOfGamePlaces(2, false));
    }

    public function testMaxNrOfGamePlaces(): void
    {
        $sportConfig1 = new SportConfig(GameMode::AGAINST, 2, 2, 1);
        $sportConfig2 = new SportConfig(GameMode::AGAINST, 3, 2, 1);

        $sportConfigService = new SportConfigService();
        self::assertSame(4, $sportConfigService->getMaxNrOfGamePlaces([$sportConfig1,$sportConfig2], true));
    }

    public function testNrGamesPerPlace(): void
    {
        $nrOfPlaces = 5;
        $totalNrOfGames = 0;

        $sportConfig1 = new SportConfig(GameMode::AGAINST, 2, 2, 1);
        $totalNrOfGames += $sportConfig1->getNrOfGamesPerPlace($nrOfPlaces);

        $sportConfig2 = new SportConfig(GameMode::AGAINST, 3, 2, 1);
        $totalNrOfGames += $sportConfig2->getNrOfGamesPerPlace($nrOfPlaces);

        $sportConfigService = new SportConfigService();
        self::assertSame($totalNrOfGames, $sportConfigService->getNrOfGamesPerPlace(
            $nrOfPlaces,
            [$sportConfig1,$sportConfig2]
        ));
    }
}
