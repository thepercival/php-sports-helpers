<?php

declare(strict_types=1);

namespace oldsportshelpers\old;

use oldsportshelpers\old\Single as SingleVariant;
use oldsportshelpers\old\WithNrOfPlaces\SportWithNrOfPlaces;
use SportsHelpers\Sports\TogetherSport;

/**
 * @template-extends SportWithNrOfPlaces<TogetherSport>
 */
readonly class SingleSportWithNrOfPlaces extends SportWithNrOfPlaces
{
    public function __construct(int $nrOfPlaces, public SingleVariant $sportVariant ) {
        parent::__construct($nrOfPlaces );
    }

//    public function getSportVariant(): SingleVariant {
//        return $this->sportVariant;
//    }
//
//    public function getTotalNrOfGames(): int
//    {
//        $totalNrOfGames = $this->getTotalNrOfGamePlaces() / $this->sportVariant->nrOfGamePlaces;
//        return (int)ceil($totalNrOfGames);
//    }
//
//
//
//    public function getTotalNrOfGamesPerPlace(): int
//    {
//        return $this->sportVariant->nrOfGamesPerPlace;
//    }
//
////    public function canAllPlacesPlaySimultaneously(): bool
////    {
////        return true;
////    }
//
//    public function getMaxNrOfGamesSimultaneously(): int
//    {
//        return (int)ceil($this->nrOfPlaces / $this->sportVariant->nrOfGamePlaces);
//    }
//
//    public function getMaxNrOfGamePlacesSimultaneously(): int
//    {
//        $maxNrOfGamePlacesSimultaneously = $this->getMaxNrOfGamesSimultaneously() * $this->sportVariant->nrOfGamePlaces;
//        if( $maxNrOfGamePlacesSimultaneously > $this->nrOfPlaces ) {
//            return $this->nrOfPlaces;
//        }
//        return $maxNrOfGamePlacesSimultaneously;
//    }

    // SINGLE
//    public function getTotalNrOfGames(int $nrOfPlaces): int
//    {
//        return (int)ceil($this->getTotalNrOfGamePlaces($nrOfPlaces) / $this->getNrOfGamePlaces());
//    }
}
