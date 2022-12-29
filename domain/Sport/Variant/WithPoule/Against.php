<?php

declare(strict_types=1);

namespace SportsHelpers\Sport\Variant\WithPoule;

use SportsHelpers\Against\Side;
use SportsHelpers\SelfReferee;
use SportsHelpers\Sport\Variant\Against\GamesPerPlace as AgainstGpp;
use SportsHelpers\Sport\Variant\Against\H2h as AgainstH2h;
use SportsHelpers\Sport\WithPoule as SportVariantWithPoule;

/**
 * @template-extends SportVariantWithPoule<AgainstGpp|AgainstH2h>
 */
abstract class Against extends SportVariantWithPoule
{
     public function __construct(int $nrOfPlaces, protected AgainstGpp|AgainstH2h $againstVariant ) {
         if( $nrOfPlaces < $againstVariant->getNrOfGamePlaces() ) {
             throw new \Exception('nrOfPlaces should be at least equal to nrOfGamePlaces');
         }
        parent::__construct($nrOfPlaces);
    }

    public function canAllPlacesPlaySimultaneously(): bool
    {
        return $this->nrOfPlaces === $this->getNrOfGamePlacesSimultaneously();
    }

    protected function getNrOfGamePlacesSimultaneously(): int
    {
        return $this->nrOfPlaces - ($this->nrOfPlaces % $this->againstVariant->getNrOfGamePlaces());
    }

    public function getNrOfGamesSimultaneously(): int
    {
        return (int)ceil($this->getNrOfGamePlacesSimultaneously() / $this->againstVariant->getNrOfGamePlaces());
    }

    public function getMaxNrOfGamesSimultaneously(SelfReferee $selfReferee): int {
        $nrOfGamePlaces = $this->againstVariant->getNrOfGamePlaces();
        if ($selfReferee === SelfReferee::SamePoule) {
            $nrOfGamePlaces++;
        }
        $nrOfSimGames = (int)floor($this->getNrOfPlaces() / $nrOfGamePlaces);
        return $nrOfSimGames === 0 ? 1 : $nrOfSimGames;
    }


//
//    protected function getMaxNrOfGamePlacesSimultaneously(int $nrOfPlaces): int
//    {
//        return $nrOfPlaces - ($nrOfPlaces % $this->getNrOfGamePlaces());
//    }
//
    public function getNrOfGamesPerPlaceOneSerie(): int
    {
        return $this->getNrOfGamesPerPlaceOneH2h() * 2;
    }
//
//    // 1vs1: 2=>1, 3=>2, 4=>3, 5=>4
//    // 1vs2: 3=>3, 4=>9(12-3), 5=>21(30-9)
    public function getNrOfGamesPerPlaceOneH2h(): int
    {
//        if (!$this->isMixed()) {
//            return $nrOfPlaces - 1;
//        }
        $nrOfGamesOneH2H = $this->againstVariant->getNrOfGamesOneH2h($this->nrOfPlaces);
        $nrOfGamesOneH2HOneLess = $this->againstVariant->getNrOfGamesOneH2h($this->nrOfPlaces - 1);
        return $nrOfGamesOneH2H - $nrOfGamesOneH2HOneLess;
    }


}
