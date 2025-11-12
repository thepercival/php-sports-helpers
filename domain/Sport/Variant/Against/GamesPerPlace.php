<?php

declare(strict_types=1);

namespace SportsHelpers\Sport\Variant\Against;

use SportsHelpers\Against\Side;
use SportsHelpers\GameMode;
use SportsHelpers\Sport\PersistVariant;
use SportsHelpers\Sport\Variant;
use SportsHelpers\Sport\Variant\Against;
use SportsHelpers\SportMath;

// gebruik bij 1 vs 1: Opgegeven in H2h(3 en 2 even vaak tegen elkaar)
// gebruik bij Mixed: NrOfGamesPerPlace(3 en 2 even veel wedstrijden)
final class GamesPerPlace extends Against implements \Stringable
{
    public function __construct(int $nrOfHomePlaces, int $nrOfAwayPlaces, protected int $nrOfGamesPerPlace)
    {
        parent::__construct($nrOfHomePlaces, $nrOfAwayPlaces);
    }

    ////    protected function getNrOfPlacesOneH2H(int $nrOfPlaces): int
    ////    {
    ////        return $this->getNrOfGamesOneH2h($nrOfPlaces) * $this->getNrOfGamePlaces();
    ////    }
    ////
//

//
//    protected function getNrOfPlacesOneGameRound(int $nrOfPlaces): int
//    {
//        return $nrOfPlaces - ($nrOfPlaces % $this->getNrOfGamePlaces());
//    }
//
//    public function getNrOfGamesOneGameRound(int $nrOfPlaces): int
//    {
//        $nrOfPlacesPerGameRound = $this->getNrOfPlacesOneGameRound($nrOfPlaces);
//        return (int)($nrOfPlacesPerGameRound / $this->getNrOfGamePlaces());
//    }
//

    public function getNrOfGamesPerPlace(): int
    {
        return $this->nrOfGamesPerPlace;
    }

//
    ////    public function getNrOfGamesOneSerie(int $nrOfPlaces): int
    ////    {
    ////        return $this->getNrOfGamesOneH2h($nrOfPlaces) * 2;
    ////    }
//
//
//    public function withAgainstMustBeEquallyAssigned(int $nrOfPlaces): bool
//    {
//        return $this->getNrOfGamesPerPlace() % $this->getNrOfGamesPerPlaceOneH2h($nrOfPlaces) === 0;
//    }
//
//    public function allPlacesPlaySameNrOfGames(int $nrOfPlaces): bool
//    {
//        $totalNrOfGamePlaces = $this->getNrOfGamesPerPlace() * $nrOfPlaces;
//        return (int)ceil($totalNrOfGamePlaces / $this->getNrOfGamePlaces());
//
//        alleen als het totaal aantal gameplaces deelbaar is door het aantal places
//        return ($this->getTotalNrOfGames($nrOfPlaces) % $this->getNrOfGamesOneH2h($nrOfPlaces)) === 0;
//    }
//
//    public function allPlacesPlayH2h(int $nrOfPlaces): bool
//    {
//        return ($this->getTotalNrOfGames($nrOfPlaces) % $this->getNrOfGamesOneH2h($nrOfPlaces)) === 0;
//    }
//
//
//    public function getNrOfGameRounds(int $nrOfPlaces): int
//    {
//        $nrOfGames = $this->getTotalNrOfGames($nrOfPlaces);
//        $nrOfGamesPerGameRound = (int)floor($nrOfPlaces / $this->getNrOfGamePlaces());
//        return (int)ceil($nrOfGames / $nrOfGamesPerGameRound);
//    }

    #[\Override]
    public function toPersistVariant(): PersistVariant
    {
        return new PersistVariant(
            $this->getGameMode(),
            $this->getNrOfHomePlaces(),
            $this->getNrOfAwayPlaces(),
            0,
            0,
            $this->getNrOfGamesPerPlace()
        );
    }

    #[\Override]
    public function __toString(): string
    {
        return parent::__toString() . '0:' . $this->getNrOfGamesPerPlace();
    }
}
