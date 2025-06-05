<?php

namespace SportsHelpers;

/**
 * @psalm-api
 */
readonly class RefereeInfo
{
    public SelfRefereeInfo $selfRefereeInfo;
    public int $nrOfReferees;

    public function __construct(SelfRefereeInfo|int|null $selfRefereeInfoOrNrOfReferees = null)
    {
        $nrOfReferees = 0;
        if ($selfRefereeInfoOrNrOfReferees instanceof SelfRefereeInfo) {
            $this->selfRefereeInfo = $selfRefereeInfoOrNrOfReferees;
        } else {
            if ($selfRefereeInfoOrNrOfReferees !== null) {
                $nrOfReferees = $selfRefereeInfoOrNrOfReferees;
            }
            $this->selfRefereeInfo = new SelfRefereeInfo(SelfReferee::Disabled, 0);
        }
        $this->nrOfReferees = $nrOfReferees;
    }
}