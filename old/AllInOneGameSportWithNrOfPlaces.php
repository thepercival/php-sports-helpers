<?php

declare(strict_types=1);

namespace oldsportshelpers\old;

use oldsportshelpers\old\AllInOneGame as AllInOneGameVariant;
use oldsportshelpers\old\WithNrOfPlaces\SportWithNrOfPlaces;

/**
 * @template-extends SportWithNrOfPlaces<AllInOneGameVariant>
 */
readonly class AllInOneGameSportWithNrOfPlaces extends SportWithNrOfPlaces
{
    public function __construct(int $nrOfPlaces, protected AllInOneGameVariant $sportVariant ) {
        parent::__construct($nrOfPlaces);
    }

    public function getSportVariant(): AllInOneGameVariant {
        return $this->sportVariant;
    }

    public function getTotalNrOfGames(): int
    {
        return $this->sportVariant->nrOfCycles;
    }

    public function getTotalNrOfGamePlaces(): int
    {
        return (int)($this->sportVariant->nrOfCycles * $this->nrOfPlaces);
    }

    public function getTotalNrOfGamesPerPlace(): int
    {
        return $this->sportVariant->nrOfCycles;
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
