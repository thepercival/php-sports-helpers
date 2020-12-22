<?php

namespace SportsHelpers;

class SportBase extends Identifiable
{
    protected int $nrOfGamePlaces;

    public function __construct(int $nrOfGamePlaces)
    {
        $this->nrOfGamePlaces = $nrOfGamePlaces;
    }

    public function getNrOfGamePlaces(): int
    {
        return $this->nrOfGamePlaces;
    }

}