<?php
declare(strict_types=1);

namespace SportsHelpers;

enum SelfReferee: int
{
    case DISABLED = 0;
    case OTHERPOULES = 1;
    case SAMEPOULE = 2;
}
