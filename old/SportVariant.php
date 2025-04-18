<?php

declare(strict_types=1);

namespace oldsportshelpers\old;

use oldsportshelpers\old\Persist\SportPersistVariant;

interface SportVariant extends \Stringable
{
    public function getGameMode(): GameMode;

    public function toPersistVariant(): SportPersistVariant;

//    public function getTotalNrOfGames(int $nrOfPlaces): int;
//
//    public function getNrOfGameRounds(int $nrOfPlaces): int;
//
//    public function getTotalNrOfGamesPerPlace(int $nrOfPlaces): int;
//
//    public function allPlacesParticipateInGameRound(int $nrOfPlaces): bool;
//
//    public function canAllGamePlacesBeEquallyAssigned(int $nrOfPlaces): bool;
}
