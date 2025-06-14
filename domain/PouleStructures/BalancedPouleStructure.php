<?php

declare(strict_types=1);

namespace SportsHelpers\PouleStructures;

use Exception;

readonly class BalancedPouleStructure extends PouleStructure
{
    /**
     * @param list<int> $poules
     * @throws Exception
     */
    public function __construct(array $poules)
    {
        parent::__construct($poules);
        if ($this->getBiggestPoule() - $this->getSmallestPoule() > 1) {
            throw new Exception('this poulestructure is not balanced', E_ERROR);
        }
    }

    public function getLastGreaterNrOfPlacesPouleNr(): int
    {
        $greatestNrOfPlaces = $this->getBiggestPoule();

        $idx = array_search($greatestNrOfPlaces, array_reverse($this->poules), true);
        if ($idx === false) {
            throw new Exception('no poules available', E_ERROR);
        }
        return ((count($this->poules)-1) - $idx) + 1;
    }

    public function getFirstLesserNrOfPlacesPouleNr(): int
    {
        $leastNrOfPlaces = $this->getSmallestPoule();
        $idx = array_search($leastNrOfPlaces, $this->poules, true);
        if ($idx === false) {
            throw new Exception('no poules available', E_ERROR);
        }
        return $idx + 1;
    }

    public function removePoule2(): self
    {
        if (count($this->poules) <= 1) {
            throw new Exception('not enough poules', E_ERROR);
        }
        $poules = $this->poules;
        array_pop($poules);
        return new self($poules);
    }
}
