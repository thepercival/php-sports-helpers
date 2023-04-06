<?php

namespace SportsHelpers;

class SelfRefereeInfo
{
    public bool $multipleSimSelfRefs = false;
    public function __construct(public SelfReferee $selfReferee, bool $multipleSimSelfRefs = false)
    {
        if ($selfReferee !== SelfReferee::Disabled) {
            $this->multipleSimSelfRefs = $multipleSimSelfRefs;
        }
    }
}