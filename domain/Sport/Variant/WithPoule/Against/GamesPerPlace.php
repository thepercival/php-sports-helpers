<?php
declare(strict_types = 1);

namespace SportsHelpers\Sport\Variant\WithPoule\Against;

use SportsHelpers\Against\Side;
use SportsHelpers\Sport\Variant\Against\GamesPerPlace as AgainstGpp;
use SportsHelpers\Sport\Variant\Against\H2h as AgainstH2h;
use SportsHelpers\Sport\Variant\WithPoule\Against as AgainstWithPoule;
use SportsHelpers\SportMath;

class GamesPerPlace extends AgainstWithPoule
{
    public function __construct(int $nrOfPlaces, protected AgainstGpp $sportVariant)
    {
        parent::__construct($nrOfPlaces, $sportVariant);
    }

    public function getSportVariant(): AgainstGpp {
        return $this->sportVariant;
    }

    public function getTotalNrOfGames(): int
    {
        $totalNrOfGamePlaces =  $this->nrOfPlaces * $this->sportVariant->getNrOfGamesPerPlace();
        $totalNrOfGames = $totalNrOfGamePlaces / $this->sportVariant->getNrOfGamePlaces();
        return (int)floor($totalNrOfGames);
    }

    public function getDeficit(): int
    {
        $totalNrOfGamePlaces =  $this->nrOfPlaces * $this->sportVariant->getNrOfGamesPerPlace();
        return $totalNrOfGamePlaces % $this->sportVariant->getNrOfGamePlaces();
    }

    public function getTotalNrOfGamePlaces(): int
    {
        return $this->getTotalNrOfGames() * $this->sportVariant->getNrOfGamePlaces();
    }

//    public function getTotalNrOfGamesPerPlace(): int
//    {
//        return $this->sportVariant->getNrOfGamesPerPlace();
//    }

    public function getNrOfGameGroups(): int
    {
        return (int)ceil($this->getTotalNrOfGamePlaces() / $this->getNrOfGamePlacesSimultaneously());
    }

    public function allPlacesSameNrOfGamesAssignable(): bool
    {
        return ($this->getTotalNrOfGamePlaces() % $this->nrOfPlaces) === 0;
    }

    public function getNrOfPossibleWithCombinations(): int
    {
        $math = new SportMath();
        $nrOfWithCombinationsHome = $math->above($this->nrOfPlaces, $this->sportVariant->getNrOfHomePlaces());
        if( $this->sportVariant->getNrOfHomePlaces() === $this->sportVariant->getNrOfAwayPlaces() ) {
            return $nrOfWithCombinationsHome;
        }
        $nrOfWithCombinationsAway = $math->above($this->nrOfPlaces, $this->sportVariant->getNrOfAwayPlaces());
        return $nrOfWithCombinationsHome + $nrOfWithCombinationsAway;
    }

    public function allWithSameNrOfGamesAssignable(Side|null $side = null): bool
    {
//        if (!$this->sportVariant->hasMultipleSidePlaces()) {
//            return true;
//        }
        $nrOfGames = $this->getTotalNrOfGames();
        $nrOfWithCombinationsPerGame = $this->sportVariant->getNrOfWithCombinationsPerGame($side);
        $nrOfWithCombinations = $nrOfWithCombinationsPerGame * $nrOfGames;

        return ($nrOfWithCombinations % $this->getNrOfPossibleWithCombinations()) === 0;
    }

    public function allAgainstSameNrOfGamesAssignable(): bool
    {
        if( !$this->sportVariant->hasMultipleSidePlaces()) {
            return true;
        }

        $totalNrOfGames = $this->getTotalNrOfGames();
        $nrOfAssignableCombinations = $this->getNrOfPossible1V1AgainstCombinations();
        $nrOfAgainstCombinationsPerGame = $this->sportVariant->getNrOfAgainstCombinationsPerGame();
        $nrOfAgainstCombinations = $nrOfAgainstCombinationsPerGame * $totalNrOfGames;
        return ($nrOfAgainstCombinations % $nrOfAssignableCombinations) === 0;
    }

    public function getNrOfPossible1V1AgainstCombinations(): int
    {
        return (new SportMath())->above($this->nrOfPlaces, 2);
    }

    public function getMinNrOfGamesPerPlace(): int {
        return $this->sportVariant->getNrOfGamesPerPlace() - ($this->getDeficit() ? 1 : 0);
    }

    public function getMaxNrOfGamesPerPlace(): int {
        return $this->sportVariant->getNrOfGamesPerPlace();
    }

    public function getMinAgainstAmountPerPlace(): int
    {
        return (int)floor($this->getMinNrOfAgainstPlacesForPlace() / ($this->getNrOfPlaces() - 1));
    }

    public function getMaxAgainstAmountPerPlace(): int
    {
        return (int)ceil($this->getMaxNrOfAgainstPlacesForPlace() / ($this->getNrOfPlaces() - 1));
    }

    public function getMinNrOfAgainstPlacesForPlace(): float
    {
        $minNrOfSidePlaces = min($this->sportVariant->getNrOfHomePlaces(), $this->sportVariant->getNrOfAwayPlaces());
        return $this->getMinNrOfGamesPerPlace() * $minNrOfSidePlaces;
    }

    public function getMaxNrOfAgainstPlacesForPlace(): float
    {
        $minNrOfSidePlaces = max($this->sportVariant->getNrOfHomePlaces(), $this->sportVariant->getNrOfAwayPlaces());
        return $this->getMaxNrOfGamesPerPlace() * $minNrOfSidePlaces;
    }
}