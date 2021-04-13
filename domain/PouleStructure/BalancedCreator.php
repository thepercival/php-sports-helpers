<?php
declare(strict_types=1);

namespace SportsHelpers\PouleStructure;

use SportsHelpers\PouleStructure\Balanced as BalancedPouleStructure;

class BalancedCreator
{
    public function createBalanced(int $nrOfPlaces, int $nrOfPoules): BalancedPouleStructure
    {
        $calculateNrOfPlacesPerPoule = function (int $nrOfPlaces, int $nrOfPoules): int {
            $nrOfPlaceLeft = ($nrOfPlaces % $nrOfPoules);
            if ($nrOfPlaceLeft === 0) {
                return (int)($nrOfPlaces / $nrOfPoules);
            }
            return (int)(($nrOfPlaces - $nrOfPlaceLeft) / $nrOfPoules);
        };

        $innerData = [];
        while ($nrOfPlaces > 0) {
            $nrOfPlacesPerPoule = $calculateNrOfPlacesPerPoule($nrOfPlaces, $nrOfPoules--);
            $nrOfPlacesToAdd = $nrOfPlaces >= $nrOfPlacesPerPoule ? $nrOfPlacesPerPoule : $nrOfPlaces;
            array_push($innerData, $nrOfPlacesToAdd);
            $nrOfPlaces -= $nrOfPlacesPerPoule;
        }
        return new BalancedPouleStructure(...$innerData);
    }
}
