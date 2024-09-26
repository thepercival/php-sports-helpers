<?php

declare(strict_types=1);

namespace SportsHelpers\SportVariants;

use SportsHelpers\GameMode;
use SportsHelpers\Sport\PersistVariant;
use SportsHelpers\Sport\Variant;

readonly class AllInOneGame implements Variant
{
    public function __construct(public int $nrOfGamesPerPlace)
    {
    }

    public function getGameMode(): GameMode {
        return GameMode::AllInOneGame;
    }

    public function getNrOfGamesPerPlace(): int
    {
        return $this->nrOfGamesPerPlace;
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

    public function allPlacesParticipateInGameRound(int $nrOfPlaces): bool
    {
        return true;
    }

    public function toPersistVariant(): PersistVariant
    {
        return new PersistVariant(
            $this->getGameMode(),
            0,
            0,
            0,
            0,
            $this->getNrOfGamesPerPlace()
        );
    }


    public function __toString()
    {
        return 'allinone gpp=>' . $this->getNrOfGamesPerPlace();
    }
}
