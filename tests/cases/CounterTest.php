<?php

namespace SportsHelpers\Tests;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Counter;

final class CounterTest extends TestCase
{
    public function testBaiscs(): void
    {
        $stdClass = new \stdClass();

        $counter = new Counter($stdClass);
        self::assertSame(0, $counter->count());

        $counter = new Counter($stdClass, 5);
        self::assertSame(5, $counter->count());
    }
}
