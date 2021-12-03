<?php

declare(strict_types=1);

namespace SportsHelpers;

class SportRange
{
    protected int $min;
    protected int $max;

    public function __construct(int $min, int $max)
    {
//        if( $min > $max ) {
//            throw new \Exception("in range minimum should be greater than maximum", E_ERROR );
//        }
        $abs = $min <= $max;
        $this->min = $abs ? $min : $max;
        $this->max = $abs ? $max : $min;
    }

    public function getMin(): int
    {
        return $this->min;
    }

    public function getMax(): int
    {
        return $this->max;
    }

    public function difference(): int
    {
        return $this->max - $this->min;
    }

    public function isWithIn(int $value): bool
    {
        return $value >= $this->min && $value <= $this->max;
    }
}
