<?php
declare(strict_types = 1);

namespace SportsHelpers;

class GameCreationStrategy
{
    public const StaticPouleSize = 1;
    public const StaticManual = 2;
    public const IncrementalRandom = 3;
    public const IncrementalRanking = 4;
}