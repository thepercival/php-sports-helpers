<?php

namespace SportsHelpers\Tests;

use PHPUnit\Framework\TestCase;
use SportsHelpers\SportRange;

final class SportRangeTest extends TestCase
{
    public function testBaiscs(): void
    {
        $range = new SportRange(3, 5);
        self::assertSame(3, $range->getMin());
        self::assertSame(5, $range->getMax());

        $rangeNegative = new SportRange(5, 3);
        self::assertSame(3, $rangeNegative->getMin());
        self::assertSame(5, $rangeNegative->getMax());
        self::assertSame(2, $rangeNegative->difference());
    }

    public function testIsWithin(): void
    {
        $range = new SportRange(3, 5);
        self::assertSame(false, $range->isWithIn(2));
        self::assertSame(true, $range->isWithIn(3));
        self::assertSame(true, $range->isWithIn(4));
        self::assertSame(true, $range->isWithIn(5));
        self::assertSame(false, $range->isWithIn(6));
    }

    public function testEquals(): void
    {
        $range = new SportRange(3, 5);
        self::assertSame(false, $range->equals(new SportRange(2, 5)));
        self::assertSame(false, $range->equals(new SportRange(3, 4)));
        self::assertSame(true, $range->equals(new SportRange(3, 5)));
    }

    public function testToArray(): void
    {
        $range = new SportRange(3, 5);
        $rangeList = $range->toArray();
        self::assertCount(3, $rangeList);
        self::assertSame(3, array_shift($rangeList));
        self::assertSame(4, array_shift($rangeList));
        self::assertSame(5, array_shift($rangeList));
    }
}
