<?php

declare(strict_types=1);

namespace SportsHelpers;

class GameModeBase extends Identifiable
{
    public function __construct(protected GameMode $gameMode)
    {
    }

    public function getGameMode(): GameMode
    {
        return $this->gameMode;
    }
}
