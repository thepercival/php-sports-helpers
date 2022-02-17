<?php

declare(strict_types=1);

namespace SportsHelpers\Sport;

use SportsHelpers\Sport\Variant as SportVariant;
use SportsHelpers\Sport\Variant\Against\GamesPerPlace as AgainstGpp;
use SportsHelpers\Sport\Variant\Against\H2h as AgainstH2h;
use SportsHelpers\Sport\Variant\AllInOneGame;
use SportsHelpers\Sport\Variant\Single;

class GamePlaceCalculator
{
    public function __construct()
    {
    }

//    /**
//     * @param list<Variant> $sportVariants
//     * @param bool $selfReferee
//     * @return int
//     */
    /*public function getMaxNrOfGamePlaces(array $sportVariants, bool $selfReferee): int
    {
        $maxNrOfGamePlaces = 0;
        foreach ($sportVariants as $sportVariant) {
            $nrOfGamePlaces = $this->getNrOfGamePlaces($sportVariant->getNrOfGamePlacesNew(), $selfReferee);
            if ($nrOfGamePlaces > $maxNrOfGamePlaces) {
                $maxNrOfGamePlaces = $nrOfGamePlaces;
            }
        }
        return $maxNrOfGamePlaces;
    }*/

    public function getNrOfGamePlaces(int $nrOfGamePlaces, bool $selfReferee): int
    {
        return $selfReferee ? $nrOfGamePlaces + 1 : $nrOfGamePlaces;
    }

    /**
     * @param int $nrOfPlaces
     * @param list<AllInOneGame|Single|AgainstH2h|AgainstGpp> $sportVariants
     * @return int
     */
    public function getMaxNrOfGamesPerPlace(int $nrOfPlaces, array $sportVariants): int
    {
        $nrOfGamesPerPlace = 0;
        foreach ($sportVariants as $sportVariant) {
            $sportVariantWithPoule = new VariantWithPoule($sportVariant, $nrOfPlaces);
            $nrOfGamesPerPlace += $sportVariantWithPoule->getTotalNrOfGamesPerPlace();
        }
        return $nrOfGamesPerPlace;
    }
}
