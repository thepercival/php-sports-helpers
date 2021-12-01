<?php
declare(strict_types=1);

namespace SportsHelpers;

enum GameMode: int
{
    case SINGLE = 1;
    case AGAINST = 2;
    case ALL_IN_ONE_GAME = 3;
}
