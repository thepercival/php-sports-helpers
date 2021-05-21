<?php
declare(strict_types=1);

namespace SportsHelpers\Sport\Variant;

use SportsHelpers\GameMode;
use SportsHelpers\Sport\PersistVariant;
use SportsHelpers\Sport\Variant;

class AllInOneGame extends Base implements Variant
{
    public function __construct(int $nrOfGamesPerPlace)
    {
        parent::__construct(GameMode::ALL_IN_ONE_GAME, $nrOfGamesPerPlace);
    }

    public function getTotalNrOfGames(int $nrOfPlaces): int
    {
        return $this->nrOfGamesPerPlace;
    }

//    public function getNrOfGamesPerPlace(int $nrOfPlaces): int
//    {
//        return $this->nrOfGameRounds;
//    }
//
    public function getTotalNrOfGamesPerPlace(int $nrOfPlaces): int
    {
        return $this->nrOfGamesPerPlace;
    }

    public function allPlacesParticipateInGameRound(int $nrOfPlaces): bool
    {
        return true;
    }

    public function mustBeEquallyAssigned(int $nrOfPlaces): bool {
        return true;
    }

    public function toPersistVariant(): PersistVariant {
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
        return 'allinone: ' . $this->getNrOfGamesPerPlace();
    }
}
