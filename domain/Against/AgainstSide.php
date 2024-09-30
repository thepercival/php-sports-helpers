<?php

declare(strict_types=1);

namespace SportsHelpers\Against;

use SportsHelpers\Against\AgainstSide as AgainstSide;

enum AgainstSide: string
{
    case Home = 'home';
    case Away = 'away';

    public function getOpposite(): self
    {
        return $this === AgainstSide::Home ? AgainstSide::Away : AgainstSide::Home;
    }
}
