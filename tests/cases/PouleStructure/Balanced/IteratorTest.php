<?php

namespace SportsHelpers\Tests\PouleStructure\Balanced;

use Exception;
use PHPUnit\Framework\TestCase;
use SportsHelpers\Place\Range as PlaceRange;
use SportsHelpers\SportRange;
use SportsHelpers\PouleStructure\BalancedIterator as BalancedPouleStructureIterator;

final class IteratorTest extends TestCase
{
    public function testRewind(): void
    {
        $placesPerPouleRange = new SportRange(4, 4);
        $placesRange = new PlaceRange(10, 20, $placesPerPouleRange);
        $pouleRange = new SportRange(4, 4);
        $iterator = new BalancedPouleStructureIterator($placesRange, $pouleRange);
        self::expectException(Exception::class);
        $iterator->rewind();
    }

    public function testNormalCase(): void
    {
        $placesPerPouleRange = new SportRange(4, 5);
        $placesRange = new PlaceRange(10, 20, $placesPerPouleRange);
        $pouleRange = new SportRange(4, 5);
        $iterator = new BalancedPouleStructureIterator($placesRange, $pouleRange);
        $balancedPouleStructure = $iterator->current();
        self::assertNotNull($balancedPouleStructure);
        self::assertSame([4,4,4,4], $balancedPouleStructure->toArray());
        $iterator->next();
        $balancedPouleStructure = $iterator->current();
        self::assertNotNull($balancedPouleStructure);
        self::assertSame([5,4,4,4], $balancedPouleStructure->toArray());
        $iterator->next();
        $balancedPouleStructure = $iterator->current();
        self::assertNotNull($balancedPouleStructure);
        self::assertSame([5,5,4,4], $balancedPouleStructure->toArray());
        $iterator->next();
        $balancedPouleStructure = $iterator->current();
        self::assertNotNull($balancedPouleStructure);
        self::assertSame([5,5,5,4], $balancedPouleStructure->toArray());
        $iterator->next();
        $balancedPouleStructure = $iterator->current();
        self::assertNotNull($balancedPouleStructure);
        self::assertSame([5,5,5,5], $balancedPouleStructure->toArray());
        $iterator->next();
        $balancedPouleStructure = $iterator->current();
        self::assertNotNull($balancedPouleStructure);
        self::assertSame([4,4,4,4,4], $balancedPouleStructure->toArray());
        $iterator->next();
        self::assertNull($iterator->current());
    }

    public function testNoPouleRange(): void
    {
        $placesPerPouleRange = new SportRange(4, 5);
        $placesRange = new PlaceRange(5, 10, $placesPerPouleRange);
        $iterator = new BalancedPouleStructureIterator($placesRange);
        $balancedPouleStructure = $iterator->current();
        self::assertNotNull($balancedPouleStructure);
        self::assertSame([5], $balancedPouleStructure->toArray());
    }

    public function testKey(): void
    {
        $placesPerPouleRange = new SportRange(5, 5);
        $placesRange = new PlaceRange(10, 10, $placesPerPouleRange);
        $pouleRange = new SportRange(2, 2);
        $iterator = new BalancedPouleStructureIterator($placesRange, $pouleRange);
        self::assertSame("5,5", $iterator->key());
    }

    public function testValid(): void
    {
        $placesPerPouleRange = new SportRange(5, 5);
        $placesRange = new PlaceRange(10, 10, $placesPerPouleRange);
        $pouleRange = new SportRange(2, 2);
        $iterator = new BalancedPouleStructureIterator($placesRange, $pouleRange);
        self::assertTrue($iterator->valid());
        $iterator->next();
        self::assertFalse($iterator->valid());
    }

    public function testNoPossibilities(): void
    {
        $placesPerPouleRange = new SportRange(4, 5);
        $placesRange = new PlaceRange(10, 15, $placesPerPouleRange);
        $pouleRange = new SportRange(4, 5);
        $iterator = new BalancedPouleStructureIterator($placesRange, $pouleRange);
        self::assertNull($iterator->current());
    }

    public function testNextWithNoCurrent(): void
    {
        $placesPerPouleRange = new SportRange(4, 5);
        $placesRange = new PlaceRange(10, 15, $placesPerPouleRange);
        $pouleRange = new SportRange(4, 5);
        $iterator = new BalancedPouleStructureIterator($placesRange, $pouleRange);
        self::assertNull($iterator->current());
        $iterator->next();
        self::assertNull($iterator->current());
    }

    public function testValidateNrOfPlacesPerPouleAfterNext(): void
    {
        $placesPerPouleRange = new SportRange(3, 3);
        $placesRange = new PlaceRange(10, 10, $placesPerPouleRange);
        $pouleRange = new SportRange(2, 2);
        $iterator = new BalancedPouleStructureIterator($placesRange, $pouleRange);
        self::assertNull($iterator->current());
    }
}
