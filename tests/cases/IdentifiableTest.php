<?php

namespace SportsHelpers\Tests;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Identifiable;

class IdentifiableTest extends TestCase
{
    public function testBaiscs()
    {
        $identifiable = new Identifiable();
        $identifiable->setId(1);
        self::assertSame(1, $identifiable->getId() );
    }
}
