<?php
declare(strict_types=1);

namespace SportsHelpers\Sport;

use SportsHelpers\GameMode;
use SportsHelpers\Identifiable;
use SportsHelpers\Sport\Variant\Single as SingleSportVariant;
use SportsHelpers\Sport\Variant\Against as AgainstSportVariant;
use SportsHelpers\Sport\Variant\AllInOneGame as AllInOneGameSportVariant;

class PersistVariant extends Identifiable
{
    public function __construct(
        protected int $gameMode,
        protected int $nrOfHomePlaces,
        protected int $nrOfAwayPlaces,
        protected int $nrOfH2H,
        protected int $nrOfPartials,
        protected int $nrOfGamePlaces,
        protected int $nrOfGamesPerPlace
    ) {
    }

    public function getGameMode(): int {
        return $this->gameMode;
    }

    public function getNrOfHomePlaces(): int
    {
        return $this->nrOfHomePlaces;
    }

    public function getNrOfAwayPlaces(): int
    {
        return $this->nrOfAwayPlaces;
    }

    public function getNrOfH2H(): int
    {
        return $this->nrOfH2H;
    }

    public function getNrOfPartials(): int
    {
        return $this->nrOfPartials;
    }

    public function getNrOfGamePlaces(): int
    {
        return $this->nrOfGamePlaces;
    }

    public function getNrOfGamesPerPlace(): int
    {
        return $this->nrOfGamesPerPlace;
    }

    public function createVariant(): SingleSportVariant|AgainstSportVariant|AllInOneGameSportVariant
    {
        if ($this->gameMode === GameMode::SINGLE) {
            return new SingleSportVariant($this->nrOfGamePlaces, $this->nrOfGamesPerPlace);
        }
        if ($this->gameMode === GameMode::ALL_IN_ONE_GAME) {
            return new AllInOneGameSportVariant($this->nrOfGamesPerPlace);
        }
        if ($this->nrOfHomePlaces + $this->nrOfAwayPlaces > 2) {
            return new AgainstSportVariant($this->nrOfHomePlaces, $this->nrOfAwayPlaces, 0, $this->nrOfPartials);
        }
        return new AgainstSportVariant($this->nrOfHomePlaces, $this->nrOfAwayPlaces, $this->nrOfH2H, 0);
    }
}
