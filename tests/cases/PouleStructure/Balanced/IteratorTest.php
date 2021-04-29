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
        $placesRange = new SportRange(10, 20);
        $placesPerPouleRange = new SportRange(4, 4);
        $pouleRange = new SportRange(4, 4);
        $iterator = new BalancedPouleStructureIterator($placesRange, $placesPerPouleRange, $pouleRange);
        self::expectException(Exception::class);
        $iterator->rewind();
    }

    public function testNormalCase(): void
    {
        $placesRange = new SportRange(10, 20);
        $placesPerPouleRange = new SportRange(4, 5);
        $pouleRange = new SportRange(4, 5);
        $iterator = new BalancedPouleStructureIterator($placesRange, $placesPerPouleRange, $pouleRange);
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
        $placesRange = new SportRange(5, 10);
        $placesPerPouleRange = new SportRange(4, 5);
        $iterator = new BalancedPouleStructureIterator($placesRange,$placesPerPouleRange);
        $balancedPouleStructure = $iterator->current();
        self::assertNotNull($balancedPouleStructure);
        self::assertSame([5], $balancedPouleStructure->toArray());
    }

    public function testKey(): void
    {
        $placesRange = new SportRange(10, 10);
        $placesPerPouleRange = new SportRange(5, 5);
        $pouleRange = new SportRange(2, 2);
        $iterator = new BalancedPouleStructureIterator($placesRange, $placesPerPouleRange, $pouleRange);
        self::assertSame("5,5", $iterator->key());
    }

    public function testValid(): void
    {
        $placesRange = new SportRange(10, 10);
        $placesPerPouleRange = new SportRange(5, 5);
        $pouleRange = new SportRange(2, 2);
        $iterator = new BalancedPouleStructureIterator($placesRange, $placesPerPouleRange, $pouleRange);
        self::assertTrue($iterator->valid());
        $iterator->next();
        self::assertFalse($iterator->valid());
    }

    public function testNoPossibilities(): void
    {
        $placesRange = new SportRange(10, 15);
        $placesPerPouleRange = new SportRange(4, 5);
        $pouleRange = new SportRange(4, 5);
        $iterator = new BalancedPouleStructureIterator($placesRange, $placesPerPouleRange, $pouleRange);
        self::assertNull($iterator->current());
    }

    public function testNextWithNoCurrent(): void
    {
        $placesRange = new SportRange(10, 15);
        $placesPerPouleRange = new SportRange(4, 5);
        $pouleRange = new SportRange(4, 5);
        $iterator = new BalancedPouleStructureIterator($placesRange, $placesPerPouleRange, $pouleRange);
        self::assertNull($iterator->current());
        $iterator->next();
        self::assertNull($iterator->current());
    }

    public function testValidateNrOfPlacesPerPouleAfterNext(): void
    {
        $placesRange = new SportRange(10, 10);
        $placesPerPouleRange = new SportRange(3, 3);
        $pouleRange = new SportRange(2, 2);
        $iterator = new BalancedPouleStructureIterator($placesRange, $placesPerPouleRange, $pouleRange);
        self::assertNull($iterator->current());
    }
}
