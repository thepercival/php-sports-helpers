<?php

declare(strict_types=1);

namespace SportsHelpers\Against;

use SportsHelpers\Against\Side as AgainstSide;

enum Side: int
{
    case Home = 1;
    case Away = 2;

    public function getOpposite(): self
    {
        return $this === AgainstSide::Home ? AgainstSide::Away : AgainstSide::Home;
    }
}
