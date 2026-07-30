<?php

declare(strict_types=1);

namespace oldsportshelpers\old;

// new version
enum GameMode: string
{
    case Single = 'single';
    case Against = 'against';
    case AllInOneGame = 'allInOneGame';
}
