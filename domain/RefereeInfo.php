<?php

namespace SportsHelpers;

/**
 * @api
 */
readonly class RefereeInfo
{
    public SelfRefereeInfo $selfRefereeInfo;

    protected function __construct(SelfRefereeInfo|null $selfRefereeInfo = null, public int $nrOfReferees = 0 )
    {
        $this->selfRefereeInfo = $selfRefereeInfo ?? new SelfRefereeInfo(SelfReferee::Disabled);
    }

    public static function fromSelfRefereeInfo(SelfRefereeInfo $selfRefereeInfo): self {
        return new self($selfRefereeInfo, 0);
    }

    public static function fromNrOfReferees(int $nrOfReferees): self {
        return new self(null, $nrOfReferees);
    }
}