<?php

declare(strict_types=1);

namespace oldsportshelpers\old;

enum GameMode: string
{
    case Single = 'single';
    case Against = 'against';
    case AllInOneGame = 'allInOneGame';
}
