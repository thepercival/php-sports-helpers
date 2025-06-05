<?php

declare(strict_types=1);

namespace SportsHelpers\PouleStructures;

final readonly class BalancedCreator
{
    /**
     * nrOfPlaces = 11, nrOfPoules = 2 wordt [6,5]
     */
    public function createBalanced(int $nrOfPlaces, int $nrOfPoules): BalancedPouleStructure
    {
        $calculateNrOfPlacesPerPoule = function (int $nrOfPlaces, int $nrOfPoules): int {
            $nrOfPlaceLeft = ($nrOfPlaces % $nrOfPoules);
            if ($nrOfPlaceLeft === 0) {
                return (int)($nrOfPlaces / $nrOfPoules);
            }
            return (int)(($nrOfPlaces - $nrOfPlaceLeft) / $nrOfPoules);
        };
        if ($nrOfPoules < 1) {
            throw new \Exception('er moet minimaal 1 poule aanwezig zijn', E_ERROR);
        }
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
