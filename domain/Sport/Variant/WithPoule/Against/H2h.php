<?php
declare(strict_types = 1);

namespace SportsHelpers\Sport\Variant\WithPoule\Against;

use SportsHelpers\Sport\Variant\Against\H2h as AgainstH2h;
use SportsHelpers\Sport\Variant\WithPoule\Against as AgainstWithPoule;

class H2h extends AgainstWithPoule
{
    public function __construct(int $nrOfPlaces, protected AgainstH2h $sportVariant)
    {
        parent::__construct($nrOfPlaces, $sportVariant);
    }

    public function getSportVariant(): AgainstH2h {
        return $this->sportVariant;
    }

    public function getTotalNrOfGames(): int
    {
        return $this->sportVariant->getNrOfGamesOneH2h($this->nrOfPlaces) * $this->sportVariant->getNrOfH2H();
    }

    public function getTotalNrOfGamePlaces(): int
    {
        return $this->getTotalNrOfGames() * $this->sportVariant->getNrOfGamePlaces();
    }

    public function getTotalNrOfGamesPerPlace(): int
    {
        return (int)($this->getNrOfGamesPerPlaceOneH2h() * $this->sportVariant->getNrOfH2H());
    }

//    public function getNrOfGameGroups(): int
//    {
//        return (int)ceil($this->getTotalNrOfGamePlaces() / $this->getNrOfGamePlacesSimultaneously());
//    }
}