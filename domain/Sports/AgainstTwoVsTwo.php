<?php

declare(strict_types=1);

namespace SportsHelpers\Sports;

final readonly class AgainstTwoVsTwo extends AgainstSportAbstract
{
    public function __construct()
    {
        parent::__construct(2, 2);
    }

    /**
     * 2 gameplaces => 1 : 1 vs 2
     * 3 gameplaces => 2 : 1 vs 3 & 2 vs 3
     * 4 gameplaces => 4 : 1 vs 3, 1 vs 4, 2 vs 3 & 2 vs 4
     * 6 gameplaces => 9 :  1 vs 4, 1 vs 5, 1 vs 6, 2 vs 4, 2 vs 5, 2 vs 6, 3 vs 4, 3 vs 5 & 3 vs 6
     *
     * @return int
     */
    public function getNrOfAgainstCombinationsPerGame(): int {
        return 4;
    }

//    private function getNrOfGamePlacesOneH2h(int $nrOfPlaces): int
//    {
//        return $this->getNrOfGamesOneH2h($nrOfPlaces) * $this->getNrOfGamePlaces();
//    }
}
