<?php

declare(strict_types=1);

namespace SportsHelpers\Sport\Variant\WithPoule;

use SportsHelpers\SelfReferee;
use SportsHelpers\SelfRefereeInfo;
use SportsHelpers\Sport\Variant\Single as SingleVariant;
use SportsHelpers\Sport\WithPoule as SportVariantWithPoule;

/**
 * @template-extends SportVariantWithPoule<SingleVariant>
 */
class Single extends SportVariantWithPoule
{
    public function __construct(int $nrOfPlaces, protected SingleVariant $sportVariant ) {
        parent::__construct($nrOfPlaces );
    }

    public function getSportVariant(): SingleVariant {
        return $this->sportVariant;
    }

    public function getTotalNrOfGames(): int
    {
        $totalNrOfGames = $this->getTotalNrOfGamePlaces() / $this->sportVariant->getNrOfGamePlaces();
        return (int)ceil($totalNrOfGames);
    }

    public function getTotalNrOfGamePlaces(): int
    {
        return (int)($this->sportVariant->getNrOfGamesPerPlace() * $this->nrOfPlaces);
    }

    public function getTotalNrOfGamesPerPlace(): int
    {
        return $this->sportVariant->getNrOfGamesPerPlace();
    }

    public function canAllPlacesPlaySimultaneously(): bool
    {
        return $this->nrOfPlaces === $this->getNrOfGamePlacesSimultaneously();
    }

    public function getNrOfGamesSimultaneously(): int
    {
        return (int)ceil($this->getNrOfGamePlacesSimultaneously() / $this->sportVariant->getNrOfGamePlaces());
    }

    public function getNrOfGamePlacesPerBatch(): int
    {
        return (int)ceil($this->getTotalNrOfGamePlaces() / $this->getNrOfGamePlacesSimultaneously());
    }

    protected function getNrOfGamePlacesSimultaneously(): int
    {
        return $this->nrOfPlaces;
    }

//    public function getMaxNrOfGamesSimultaneously(SelfRefereeInfo $selfRefereeInfo): int {
//        $nrOfGamePlaces = $this->sportVariant->getNrOfGamePlaces();
//        if ($selfRefereeInfo->selfReferee === SelfReferee::SamePoule && $selfRefereeInfo->nrIfSimSelfRefs === 1) {
//            $nrOfSimGames = (int)floor($this->getNrOfPlaces() / ($nrOfGamePlaces + 1));
//        } else if ($selfRefereeInfo->selfReferee === SelfReferee::SamePoule && $selfRefereeInfo->nrIfSimSelfRefs > 1) {
//            $nrOfSimGames = (int)floor(($this->getNrOfPlaces() - 1) / $nrOfGamePlaces);
//        } else {
//            $nrOfSimGames = (int)floor($this->getNrOfPlaces() / $nrOfGamePlaces);
//        }
//        return $nrOfSimGames === 0 ? 1 : $nrOfSimGames;
//    }



    // SINGLE
//    public function getTotalNrOfGames(int $nrOfPlaces): int
//    {
//        return (int)ceil($this->getTotalNrOfGamePlaces($nrOfPlaces) / $this->getNrOfGamePlaces());
//    }
}
