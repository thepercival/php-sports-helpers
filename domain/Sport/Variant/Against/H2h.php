<?php

declare(strict_types=1);

namespace SportsHelpers\Sport\Variant\Against;

use SportsHelpers\Sport\PersistVariant;
use SportsHelpers\Sport\Variant\Against;

// gebruik bij 1 vs 1: Opgegeven in H2h(3 en 2 even vaak tegen elkaar)
// gebruik bij Mixed: NrOfGamesPerPlace(3 en 2 even veel wedstrijden)
final class H2h extends Against implements \Stringable
{
    public function __construct(int $nrOfHomePlaces, int $nrOfAwayPlaces, protected int $nrOfH2H)
    {
        parent::__construct($nrOfHomePlaces, $nrOfAwayPlaces);
    }

    public function getNrOfH2H(): int
    {
        return $this->nrOfH2H;
    }

    #[\Override]
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

    #[\Override]
    public function __toString(): string
    {
        return parent::__toString() . $this->getNrOfH2H() . ':0';
    }

//    private function getNrOfGamePlacesOneH2h(int $nrOfPlaces): int
//    {
//        return $this->getNrOfGamesOneH2h($nrOfPlaces) * $this->getNrOfGamePlaces();
//    }
}
