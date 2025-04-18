<?php

declare(strict_types=1);

namespace oldsportshelpers\old\WithNrOfPlaces;

use SportsHelpers\Sports\AgainstSportOneVsOne;
use SportsHelpers\Sports\AgainstSportOneVsTwo;
use SportsHelpers\Sports\AgainstSportTwoVsTwo;

readonly class AgainstSportOneVsTwoWithNrOfPlaces extends SportWithNrOfPlaces
{
     public function __construct(
         int $nrOfPlaces,
         public AgainstSportOneVsOne $sport) {
         if( $nrOfPlaces < $sport->getNrOfGamePlaces() ) {
             throw new \Exception('nrOfPlaces should be at least equal to nrOfGamePlaces');
         }
        parent::__construct($nrOfPlaces);
    }

    public function calcNrOfGamesPerCyclePart(): int {
        throw new \Exception('implement');
    }

    public function calcNrOfGamesPerCycle(): int {
        throw new \Exception('implement');
    }

//    public function calcTotalNrOfGames(int $nrOfCycles, int $nrOfCycleParts): int {
//        if( $nrOfCycleParts === 0 && $nrOfCycles === 0) {
//            throw new \Exception('there should be at least one cyclePart');
//        }
//        // 1 calculate nr of games per cycle part
//        // 2 getNrOfCycleParts
//        // 3 calculate nr of games per cycle
//        throw new \Exception('implement');
//
//        $nrOfCycles
////        $nrOfGamesPerCyclePart = $this->calcNrOfGamesPerCyclePart();
////        $maxNrOfCyclePartsPerCycle = $this->calculateMaxNrOfCyclePartsPerCycle();
////        if( $this->nrOfCycleParts > $this->calculateMaxNrOfCyclePartsPerCycle() ) {
////            throw new \Exception('there are too many parts');
////        }
////
////            $calcNrOfPartsPerCycle = 12;
////        if( $calcNrOfPartsPerCycle *
////
////        $totalNrOfGames = $nrOfGamesPerCycle * $this->nrOfCycles;
////        return $totalNrOfGames + ($this->calcNrOfGamesPerCyclePart() * $this->nrOfCycleParts);
//    }

//    private function getNrOfGamesPerCycle(): int
//    {
//        $nrOfCombinations = (new SportMath())->above($this->nrOfPlaces, $this->sport->getNrOfGamePlaces());
//        return (int)($nrOfCombinations * $this->sport->getNrOfHomeAwayCombinations());
//    }

//    public function getTotalNrOfGames(): int
//    {
//        return $this->getNrOfGamesPerCycle() * $this->againstVariant->nrOfCycles;
//    }
//
//    public function getTotalNrOfGamePlaces(): int
//    {
//        return $this->getTotalNrOfGames() * $this->againstVariant->getNrOfGamePlaces();
//    }
//
//    public function canGamePlacesBeEquallyAssignedOverPlaces(): bool {
//        return // bij onevsone=> als cycleparts > 0 // dan nrOfGmaesPerCycleP
//    }



//    public function getTotalNrOfGamesPerPlace(): int
//    {
//        return (int)($this->getNrOfGamesPerPlaceForSingleCycle() * $this->againstVariant->nrOfCycles);
//    }

//    public function getNrOfGamePlacesPerBatch(): int
//    {
//        return (int)ceil($this->getTotalNrOfGamePlaces() / $this->getNrOfGamePlacesSimultaneously());
//    }

//    public function canAllPlacesPlaySimultaneously(): bool
//    {
//        return $this->nrOfPlaces === $this->getMaxNrOfGamePlacesSimultaneously();
//    }
////
//    protected function getMaxNrOfGamePlacesSimultaneously(): int
//    {
//        return $this->nrOfPlaces - ($this->nrOfPlaces % $this->againstVariant->getNrOfGamePlaces());
//    }
//
//    public function getMaxNrOfGamesSimultaneously(): int
//    {
//        return (int)floor($this->nrOfPlaces / $this->againstVariant->getNrOfGamePlaces());
//    }

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
//    public function getNrOfGamesPerPlaceForSingleCycle(): int
//    {
////        if (!$this->isMixed()) {
////            return $nrOfPlaces - 1;
////        }
//        $nrOfGamesOneH2h = $this->getNrOfGamesPerCycle();
//
//        $onePlaceLess = new AgainstSportWithNrOfPlaces($this->nrOfPlaces - 1, $this->againstVariant);
//        $nrOfGamesOneH2hOneLess = $onePlaceLess->getNrOfGamesPerCycle();
//        return $nrOfGamesOneH2h - $nrOfGamesOneH2hOneLess;
//    }


}
