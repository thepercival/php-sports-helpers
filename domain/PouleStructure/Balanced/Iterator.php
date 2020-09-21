<?php
declare(strict_types=1);

namespace SportsHelpers\PouleStructure\Balanced;

use SportsHelpers\Place\Range as PlaceRange;
use SportsHelpers\Range;
use SportsHelpers\PouleStructure\Balanced as BalancedPouleStructure;

class Iterator implements \Iterator {

    /**
     * @var PlaceRange
     */
    private $placeRange;
    /**
     * @var Range
     */
    private $pouleRange;
    /**
     * @var BalancedPouleStructure|null
     */
    private $current;

    public function __construct(PlaceRange $placeRange, Range $pouleRange = null)
    {
        $this->placeRange = $placeRange;
        if( $pouleRange === null ) {
            $pouleRange = new Range( 1, $placeRange->max );
        }
        $this->pouleRange = $pouleRange;
        $this->current = new BalancedPouleStructure( $this->placeRange->min, $this->pouleRange->min);
        $this->validateNrOfPlacesPerPouleAfterNext();
    }

    public function current () : ?BalancedPouleStructure {
        return $this->current;
    }

    public function key () : string {
        return $this->current->toString();
    }

    public function next() {
        if( $this->current === null ) {
            return;
        }
        $this->nextNrOfPoules();
    }

    protected function nextNrOfPoules() {
        if ($this->current->getNrOfPoules() === $this->pouleRange->max) {
            $this->nextNrOfPlaces();
            return;
        }
        $this->current = new BalancedPouleStructure( $this->current->getNrOfPlaces(), $this->current->getNrOfPoules() + 1 );

        $this->validateNrOfPlacesPerPouleAfterNext();
    }

    protected function nextNrOfPlaces() {
        if ($this->current->getNrOfPlaces() === $this->placeRange->max) {
            $this->current = null;
            return;
        }
        $this->current = new BalancedPouleStructure( $this->current->getNrOfPlaces() + 1, $this->pouleRange->min );

        $this->validateNrOfPlacesPerPouleAfterNext();
    }

    protected function validateNrOfPlacesPerPouleAfterNext() {
        $placesPerPoule = $this->current->getNrOfPlacesPerPoule(true);

        $placesPerPouleRange = $this->placeRange->getPlacesPerPouleRange();
        if( $placesPerPoule < $placesPerPouleRange->min ) {
            $this->nextNrOfPlaces();
            return;
        }
        if( $placesPerPoule > $placesPerPouleRange->max ) {
            $this->nextNrOfPoules();
            return;
        }
    }

    public function rewind() {
        throw new \Exception("rewind is not implemented", E_ERROR );
    }

    public function valid () : bool {
        return $this->current !== null;
    }
}
