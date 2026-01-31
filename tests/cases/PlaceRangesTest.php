<?php

declare(strict_types=1);

namespace SportsHelpers\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use SportsHelpers\PlaceRanges;
use SportsHelpers\PouleStructures\BalancedPouleStructure as BalancedPouleStructure;
use SportsHelpers\Sports\AgainstOneVsOne;
use SportsHelpers\Sports\AgainstTwoVsTwo;
use SportsHelpers\Sports\Calculators\MinNrOfPlacesCalculator;
use SportsHelpers\Sports\TogetherSport;

final class PlaceRangesTest extends TestCase
{
    public function testSingleSportNrOfGamePlacesValid(): void
    {
        $nrOfGamePlaces = 3;
        $togetherSports = [new TogetherSport($nrOfGamePlaces)]; // 3

        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->calculateMinNrOfPlacesPerPoule($togetherSports);
        $maxNrOfPlacesPerPoule = 2;
        $minNrOfPlacesPerRound = $minNrOfPlacesPerPoule;
        $maxNrOfPlacesPerRound = 3;
        $placeRanges = new PlaceRanges(
            $minNrOfPlacesPerPoule,
            $maxNrOfPlacesPerPoule,
            null,
            $minNrOfPlacesPerRound,
            $maxNrOfPlacesPerRound,
            null
        );
        $structure = new BalancedPouleStructure(3);
        self::assertTrue($placeRanges->validate($structure->getNrOfPlaces(), $structure->getNrOfPoules()));
    }

    public function testSingleSportNrOfGamePlacesInvalid(): void
    {
        $nrOfGamePlaces = 3;
        $togetherSports = [new TogetherSport($nrOfGamePlaces)]; // 1

        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->calculateMinNrOfPlacesPerPoule($togetherSports);
        $maxNrOfPlacesPerPoule = 2;
        $minNrOfPlacesPerRound = $minNrOfPlacesPerPoule;
        $maxNrOfPlacesPerRound = 2;
        $placeRanges = new PlaceRanges(
            $minNrOfPlacesPerPoule,
            $maxNrOfPlacesPerPoule,
            null,
            $minNrOfPlacesPerRound,
            $maxNrOfPlacesPerRound,
            null
        );

        $structure = new BalancedPouleStructure(2);
        self::expectException(Exception::class);
        $placeRanges->validate($structure->getNrOfPlaces(), $structure->getNrOfPoules());
    }

    public function testAgainsteSportNrOfGamePlacesValid2(): void
    {
        $againstSportVariant = new AgainstOneVsOne();

        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->calculateMinNrOfPlacesPerPoule([$againstSportVariant]);
        $maxNrOfPlacesPerPoule = 2;
        $minNrOfPlacesPerRound = $minNrOfPlacesPerPoule;
        $maxNrOfPlacesPerRound = 4;
        $placeRanges = new PlaceRanges(
            $minNrOfPlacesPerPoule,
            $maxNrOfPlacesPerPoule,
            null,
            $minNrOfPlacesPerRound,
            $maxNrOfPlacesPerRound,
            null
        );

        $structure = new BalancedPouleStructure(2, 2);
        self::assertTrue($placeRanges->validate($structure->getNrOfPlaces(), $structure->getNrOfPoules()));
    }

    public function testAgainsteSportNrOfGamePlacesInvalid(): void
    {
        $againstSportVariant = new AgainstTwoVsTwo();

        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->calculateMinNrOfPlacesPerPoule([$againstSportVariant]);
        $maxNrOfPlacesPerPoule = 3;
        $minNrOfPlacesPerRound = $minNrOfPlacesPerPoule;
        $maxNrOfPlacesPerRound = 10;
        $placeRanges = new PlaceRanges(
            $minNrOfPlacesPerPoule,
            $maxNrOfPlacesPerPoule,
            null,
            $minNrOfPlacesPerRound,
            $maxNrOfPlacesPerRound,
            null
        );

        $structure = new BalancedPouleStructure(3);
        self::expectException(Exception::class);
        $placeRanges->validate($structure->getNrOfPlaces(), $structure->getNrOfPoules());
    }

    public function testAgainsteSportNrOfGamePlacesValid(): void
    {
        $againstSportVariant = new AgainstTwoVsTwo();

        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->calculateMinNrOfPlacesPerPoule([$againstSportVariant]);
        $maxNrOfPlacesPerPoule = 4;
        $minNrOfPlacesPerRound = $minNrOfPlacesPerPoule;
        $maxNrOfPlacesPerRound = 10;
        $placeRanges = new PlaceRanges(
            $minNrOfPlacesPerPoule,
            $maxNrOfPlacesPerPoule,
            null,
            $minNrOfPlacesPerRound,
            $maxNrOfPlacesPerRound,
            null
        );
        $structure = new BalancedPouleStructure(4);
        self::assertTrue($placeRanges->validate($structure->getNrOfPlaces(), $structure->getNrOfPoules()));
    }

