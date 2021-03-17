<?php

namespace SportsHelpers\Tests\Place;

use PHPUnit\Framework\TestCase;
use SportsHelpers\Place\Range as PlaceRange;
use SportsHelpers\SportRange;

final class RangeTest extends TestCase
{
    public function testBaiscs(): void
    {
        $range = new SportRange(3, 5);
        $placeRange = new PlaceRange(3, 5, $range);

        self::assertSame($range, $placeRange->getPlacesPerPouleRange());
    }
}
