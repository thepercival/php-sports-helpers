<?php

declare(strict_types=1);

namespace SportsHelpers\Sport\Variant;

final class MinNrOfPlacesCalculator
{
    public const MinNrOfPlacesPerPoule = 2;

    public function __construct()
    {
    }

    /**
     * @param list<Single | Against | AllInOneGame> $sportVariants
     * @return int
     */
    public function getMinNrOfPlacesPerPoule(array $sportVariants): int
    {
        if (count($sportVariants) === 0) {
            return self::MinNrOfPlacesPerPoule;
        }
        $minimum = min(
            array_map(function (Single|Against|AllInOneGame $sportVariant) {
                return $this->getMinNrOfPlacesPerPouleForSport($sportVariant);
            }, $sportVariants)
        );

        if ($minimum < self::MinNrOfPlacesPerPoule) {
            $minimum = self::MinNrOfPlacesPerPoule;
        }
        return $minimum;
    }

    protected function getMinNrOfPlacesPerPouleForSport(Single|Against|AllInOneGame $sportVariant): int
    {
        if ($sportVariant instanceof AllInOneGame) {
            return self::MinNrOfPlacesPerPoule;
        }
        return $sportVariant->getNrOfGamePlaces();
    }
}