    public function testAllInOneGameNrOfGamePlacesValid(): void
    {
        $togetherSports = [new TogetherSport(null)];

        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->calculateMinNrOfPlacesPerPoule($togetherSports);
        $maxNrOfPlacesPerPoule = 2;
        $minNrOfPlacesPerRound = $minNrOfPlacesPerPoule;
        $maxNrOfPlacesPerRound = 10;
        $placeRanges = new PlaceRanges(
            $minNrOfPlacesPerPoule,
            $maxNrOfPlacesPerPoule,
            null,
            $minNrOfPlacesPerRound,
            $maxNrOfPlacesPerRound,
            null
        );
        $structure = new BalancedPouleStructure(2);
        self::assertTrue($placeRanges->validate($structure->getNrOfPlaces(), $structure->getNrOfPoules()));
    }

    public function testMinNrOfPlacesPerPouleInvalid(): void
    {
        $togetherSports = [new TogetherSport(null)];

        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->calculateMinNrOfPlacesPerPoule($togetherSports);
        $maxNrOfPlacesPerPoule = 1;
        $minNrOfPlacesPerRound = $minNrOfPlacesPerPoule;
        $maxNrOfPlacesPerRound = 10;
        $placeRanges = new PlaceRanges(
            $minNrOfPlacesPerPoule,
            $maxNrOfPlacesPerPoule,
            null,
            $minNrOfPlacesPerRound,
            $maxNrOfPlacesPerRound,
            null
        );
        $structure = new BalancedPouleStructure(1);
        self::expectException(Exception::class);
        $placeRanges->validate($structure->getNrOfPlaces(), $structure->getNrOfPoules());
    }

    public function testLargePerPouleRoundValid(): void
    {
        $togetherSports = [new TogetherSport(null)];

        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->calculateMinNrOfPlacesPerPoule($togetherSports);
        $maxNrOfPlacesPerPoule = 5;
        $minNrOfPlacesPerRound = $minNrOfPlacesPerPoule;
        $maxNrOfPlacesPerRound = 10;
        $placeRanges = new PlaceRanges(
            $minNrOfPlacesPerPoule,
            $maxNrOfPlacesPerPoule,
            5,
            $minNrOfPlacesPerRound,
            $maxNrOfPlacesPerRound,
            20
        );

        $structure = new BalancedPouleStructure(5, 5, 5);
        self::assertTrue($placeRanges->validate($structure->getNrOfPlaces(), $structure->getNrOfPoules()));
    }

    public function testLargePerPouleInvalid(): void
    {
        $togetherSports = [new TogetherSport(null)];

        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->calculateMinNrOfPlacesPerPoule($togetherSports);
        $maxNrOfPlacesPerPoule = 5;
        $minNrOfPlacesPerRound = $minNrOfPlacesPerPoule;
        $maxNrOfPlacesPerRound = 10;
        $placeRanges = new PlaceRanges(
            $minNrOfPlacesPerPoule,
            $maxNrOfPlacesPerPoule,
            5,
            $minNrOfPlacesPerRound,
            $maxNrOfPlacesPerRound,
            20
        );

        $structure = new BalancedPouleStructure(6, 6, 6);
        self::expectException(Exception::class);
        $placeRanges->validate($structure->getNrOfPlaces(), $structure->getNrOfPoules());
    }

    public function testLargePerRoundInvalid(): void
    {
        $allInOneGameSportVariant = new TogetherSport(1);

        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->calculateMinNrOfPlacesPerPoule([$allInOneGameSportVariant]);
        $maxNrOfPlacesPerPoule = 5;
        $minNrOfPlacesPerRound = $minNrOfPlacesPerPoule;
        $maxNrOfPlacesPerRound = 10;
        $placeRanges = new PlaceRanges(
            $minNrOfPlacesPerPoule,
            $maxNrOfPlacesPerPoule,
            5,
            $minNrOfPlacesPerRound,
            $maxNrOfPlacesPerRound,
            20
        );

        $structure = new BalancedPouleStructure(5, 5, 5, 5, 5);
        self::expectException(Exception::class);
        $placeRanges->validateStructure($structure);
    }
}
