<?php

declare(strict_types=1);

namespace SportsHelpers\SportVariants;

use SportsHelpers\GameMode;
use SportsHelpers\SportVariants\Persist\SportPersistVariant;

readonly class AllInOneGame implements SportVariant
{
    public function __construct(public int $nrOfCycles)
    {
    }

    public function getGameMode(): GameMode {
        return GameMode::AllInOneGame;
    }

//    public function getTotalNrOfGames(int $nrOfPlaces): int
//    {
//        return $this->nrOfGamesPerPlace;
//    }

//    public function getNrOfGamesPerPlace(int $nrOfPlaces): int
//    {
//        return $this->nrOfGameRounds;
//    }
//

//    public function allPlacesParticipateInGameRound(int $nrOfPlaces): bool
//    {
//        return true;
//    }

    public function toPersistVariant(): SportPersistVariant
    {
        return new SportPersistVariant(
            $this->getGameMode(),
            0,
            0,
            0,
            $this->nrOfCycles,
            0
        );
    }


    public function __toString()
    {
        return 'allinone gpp=>' . $this->nrOfCycles;
    }
}
