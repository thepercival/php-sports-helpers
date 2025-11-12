<?php

declare(strict_types=1);

namespace SportsHelpers\Sport;

use SportsHelpers\GameMode;
use SportsHelpers\Sport\Variant\Against\H2h as AgainstH2h;
use SportsHelpers\Sport\Variant\Against\GamesPerPlace as AgainstGpp;
use SportsHelpers\Sport\Variant\AllInOneGame;
use SportsHelpers\Sport\Variant\Single;
use SportsHelpers\Identifiable;

final class PersistVariant extends Identifiable
{
    public function __construct(
        protected GameMode $gameMode,
        protected int $nrOfHomePlaces,
        protected int $nrOfAwayPlaces,
        protected int $nrOfGamePlaces,
        protected int $nrOfH2H,
        protected int $nrOfGamesPerPlace
    ) {
    }
    public function getGameMode(): GameMode
    {
        return $this->gameMode;
    }

    public function setGameMode(GameMode $gameMode): void
    {
        $this->gameMode = $gameMode;
    }
    public function getNrOfHomePlaces(): int
    {
        return $this->nrOfHomePlaces;
    }

    public function getNrOfAwayPlaces(): int
    {
        return $this->nrOfAwayPlaces;
    }

    public function getNrOfGamePlaces(): int
    {
        return $this->nrOfGamePlaces;
    }

    public function getNrOfH2H(): int
    {
        return $this->nrOfH2H;
    }

    public function getNrOfGamesPerPlace(): int
    {
        return $this->nrOfGamesPerPlace;
    }


    public function createVariant(): Single|AgainstH2h|AgainstGpp|AllInOneGame
    {
        if ($this->gameMode === GameMode::Single) {
            return new Single($this->nrOfGamePlaces, $this->nrOfGamesPerPlace);
        }
        if ($this->gameMode === GameMode::AllInOneGame) {
            return new AllInOneGame($this->nrOfGamesPerPlace);
        }
        if ($this->nrOfH2H > 0) {
            return new AgainstH2h($this->nrOfHomePlaces, $this->nrOfAwayPlaces, $this->nrOfH2H);
        }
        return new AgainstGpp($this->nrOfHomePlaces, $this->nrOfAwayPlaces, $this->nrOfGamesPerPlace);
    }
}
