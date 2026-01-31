<?php

declare(strict_types=1);

namespace SportsHelpers\Sport\Variant;

use SportsHelpers\GameMode;
use SportsHelpers\Identifiable;

class Base extends Identifiable
{
    public function __construct(protected GameMode $gameMode)
    {
    }

    public function getGameMode(): GameMode
    {
        return $this->gameMode;
    }
}