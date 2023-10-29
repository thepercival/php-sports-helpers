<?php

declare(strict_types=1);

namespace SportsHelpers\Sport;

use SportsHelpers\Sport\Variant\WithPoule\AllInOneGame as AllInOneGameWithPoule;
use SportsHelpers\Sport\Variant\WithPoule\Single as SingleWithPoule;
use SportsHelpers\Sport\Variant\WithPoule\Against\GamesPerPlace as AgainstGppWithPoule;
use SportsHelpers\Sport\Variant\WithPoule\Against\H2h as AgainstH2hWithPoule;

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

//    public function getNrOfGamePlaces(int $nrOfGamePlaces, bool $selfReferee): int
//    {
//        return $selfReferee ? $nrOfGamePlaces + 1 : $nrOfGamePlaces;
//    }

}
