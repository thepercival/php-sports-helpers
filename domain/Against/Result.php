<?php

declare(strict_types=1);

namespace SportsHelpers\Against;

enum Result: int
{
    case Win = 1;
    case Draw = 2;
    case Loss = 3;
}
