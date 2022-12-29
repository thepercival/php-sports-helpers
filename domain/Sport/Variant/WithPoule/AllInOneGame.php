<?php

declare(strict_types=1);

namespace SportsHelpers\Sport\Variant\WithPoule;

use SportsHelpers\SelfReferee;
use SportsHelpers\Sport\Variant\AllInOneGame as AllInOneGameVariant;
use SportsHelpers\Sport\WithPoule as SportVariantWithPoule;

/**
 * @template-extends SportVariantWithPoule<AllInOneGameVariant>
 */
class AllInOneGame extends SportVariantWithPoule
{
    public function __construct(int $nrOfPlaces, protected AllInOneGameVariant $sportVariant ) {
        parent::__construct($nrOfPlaces);
    }

    public function getSportVariant(): AllInOneGameVariant {
        return $this->sportVariant;
    }

    public function getTotalNrOfGames(): int
    {
        return $this->sportVariant->getNrOfGamesPerPlace();
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

    protected function getNrOfGamePlacesSimultaneously(): int
    {
        return $this->nrOfPlaces;
    }

    public function getNrOfGamePlaces(): int
    {
        return $this->nrOfPlaces;
    }

//    public function canAllPlacesPlaySimultaneously(): bool
//    {
//        return $this->nrOfPlaces === $this->getNrOfGamePlacesSimultaneously();
//    }

    public function getNrOfGamesSimultaneously(): int
    {
        return (int)ceil($this->getNrOfGamePlacesSimultaneously() / $this->getNrOfGamePlaces());
    }

    public function getNrOfGameGroups(): int
    {
        return (int)ceil($this->getTotalNrOfGamePlaces() / $this->getNrOfGamePlacesSimultaneously());
    }

    public function getMaxNrOfGamesSimultaneously(SelfReferee $selfReferee): int {
        return 1;
    }

}
