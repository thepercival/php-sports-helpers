<?php

namespace SportsHelpers;

class PouleStructure
{
    /**
     * @var array| int[] $poules
     */
    protected $poules;
    /**
     * @var int|null
     */
    protected $nrOfGamePlaces;

    /**
     * @param array| int[] $poules
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
        return reset($this->poules );
    }

    public function getSmallestPoule(): int
    {
        return end($this->poules );
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
     * @return array|int[]
     */
    public function getNrOfPoulesByNrOfPlaces(): array
    {
        $nrOfPoulesByNrOfPlaces = [];
        foreach ($this->toArray() as $pouleNrOfPlaces) {
            if (array_key_exists($pouleNrOfPlaces, $nrOfPoulesByNrOfPlaces) === false) {
                $nrOfPoulesByNrOfPlaces[$pouleNrOfPlaces] = 0;
            }
            $nrOfPoulesByNrOfPlaces[$pouleNrOfPlaces]++;
        }
        return $nrOfPoulesByNrOfPlaces;
    }

    /**
     * @return array| int[]
     */
    public function toArray(): array {
        return $this->poules;
    }

    public function toString(): string {
        return implode(',', $this->toArray());
    }
}