<?php

declare(strict_types=1);

namespace oldsportshelpers\old\Persist;

use oldsportshelpers\old\AllInOneGame;
use oldsportshelpers\old\GameMode;
use oldsportshelpers\old\Single;
use SportsHelpers\Identifiable;
use SportsHelpers\Sports\AgainstSportOneVsOne;
use SportsHelpers\Sports\AgainstSportOneVsTwo;
use SportsHelpers\Sports\AgainstSportTwoVsTwo;

class SportPersistVariant extends Identifiable
{
    public function __construct(
        protected GameMode $gameMode,
        protected int $nrOfHomePlaces,
        protected int $nrOfAwayPlaces,
        protected int $nrOfGamePlaces,
        protected int $nrOfCycles,
        protected int $nrOfCycleParts
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

    public function getNrOfCycleParts(): int
    {
        return $this->nrOfCycleParts;
    }


    public function createVariant(): Single|AllInOneGame|AgainstSportOneVsOne|AgainstSportOneVsTwo|AgainstSportTwoVsTwo
    {
        if ($this->gameMode === GameMode::Single) {
            return new Single($this->nrOfGamePlaces, $this->nrOfCycles);
        }
        if ($this->gameMode === GameMode::AllInOneGame) {
            return new AllInOneGame($this->nrOfCycles);
        }
        if( $this->nrOfHomePlaces === 1 && $this->nrOfAwayPlaces === 1 ) {
            return new AgainstSportOneVsOne($this->nrOfCycles);
        }
        if( $this->nrOfHomePlaces === 1 && $this->nrOfAwayPlaces === 2 ) {
            return new AgainstSportOneVsTwo($this->nrOfCycles);
        }
        return new AgainstSportTwoVsTwo($this->nrOfCycles);
    }
}
