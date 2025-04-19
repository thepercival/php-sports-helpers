<?php

declare(strict_types=1);

namespace oldsportshelpers\old\WithNrOfPlaces;

use SportsHelpers\Sports\TogetherSport;

readonly class TogetherSportWithNrOfPlaces extends SportWithNrOfPlaces
{
    public function __construct(int $nrOfPlaces, public TogetherSport $sport, public int $nrOfGamesPerPlace ) {
        parent::__construct($nrOfPlaces );
    }

    public function getNrOfGamePlaces(): int
    {
        return $this->sport->nrOfGamePlaces ?? $this->nrOfPlaces;
    }

    public function calcTotalNrOfGames(): int
    {
        return (int)ceil($this->calcTotalNrOfGamePlaces() / $this->getNrOfGamePlaces());
    }

    private function calcTotalNrOfGamePlaces(): int
    {
        return $this->nrOfGamesPerPlace * $this->nrOfPlaces;
    }

//    public function getTotalNrOfGamesPerPlace(): int
//    {
//        return $this->togetherSport->nrOfGamesPerPlace;
//    }

//    public function canAllPlacesPlaySimultaneously(): bool
//    {
//        return true;
//    }

//    public function getMaxNrOfGamesSimultaneously(): int
//    {
//        return (int)ceil($this->nrOfPlaces / $this->togetherSport->nrOfGamePlaces);
//    }
//
//    public function getMaxNrOfGamePlacesSimultaneously(): int
//    {
//        $maxNrOfGamePlacesSimultaneously = $this->getMaxNrOfGamesSimultaneously() * $this->togetherSport->nrOfGamePlaces;
//        if( $maxNrOfGamePlacesSimultaneously > $this->nrOfPlaces ) {
//            return $this->nrOfPlaces;
//        }
//        return $maxNrOfGamePlacesSimultaneously;
//    }

    // ALLINONEGAME PART : BEGIN //////////////////////////////////////////////


//    public function getTotalNrOfGamePlaces(): int
//    {
//        return (int)($this->sportVariant->nrOfCycles * $this->nrOfPlaces);
//    }
//
//    public function getTotalNrOfGamesPerPlace(): int
//    {
//        return $this->sportVariant->nrOfCycles;
//    }

//    public function getNrOfGamePlaces(): int
//    {
//        return $this->nrOfPlaces;
//    }
//
//    public function getNrOfGamesSimultaneously(): int
//    {
//        return 1;
//    }
    // ALLINONEGAME PART : END ///////////////////////////////////

    // SINGLE
//    public function getTotalNrOfGames(int $nrOfPlaces): int
//    {
//        return (int)ceil($this->getTotalNrOfGamePlaces($nrOfPlaces) / $this->getNrOfGamePlaces());
//    }
}
