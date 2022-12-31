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

    public function getNrOfPossibleAgainstCombinations(): int
    {
        return (new SportMath())->above($this->nrOfPlaces, 2);
    }

    public function getNrOfPossibleWithCombinations(Side|null $side = null): int
    {
        $combinations = 0;
        if( $side === null || $side === Side::Home) {
            $combinations += (new SportMath())->above($this->nrOfPlaces, $this->sportVariant->getNrOfHomePlaces());
        }
        if( $side === null && $this->sportVariant->getNrOfAwayPlaces() !== $this->sportVariant->getNrOfHomePlaces() ) {
            $combinations += (new SportMath())->above($this->nrOfPlaces, $this->sportVariant->getNrOfAwayPlaces());
        } else if( $side === Side::Away ) {
            $combinations += (new SportMath())->above($this->nrOfPlaces, $this->sportVariant->getNrOfAwayPlaces());
        }
        return $combinations;
    }

    public function allWithSameNrOfGamesAssignable(Side|null $side = null): bool
    {
        return (new EquallyAssignCalculator())->assignEqually(
            $this->getTotalNrOfGames(),
            $this->getNrOfPossibleWithCombinations($side),
            $this->sportVariant->getNrOfWithCombinationsPerGame($side)
        );
    }

    public function allAgainstSameNrOfGamesAssignable(): bool
    {
        return (new EquallyAssignCalculator())->assignEqually(
            $this->getTotalNrOfGames(),
            $this->getNrOfPossibleAgainstCombinations(),
            $this->sportVariant->getNrOfAgainstCombinationsPerGame()
        );
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