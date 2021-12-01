<?php
declare(strict_types=1);

namespace SportsHelpers\Sport;

use SportsHelpers\GameMode;
use SportsHelpers\Identifiable;
use SportsHelpers\Sport\Variant\Against as AgainstSportVariant;
use SportsHelpers\Sport\Variant\AllInOneGame as AllInOneGameSportVariant;
use SportsHelpers\Sport\Variant\Single as SingleSportVariant;

class PersistVariant extends Identifiable
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
        return new AgainstSportVariant($this->nrOfHomePlaces, $this->nrOfAwayPlaces, $this->nrOfH2H, $this->nrOfGamesPerPlace);
    }
}
