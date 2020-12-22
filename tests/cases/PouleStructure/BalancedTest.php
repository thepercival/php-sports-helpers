<?php

namespace SportsHelpers\Tests\PouleStructure;

use SportsHelpers\GameCalculatorDep;
use SportsHelpers\PouleStructure;
use SportsHelpers\PouleStructure\Balanced as BalancedPouleStructure;

class BalancedTest extends \PHPUnit\Framework\TestCase
{
    public function testStructure()
    {
        $pouleStructure = new BalancedPouleStructure( 13,4);
        self::assertSame(3, $pouleStructure->getRoundedNrOfPlacesPerPoule( true ) );
        self::assertSame(4, $pouleStructure->getRoundedNrOfPlacesPerPoule( false ) );
    }
}
