<?php

namespace SportsHelpers\Tests\SportConfig;

use PHPUnit\Framework\TestCase;
use SportsHelpers\GameMode;
use SportsHelpers\SportBase;
use SportsHelpers\SportConfig;
use SportsHelpers\SportConfig\Service as SportConfigService;

class ServiceTest extends TestCase
{
    public function testNrOfGamePlaces()
    {
        $sportConfigService = new SportConfigService();

        self::assertSame(3, $sportConfigService->getNrOfGamePlaces(2, true));
        self::assertSame(2, $sportConfigService->getNrOfGamePlaces(2, false));
    }

    public function testMaxNrOfGamePlaces()
    {
        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 2);
        $gameAmount = 1;

        $sportConfig1 = new SportConfig($sport, $nrOfFields, $gameAmount);

        $nrOfFields2 = 2;
        $sport2 = new SportBase(GameMode::AGAINST, 3);
        $gameAmount2 = 1;
        $sportConfig2 = new SportConfig($sport2, $nrOfFields2, $gameAmount2);

        $sportConfigService = new SportConfigService();
        self::assertSame(4, $sportConfigService->getMaxNrOfGamePlaces([$sportConfig1,$sportConfig2], true));
    }

    public function testNrGamesPerPlace()
    {
        $nrOfPlaces = 5;
        $totalNrOfGames = 0;

        $nrOfFields = 2;
        $sport = new SportBase(GameMode::AGAINST, 2);
        $gameAmount = 1;

        $sportConfig1 = new SportConfig($sport, $nrOfFields, $gameAmount);
        $totalNrOfGames += $sportConfig1->getNrOfGamesPerPlace($nrOfPlaces);

        $nrOfFields2 = 2;
        $sport2 = new SportBase(GameMode::AGAINST, 3);
        $gameAmount2 = 1;
        $sportConfig2 = new SportConfig($sport2, $nrOfFields2, $gameAmount2);
        $totalNrOfGames += $sportConfig2->getNrOfGamesPerPlace($nrOfPlaces);

        $sportConfigService = new SportConfigService();
        self::assertSame($totalNrOfGames, $sportConfigService->getNrOfGamesPerPlace(
            $nrOfPlaces,
            [$sportConfig1,$sportConfig2]
        ));
    }
}
