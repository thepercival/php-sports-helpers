<?php

declare(strict_types=1);

namespace SportsHelpers\Sports;

readonly class TogetherSport
{
    public function __construct(protected int|null $nrOfGamePlaces )
    {
    }

    public function getNrOfGamePlaces(): int|null
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


//    public function toPersistVariant(): SportPersistVariant
//    {
//        return new SportPersistVariant(
//            $this->getGameMode(),
//            0,
//            0,
//            $this->nrOfGamePlaces,
//            0,
//            $this->nrOfGamesPerPlace,
//        );
//    }

//    public function __toString()
//    {
//        return 'single(' . $this->nrOfGamePlaces . ') gpp=>' . $this->nrOfGamesPerPlace;
//    }

//    public function toJson(): string {
//        $name = [
//            'nrOfGamesPerPlace' => $this->nrOfGamesPerPlace,
//            'nrOfGamePlaces' => $this->nrOfGamePlaces
//        ];
//        $json = json_encode($name);
//        return $json === false ? '?' : $json;
//    }
}
