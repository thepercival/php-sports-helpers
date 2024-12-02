<?php

declare(strict_types=1);

namespace SportsHelpers\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use SportsHelpers\PlaceRanges;
use SportsHelpers\PouleStructures\BalancedPouleStructure as BalancedPouleStructure;
use SportsHelpers\RefereeInfo;
use SportsHelpers\SelfReferee;
use SportsHelpers\SelfRefereeInfo;
use SportsHelpers\SportVariants\AgainstOneVsOne;
use SportsHelpers\SportVariants\AgainstTwoVsTwo;
use SportsHelpers\SportVariants\AllInOneGame as AllInOneGameSportVariant;
use SportsHelpers\SportVariants\Helpers\MinNrOfPlacesCalculator;
use SportsHelpers\SportVariants\Single as SingleSportVariant;

final class RefereeInfoTest extends TestCase
{
    public function testRefereeInfoSelfReferee(): void
    {
        $selfRefereeInfo = new SelfRefereeInfo(SelfReferee::Disabled, 1);
        $refereeInfo = new RefereeInfo($selfRefereeInfo);
        self::assertEquals($selfRefereeInfo, $refereeInfo->selfRefereeInfo);
        self::assertEquals(0, $refereeInfo->nrOfReferees);
    }

    public function testRefereeInfoNoParams(): void
    {
        $refereeInfo = new RefereeInfo();
        self::assertEquals(SelfReferee::Disabled, $refereeInfo->selfRefereeInfo->selfReferee);
        self::assertEquals(0, $refereeInfo->nrOfReferees);
    }

    public function testRefereeInfoNrOfReferees(): void
    {
        $refereeInfo = new RefereeInfo(12);
        self::assertEquals(SelfReferee::Disabled, $refereeInfo->selfRefereeInfo->selfReferee);
        self::assertEquals(12, $refereeInfo->nrOfReferees);
    }

}
