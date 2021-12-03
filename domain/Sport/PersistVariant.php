<?php

declare(strict_types=1);

namespace SportsHelpers\Sport;

use SportsHelpers\GameMode;
use SportsHelpers\Sport\Variant\Against as AgainstSportVariant;
use SportsHelpers\Sport\Variant\AllInOneGame as AllInOneGameSportVariant;
use SportsHelpers\Sport\Variant\Base as BaseVariant;
use SportsHelpers\Sport\Variant\Single as SingleSportVariant;

class PersistVariant extends BaseVariant
{
    public function __construct(
        GameMode $gameMode,
        protected int $nrOfHomePlaces,
        protected int $nrOfAwayPlaces,
        protected int $nrOfGamePlaces,
        protected int $nrOfH2H,
        int $nrOfGamesPerPlace
    ) {
        parent::__construct($gameMode, $nrOfGamesPerPlace);
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

    public function createVariant(): SingleSportVariant|AgainstSportVariant|AllInOneGameSportVariant
    {
        if ($this->gameMode === GameMode::Single) {
            return new SingleSportVariant($this->nrOfGamePlaces, $this->nrOfGamesPerPlace);
        }
        if ($this->gameMode === GameMode::AllInOneGame) {
            return new AllInOneGameSportVariant($this->nrOfGamesPerPlace);
        }
        return new AgainstSportVariant(
            $this->nrOfHomePlaces,
            $this->nrOfAwayPlaces,
            $this->nrOfH2H,
            $this->nrOfGamesPerPlace
        );
    }

    public function getGameModeNative(): int
    {
        return $this->gameMode->value;
    }

    public function setGameModeNative(int $gameMode): void
    {
        /** @psalm-suppress MixedAssignment, UndefinedMethod */
        $this->gameMode = GameMode::from($gameMode);
    }
}
