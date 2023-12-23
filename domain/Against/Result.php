<?php

declare(strict_types=1);

namespace SportsHelpers\Against;

enum Result: string
{
    case Win = 'win';
    case Draw = 'draw';
    case Loss = 'loss';
}
