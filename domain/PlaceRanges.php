<?php
declare(strict_types=1);

namespace SportsHelpers;

use Exception;
use SportsHelpers\SportRange;
use SportsHelpers\PouleStructure\Balanced as BalancedPouleStructure;
use SportsHelpers\PouleStructure\BalancedCreator as BalancedPouleStructureCreator;

class PlaceRanges
{
    public const MinNrOfPlacesPerPoule = 2;
    private SportRange $placesPerPouleSmall;
    private SportRange $placesPerRoundSmall;
    private int $nrOfPlacesSmallLargeBorder;
    private SportRange|null $placesPerPouleLarge = null;
    private SportRange|null $placesPerRoundLarge = null;
    // private minNrOfPlacesPerPoule: number;
    // private minNrOfPlacesPerRound: number;

    public function __construct(
        int $minNrOfPlacesPerPoule,
        int $maxNrOfPlacesPerPouleSmall,
        int|null $maxNrOfPlacesPerPouleLarge,
        int $minNrOfPlacesPerRound,
        int $maxNrOfPlacesPerRoundSmall,
        int|null $maxNrOfPlacesPerRoundLarge
    ) {
        $this->placesPerPouleSmall = $this->initRange($minNrOfPlacesPerPoule, $maxNrOfPlacesPerPouleSmall);
        $this->placesPerRoundSmall = $this->initRange($minNrOfPlacesPerRound, $maxNrOfPlacesPerRoundSmall);
        $this->nrOfPlacesSmallLargeBorder = $maxNrOfPlacesPerRoundSmall;
        if ($maxNrOfPlacesPerPouleLarge !== null) {
            $this->placesPerPouleLarge = $this->initRange($minNrOfPlacesPerPoule, $maxNrOfPlacesPerPouleLarge);
            if ($maxNrOfPlacesPerRoundLarge !== null) {
                $this->placesPerRoundLarge = $this->initRange($minNrOfPlacesPerRound, $maxNrOfPlacesPerRoundLarge);
            }
        }
    }

    protected function initRange(int $min, int $max): SportRange
    {
        return new SportRange($min, $max >= $min ? $max : $min);
    }

    public function getPlacesPerPouleSmall(): SportRange
    {
        return $this->placesPerPouleSmall;
    }

    public function validateStructure(BalancedPouleStructure $structure): void
    {
        $this->validate($structure->getNrOfPlaces(), $structure->getNrOfPoules());
    }

    public function validate(int $nrOfPlaces, int $nrOfPoules): bool
    {
        $placesPerRound = $this->getValidPlacesPerRound($nrOfPlaces);
        if ($placesPerRound === null || $nrOfPlaces < $placesPerRound->getMin()) {
            $suffix = $placesPerRound !== null ? '('.$placesPerRound->getMin().')' : '';
            throw new Exception('het aantal deelnemers per ronde('.$nrOfPlaces.') is kleiner dan het minimum' . $suffix, E_ERROR);
        }
        if ($nrOfPlaces > $placesPerRound->getMax()) {
            throw new Exception('het aantal deelnemers per ronde('.$nrOfPlaces.') is groter dan het maximum('.$placesPerRound->getMax().')', E_ERROR);
        }

        $creator = new BalancedPouleStructureCreator();
        $pouleStructure = $creator->createBalanced($nrOfPlaces, $nrOfPoules);
        $smallest = $pouleStructure->getSmallestPoule();
        $biggest = $pouleStructure->getBiggestPoule();

        $placesPerPoule = $this->getValidPlacesPerPoule($nrOfPlaces);
        if ($placesPerPoule === null || $smallest < $placesPerPoule->getMin()) {
            $suffix = $placesPerPoule !== null ? '('.$placesPerPoule->getMin().')' : '';
            throw new Exception('het aantal deelnemers per poule('.$smallest.') is kleiner dan het minimum'.$suffix, E_ERROR);
        }
        if ($biggest > $placesPerPoule->getMax()) {
            throw new Exception('het aantal deelnemers per poule('.$biggest.') is groter dan het maximum('.$placesPerPoule->getMax().')', E_ERROR);
        }
        return true;
    }


    protected function getValidPlacesPerRound(int $nrOfPlaces): SportRange | null
    {
        if ($nrOfPlaces <= $this->nrOfPlacesSmallLargeBorder) {
            return $this->placesPerRoundSmall;
        }
        return $this->placesPerRoundLarge;
    }

    protected function getValidPlacesPerPoule(int $nrOfPlaces): SportRange | null
    {
        if ($nrOfPlaces <= $this->nrOfPlacesSmallLargeBorder) {
            return $this->placesPerPouleSmall;
        }
        return $this->placesPerPouleLarge;
    }
}
