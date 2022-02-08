<?php

namespace SportsHelpers\Tests;

use PHPUnit\Framework\TestCase;
use SportsHelpers\SportMath;

final class SportMathTest extends TestCase
{
    public function testSmallCommonDividend(): void
    {
        $math = new SportMath();

        self::assertSame(28, $math->getSmallestCommonDividend(7, 4));
        self::assertSame(3, $math->getSmallestCommonDividend(3, 3));
        self::assertSame(3, $math->getSmallestCommonDividend(3, 1));
        self::assertSame(3, $math->getSmallestCommonDividend(1, 3));
    }

    public function testFaculty(): void
    {
        $math = new SportMath();

        self::assertSame($math->faculty(0), 1.0);
        self::assertSame($math->faculty(1), 1.0);
        self::assertSame($math->faculty(2), 2.0);
        self::assertSame($math->faculty(3), 6.0);
        self::assertSame($math->faculty(4), 24.0);
        self::assertSame($math->faculty(5), 120.0);
    }

    public function testAbove(): void
    {
        $math = new SportMath();

        // bijv. aantal wedstrijden per poule(dit is zonder volgorde)
        self::assertSame($math->above(1, 2), 0);
        self::assertSame($math->above(2, 2), 1);
        self::assertSame($math->above(3, 2), 3);
        self::assertSame($math->above(4, 2), 6);
        self::assertSame($math->above(5, 2), 10);
        self::assertSame($math->above(6, 2), 15);

        // bijv. berekening van 5 deelnemers, per avond 3 deelnemers die een halve competitie doen
        self::assertSame($math->above(5, 3), 10);

        self::assertSame($math->above(6, 3), 20);
        self::assertSame($math->above(7, 3), 35);
    }

    public function testGetDivisors(): void
    {
        $math = new SportMath();

        self::assertSame($math->getDivisors(1), [1]);
        self::assertSame($math->getDivisors(2), [1,2]);
        self::assertSame($math->getDivisors(3), [1,3]);
        self::assertSame($math->getDivisors(4), [1,2,4]);
        self::assertSame($math->getDivisors(5), [1,5]);
        self::assertSame($math->getDivisors(6), [1,2,3,6]);
        self::assertSame($math->getDivisors(7), [1,7]);
        self::assertSame($math->getDivisors(8), [1,2,4,8]);
        self::assertSame($math->getDivisors(9), [1,3,9]);
    }

    public function testGetCommonDivisors(): void
    {
        $math = new SportMath();

        self::assertSame($math->getCommonDivisors(1, 1), [1]);
        // bijv 2 poules met dezelfde aantal deelnemers, 2 scheidsrecchters
        self::assertSame($math->getCommonDivisors(2, 2), [2,1]);
        self::assertSame($math->getCommonDivisors(2, 1), [1]);
        self::assertSame($math->getCommonDivisors(9, 6), [3,1]);
        self::assertSame($math->getCommonDivisors(8, 4), [4,2,1]);
    }

    public function testGetGreatestCommonDivisor(): void
    {
        $math = new SportMath();

        self::assertSame(0, $math->getGreatestCommonDivisor([]));
        self::assertSame(1, $math->getGreatestCommonDivisor([1]));
        self::assertSame(2, $math->getGreatestCommonDivisor([2]));
        self::assertSame(4, $math->getGreatestCommonDivisor([8,4]));
        self::assertSame(2, $math->getGreatestCommonDivisor([2, 8,4]));
        self::assertSame(1, $math->getGreatestCommonDivisor([2, 8,1]));

        self::assertSame(3, $math->getGreatestCommonDivisor([15, 18]));
    }

    public function testGetLeastCommonMultiple(): void
    {
        $math = new SportMath();

        self::assertSame(2, $math->getLeastCommonMultiple([2]));
        self::assertSame(15, $math->getLeastCommonMultiple([3,15]));
        self::assertSame(6, $math->getLeastCommonMultiple([3,3,2]));
        self::assertSame(300, $math->getLeastCommonMultiple([12,15,75]));
    }

    public function testGetUniqueNrOfHomeAways(): void
    {
        $math = new SportMath();

        self::assertSame(1, $math->getUniqueNrOfHomeAways(2, 1, 1));
        self::assertSame(3, $math->getUniqueNrOfHomeAways(3, 1, 1));
        self::assertSame(6, $math->getUniqueNrOfHomeAways(4, 1, 1));
        self::assertSame(10, $math->getUniqueNrOfHomeAways(5, 1, 1));
        self::assertSame(15, $math->getUniqueNrOfHomeAways(6, 1, 1));
        self::assertSame(21, $math->getUniqueNrOfHomeAways(7, 1, 1));
        self::assertSame(28, $math->getUniqueNrOfHomeAways(8, 1, 1));

        self::assertSame(3, $math->getUniqueNrOfHomeAways(3, 1, 2));
        self::assertSame(12, $math->getUniqueNrOfHomeAways(4, 1, 2));
        self::assertSame(30, $math->getUniqueNrOfHomeAways(5, 1, 2));

        self::assertSame(3, $math->getUniqueNrOfHomeAways(4, 2, 2));
        self::assertSame(15, $math->getUniqueNrOfHomeAways(5, 2, 2));
        self::assertSame(45, $math->getUniqueNrOfHomeAways(6, 2, 2));
        self::assertSame(105, $math->getUniqueNrOfHomeAways(7, 2, 2));
        self::assertSame(210, $math->getUniqueNrOfHomeAways(8, 2, 2));
    }
}
