<?php
declare(strict_types=1);

namespace SportsHelpers;

class Range
{
    public $min;
    public $max;

    public function __construct(int $min, int $max)
    {
//        if( $min > $max ) {
//            throw new \Exception("in range minimum should be greater than maximum", E_ERROR );
//        }
        $abs = $min <= $max;
        $this->min = $abs ? $min : $max;
        $this->max = $abs ? $max : $min;
    }

    public function difference(): int
    {
        return $this->max - $this->min;
    }
}
