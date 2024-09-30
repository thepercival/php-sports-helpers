<?php

declare(strict_types=1);

namespace SportsHelpers\Sport;

use SportsHelpers\GameMode;
use SportsHelpers\Identifiable;
use SportsHelpers\SportVariants\AgainstOneVsTwo;
use SportsHelpers\SportVariants\AgainstTwoVsTwo;
use SportsHelpers\SportVariants\AllInOneGame;
use SportsHelpers\SportVariants\AgainstOneVsOne;
use SportsHelpers\SportVariants\Single;

class PersistVariant extends Identifiable
{
    public function __construct(
        protected GameMode $gameMode,
        protected int $nrOfHomePlaces,
        protected int $nrOfAwayPlaces,
        protected int $nrOfGamePlaces,
        protected int $nrOfCycles,
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

    public function getNrOfCycles(): int
    {
        return $this->nrOfCycles;
    }

    public function getNrOfGamesPerPlace(): int
    {
        return $this->nrOfGamesPerPlace;
    }


    public function createVariant(): Single|AllInOneGame|AgainstOneVsOne|AgainstOneVsTwo|AgainstTwoVsTwo
    {
        if ($this->gameMode === GameMode::Single) {
            return new Single($this->nrOfGamePlaces, $this->nrOfGamesPerPlace);
        }
        if ($this->gameMode === GameMode::AllInOneGame) {
            return new AllInOneGame($this->nrOfGamesPerPlace);
        }
        if( $this->nrOfHomePlaces === 1 && $this->nrOfAwayPlaces === 1 ) {
            return new AgainstOneVsOne($this->nrOfCycles);
        }
        if( $this->nrOfHomePlaces === 1 && $this->nrOfAwayPlaces === 2 ) {
            return new AgainstOneVsTwo($this->nrOfCycles);
        }
        return new AgainstTwoVsTwo($this->nrOfCycles);
    }
}
