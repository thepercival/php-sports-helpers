<?php

declare(strict_types=1);

namespace SportsHelpers\Tests;

use PHPUnit\Framework\TestCase;
use SportsHelpers\SelfReferee;
use SportsHelpers\SelfRefereeInfo;

final class SelfRefereeInfoTest extends TestCase
{
    public function testNotDisabledSmallerThanOne(): void
    {
        self::expectException(\Exception::class);
        $selfRefereeInfo = new SelfRefereeInfo(SelfReferee::SamePoule, 0);
    }

    public function testNotDisabledGreaterThanZero(): void
    {
        $selfRefereeInfo = new SelfRefereeInfo(SelfReferee::SamePoule, 2);
        self::assertEquals(2, $selfRefereeInfo->nrOfSimSelfRefs);
    }
}
