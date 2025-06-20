<?php

declare(strict_types=1);

namespace SportsHelpers\Sports;

// gebruik bij 1 vs 1: Opgegeven in H2h(3 en 2 even vaak tegen elkaar)
// gebruik bij Mixed: NrOfGamesPerPlace(3 en 2 even veel wedstrijden)
final readonly class AgainstOneVsOne
{

    use AgainstSportTrait;

    public function __construct()
    {
        $this->nrOfHomePlaces = 1;
        $this->nrOfAwayPlaces = 1;
    }

    public function getNrOfAgainstCombinationsPerGame(): int {
        return 1;
    }

//    private function getNrOfGamePlacesOneH2h(int $nrOfPlaces): int
//    {
//        return $this->getNrOfGamesOneH2h($nrOfPlaces) * $this->getNrOfGamePlaces();
//    }
}
