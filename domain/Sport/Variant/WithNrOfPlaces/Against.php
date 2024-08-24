<?php

declare(strict_types=1);

namespace SportsHelpers\Sport\Variant\WithNrOfPlaces;

use SportsHelpers\Against\Side;
use SportsHelpers\Sport\WithNrOfPlaces as SportVariantWithNrOfPlaces;
use SportsHelpers\SportMath;
use SportsHelpers\SportVariants\AgainstGpp as AgainstGpp;
use SportsHelpers\SportVariants\AgainstH2h as AgainstH2h;

/**
 * @template-extends SportVariantWithNrOfPlaces<AgainstGpp|AgainstH2h>
 */
abstract class Against extends SportVariantWithNrOfPlaces
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
//
    protected function getNrOfGamePlacesSimultaneously(): int
    {
        return $this->nrOfPlaces - ($this->nrOfPlaces % $this->againstVariant->getNrOfGamePlaces());
    }

    public function getNrOfGamesSimultaneously(): int
    {
        return (int)ceil($this->getNrOfGamePlacesSimultaneously() / $this->againstVariant->getNrOfGamePlaces());
    }

    public function getNrOfPossibleWithCombinations(Side|null $side = null): int
    {
        $combinations = 0;
        // if( $this->againstVariant->getNrOfHomePlaces() > 1 ) {
            if( $side === null || $side === Side::Home) {
                $combinations += (new SportMath())->above($this->nrOfPlaces, $this->againstVariant->getNrOfHomePlaces());
            }
        // }

        // if( $this->againstVariant->getNrOfAwayPlaces() > 1 ) {
            if( $side === Side::Away || ($side === null
                    && $this->againstVariant->getNrOfHomePlaces() !== $this->againstVariant->getNrOfAwayPlaces())) {
                $combinations += (new SportMath())->above($this->nrOfPlaces, $this->againstVariant->getNrOfAwayPlaces());
            }
        // }

        return $combinations;
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
