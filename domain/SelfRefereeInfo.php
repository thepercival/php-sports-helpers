<?php

namespace SportsHelpers;

final class SelfRefereeInfo
{
    public function __construct(public SelfReferee $selfReferee, public int $nrOfSimSelfRefs = 1)
    {
        if( $nrOfSimSelfRefs < 1 ) {
            throw new \Exception("Nr of sim self referee must be a positive integer");
        }
    }
}