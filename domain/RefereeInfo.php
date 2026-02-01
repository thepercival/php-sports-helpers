<?php

namespace SportsHelpers;

/**
 * @api
 */
class RefereeInfo
{
    protected function __construct(public SelfRefereeInfo|null $selfRefereeInfo = null, public int $nrOfReferees = 0 )
    {

    }

    public static function fromSelfRefereeInfo(SelfRefereeInfo $selfRefereeInfo): self {
        return new self($selfRefereeInfo, 0);
    }

    public static function fromNrOfReferees(int $nrOfReferees): self {
        return new self(null, $nrOfReferees);
    }
}