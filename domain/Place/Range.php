<?php

namespace SportsHelpers\Place;

use SportsHelpers\SportRange;

class Range extends SportRange
{
    public function __construct(int $min, int $max, private SportRange $placesPerPouleRange)
    {
        parent::__construct($min, $max);
    }

    public function getPlacesPerPouleRange(): SportRange
    {
        return $this->placesPerPouleRange;
    }
}
