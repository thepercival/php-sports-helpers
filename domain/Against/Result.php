<?php
declare(strict_types=1);

namespace SportsHelpers\Against;

enum Result: int
{
    case WIN = 1;
    case DRAW = 2;
    case LOSS = 3;
}
