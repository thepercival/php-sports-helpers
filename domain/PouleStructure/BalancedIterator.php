<?php

declare(strict_types=1);

namespace SportsHelpers\PouleStructure;

use Exception;
use Iterator;
use SportsHelpers\PouleStructure\Balanced as BalancedPouleStructure;
use SportsHelpers\SportRange;

class BalancedIterator implements Iterator
{
    private SportRange $pouleRange;
    private BalancedPouleStructure|null $current;
    private BalancedCreator $balancedCreator;

    public function __construct(
        private SportRange $placeRange,
        private SportRange $placesPerPouleRange,
        SportRange $pouleRange = null
    ) {
        $this->balancedCreator = new BalancedCreator();
        if ($pouleRange === null) {
            $pouleRange = new SportRange(1, $placeRange->getMax());
        }
        $this->pouleRange = $pouleRange;

        $this->current = $this->balancedCreator->createBalanced($this->placeRange->getMin(), $this->pouleRange->getMin());
        $this->validateNrOfPlacesPerPouleAfterNext();
    }

    public function current(): ?BalancedPouleStructure
    {
        return $this->current;
    }

    public function key(): string
    {
        return (string)$this->current;
    }

    public function next(): void
    {
        if ($this->current === null) {
            return;
        }
        $this->nextNrOfPoules();
    }

    protected function nextNrOfPoules(): void
    {
        if ($this->current === null) {
            return;
        }
        if ($this->current->getNrOfPoules() === $this->pouleRange->getMax()) {
            $this->nextNrOfPlaces();
            return;
        }
        $this->current = $this->balancedCreator->createBalanced($this->current->getNrOfPlaces(), $this->current->getNrOfPoules() + 1);

        $this->validateNrOfPlacesPerPouleAfterNext();
    }

    protected function nextNrOfPlaces(): void
    {
        if ($this->current === null) {
            return;
        }
        if ($this->current->getNrOfPlaces() === $this->placeRange->getMax()) {
            $this->current = null;
            return;
        }
        $this->current = $this->balancedCreator->createBalanced($this->current->getNrOfPlaces() + 1, $this->pouleRange->getMin());

        $this->validateNrOfPlacesPerPouleAfterNext();
    }

    protected function validateNrOfPlacesPerPouleAfterNext(): void
    {
        if ($this->current === null) {
            return;
        }
        if ($this->current->getSmallestPoule() < $this->placesPerPouleRange->getMin()) {
            $this->nextNrOfPlaces();
            return;
        }
        if ($this->current->getBiggestPoule() > $this->placesPerPouleRange->getMax()) {
            $this->nextNrOfPoules();
            return;
        }
    }

    public function rewind(): void
    {
        throw new Exception("rewind is not implemented", E_ERROR);
    }

    public function valid(): bool
    {
        return $this->current !== null;
    }
}
