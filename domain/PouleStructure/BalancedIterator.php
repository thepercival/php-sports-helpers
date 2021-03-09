<?php
declare(strict_types=1);

namespace SportsHelpers\PouleStructure;

use Exception;
use Iterator;
use SportsHelpers\Place\Range as PlaceRange;
use SportsHelpers\Range;
use SportsHelpers\PouleStructure\Balanced as BalancedPouleStructure;

class BalancedIterator implements Iterator
{
    private BalancedPouleStructure|null $current;

    public function __construct(
        private PlaceRange $placeRange,
        private ?Range $pouleRange = null
    ) {
        if ($this->pouleRange === null) {
            $this->pouleRange = new Range(1, $placeRange->max);
        }
        $this->current = new BalancedPouleStructure($this->placeRange->min, $this->pouleRange->min);
        $this->validateNrOfPlacesPerPouleAfterNext();
    }

    public function current() : ?BalancedPouleStructure
    {
        return $this->current;
    }

    public function key() : string
    {
        return (string) $this->current;
    }

    public function next()
    {
        if ($this->current === null) {
            return;
        }
        $this->nextNrOfPoules();
    }

    protected function nextNrOfPoules()
    {
        if ($this->current->getNrOfPoules() === $this->pouleRange->max) {
            $this->nextNrOfPlaces();
            return;
        }
        $this->current = new BalancedPouleStructure($this->current->getNrOfPlaces(), $this->current->getNrOfPoules() + 1);

        $this->validateNrOfPlacesPerPouleAfterNext();
    }

    protected function nextNrOfPlaces()
    {
        if ($this->current->getNrOfPlaces() === $this->placeRange->max) {
            $this->current = null;
            return;
        }
        $this->current = new BalancedPouleStructure($this->current->getNrOfPlaces() + 1, $this->pouleRange->min);

        $this->validateNrOfPlacesPerPouleAfterNext();
    }

    protected function validateNrOfPlacesPerPouleAfterNext()
    {
        $placesPerPoule = $this->current->getRoundedNrOfPlacesPerPoule(true);

        $placesPerPouleRange = $this->placeRange->getPlacesPerPouleRange();
        if ($placesPerPoule < $placesPerPouleRange->min) {
            $this->nextNrOfPlaces();
            return;
        }
        if ($placesPerPoule > $placesPerPouleRange->max) {
            $this->nextNrOfPoules();
            return;
        }
    }

    public function rewind()
    {
        throw new Exception("rewind is not implemented", E_ERROR);
    }

    public function valid() : bool
    {
        return $this->current !== null;
    }
}
