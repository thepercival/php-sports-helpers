<?php

namespace SportsHelpers;

final readonly class SelfRefereeInfo
{
    public int $nrIfSimSelfRefs;
    public function __construct(public SelfReferee $selfReferee, int $nrIfSimSelfRefsParam = 0)
    {
        $nrIfSimSelfRefs = null;
        if ($selfReferee !== SelfReferee::Disabled) {
            if( $nrIfSimSelfRefsParam > 0 ) {
                $nrIfSimSelfRefs = $nrIfSimSelfRefsParam;
            } else {
                $nrIfSimSelfRefs = 1;
            }
        }
        $this->nrIfSimSelfRefs = $nrIfSimSelfRefs ?? 0;
    }
}