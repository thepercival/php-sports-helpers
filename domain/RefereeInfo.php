<?php

namespace SportsHelpers;

/**
 * @psalm-api
 */
readonly class RefereeInfo
{
//    public SelfRefereeInfo $selfRefereeInfo;
//    public int $nrOfReferees;

//    public function __construct(SelfRefereeInfo|int|null $selfRefereeInfoOrNrOfReferees = null)
//    {
//        $nrOfReferees = 0;
//        if ($selfRefereeInfoOrNrOfReferees instanceof SelfRefereeInfo) {
//            $this->selfRefereeInfo = $selfRefereeInfoOrNrOfReferees;
//        } else {
//            if ($selfRefereeInfoOrNrOfReferees !== null) {
//                $nrOfReferees = $selfRefereeInfoOrNrOfReferees;
//            }
//            $this->selfRefereeInfo = new SelfRefereeInfo(SelfReferee::Disabled, 0);
//        }
//        $this->nrOfReferees = $nrOfReferees;
//    }

    private function __construct(public SelfRefereeInfo|null $selfRefereeInfo, public int $nrOfReferees )
    {

    }

    public static function fromSelfRefereeInfo(SelfRefereeInfo $selfRefereeInfo): self {
        return new self($selfRefereeInfo, 0);
    }

    public static function fromNrOfReferees(int $nrOfReferees): self {
        return new self(null, $nrOfReferees);
    }
}