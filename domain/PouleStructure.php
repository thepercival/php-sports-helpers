<?php

declare(strict_types=1);

namespace SportsHelpers;

use Stringable;

class PouleStructure implements Stringable
{
    /**
     * @var list<int> $poules
     */
    protected $poules;
    protected int|null $nrOfGamePlaces = null;

    /**
     * @param list<int> $poules
     */
    public function __construct(array $poules)
    {
        uasort(
            $poules,
            function (int $nrOfPlacesPouleA, int $nrOfPlacesPouleB): int {
                return $nrOfPlacesPouleA > $nrOfPlacesPouleB ? -1 : 1;
            }
        );
        $this->poules = array_values($poules);
    }

    public function getNrOfPoules(): int
    {
        return count($this->poules);
    }

    public function getNrOfPlaces(): int
    {
        if ($this->nrOfGamePlaces === null) {
            $this->nrOfGamePlaces = array_sum($this->poules);
        }
        return $this->nrOfGamePlaces;
    }

    public function getBiggestPoule(): int
    {
        return reset($this->poules);
    }

    public function getSmallestPoule(): int
    {
        return end($this->poules);
    }

    public function isAlmostBalanced(): bool
    {
        return ($this->getBiggestPoule() - 1) <= $this->getSmallestPoule();
    }

    public function isBalanced(): bool
    {
        return $this->getBiggestPoule() === $this->getSmallestPoule();
    }

    /**
     * @return array<int,int>
     */
    public function getNrOfPoulesByNrOfPlaces(): array
    {
        $nrOfPoulesByNrOfPlaces = [];
        foreach ($this->poules as $pouleNrOfPlaces) {
            if (array_key_exists($pouleNrOfPlaces, $nrOfPoulesByNrOfPlaces) === false) {
                $nrOfPoulesByNrOfPlaces[$pouleNrOfPlaces] = 0;
            }
            $nrOfPoulesByNrOfPlaces[$pouleNrOfPlaces]++;
        }
        return $nrOfPoulesByNrOfPlaces;
    }

    /**
     * @param list<SportConfig> $sportConfigs
     * @return int
     */
    public function getNrOfGames(array $sportConfigs): int
    {
        $nrOfGames = 0;
        foreach ($this->poules as $nrOfPlaces) {
            foreach ($sportConfigs as $sportConfig) {
                $nrOfGames += $sportConfig->getNrOfGames($nrOfPlaces);
            }
        }
        return $nrOfGames;
    }

//    /**
//     * @param array|SportConfig[] $sportConfigs
//     * @param int $gameMode
//     * @return int
//     */
//    public function getNrOfGameRounds(array $sportConfigs, int $gameMode ): int
//    {
//        $nrOfGames = 0;
//        foreach ($this->poules as $nrOfPlaces ) {
//            foreach( $sportConfigs as $sportConfig ) {
//                $nrOfGames += $sportConfig->getNrOfGameRounds( $nrOfPlaces, $gameMode );
//            }
//        }
//        return $nrOfGames;
//    }

    /**
     * @return list<int>
     */
    public function toArray(): array
    {
        return $this->poules;
    }

    public function __toString(): string
    {
        return implode(',', $this->toArray());
    }
}
