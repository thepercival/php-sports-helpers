<?php

declare(strict_types=1);

namespace SportsHelpers\Sport;

use SportsHelpers\Sport\Variant\Against\GamesPerPlace as AgainstGpp;
use SportsHelpers\Sport\Variant\AllInOneGame;
use SportsHelpers\Sport\Variant\Against\H2h as AgainstH2h;
use SportsHelpers\Sport\Variant\Single;

class VariantWithPoule
{
    public function __construct(
        protected AllInOneGame|Single|AgainstH2h|AgainstGpp $sportVariant,
        protected int $nrOfPlaces
    ) {
    }

    public function getSportVariant(): AllInOneGame|Single|AgainstH2h|AgainstGpp
    {
        return $this->sportVariant;
    }

    public function getNrOfPlaces(): int
    {
        return $this->nrOfPlaces;
    }

    public function getTotalNrOfGames(): int
    {
        if ($this->sportVariant instanceof AllInOneGame) {
            return $this->sportVariant->getNrOfGamesPerPlace();
        }
        if ($this->sportVariant instanceof AgainstH2h) {
            return $this->sportVariant->getTotalNrOfGames($this->nrOfPlaces);
        }
        return (int)ceil($this->getTotalNrOfGamePlaces() / $this->sportVariant->getNrOfGamePlaces());
    }

    public function getTotalNrOfGamePlaces(): int
    {
        if (!($this->sportVariant instanceof AgainstH2h)) {
            return $this->nrOfPlaces * $this->sportVariant->getNrOfGamesPerPlace();
        }
        return $this->sportVariant->getTotalNrOfGamePlaces($this->nrOfPlaces);
    }

    public function getTotalNrOfGamesPerPlace(): int
    {
        if ($this->sportVariant instanceof AgainstH2h) {
            return $this->sportVariant->getNrOfGamesPerPlaceOneH2H($this->nrOfPlaces) * $this->sportVariant->getNrOfH2H(
                );
        }
        return $this->sportVariant->getNrOfGamesPerPlace();
    }

    public function canAllPlacesPlaySimultaneously(): bool
    {
        return $this->nrOfPlaces === $this->getNrOfGamePlacesSimultaneously();
    }

    protected function getNrOfGamePlacesSimultaneously(): int
    {
        if ($this->sportVariant instanceof AllInOneGame || $this->sportVariant instanceof Single) {
            return $this->nrOfPlaces;
        }
        return $this->nrOfPlaces - ($this->nrOfPlaces % $this->getNrOfGamePlaces());
    }

    public function getNrOfGamePlaces(): int
    {
        if (!$this->sportVariant instanceof AllInOneGame) {
            return $this->sportVariant->getNrOfGamePlaces();
        }
        return $this->nrOfPlaces;
    }

    public function getNrOfGamesSimultaneously(): int
    {
        return (int)ceil($this->getNrOfGamePlacesSimultaneously() / $this->getNrOfGamePlaces());
    }

    public function getNrOfGameGroups(): int
    {
        return (int)ceil($this->getTotalNrOfGamePlaces() / $this->getNrOfGamePlacesSimultaneously());
    }

    // SINGLE
//    public function getTotalNrOfGames(int $nrOfPlaces): int
//    {
//        return (int)ceil($this->getTotalNrOfGamePlaces($nrOfPlaces) / $this->getNrOfGamePlaces());
//    }
}
