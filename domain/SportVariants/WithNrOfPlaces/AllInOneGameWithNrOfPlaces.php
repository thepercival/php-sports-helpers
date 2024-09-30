<?php

declare(strict_types=1);

namespace SportsHelpers\SportVariants\WithNrOfPlaces;

use SportsHelpers\SportVariants\AllInOneGame as AllInOneGameVariant;

/**
 * @template-extends WithNrOfPlacesAbstract<AllInOneGameVariant>
 */
readonly class AllInOneGameWithNrOfPlaces extends WithNrOfPlacesAbstract
{
    public function __construct(int $nrOfPlaces, protected AllInOneGameVariant $sportVariant ) {
        parent::__construct($nrOfPlaces);
    }

    public function getSportVariant(): AllInOneGameVariant {
        return $this->sportVariant;
    }

    public function getTotalNrOfGames(): int
    {
        return $this->sportVariant->nrOfGamesPerPlace;
    }

    public function getTotalNrOfGamePlaces(): int
    {
        return (int)($this->sportVariant->nrOfGamesPerPlace * $this->nrOfPlaces);
    }

    public function getTotalNrOfGamesPerPlace(): int
    {
        return $this->sportVariant->nrOfGamesPerPlace;
    }

    public function canAllPlacesPlaySimultaneously(): bool
    {
        return $this->nrOfPlaces === $this->getNrOfGamePlacesSimultaneously();
    }

    protected function getNrOfGamePlacesSimultaneously(): int
    {
        return $this->nrOfPlaces;
    }

    private function getNrOfGamePlaces(): int
    {
        return $this->nrOfPlaces;
    }

    public function getNrOfGamesSimultaneously(): int
    {
        return (int)ceil($this->getNrOfGamePlacesSimultaneously() / $this->getNrOfGamePlaces());
    }

    public function getNrOfGamePlacesPerBatch(): int
    {
        return (int)ceil($this->getTotalNrOfGamePlaces() / $this->getNrOfGamePlacesSimultaneously());
    }

}
