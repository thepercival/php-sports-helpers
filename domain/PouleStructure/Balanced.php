<?php

declare(strict_types=1);

namespace SportsHelpers\PouleStructure;

use SportsHelpers\PouleStructure;

class Balanced extends PouleStructure
{
    public function __construct(int $nrOfPlaces, int $nrOfPoules)
    {
        $poules = [];
        while ($nrOfPlaces > 0) {
            $nrOfPlacesToAdd = $this->getNrOfPlacesPerPouleHelper($nrOfPlaces, $nrOfPoules, false);
            $poules[] = $nrOfPlacesToAdd;
            $nrOfPlaces -= $nrOfPlacesToAdd;
            $nrOfPoules--;
        }
        parent::__construct(array_values($poules));
    }

    public function getRoundedNrOfPlacesPerPoule(bool $floor): int
    {
        return $this->getNrOfPlacesPerPouleHelper($this->getNrOfPlaces(), $this->getNrOfPoules(), $floor);
    }

    protected function getNrOfPlacesPerPouleHelper(int $nrOfPlaces, int $nrOfPoules, bool $floor): int
    {
        $nrOfPlaceLeft = ($nrOfPlaces % $nrOfPoules);
        if ($nrOfPlaceLeft === 0) {
            return (int)($nrOfPlaces / $nrOfPoules);
        }
        if ($floor) {
            return (int)floor((($nrOfPlaces - $nrOfPlaceLeft) / $nrOfPoules));
        }
        return (int)ceil((($nrOfPlaces + ($nrOfPoules - $nrOfPlaceLeft)) / $nrOfPoules));
    }
}
