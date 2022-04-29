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
        return $this->getNrOfGamesOneH2h($nrOfPlaces) * $this->getNrOfGamePlaces() * $this->getNrOfH2H();
    }

    public function getNrOfH2H(): int
    {
        return $this->nrOfH2H;
    }

    public function getTotalNrOfGames(int $nrOfPlaces): int
    {
        $totalNrOfGamePlaces = $nrOfPlaces * $this->getNrOfGamesPerPlaceOneH2h($nrOfPlaces) * $this->getNrOfH2H();
        return (int)ceil($totalNrOfGamePlaces / $this->getNrOfGamePlaces());
    }

    public function getTotalNrOfGamesPerPlace(int $nrOfPlaces): int
    {
        return $this->getNrOfGamesPerPlaceOneH2h($nrOfPlaces) * $this->getNrOfH2H();
    }

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

    public function __toString()
    {
        return parent::__toString() . $this->getNrOfH2H() . ':0';
    }

//    private function getNrOfGamePlacesOneH2h(int $nrOfPlaces): int
//    {
//        return $this->getNrOfGamesOneH2h($nrOfPlaces) * $this->getNrOfGamePlaces();
//    }
}
