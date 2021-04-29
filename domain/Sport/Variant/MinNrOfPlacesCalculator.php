<?php
declare(strict_types=1);

namespace SportsHelpers\Sport\Variant;

use SportsHelpers\PlaceRanges;
use SportsHelpers\Sport\Variant\Single as SingleSportVariant;
use SportsHelpers\Sport\Variant\Against as AgainstSportVariant;
use SportsHelpers\Sport\Variant\AllInOneGame as AllInOneGameSportVariant;

class MinNrOfPlacesCalculator
{
    public function __construct()
    {
    }

    /**
     * @param list<SingleSportVariant | AgainstSportVariant | AllInOneGameSportVariant> $sportVariants
     * @return int
     */
    public function getMinNrOfPlacesPerPoule(array $sportVariants): int
    {
        $max = 0;
        foreach ($sportVariants as $sportVariant) {
            $minNrOfPlacesPerPoule = $this->getMinNrOfPlacesPerPouleHelper($sportVariant);
            if ($minNrOfPlacesPerPoule > $max) {
                $max = $minNrOfPlacesPerPoule;
            }
        }
        return $max;
    }

    protected function getMinNrOfPlacesPerPouleHelper(SingleSportVariant | AgainstSportVariant | AllInOneGameSportVariant $sportVariant): int
    {
        if ($sportVariant instanceof AgainstSportVariant) {
            return $sportVariant->getNrOfGamePlaces();
        } elseif ($sportVariant instanceof SingleSportVariant) {
            return $sportVariant->getNrOfGamePlaces();
        }
        return PlaceRanges::MinNrOfPlacesPerPoule;
    }
}
