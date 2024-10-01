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

    public function getNrOfGamePlaces(): int
    {
        return $this->nrOfPlaces;
    }

    public function getNrOfGamesSimultaneously(): int
    {
        return 1;
    }
}
