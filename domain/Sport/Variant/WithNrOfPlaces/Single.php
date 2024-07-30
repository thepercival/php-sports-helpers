<?php

declare(strict_types=1);

namespace SportsHelpers\Sport\Variant\WithNrOfPlaces;

use SportsHelpers\SelfReferee;
use SportsHelpers\SelfRefereeInfo;
use SportsHelpers\Sport\Variant\Single as SingleVariant;
use SportsHelpers\Sport\WithNrOfPlaces as SportVariantWithNrOfPlaces;

/**
 * @template-extends SportVariantWithNrOfPlaces<SingleVariant>
 */
class Single extends SportVariantWithNrOfPlaces
{
    public function __construct(int $nrOfPlaces, protected SingleVariant $sportVariant ) {
        parent::__construct($nrOfPlaces );
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

    public function canAllPlacesPlaySimultaneously(): bool
    {
        return $this->nrOfPlaces === $this->getNrOfGamePlacesSimultaneously();
    }

    public function getNrOfGamesSimultaneously(): int
    {
        return (int)ceil($this->getNrOfGamePlacesSimultaneously() / $this->sportVariant->getNrOfGamePlaces());
    }

    public function getNrOfGamePlacesPerBatch(): int
    {
        return (int)ceil($this->getTotalNrOfGamePlaces() / $this->getNrOfGamePlacesSimultaneously());
    }

    protected function getNrOfGamePlacesSimultaneously(): int
    {
        return $this->nrOfPlaces;
    }

    // SINGLE
//    public function getTotalNrOfGames(int $nrOfPlaces): int
//    {
//        return (int)ceil($this->getTotalNrOfGamePlaces($nrOfPlaces) / $this->getNrOfGamePlaces());
//    }
}
