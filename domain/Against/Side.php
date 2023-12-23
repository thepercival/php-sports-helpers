<?php

declare(strict_types=1);

namespace SportsHelpers\Against;

use SportsHelpers\Against\Side as AgainstSide;

enum Side: string
{
    case Home = 'home';
    case Away = 'away';

    public function getOpposite(): self
    {
        return $this === AgainstSide::Home ? AgainstSide::Away : AgainstSide::Home;
    }
}
