<?php
declare(strict_types=1);

namespace SportsHelpers\Sport\Variant;

use SportsHelpers\GameMode;
use SportsHelpers\Identifiable;
use SportsHelpers\Sport\PersistVariant;
use SportsHelpers\Sport\Variant;

class Single extends Identifiable implements Variant
{
    protected int $gameMode;

    public function __construct(protected int $nrOfGamePlaces, protected int $nrOfGamesPerPlace)
    {
        $this->gameMode = GameMode::SINGLE;
    }

    public function getGameMode(): int
    {
        return $this->gameMode;
    }

    public function getNrOfGamePlaces(): int
    {
        return $this->nrOfGamePlaces;
    }

    public function getNrOfGamesPerPlace(): int
    {
        return $this->nrOfGamesPerPlace;
    }

    public function getTotalNrOfGames(int $nrOfPlaces): int
    {
        $totalNrOfGamePlaces = $nrOfPlaces * $this->getNrOfGamesPerPlace();
        return (int)ceil($totalNrOfGamePlaces / $this->getNrOfGamePlaces());
    }

    public function getMaxNrOfGameRounds(int $nrOfPlaces): int
    {
        $totalNrOfGames = $this->getTotalNrOfGames($nrOfPlaces);
        $nrOfGamesPerGameRound = (int)floor($nrOfPlaces / $this->getNrOfGamePlaces());
        return (int)ceil($totalNrOfGames / $nrOfGamesPerGameRound);
    }

    public function getTotalNrOfGamesPerPlace(int $nrOfPlaces): int
    {
        return $this->getNrOfGamesPerPlace();
    }

    public function allPlacesParticipate(int $nrOfPlaces): bool
    {
        return $this->getNrOfGamePlaces() >= $nrOfPlaces;
    }

    public function createPersistVariant(): PersistVariant {
        return new PersistVariant(
            $this->getGameMode(),
            0,
            0,
            0,
            0,
            $this->getNrOfGamePlaces(),
            $this->getNrOfGamesPerPlace(),
        );
    }

    public function __toString()
    {
        return 'SINGLE: ' . $this->getNrOfGamePlaces() . ' x ' . $this->getNrOfGamesPerPlace();
    }
}
