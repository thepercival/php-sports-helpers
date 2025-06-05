<?php

declare(strict_types=1);

namespace SportsHelpers\Sports\Calculators;

use SportsHelpers\Sports\AgainstOneVsOne;
use SportsHelpers\Sports\AgainstOneVsTwo;
use SportsHelpers\Sports\AgainstTwoVsTwo;
use SportsHelpers\Sports\TogetherSport;

final class MinNrOfPlacesCalculator
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
                return $sport->getNrOfGamePlaces() ?? 1;
            }, $sports)
        );

        if ($minimum < self::MinNrOfPlacesPerPoule) {
            $minimum = self::MinNrOfPlacesPerPoule;
        }
        return $minimum;
    }
}
