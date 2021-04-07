<?php

declare(strict_types=1);

namespace SportsHelpers\PouleStructure;

use Exception;
use SportsHelpers\PouleStructure;

class Balanced extends PouleStructure
{
    public function __construct(int ...$nrOfPlaces)
    {
        parent::__construct(...$nrOfPlaces);
        if ($this->getBiggestPoule() - $this->getSmallestPoule() > 1) {
            throw new Exception('this poulestructure is not balanced', E_ERROR);
        }
    }

    public function getLastGreaterNrOfPlacesPouleNr(): int
    {
        $greatestNrOfPlaces = $this->getBiggestPoule();

        return ((count($this->poules)-1) - array_search($greatestNrOfPlaces, array_reverse($this->poules), true)) + 1;
    }

    public function getFirstLesserNrOfPlacesPouleNr(): int
    {
        $leastNrOfPlaces = $this->getSmallestPoule();
        return array_search($leastNrOfPlaces, $this->poules, true) + 1;
    }
}
