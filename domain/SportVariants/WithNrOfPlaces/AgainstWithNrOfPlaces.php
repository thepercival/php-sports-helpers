<?php

declare(strict_types=1);

namespace SportsHelpers\SportVariants\WithNrOfPlaces;

use SportsHelpers\Against\AgainstSide;
use SportsHelpers\SportMath;
use SportsHelpers\SportVariants\AgainstOneVsOne;
use SportsHelpers\SportVariants\AgainstOneVsTwo;
use SportsHelpers\SportVariants\AgainstTwoVsTwo;

/**
 * @template-extends WithNrOfPlacesAbstract<AgainstOneVsOne|AgainstOneVsTwo|AgainstTwoVsTwo>
 */
readonly class AgainstWithNrOfPlaces extends WithNrOfPlacesAbstract
{
     public function __construct(int $nrOfPlaces, protected AgainstOneVsOne|AgainstOneVsTwo|AgainstTwoVsTwo $againstVariant ) {
         if( $nrOfPlaces < $againstVariant->getNrOfGamePlaces() ) {
             throw new \Exception('nrOfPlaces should be at least equal to nrOfGamePlaces');
         }
        parent::__construct($nrOfPlaces);
    }

    public function getSportVariant(): AgainstOneVsOne|AgainstOneVsTwo|AgainstTwoVsTwo {
        return $this->againstVariant;
    }

    public function getTotalNrOfGames(): int
    {
        return $this->againstVariant->getNrOfGamesForSingleCycle($this->nrOfPlaces) * $this->againstVariant->nrOfCycles;
    }

    public function getTotalNrOfGamePlaces(): int
    {
        return $this->getTotalNrOfGames() * $this->againstVariant->getNrOfGamePlaces();
    }

    public function getTotalNrOfGamesPerPlace(): int
    {
        return (int)($this->getNrOfGamesPerPlaceForSingleCycle() * $this->againstVariant->nrOfCycles);
    }

//    public function getNrOfGamePlacesPerBatch(): int
//    {
//        return (int)ceil($this->getTotalNrOfGamePlaces() / $this->getNrOfGamePlacesSimultaneously());
//    }

    public function canAllPlacesPlaySimultaneously(): bool
    {
        return $this->nrOfPlaces === $this->getMaxNrOfGamePlacesSimultaneously();
    }
//
    protected function getMaxNrOfGamePlacesSimultaneously(): int
    {
        return $this->nrOfPlaces - ($this->nrOfPlaces % $this->againstVariant->getNrOfGamePlaces());
    }

    public function getMaxNrOfGamesSimultaneously(): int
    {
        return (int)floor($this->nrOfPlaces / $this->againstVariant->getNrOfGamePlaces());
    }

//    public function getNrOfPossibleWithCombinations(AgainstSide|null $side = null): int
//    {
//        $combinations = 0;
//        // if( $this->againstVariant->nrOfHomePlaces > 1 ) {
//            if( $side === null || $side === AgainstSide::Home) {
//                $combinations += (new SportMath())->above($this->nrOfPlaces, $this->againstVariant->nrOfHomePlaces);
//            }
//        // }
//
//        // if( $this->againstVariant->nrOfAwayPlaces() > 1 ) {
//            if( $side === AgainstSide::Away || ($side === null
//                    && $this->againstVariant->nrOfHomePlaces !== $this->againstVariant->nrOfAwayPlaces)) {
//                $combinations += (new SportMath())->above($this->nrOfPlaces, $this->againstVariant->nrOfAwayPlaces);
//            }
//        // }
//
//        return $combinations;
//    }

//
//    protected function getMaxNrOfGamePlacesSimultaneously(int $nrOfPlaces): int
//    {
//        return $nrOfPlaces - ($nrOfPlaces % $this->getNrOfGamePlaces());
//    }
//
//    public function getNrOfGamesPerPlaceOneSerie(): int
//    {
//        return $this->getNrOfGamesPerPlaceForSingleCycle() * 2;
//    }
//
//    // 1vs1: 2=>1, 3=>2, 4=>3, 5=>4
//    // 1vs2: 3=>3, 4=>9(12-3), 5=>21(30-9)
    public function getNrOfGamesPerPlaceForSingleCycle(): int
    {
//        if (!$this->isMixed()) {
//            return $nrOfPlaces - 1;
//        }
        $nrOfGamesOneH2h = $this->againstVariant->getNrOfGamesForSingleCycle($this->nrOfPlaces);
        $nrOfGamesOneH2hOneLess = $this->againstVariant->getNrOfGamesForSingleCycle($this->nrOfPlaces - 1);
        return $nrOfGamesOneH2h - $nrOfGamesOneH2hOneLess;
    }


}
