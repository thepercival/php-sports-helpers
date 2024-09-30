<?php

declare(strict_types=1);

namespace SportsHelpers\SportVariants\WithNrOfPlaces;

/**
 * @template T
 */
readonly abstract class WithNrOfPlacesAbstract
{
    /**
     * @param int $nrOfPlaces
     */
    public function __construct(protected int $nrOfPlaces) {
    }

    public function getNrOfPlaces(): int
    {
        return $this->nrOfPlaces;
    }

    /**
     * @return T
     */
    abstract public function getSportVariant(): mixed;

    abstract public function getTotalNrOfGames(): int;

    // abstract public function getMaxNrOfGamesSimultaneously(SelfRefereeInfo $selfRefereeInfo): int;
}
