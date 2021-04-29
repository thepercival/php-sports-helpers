<?php
declare(strict_types=1);

namespace SportsHelpers\Sport\Variant;

use SportsHelpers\GameMode;
use SportsHelpers\Identifiable;
use SportsHelpers\Sport\PersistVariant;
use SportsHelpers\Sport\Variant;

class AllInOneGame extends Identifiable implements Variant
{
    protected int $gameMode;

    public function __construct(protected int $nrOfGamesPerPlace)
    {
        $this->gameMode = GameMode::ALL_IN_ONE_GAME;
    }

    public function getGameMode(): int
    {
        return $this->gameMode;
    }

    public function getNrOfGames(): int
    {
        return $this->nrOfGamesPerPlace;
    }

    public function getTotalNrOfGames(int $nrOfPlaces): int
    {
        return $this->nrOfGamesPerPlace;
    }

    public function getNrOfGamesPerPlace(int $nrOfPlaces): int
    {
        return $this->nrOfGamesPerPlace;
    }

    public function getTotalNrOfGamesPerPlace(int $nrOfPlaces): int
    {
        return $this->nrOfGamesPerPlace;
    }

    public function allPlacesParticipate(int $nrOfPlaces): bool
    {
        return true;
    }

    public function createPersistVariant(): PersistVariant {
        return new PersistVariant(
            $this->getGameMode(),
            0,
            0,
            0,
            0,
            0,
            $this->getNrOfGames(),
        );
    }


    public function __toString()
    {
        return 'ALLINONE: ' . $this->getNrOfGames();
    }
}
