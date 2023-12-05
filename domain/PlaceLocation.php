<?php

namespace SportsHelpers;

class PlaceLocation implements  PlaceLocationInterface, \Stringable
{
    public function __construct(protected int $pouleNr, protected int $placeNr)
    {
    }

    public function getPouleNr(): int
    {
        return $this->pouleNr;
    }

    public function getPlaceNr(): int
    {
        return $this->placeNr;
    }

    public function __toString(): string
    {
        return $this->getPouleNr() . '.' . $this->getPlaceNr();
    }
}