<?php

declare(strict_types=1);

namespace SportsHelpers\SportVariants;

use SportsHelpers\GameMode;
use SportsHelpers\Sport\PersistVariant;

// gebruik bij 1 vs 1: Opgegeven in H2h(3 en 2 even vaak tegen elkaar)
// gebruik bij Mixed: NrOfGamesPerPlace(3 en 2 even veel wedstrijden)
readonly class AgainstH2h extends AgainstAbstract implements \Stringable
{
    public function __construct(int $nrOfHomePlaces, int $nrOfAwayPlaces, public int $nrOfH2h)
    {
        parent::__construct($nrOfHomePlaces, $nrOfAwayPlaces);
    }

    public function toPersistVariant(): PersistVariant
    {
        return new PersistVariant(
            $this->getGameMode(),
            $this->nrOfHomePlaces,
            $this->nrOfAwayPlaces,
            0,
            $this->nrOfH2h,
            0
        );
    }

    public function __toString(): string
    {
        return parent::__toString() . $this->nrOfH2h . ':0';
    }

//    private function getNrOfGamePlacesOneH2h(int $nrOfPlaces): int
//    {
//        return $this->getNrOfGamesOneH2h($nrOfPlaces) * $this->getNrOfGamePlaces();
//    }
}
