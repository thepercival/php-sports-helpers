<?php

declare(strict_types=1);

namespace SportsHelpers\Sport;

use SportsHelpers\GameMode;

interface Variant extends \Stringable
{
    public function getGameMode(): GameMode;

    public function getTotalNrOfGames(int $nrOfPlaces): int;

    public function getNrOfGameRounds(int $nrOfPlaces): int;

    public function getTotalNrOfGamesPerPlace(int $nrOfPlaces): int;

    public function allPlacesParticipateInGameRound(int $nrOfPlaces): bool;

    public function mustBeEquallyAssigned(int $nrOfPlaces): bool;

    public function toPersistVariant(): PersistVariant;
}
