<?php

namespace SportsHelpers\Tests\Place;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Place\Range as PlaceRange;
use SportsHelpers\Range;

class RangeTest extends TestCase
{
    public function testBaiscs()
    {
        $range = new Range(3, 5 );
        $placeRange = new PlaceRange(3, 5, $range );

        self::assertSame($range, $placeRange->getPlacesPerPouleRange() );
    }
}
