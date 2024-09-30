<?php

declare(strict_types=1);

namespace SportsHelpers\Against;

enum AgainstResult: string
{
    case Win = 'win';
    case Draw = 'draw';
    case Loss = 'loss';
}
