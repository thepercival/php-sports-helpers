<?php

namespace SportsHelpers;

class RefereeInfo
{
    public SelfRefereeInfo $selfRefereeInfo;
    public int $nrOfReferees = 0;

    public function __construct(SelfRefereeInfo|int|null $selfRefereeInfoOrNrOfReferees = null)
    {
        if ($selfRefereeInfoOrNrOfReferees instanceof SelfRefereeInfo) {
            $this->selfRefereeInfo = $selfRefereeInfoOrNrOfReferees;
        } else {
            if ($selfRefereeInfoOrNrOfReferees !== null) {
                $this->nrOfReferees = $selfRefereeInfoOrNrOfReferees;
            }
            $this->selfRefereeInfo = new SelfRefereeInfo(SelfReferee::Disabled, 0);
        }
    }
}