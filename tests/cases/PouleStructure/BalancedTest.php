<?php

namespace SportsHelpers\Tests\PouleStructure;

use PHPUnit\Framework\TestCase;
use SportsHelpers\PouleStructure\Balanced as BalancedPouleStructure;

final class BalancedTest extends TestCase
{
    public function testStructure(): void
    {
        $pouleStructure = new BalancedPouleStructure(13, 4);
        self::assertSame(3, $pouleStructure->getRoundedNrOfPlacesPerPoule(true));
        self::assertSame(4, $pouleStructure->getRoundedNrOfPlacesPerPoule(false));
    }
}
