<?php

declare(strict_types=1);

namespace SportsHelpers\Sports\Calculators;

use SportsHelpers\Sports\AgainstSport;
use SportsHelpers\Sports\TogetherSport;

class MinNrOfPlacesCalculator
{
    public const int MinNrOfPlacesPerPoule = 2;

    public function __construct()
    {
    }

    /**
     * @param list<TogetherSport|AgainstSport> $sports
     * @return int
     */
    public function calculateMinNrOfPlacesPerPoule(array $sports): int
    {
        if (count($sports) === 0) {
            return self::MinNrOfPlacesPerPoule;
        }
        $minimum = min(
            array_map(function (TogetherSport|AgainstSport $sport) {
                return $this->getMinNrOfPlacesPerPouleForSport($sport);
            }, $sports)
        );

        if ($minimum < self::MinNrOfPlacesPerPoule) {
            $minimum = self::MinNrOfPlacesPerPoule;
        }
        return $minimum;
    }

    protected function getMinNrOfPlacesPerPouleForSport(TogetherSport|AgainstSport $sport): int
    {
        return $sport->getNrOfGamePlaces() ?? self::MinNrOfPlacesPerPoule;
    }
}
