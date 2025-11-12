<?php
declare(strict_types = 1);

namespace SportsHelpers\Sport\Variant\WithPoule\Against;

use SportsHelpers\Against\Side;
use SportsHelpers\Sport\Variant\Against\GamesPerPlace as AgainstGpp;
use SportsHelpers\Sport\Variant\Against\H2h as AgainstH2h;
use SportsHelpers\Sport\Variant\WithPoule\Against as AgainstWithPoule;
use SportsHelpers\SportMath;

final class GamesPerPlace extends AgainstWithPoule
{
    public function __construct(int $nrOfPlaces, protected AgainstGpp $sportVariant)
    {
        parent::__construct($nrOfPlaces, $sportVariant);
    }

    #[\Override]
    public function getSportVariant(): AgainstGpp {
        return $this->sportVariant;
    }

    #[\Override]
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

    public function getNrOfAgainstDeficit(): int
    {
        $nrOfCombinations = $this->sportVariant->getNrOfAgainstCombinationsPerGame() * $this->getTotalNrOfGames();
        return (new EquallyAssignCalculator())->getNrOfDeficit(
            $nrOfCombinations,
            $this->getNrOfPossibleAgainstCombinations(),
        );
    }

    public function getNrOfWithDeficit(): int
    {
        $nrOfCombinations = $this->sportVariant->getNrOfWithCombinationsPerGame() * $this->getTotalNrOfGames();
        return (new EquallyAssignCalculator())->getNrOfDeficit(
            $nrOfCombinations,
            $this->getNrOfPossibleWithCombinations()
        );
    }

    public function getTotalNrOfGamePlaces(): int
    {
        return $this->getTotalNrOfGames() * $this->sportVariant->getNrOfGamePlaces();
    }

    public function getTotalNrOfSidePlaces(Side $side): int
    {
        return $this->getTotalNrOfGames() * $this->sportVariant->getNrOfSidePlaces($side);
    }

//    public function getTotalNrOfGamesPerPlace(): int
//    {
//        return $this->sportVariant->getNrOfGamesPerPlace();
//    }

    public function getNrOfGamePlacesPerBatch(): int
    {
        return (int)ceil($this->getTotalNrOfGamePlaces() / $this->getNrOfGamePlacesSimultaneously());
    }

    public function allPlacesSameNrOfGamesAssignable(): bool
    {
        return ($this->getTotalNrOfGamePlaces() % $this->nrOfPlaces) === 0;
    }

    public function allPlacesSameNrOfOfSidePlacesAssignable(Side $side): bool
    {
        return ($this->getTotalNrOfSidePlaces($side) % $this->nrOfPlaces) === 0;
    }

    public function getNrOfPossibleAgainstCombinations(int|null $nrOfPlaces = null): int
    {
        if( $nrOfPlaces === null ) {
            $nrOfPlaces = $this->nrOfPlaces;
        }
        return (new SportMath())->above($nrOfPlaces, 2);
    }

    public function allAgainstSameNrOfGamesAssignable(): bool
    {
        return $this->getNrOfAgainstDeficit() === 0;
    }

    public function allWithSameNrOfGamesAssignable(Side|null $side = null): bool
    {
        return (new EquallyAssignCalculator())->assignEqually(
            $this->getTotalNrOfGames(),
            $this->getNrOfPossibleWithCombinations($side),
            $this->sportVariant->getNrOfWithCombinationsPerGame($side)
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
        return (int)floor($this->getMinNrOfAgainstPlacesForPlace() / ((float)$this->getNrOfPlaces() - 1.0));
    }

    public function getMaxAgainstAmountPerPlace(): int
    {
        return (int)ceil($this->getMaxNrOfAgainstPlacesForPlace() / ((float)$this->getNrOfPlaces() - 1.0));
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