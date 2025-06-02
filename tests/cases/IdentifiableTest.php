<?php

namespace SportsHelpers\Tests;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Identifiable;

final class IdentifiableTest extends TestCase
{
    public function testBaiscs(): void
    {
        $identifiable = new Identifiable();
        self::assertSame(null, $identifiable->id);
    }
}
