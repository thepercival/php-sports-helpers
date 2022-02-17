<?php

declare(strict_types=1);

namespace SportsHelpers\Sport\Variant;

use SportsHelpers\GameMode;
use SportsHelpers\Sport\PersistVariant;
use SportsHelpers\Sport\Variant;

class Single extends Base implements Variant
{
    public function __construct(protected int $nrOfGamePlaces, protected int $nrOfGamesPerPlace)
    {
        parent::__construct(GameMode::Single);
    }

    public function getNrOfGamesPerPlace(): int
    {
        return $this->nrOfGamesPerPlace;
    }

    public function getNrOfGamePlaces(): int
    {
        return $this->nrOfGamePlaces;
    }

//    public function getNrOfGameGroups(int $nrOfPlaces): int
//    {
//
//        // iedereen 3x, 2 gameplaces, bij [3]=>
//        $this->getTotalNrOfGamePlaces($nrOfPlaces)
//
//        return (int)ceil($this->getTotalNrOfGamePlaces($nrOfPlaces) / $this->getNrOfGamePlaces());
//
//        $totalNrOfGamePlaces = $this->getTotalNrOfGamePlaces($nrOfPlaces);
//        $nrOfGamesPerGameRound = (int)floor($nrOfPlaces / $this->getNrOfGamePlaces());
//        return (int)ceil($totalNrOfGames / $nrOfGamesPerGameRound);
//    }


//    public function getNrOfGamesPerPlace(int $nrOfPlaces): int
//    {
    //$this->getNrOfGameRounds()
//        return $this->nrOfGameRounds * ;
//    }


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
        return 'single(' . $this->getNrOfGamePlaces() . ') gpp=>' . $this->getNrOfGamesPerPlace();
    }
}
