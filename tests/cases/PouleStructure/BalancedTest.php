<?php

namespace SportsHelpers\Tests\PouleStructure;

use PHPUnit\Framework\TestCase;
use SportsHelpers\PouleStructure\Balanced as BalancedPouleStructure;

final class BalancedTest extends TestCase
{
    public function testStructure(): void
    {
        $pouleStructure = new BalancedPouleStructure(4, 3, 3, 3);
        self::assertSame(1, $pouleStructure->getLastGreaterNrOfPlacesPouleNr());
        self::assertSame(2, $pouleStructure->getFirstLesserNrOfPlacesPouleNr());
    }
}
