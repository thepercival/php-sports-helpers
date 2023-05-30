<?php

namespace SportsHelpers;

class SelfRefereeInfo
{
    public int $nrIfSimSelfRefs = 0;
    public function __construct(public SelfReferee $selfReferee, int $nrIfSimSelfRefs)
    {
        if ($selfReferee !== SelfReferee::Disabled) {
            if( $nrIfSimSelfRefs > 0 ) {
                $this->nrIfSimSelfRefs = $nrIfSimSelfRefs;
            } else {
                $this->nrIfSimSelfRefs = 1;
            }
        }
    }
}