<?php
declare(strict_types=1);

namespace SportsHelpers\Sport;

class GamePlaceCalculator {

    public function __construct()
    {
    }

    /**
     * @param list<Variant> $sportVariants
     * @param bool $selfReferee
     * @return int
     */
    public function getMaxNrOfGamePlaces(array $sportVariants, bool $selfReferee): int
    {
        $maxNrOfGamePlaces = 0;
        foreach ($sportVariants as $sportVariant) {
            $nrOfGamePlaces = $this->getNrOfGamePlaces($sportVariant->getNrOfGamePlaces(), $selfReferee);
            if ($nrOfGamePlaces > $maxNrOfGamePlaces) {
                $maxNrOfGamePlaces = $nrOfGamePlaces;
            }
        }
        return $maxNrOfGamePlaces;
    }

    public function getNrOfGamePlaces(int $nrOfGamePlaces, bool $selfReferee): int
    {
        return $selfReferee ? $nrOfGamePlaces + 1 : $nrOfGamePlaces;
    }

    /**
     * @param int $nrOfPlaces
     * @param list<GameAmountVariant> $sportGameAmountVariants
     * @return int
     */
    public function getNrOfGamesPerPlace(int $nrOfPlaces, array $sportGameAmountVariants): int
    {
        $nrOfGamesPerPlace = 0;
        foreach ($sportGameAmountVariants as $sportGameAmountVariant) {
            $nrOfGamesPerPlace += $sportGameAmountVariant->getNrOfGamesPerPlace($nrOfPlaces);
        }
        return $nrOfGamesPerPlace;
    }
}
