<?php

declare(strict_types=1);

namespace SportsHelpers\SportVariants\WithNrOfPlaces;

use SportsHelpers\SportVariants\Single as SingleVariant;

/**
 * @template-extends WithNrOfPlacesAbstract<SingleVariant>
 */
readonly class SingleWithNrOfPlaces extends WithNrOfPlacesAbstract
{
    public function __construct(int $nrOfPlaces, public SingleVariant $sportVariant ) {
        parent::__construct($nrOfPlaces );
    }

    public function getSportVariant(): SingleVariant {
        return $this->sportVariant;
    }

    public function getTotalNrOfGames(): int
    {
        $totalNrOfGames = $this->getTotalNrOfGamePlaces() / $this->sportVariant->nrOfGamePlaces;
        return (int)ceil($totalNrOfGames);
    }

    public function getTotalNrOfGamePlaces(): int
    {
        return (int)($this->sportVariant->nrOfGamesPerPlace * $this->nrOfPlaces);
    }

    public function getTotalNrOfGamesPerPlace(): int
    {
        return $this->sportVariant->nrOfGamesPerPlace;
    }

//    public function canAllPlacesPlaySimultaneously(): bool
//    {
//        return true;
//    }

    public function getMaxNrOfGamesSimultaneously(): int
    {
        return (int)ceil($this->nrOfPlaces / $this->sportVariant->nrOfGamePlaces);
    }

    public function getMaxNrOfGamePlacesSimultaneously(): int
    {
        $maxNrOfGamePlacesSimultaneously = $this->getMaxNrOfGamesSimultaneously() * $this->sportVariant->nrOfGamePlaces;
        if( $maxNrOfGamePlacesSimultaneously > $this->nrOfPlaces ) {
            return $this->nrOfPlaces;
        }
        return $maxNrOfGamePlacesSimultaneously;
    }

    // SINGLE
//    public function getTotalNrOfGames(int $nrOfPlaces): int
//    {
//        return (int)ceil($this->getTotalNrOfGamePlaces($nrOfPlaces) / $this->getNrOfGamePlaces());
//    }
}
