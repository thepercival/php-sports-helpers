<?php

namespace SportsHelpers\Tests\PouleStructures;

use PHPUnit\Framework\TestCase;
use SportsHelpers\PouleStructures\BalancedPouleStructure as BalancedPouleStructure;

final class BalancedPouleStructureTest extends TestCase
{
    public function testStructure(): void
    {
        $pouleStructure = new BalancedPouleStructure(4, 3, 3, 3);
        self::assertSame(1, $pouleStructure->getLastGreaterNrOfPlacesPouleNr());
        self::assertSame(2, $pouleStructure->getFirstLesserNrOfPlacesPouleNr());
    }
}
