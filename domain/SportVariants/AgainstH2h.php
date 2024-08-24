<?php

declare(strict_types=1);

namespace SportsHelpers\SportVariants;

use SportsHelpers\GameMode;
use SportsHelpers\Sport\PersistVariant;

// gebruik bij 1 vs 1: Opgegeven in H2h(3 en 2 even vaak tegen elkaar)
// gebruik bij Mixed: NrOfGamesPerPlace(3 en 2 even veel wedstrijden)
readonly class AgainstH2h extends AgainstAbstract implements \Stringable
{
    public function __construct(int $nrOfHomePlaces, int $nrOfAwayPlaces, protected int $nrOfH2H)
    {
        parent::__construct($nrOfHomePlaces, $nrOfAwayPlaces);
    }

    public function getNrOfH2H(): int
    {
        return $this->nrOfH2H;
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

    public function __toString(): string
    {
        return parent::__toString() . $this->getNrOfH2H() . ':0';
    }

    private function toJson(): string {

        $name = [
            'nrOfHomePlaces' => $this->getNrOfHomePlaces(),
            'nrOfAwayPlaces' => $this->getNrOfAwayPlaces(),
            'nrOfH2H' => $this->getNrOfH2H()
        ];
        $json = json_encode($name);
        return $json === false ? '?' : $json;
    }

//    private function getNrOfGamePlacesOneH2h(int $nrOfPlaces): int
//    {
//        return $this->getNrOfGamesOneH2h($nrOfPlaces) * $this->getNrOfGamePlaces();
//    }
}
