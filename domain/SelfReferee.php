<?php

declare(strict_types=1);

namespace SportsHelpers;

enum SelfReferee: string
{
    case Disabled = 'disabled';
    case OtherPoules = 'otherPoules';
    case SamePoule = 'samePoule';
}
