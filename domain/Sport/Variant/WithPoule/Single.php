<?php

declare(strict_types=1);

namespace SportsHelpers\Sport\Variant\WithPoule;

use SportsHelpers\SelfReferee;
use SportsHelpers\Sport\Variant\Single as SingleVariant;
use SportsHelpers\Sport\WithPoule as SportVariantWithPoule;

/**
 * @template-extends SportVariantWithPoule<SingleVariant>
 */
class Single extends SportVariantWithPoule
{
    public function __construct(int $nrOfPlaces, protected SingleVariant $sportVariant ) {
        parent::__construct($nrOfPlaces, );
    }

    public function getSportVariant(): SingleVariant {
        return $this->sportVariant;
    }

    public function getTotalNrOfGames(): int
    {
        $totalNrOfGames = $this->getTotalNrOfGamePlaces() / $this->sportVariant->getNrOfGamePlaces();
        return (int)ceil($totalNrOfGames);
    }

    public function getTotalNrOfGamePlaces(): int
    {
        return (int)($this->sportVariant->getNrOfGamesPerPlace() * $this->nrOfPlaces);
    }

    public function getTotalNrOfGamesPerPlace(): int
    {
        return $this->sportVariant->getNrOfGamesPerPlace();
    }

//    public function canAllPlacesPlaySimultaneously(): bool
//    {
//        return $this->nrOfPlaces === $this->getNrOfGamePlacesSimultaneously();
//    }
//
    protected function getNrOfGamePlacesSimultaneously(): int
    {
        return $this->nrOfPlaces;
    }
//
//    public function getNrOfGamePlaces(): int
//    {
//        return $this->nrOfPlaces;
//    }

    public function canAllPlacesPlaySimultaneously(): bool
    {
        return $this->nrOfPlaces === $this->getNrOfGamePlacesSimultaneously();
    }

    public function getNrOfGamesSimultaneously(): int
    {
        return (int)ceil($this->getNrOfGamePlacesSimultaneously() / $this->sportVariant->getNrOfGamePlaces());
    }

    public function getNrOfGameGroups(): int
    {
        return (int)ceil($this->getTotalNrOfGamePlaces() / $this->getNrOfGamePlacesSimultaneously());
    }

    public function getMaxNrOfGamesSimultaneously(SelfReferee $selfReferee): int {
        $nrOfGamePlaces = $this->sportVariant->getNrOfGamePlaces();
        if ($selfReferee === SelfReferee::SamePoule) {
            $nrOfGamePlaces++;
        }
        $nrOfSimGames = (int)floor($this->getNrOfPlaces() / $nrOfGamePlaces);
        return $nrOfSimGames === 0 ? 1 : $nrOfSimGames;
    }



    // SINGLE
//    public function getTotalNrOfGames(int $nrOfPlaces): int
//    {
//        return (int)ceil($this->getTotalNrOfGamePlaces($nrOfPlaces) / $this->getNrOfGamePlaces());
//    }
}
