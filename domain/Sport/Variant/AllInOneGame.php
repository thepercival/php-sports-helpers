<?php

declare(strict_types=1);

namespace SportsHelpers\Sport\Variant;

use SportsHelpers\GameMode;
use SportsHelpers\Sport\PersistVariant;
use SportsHelpers\Sport\Variant;

final class AllInOneGame extends Base implements Variant
{
    public function __construct(protected int $nrOfGamesPerPlace)
    {
        parent::__construct(GameMode::AllInOneGame);
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

    #[\Override]
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
