<?php
declare(strict_types=1);

namespace SportsHelpers\Sport\Variant;

use SportsHelpers\GameMode;
use SportsHelpers\Sport\PersistVariant;
use SportsHelpers\Sport\Variant;

class Single extends Base implements Variant
{
    public function __construct(protected int $nrOfGamePlaces, int $nrOfGamesPerPlace)
    {
        parent::__construct(GameMode::SINGLE, $nrOfGamesPerPlace);
    }

    public function getNrOfGamePlaces(): int
    {
        return $this->nrOfGamePlaces;
    }

    public function getTotalNrOfGames(int $nrOfPlaces): int
    {
        $totalNrOfPlaces = $nrOfPlaces * $this->getNrOfGamesPerPlace();
        return (int)ceil($totalNrOfPlaces / $this->getNrOfGamePlaces());
    }

//    public function getMaxNrOfGameRounds(int $nrOfPlaces): int
//    {
//        $totalNrOfGames = $this->getTotalNrOfGames($nrOfPlaces);
//        $nrOfGamesPerGameRound = (int)floor($nrOfPlaces / $this->getNrOfGamePlaces());
//        return (int)ceil($totalNrOfGames / $nrOfGamesPerGameRound);
//    }

    public function getTotalNrOfGamesPerPlace(int $nrOfPlaces): int
    {
        return $this->getNrOfGamesPerPlace();
    }

//    public function getNrOfGamesPerPlace(int $nrOfPlaces): int
//    {
    //$this->getNrOfGameRounds()
//        return $this->nrOfGameRounds * ;
//    }

    protected function getNrOfPlacesPerGameRound(int $nrOfPlaces): int
    {
        return $nrOfPlaces - ($nrOfPlaces % $this->getNrOfGamePlaces());
    }


    public function allPlacesParticipateInGameRound(int $nrOfPlaces): bool
    {
        return $nrOfPlaces === $this->getNrOfPlacesPerGameRound($nrOfPlaces);
    }

    public function mustBeEquallyAssigned(int $nrOfPlaces): bool {
        return true;
    }

    public function toPersistVariant(): PersistVariant
    {
        return new PersistVariant(
            $this->getGameMode(),
            0,
            0,
            $this->getNrOfGamePlaces(),
            0,
            $this->getNrOfGamesPerPlace(),
        );
    }

    public function __toString()
    {
        return 'single: ' . $this->getNrOfGamePlaces() . ' x ' . $this->getNrOfGamesPerPlace();
    }
}
