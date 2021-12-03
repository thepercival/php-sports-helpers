<?php

declare(strict_types=1);

namespace SportsHelpers;

enum SelfReferee: int
{
    case Disabled = 0;
    case OtherPoules = 1;
    case SamePoule = 2;
}
