<?php

declare(strict_types=1);

namespace SportsHelpers\Sport\Variant\WithPoule;

use SportsHelpers\Against\Side;
use SportsHelpers\SelfReferee;
use SportsHelpers\SelfRefereeInfo;
use SportsHelpers\Sport\Variant\Against\GamesPerPlace as AgainstGpp;
use SportsHelpers\Sport\Variant\Against\H2h as AgainstH2h;
use SportsHelpers\Sport\WithPoule as SportVariantWithPoule;
use SportsHelpers\SportMath;

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

    // kijken bij simultaneously
    // a eigen scheidsrechters

    // HET AANTAL BIJ MEERDERE POULES MET VERSCHILLENDE GROOTTES WIL JE HET MAX BEREKENING
    // DAARBIJ IS HET BELANGRIJK OM AAN TE GEVEN ALS DIT EEN MAXIMUM IS DIE HAALBAAR IS VOOR DE ALLE ITERATIES!!

    // VOORBEELD
    // BIJ [6,5] EN SportAgainst MET 2 VELDEN GEBRUIK PLANNINGPOULESTRUCTURE
    // BIJ NrOfPlaces 5 Kun je niet Alleen iets met SAMEPOULE ]


    // maxNrOfGamePlacesSimultaneouslyPossible, against
    // bij eigen scheids uit eigen poule
    //  a1 ja, andere poule dan meetellen voor desbetreffende poule
    //          a1a eigen poule scheids ontvangen  : altijd verzekerd, bij
    //          a1b eigen poule scheids leveren     : hoeveelheid kan verschillen
    //  a2 nee, eigen poule scheids ontvangen  : kan niet
    //          eigen poule scheids leveren     : hoeveelheid kan verschillen
    //
//    public function getMaxNrOfGamesSimultaneouslyPossible(SelfRefereeInfo $refereeInfo): int {
//        $nrOfGamePlaces = $this->againstVariant->getNrOfGamePlaces();
//
//        // als i
//        if ($selfRefereeInfo->selfReferee === SelfReferee::SamePoule && $selfRefereeInfo->nrIfSimSelfRefs === 1) {
//            $nrOfSimGames = (int)floor($this->getNrOfPlaces() / ($nrOfGamePlaces + 1));
//        } else if ($selfRefereeInfo->selfReferee === SelfReferee::SamePoule && $selfRefereeInfo->nrIfSimSelfRefs > 1) {
//            $nrOfSimGames = (int)floor(($this->getNrOfPlaces() - 1) / $nrOfGamePlaces);
//        } else {
//            $nrOfSimGames = (int)floor($this->getNrOfPlaces() / $nrOfGamePlaces);
//        }
//        return $nrOfSimGames === 0 ? 1 : $nrOfSimGames;
//    }

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
