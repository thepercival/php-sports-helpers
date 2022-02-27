<?php

declare(strict_types=1);

namespace SportsHelpers\Sport\Variant\Against;

use SportsHelpers\GameMode;
use SportsHelpers\Sport\PersistVariant;
use SportsHelpers\Sport\Variant;
use SportsHelpers\Sport\Variant\Against;
use SportsHelpers\SportMath;

// gebruik bij 1 vs 1: Opgegeven in H2h(3 en 2 even vaak tegen elkaar)
// gebruik bij Mixed: NrOfGamesPerPlace(3 en 2 even veel wedstrijden)
class H2h extends Against implements \Stringable
{
    public function __construct(int $nrOfHomePlaces, int $nrOfAwayPlaces, protected int $nrOfH2H)
    {
        parent::__construct($nrOfHomePlaces, $nrOfAwayPlaces);
    }

    public function getTotalNrOfGamePlaces(int $nrOfPlaces): int
    {
        return $this->getNrOfGamesOneH2H($nrOfPlaces) * $this->getNrOfGamePlaces() * $this->getNrOfH2H();
    }

    public function getNrOfH2H(): int
    {
        return $this->nrOfH2H;
    }

    public function getTotalNrOfGames(int $nrOfPlaces): int
    {
        $totalNrOfGamePlaces = $nrOfPlaces * $this->getNrOfGamesPerPlaceOneH2H($nrOfPlaces) * $this->getNrOfH2H();
        return (int)ceil($totalNrOfGamePlaces / $this->getNrOfGamePlaces());
    }

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

    public function getTotalNrOfGamesPerPlace(int $nrOfPlaces): int
    {
        return $this->getNrOfGamesPerPlaceOneH2H($nrOfPlaces) * $this->getNrOfH2H();
    }
//
////    public function getNrOfGamesOneSerie(int $nrOfPlaces): int
////    {
////        return $this->getNrOfGamesOneH2H($nrOfPlaces) * 2;
////    }
//


//
//    public function withAgainstMustBeEquallyAssigned(int $nrOfPlaces): bool
//    {
//        return $this->getNrOfGamesPerPlace() % $this->getNrOfGamesPerPlaceOneH2H($nrOfPlaces) === 0;
//    }
//

//
//
//    public function getNrOfGameRounds(int $nrOfPlaces): int
//    {
//        $nrOfGames = $this->getTotalNrOfGames($nrOfPlaces);
//        $nrOfGamesPerGameRound = (int)floor($nrOfPlaces / $this->getNrOfGamePlaces());
//        return (int)ceil($nrOfGames / $nrOfGamesPerGameRound);
//    }
//
//

    public function toPersistVariant(): PersistVariant
    {
        return new PersistVariant(
            $this->getGameMode(),
            $this->getNrOfHomePlaces(),
            $this->getNrOfAwayPlaces(),
            0,
            $this->getNrOfH2H(),
            0
        );
    }

////    protected function getNrOfPlacesPerGameRound(int $nrOfPlaces): int
////    {
////        return $nrOfPlaces - ($nrOfPlaces % $this->getNrOfGamePlaces());
////    }

    public function __toString()
    {
        return parent::__toString() . $this->getNrOfH2H() . ':0';
    }

    private function getNrOfGamePlacesOneH2H(int $nrOfPlaces): int
    {
        return $this->getNrOfGamesOneH2H($nrOfPlaces) * $this->getNrOfGamePlaces();
    }
}
