<?php

namespace SportsHelpers\Tests\PouleStructure\Balanced;

use Exception;
use PHPUnit\Framework\TestCase;
use SportsHelpers\Place\Range as PlaceRange;
use SportsHelpers\PouleStructure\Balanced as BalancedPouleStructure;
use SportsHelpers\SportRange;
use SportsHelpers\PouleStructure\BalancedIterator as BalancedPouleStructureIterator;

class IteratorTest extends TestCase
{
    public function testRewind()
    {
        $placesPerPouleRange = new SportRange(4, 4);
        $placesRange = new PlaceRange(10, 20, $placesPerPouleRange);
        $pouleRange = new SportRange(4, 4);
        $iterator = new BalancedPouleStructureIterator($placesRange, $pouleRange);
        self::expectException(Exception::class);
        $iterator->rewind();
    }

    public function testNormalCase()
    {
        $placesPerPouleRange = new SportRange(4, 5);
        $placesRange = new PlaceRange(10, 20, $placesPerPouleRange);
        $pouleRange = new SportRange(4, 5);
        $iterator = new BalancedPouleStructureIterator($placesRange, $pouleRange);
        self::assertSame([4,4,4,4], $iterator->current()->toArray());
        $iterator->next();
        self::assertSame([5,4,4,4], $iterator->current()->toArray());
        $iterator->next();
        self::assertSame([5,5,4,4], $iterator->current()->toArray());
        $iterator->next();
        self::assertSame([5,5,5,4], $iterator->current()->toArray());
        $iterator->next();
        self::assertSame([5,5,5,5], $iterator->current()->toArray());
        $iterator->next();
        self::assertSame([4,4,4,4,4], $iterator->current()->toArray());
        $iterator->next();
        self::assertNull($iterator->current());
    }

    public function testNoPouleRange()
    {
        $placesPerPouleRange = new SportRange(4, 5);
        $placesRange = new PlaceRange(5, 10, $placesPerPouleRange);
        $iterator = new BalancedPouleStructureIterator($placesRange);
        self::assertSame([5], $iterator->current()->toArray());
    }

    public function testKey()
    {
        $placesPerPouleRange = new SportRange(5, 5);
        $placesRange = new PlaceRange(10, 10, $placesPerPouleRange);
        $pouleRange = new SportRange(2, 2);
        $iterator = new BalancedPouleStructureIterator($placesRange, $pouleRange);
        self::assertSame("5,5", $iterator->key());
    }

    public function testValid()
    {
        $placesPerPouleRange = new SportRange(5, 5);
        $placesRange = new PlaceRange(10, 10, $placesPerPouleRange);
        $pouleRange = new SportRange(2, 2);
        $iterator = new BalancedPouleStructureIterator($placesRange, $pouleRange);
        self::assertTrue($iterator->valid());
        $iterator->next();
        self::assertFalse($iterator->valid());
    }

    public function testNoPossibilities()
    {
        $placesPerPouleRange = new SportRange(4, 5);
        $placesRange = new PlaceRange(10, 15, $placesPerPouleRange);
        $pouleRange = new SportRange(4, 5);
        $iterator = new BalancedPouleStructureIterator($placesRange, $pouleRange);
        self::assertNull($iterator->current());
    }

    public function testNextWithNoCurrent()
    {
        $placesPerPouleRange = new SportRange(4, 5);
        $placesRange = new PlaceRange(10, 15, $placesPerPouleRange);
        $pouleRange = new SportRange(4, 5);
        $iterator = new BalancedPouleStructureIterator($placesRange, $pouleRange);
        self::assertNull($iterator->current());
        $iterator->next();
        self::assertNull($iterator->current());
    }

    public function testValidateNrOfPlacesPerPouleAfterNext()
    {
        $placesPerPouleRange = new SportRange(3, 3);
        $placesRange = new PlaceRange(10, 10, $placesPerPouleRange);
        $pouleRange = new SportRange(2, 2);
        $iterator = new BalancedPouleStructureIterator($placesRange, $pouleRange);
        self::assertNull($iterator->current());
    }
}
