<?php

declare(strict_types=1);

namespace oldsportshelpers\old;

use oldsportshelpers\old\Persist\SportPersistVariant;

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
            null,
            null,
            null,
            $this->nrOfGames,
            null
        );
    }


    public function __toString()
    {
        return 'allinone gpp=>' . $this->nrOfCycles;
    }
}
