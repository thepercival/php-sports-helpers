<?php
declare(strict_types=1);

namespace SportsHelpers;

class SportBase extends Identifiable
{
    protected int $gameMode;
    protected int $nrOfGamePlaces;

    public function __construct(int $gameMode, int $nrOfGamePlaces)
    {
        $this->nrOfGamePlaces = $nrOfGamePlaces;
        $this->gameMode = $gameMode;
    }

    public function getGameMode(): int
    {
        return $this->gameMode;
    }

    public function getNrOfGamePlaces(): int
    {
        return $this->nrOfGamePlaces;
    }

}