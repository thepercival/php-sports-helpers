<?php
declare(strict_types=1);

namespace SportsHelpers;

class SportMath
{


    /**
     * @param array $array
     * @param int|null $gcd
     * @return int
     */
    public function getGreatestCommonDivisor(array $array, int $gcd = null): int
    {
        if ($gcd === null) {
            if (count($array) === 0) {
                return 0;
            }
            $gcd = array_pop($array);
        }
        $number = array_pop($array);
        if ($number === null) {
            return $gcd;
        }
        $commonDivsors = $this->getCommonDivisors($gcd, $number);
        $newGcd = array_shift($commonDivsors);
        return $this->getGreatestCommonDivisor($array, $newGcd);
    }

    /**
     * @param int $a
     * @param int $b
     * @return array|int[]
     */
    public function getCommonDivisors(int $a, int $b): array
    {
        $gcd = function (int $x, int $y) use (&$gcd): int {
            if ($y === 0) {
                return $x;
            }
            return $gcd($y, $x % $y);
        };
        return array_reverse($this->getDivisors($gcd($a, $b)));
    }


    /**
     * @param int $number
     * @return array|int[]
     */
    public function getDivisors(int $number): array
    {
        $divisors = [];
        for ($currentDivisor = 1; $currentDivisor <= $number; $currentDivisor++) {
            if ($number % $currentDivisor === 0) {
                $divisors[] = $currentDivisor;
            }
        }
        return $divisors;
    }

    public function above(int $top, int $bottom): int
    {
        // if (bottom > top) {
        //     return 0;
        // }
        $y = $this->faculty($top);
        $z = ($this->faculty($top - $bottom) * $this->faculty($bottom));
        $x = $y / $z;
        return (int) $x;
    }

    public function faculty(float $x): float
    {
        if ($x > 1) {
            return $this->faculty($x - 1) * $x;
        }
        return 1;
    }
}
