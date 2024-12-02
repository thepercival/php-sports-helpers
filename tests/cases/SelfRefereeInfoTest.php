<?php

declare(strict_types=1);

namespace SportsHelpers\Tests;

use PHPUnit\Framework\TestCase;
use SportsHelpers\SelfReferee;
use SportsHelpers\SelfRefereeInfo;

final class SelfRefereeInfoTest extends TestCase
{
    public function testDisabled(): void
    {
        $selfRefereeInfo = new SelfRefereeInfo(SelfReferee::Disabled, 1);
        self::assertEquals(0, $selfRefereeInfo->nrIfSimSelfRefs);
    }
    
    public function testNotDisabledSmallerThanOne(): void
    {
        $selfRefereeInfo = new SelfRefereeInfo(SelfReferee::SamePoule, 0);
        self::assertEquals(1, $selfRefereeInfo->nrIfSimSelfRefs);
    }

    public function testNotDisabledGreaterThanZero(): void
    {
        $selfRefereeInfo = new SelfRefereeInfo(SelfReferee::SamePoule, 1);
        self::assertEquals(1, $selfRefereeInfo->nrIfSimSelfRefs);
    }
}
