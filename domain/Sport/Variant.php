<?php
declare(strict_types=1);

namespace SportsHelpers\Sport;

interface Variant extends \Stringable
{
    public function getGameMode(): int;
    public function getTotalNrOfGames(int $nrOfPlaces): int;
    public function getTotalNrOfGamesPerPlace(int $nrOfPlaces): int;
    public function allPlacesParticipateInGameRound(int $nrOfPlaces): bool;
    public function mustBeEquallyAssigned(int $nrOfPlaces): bool;
    public function toPersistVariant(): PersistVariant;
}
