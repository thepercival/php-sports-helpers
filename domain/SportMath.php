<?php

declare(strict_types=1);

namespace SportsHelpers;

class SportMath
{
    public function getSmallestCommonDividend(int $number1, int $number2): int
    {
        $multiplier = 1;
        while (($multiplier * $number1) % $number2 !== 0) {
            $multiplier++;
        }
        return $multiplier * $number1;
    }

    /**
     * @param list<int> $numbers
     * @param int|null $gcd
     * @return int
     */
    public function getGreatestCommonDivisor(array $numbers, int $gcd = null): int
    {
        if ($gcd === null) {
            $gcd = array_pop($numbers);
        }
        if ($gcd === null) {
            return 0;
        }
        $number = array_pop($numbers);
        if ($number === null) {
            return $gcd;
        }
        $commonDivsors = $this->getCommonDivisors($gcd, $number);
        $newGcd = array_shift($commonDivsors);
        return $this->getGreatestCommonDivisor($numbers, $newGcd);
    }

    /**
     * @param int $a
     * @param int $b
     * @return list<int>
     */
    public function getCommonDivisors(int $a, int $b): array
    {
        $gcd = $this->getCommonDivisorsHelper($a, $b);
        return array_reverse($this->getDivisors($gcd));
    }

    private function getCommonDivisorsHelper(int $x, int $y): int
    {
        if ($y === 0) {
            return $x;
        }
        return $this->getCommonDivisorsHelper($y, $x % $y);
    }


    /**
     * @param int $number
     * @return list<int>
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

    public function getUniqueNrOfHomeAways(int $nrOfPoulePlaces, int $nrOfHomePlaces, int $nrOfAwayPlaces): int
    {
        $nrOfGamePlaces = $nrOfHomePlaces + $nrOfAwayPlaces;
        if ($nrOfPoulePlaces < $nrOfGamePlaces) {
            throw new \Exception('aantal plekken moet minimaal aantal wedstrijdplekken zijn', E_ERROR);
        }
        $nrOfHomeAways = $this->above($nrOfPoulePlaces, $nrOfHomePlaces)
            * $this->above($nrOfPoulePlaces - $nrOfHomePlaces, $nrOfAwayPlaces);
        if ($nrOfHomePlaces === $nrOfAwayPlaces) {
            return (int)($nrOfHomeAways / 2);
        }
        return $nrOfHomeAways;
    }
}
