<?php

declare(strict_types=1);

namespace oldsportshelpers\old\WithNrOfPlaces;

readonly abstract class SportWithNrOfPlaces
{
    /**
     * @param int $nrOfPlaces
     */
    public function __construct(public int $nrOfPlaces) {
    }


//    abstract public function getTotalNrOfGames(): int;

    // abstract public function getMaxNrOfGamesSimultaneously(SelfRefereeInfo $selfRefereeInfo): int;
}
