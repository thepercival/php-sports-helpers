<?php

namespace SportsHelpers\Tests;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Range;

class RangeTest extends TestCase
{
    public function testBaiscs()
    {
        $range = new Range(3, 5 );
        self::assertSame(3, $range->min);
        self::assertSame(5, $range->max);

        $rangeNegative = new Range(5, 3 );
        self::assertSame(3, $rangeNegative->min);
        self::assertSame(5, $rangeNegative->max);
        self::assertSame(2, $rangeNegative->difference() );
    }
}
