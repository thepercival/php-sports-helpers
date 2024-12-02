<?php

declare(strict_types=1);

namespace SportsHelpers\Tests\Against;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Against\AgainstSide;

final class AgainstSideTest extends TestCase
{
    public function testOpposite(): void
    {
        self::assertEquals(AgainstSide::Home, AgainstSide::Away->getOpposite());
        self::assertEquals(AgainstSide::Away, AgainstSide::Home->getOpposite());
    }
}
