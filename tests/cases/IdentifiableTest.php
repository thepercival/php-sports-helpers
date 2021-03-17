<?php

namespace SportsHelpers\Tests;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Identifiable;

final class IdentifiableTest extends TestCase
{
    public function testBaiscs(): void
    {
        $identifiable = new Identifiable();
        $identifiable->setId(1);
        self::assertSame(1, $identifiable->getId() );
    }
}
