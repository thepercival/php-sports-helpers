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
        self::assertCount(0, $counter);

        $counter = new Counter($stdClass, 5);
        self::assertCount(5, $counter);
    }
}
