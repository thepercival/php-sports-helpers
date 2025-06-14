<?php

declare(strict_types=1);

namespace SportsHelpers\PouleStructures;

use Exception;

final readonly class ValidMinimumBalancedPouleStructure extends BalancedPouleStructure
{
    /**
     * @param int $minNrOfPoulePlaces
     * @param list<int> $poules
     * @throws Exception
     */
    public function __construct(private int $minNrOfPoulePlaces, array $poules)
    {
        foreach ($poules as $nrOfPoulePlaces) {
            if ($nrOfPoulePlaces < $this->minNrOfPoulePlaces) {
                throw new \Exception('een poule heeft te weinig plekken', E_ERROR);
            }
        }
        parent::__construct($poules);
    }

    public function removePlace2(): self
    {
        $poules = $this->poules;

        $greatestNrOfPlaces = $this->getBiggestPoule();

        $idx = array_search($greatestNrOfPlaces, array_reverse($poules, true), true);
        if ($idx === false) {
            throw new Exception('no poules available', E_ERROR);
        }

        // als door het verwijderen van de plek de poulegrootte te klein wordt
        if (($poules[$idx] - 1) < $this->minNrOfPoulePlaces) { // remove poule
            $nrOfPlacesToRemove = $poules[$idx];
            unset($poules[$idx]);
            $self = new self($this->minNrOfPoulePlaces, array_values($poules));
            while ($nrOfPlacesToRemove--) {
                $self = $self->removePlace2();
            }
            return $self;
        }
        $poules[$idx] = $poules[$idx] - 1;
        return new self($this->minNrOfPoulePlaces, $poules);
    }
}
