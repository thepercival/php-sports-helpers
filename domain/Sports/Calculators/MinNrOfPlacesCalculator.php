<?php

declare(strict_types=1);

namespace SportsHelpers\Sports\Calculators;

use SportsHelpers\Sports\AgainstOneVsOne;
use SportsHelpers\Sports\AgainstOneVsTwo;
use SportsHelpers\Sports\AgainstSport;
use SportsHelpers\Sports\AgainstTwoVsTwo;
use SportsHelpers\Sports\TogetherSport;

class MinNrOfPlacesCalculator
{
    public const int MinNrOfPlacesPerPoule = 2;

    public function __construct()
    {
    }

    /**
     * @param list<TogetherSport|AgainstOneVsOne|AgainstOneVsTwo|AgainstTwoVsTwo> $sports
     * @return int
     */
    public function calculateMinNrOfPlacesPerPoule(array $sports): int
    {
        if (count($sports) === 0) {
            return self::MinNrOfPlacesPerPoule;
        }
        $minimum = min(
            array_map(function (TogetherSport|AgainstOneVsOne|AgainstOneVsTwo|AgainstTwoVsTwo $sport) {
                return $this->getMinNrOfPlacesPerPouleForSport($sport);
            }, $sports)
        );

        if ($minimum < self::MinNrOfPlacesPerPoule) {
            $minimum = self::MinNrOfPlacesPerPoule;
        }
        return $minimum;
    }

    protected function getMinNrOfPlacesPerPouleForSport(TogetherSport|AgainstOneVsOne|AgainstOneVsTwo|AgainstTwoVsTwo $sport): int
    {
        return $sport->nrOfGamePlaces ?? self::MinNrOfPlacesPerPoule;
    }
}
