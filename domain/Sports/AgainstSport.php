<?php

declare(strict_types=1);

namespace SportsHelpers\Sports;

use SportsHelpers\Against\AgainstSide;
use SportsHelpers\SportMath;
//use SportsHelpers\Sports\Old\GameMode;
//use SportsHelpers\Sports\Old\SportVariant;

// gebruik bij 1 vs 1: Opgegeven in H2h(3 en 2 even vaak tegen elkaar)
// gebruik bij Mixed: NrOfGamesPerPlace(3 en 2 even veel wedstrijden)
readonly abstract class AgainstSport
{
    public function __construct(public int $nrOfHomePlaces, public int $nrOfAwayPlaces)
    {
    }

//    public function getGameMode(): GameMode {
//        return GameMode::Against;
//    }

    public function getNrOfSidePlaces(AgainstSide $side): int
    {
        return $side === AgainstSide::Home ? $this->nrOfHomePlaces : $this->nrOfAwayPlaces;
    }

    public function getNrOfGamePlaces(): int
    {
        return $this->nrOfHomePlaces + $this->nrOfAwayPlaces;
    }

    public function hasMultipleSidePlaces(): bool
    {
        return $this->getNrOfGamePlaces() > 2;
    }

//    public function getNrOfWithCombinationsPerGame(Side|null $side = null): int {
////        $nrOfHomeWithCombinations = $this->nrOfHomePlaces > 1 ? 1 : 0;
////        $nrOfAwayWithCombinations = $this->nrOfAwayPlaces() > 1 ? 1 : 0;
//        if( $side === Side::Home) {
//            return 1;
//        } else if( $side === Side::Away) {
//            return 1;
//        }
//        return 2;
//    }

    /**
     * 2 gameplaces => 1 : 1 vs 2
     * 4 gameplaces => 3 : 1 2 vs 3 4, 1 3 vs 2 4, 1 4 vs 2 3
     * 6 gameplaces => 10 :  1 2 3 vs 4 5 6, 1 2 4 vs 3 5 6, 1 2 5 vs 3 5 6 ..
     *
     * @return int
     */
    public function getNrOfHomeAwayCombinations(): int
    {
        if ($this->nrOfHomePlaces !== $this->nrOfAwayPlaces) {
            return (new SportMath())->above($this->getNrOfGamePlaces(), $this->nrOfHomePlaces)
                * (new SportMath())->above($this->getNrOfGamePlaces() - $this->nrOfHomePlaces, $this->nrOfAwayPlaces);
        }
        $nrOfSides = 2;
        $nrOfFormations = (new SportMath())->above($this->getNrOfGamePlaces(), $this->nrOfHomePlaces);
        return (int)($nrOfFormations / $nrOfSides); // remove symetric
    }

//    public function toPersistVariant(): SportPersistVariant
//    {
//        return new SportPersistVariant(
//            $this->getGameMode(),
//            $this->nrOfHomePlaces,
//            $this->nrOfAwayPlaces,
//            0,
//            $this->nrOfCycles,
//            $this->nrOfCycleParts
//        );
//    }
//
//    public function __toString()
//    {
//        return 'against(' . $this->nrOfHomePlaces . 'vs' . $this->nrOfAwayPlaces . ')' . ' nrOfCycles=>' . $this->nrOfCycles . ',' . $this->nrOfCycleParts;
//    }
}
