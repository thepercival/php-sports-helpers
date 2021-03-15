<?php

namespace SportsHelpers\Tests;

use PHPUnit\Framework\TestCase;
use SportsHelpers\SportRange;

class SportRangeTest extends TestCase
{
    public function testBaiscs()
    {
        $range = new SportRange(3, 5);
        self::assertSame(3, $range->getMin());
        self::assertSame(5, $range->getMax());

        $rangeNegative = new SportRange(5, 3);
        self::assertSame(3, $rangeNegative->getMin());
        self::assertSame(5, $rangeNegative->getMax());
        self::assertSame(2, $rangeNegative->difference());
    }
}
