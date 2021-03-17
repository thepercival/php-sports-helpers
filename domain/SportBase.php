<?php
declare(strict_types=1);

namespace SportsHelpers;

class SportBase extends Identifiable
{
    public function __construct(protected int $gameMode, protected int $nrOfGamePlaces)
    {
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