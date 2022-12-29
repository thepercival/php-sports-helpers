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

    public function testReset(): void
    {
        $stdClass = new \stdClass();

        $counter = new Counter($stdClass, 4);
        $counter->reset();
        self::assertSame(0, $counter->count());
    }

    public function testDecrement(): void
    {
        $stdClass = new \stdClass();

        $counter = new Counter($stdClass);
        self::assertSame(-1, ($counter->decrement2())->count());

        $counter = new Counter($stdClass, 4);
        self::assertSame(3, ($counter->decrement2())->count());
    }

    public function testIncrement(): void
    {
        $stdClass = new \stdClass();
        $counter = new Counter($stdClass, 4);
        self::assertSame(5, $counter->increment());
    }

    public function testIncrease(): void
    {
        $stdClass = new \stdClass();
        $counter = new Counter($stdClass, 4);
        $counter->increase(3);
        self::assertSame(7, $counter->count());
    }
}
