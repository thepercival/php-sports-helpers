<?php

declare(strict_types=1);

namespace SportsHelpers\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use SportsHelpers\PlaceRanges;
use SportsHelpers\PouleStructure\Balanced as BalancedPouleStructure;
use SportsHelpers\Sport\Variant\MinNrOfPlacesCalculator;
use SportsHelpers\SportVariants\AllInOneGame as AllInOneGameSportVariant;
use SportsHelpers\SportVariants\AgainstGpp;
use SportsHelpers\SportVariants\AgainstH2h;
use SportsHelpers\SportVariants\Single as SingleSportVariant;

final class PlaceRangesTest extends TestCase
{
    public function testSingleSportNrOfGamePlacesValid(): void
    {
        $nrOfGamePlaces = 3;
        $singleSportVariant = new SingleSportVariant($nrOfGamePlaces, 3);

        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->getMinNrOfPlacesPerPoule([$singleSportVariant]);
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
        $singleSportVariant = new SingleSportVariant($nrOfGamePlaces, 1);

        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->getMinNrOfPlacesPerPoule([$singleSportVariant]);
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
        $nrOfSidePlaces = 1;
        $againstSportVariant = new AgainstH2h($nrOfSidePlaces, $nrOfSidePlaces, 1);

        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->getMinNrOfPlacesPerPoule([$againstSportVariant]);
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
        $nrOfSidePlaces = 2;
        $againstSportVariant = new AgainstGpp($nrOfSidePlaces, $nrOfSidePlaces, 1);

        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->getMinNrOfPlacesPerPoule([$againstSportVariant]);
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
        $nrOfSidePlaces = 2;
        $againstSportVariant = new AgainstGpp($nrOfSidePlaces, $nrOfSidePlaces, 1);

        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->getMinNrOfPlacesPerPoule([$againstSportVariant]);
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
        $allInOneGameSportVariant = new AllInOneGameSportVariant(1);

        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->getMinNrOfPlacesPerPoule([$allInOneGameSportVariant]);
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
        $allInOneGameSportVariant = new AllInOneGameSportVariant(1);

        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->getMinNrOfPlacesPerPoule([$allInOneGameSportVariant]);
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
        $allInOneGameSportVariant = new AllInOneGameSportVariant(1);

        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->getMinNrOfPlacesPerPoule([$allInOneGameSportVariant]);
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
        $allInOneGameSportVariant = new AllInOneGameSportVariant(1);

        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->getMinNrOfPlacesPerPoule([$allInOneGameSportVariant]);
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
        $allInOneGameSportVariant = new AllInOneGameSportVariant(1);

        $minNrOfPlacesPerPoule = (new MinNrOfPlacesCalculator())->getMinNrOfPlacesPerPoule([$allInOneGameSportVariant]);
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
        $placeRanges->validate($structure->getNrOfPlaces(), $structure->getNrOfPoules());
    }
}
