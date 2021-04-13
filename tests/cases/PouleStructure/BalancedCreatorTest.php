<?php
declare(strict_types=1);

namespace SportsHelpers\Tests\PouleStructure;

use PHPUnit\Framework\TestCase;
use SportsHelpers\PouleStructure\BalancedCreator;

final class BalancedCreatorTest extends TestCase
{
    public function test11PlacesAnd2Poules(): void
    {
        $balancedCreator = new BalancedCreator();
        $balancedStructure = $balancedCreator->createBalanced(11, 2);
        self::assertSame(11, $balancedStructure->getNrOfPlaces());
        self::assertSame(2, $balancedStructure->getNrOfPoules());
        self::assertSame(6, $balancedStructure->getBiggestPoule());
        self::assertSame(5, $balancedStructure->getSmallestPoule());
    }

    public function test11PlacesAnd3Poules(): void
    {
        $balancedCreator = new BalancedCreator();
        $balancedStructure = $balancedCreator->createBalanced(11, 3);
        self::assertSame(11, $balancedStructure->getNrOfPlaces());
        self::assertSame(3, $balancedStructure->getNrOfPoules());
        self::assertSame(4, $balancedStructure->getBiggestPoule());
        self::assertSame(3, $balancedStructure->getSmallestPoule());
    }
}
