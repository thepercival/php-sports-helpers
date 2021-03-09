<?php

namespace SportsHelpers\Place;

use SportsHelpers\Range as BaseRange;

class Range extends BaseRange
{
    public function __construct(int $min, int $max, private BaseRange $placesPerPouleRange)
    {
        parent::__construct($min, $max);
    }

    public function getPlacesPerPouleRange(): BaseRange
    {
        return $this->placesPerPouleRange;
    }
}
