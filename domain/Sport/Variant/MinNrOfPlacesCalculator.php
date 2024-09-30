<?php

declare(strict_types=1);

namespace SportsHelpers\Sport\Variant;

use SportsHelpers\SportVariants\AgainstOneVsOne;
use SportsHelpers\SportVariants\AgainstOneVsTwo;
use SportsHelpers\SportVariants\AgainstTwoVsTwo;
use SportsHelpers\SportVariants\AllInOneGame;
use SportsHelpers\SportVariants\Single;

class MinNrOfPlacesCalculator
{
    public const int MinNrOfPlacesPerPoule = 2;
    public function __construct()
    {
    }

    /**
     * @param list<Single | AgainstOneVsOne|AgainstOneVsTwo|AgainstTwoVsTwo | AllInOneGame> $sportVariants
     * @return int
     */
    public function getMinNrOfPlacesPerPoule(array $sportVariants): int
    {
        if (count($sportVariants) === 0) {
            return self::MinNrOfPlacesPerPoule;
        }
        $minimum = min(
            array_map(function (Single|AgainstOneVsOne|AgainstOneVsTwo|AgainstTwoVsTwo|AllInOneGame $sportVariant) {
                return $this->getMinNrOfPlacesPerPouleForSport($sportVariant);
            }, $sportVariants)
        );

        if ($minimum < self::MinNrOfPlacesPerPoule) {
            $minimum = self::MinNrOfPlacesPerPoule;
        }
        return $minimum;
    }

    protected function getMinNrOfPlacesPerPouleForSport(
        Single|AgainstOneVsOne|AgainstOneVsTwo|AgainstTwoVsTwo|AllInOneGame $sportVariant): int
    {
        if ($sportVariant instanceof AllInOneGame) {
            return self::MinNrOfPlacesPerPoule;
        }
        if ($sportVariant instanceof Single) {
            return $sportVariant->nrOfGamePlaces;
        }
        return $sportVariant->getNrOfGamePlaces();
    }
}
