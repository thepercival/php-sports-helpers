<?php
declare(strict_types=1);

namespace SportsHelpers;

use SportsHelpers\SportConfig as SportConfigHelper;

class GameCalculator
{
    protected Math $math;

    public const DEFAULTNROFGAMEPLACES = 2; // @TODO DEPRECATED

    public function __construct() {
        $this->math = new Math();
    }

    public function getNrOfGamePlaces(int $nrOfGamePlaces, bool $teamup, bool $selfReferee): int
    {
        if ($teamup) {
            $nrOfGamePlaces *= 2;
        }
        if ($selfReferee) {
            $nrOfGamePlaces++;
        }
        return $nrOfGamePlaces;
    }

    /**
     * @param array|SportConfigHelper[] $sportConfigHelpers
     * @param bool $teamup
     * @param bool $selfReferee
     * @return int
     */
    public function getMaxNrOfGamePlaces(array $sportConfigHelpers, bool $teamup, bool $selfReferee): int
    {
        $maxNrOfGamePlaces = 0;
        foreach ($sportConfigHelpers as $sportConfigHelper) {
            $nrOfGamePlaces = $this->getNrOfGamePlaces($sportConfigHelper->getNrOfGamePlaces(), $teamup, $selfReferee);
            if ($nrOfGamePlaces > $maxNrOfGamePlaces) {
                $maxNrOfGamePlaces = $nrOfGamePlaces;
            }
        }
        return $maxNrOfGamePlaces;
    }

    public function getNrOfGamesPerPouleStructure(PouleStructure $pouleStructure, bool $teamup, int $nrOfHeadtohead ): int
    {
        $nrOfGames = 0;
        foreach( $pouleStructure->toArray() as $nrOfPlaces ) {
            $nrOfGames += $this->getNrOfGamesPerPoule( $nrOfPlaces, $teamup, $nrOfHeadtohead);
        }
        return $nrOfGames;
    }

    public function getNrOfGamesPerPoule(int $nrOfPoulePlaces, bool $teamup, int $nrOfHeadtohead ): int
    {
//        if ($nrOfHeadtohead === null) {
//            $nrOfHeadtohead = 1;
//        }
        return ($this->getNrOfCombinations($nrOfPoulePlaces, $teamup) * $nrOfHeadtohead);
    }

    public function getNrOfGamesPerPlace(int $nrOfPoulePlaces, bool $teamup, bool $selfRefereeEnabled, int $nrOfHeadtohead): int
    {
        $nrOfGames = $nrOfPoulePlaces - 1;
        if ($teamup === true) {
            $nrOfGames = $this->getNrOfGamesPerPlaceTeamup($nrOfPoulePlaces);
        }
        if ( $selfRefereeEnabled ) {
            $nrOfPouleGames = $this->getNrOfGamesPerPoule($nrOfPoulePlaces, $teamup, $nrOfHeadtohead);
            $nrOfGames += (int)ceil($nrOfPouleGames / $nrOfPoulePlaces);
        }
        return $nrOfGames * $nrOfHeadtohead;
    }

    protected function getNrOfGamesPerPlaceTeamup(int $nrOfPlaces): int
    {
        if( $nrOfPlaces < 4 ) {
            return 0;
        }
        $tmp = $this->math->above($nrOfPlaces - 2, 4 - 2 ); // 4 - 2 == opponents
        return ( $nrOfPlaces -1 ) * $tmp;
    }

    public function getNrOfCombinations(int $nrOfPlaces, bool $teamup): int
    {
        if ($teamup === false) {
            return $this->math->above($nrOfPlaces, self::DEFAULTNROFGAMEPLACES);
        }
        $nrOfCombinations = 0;
        for($nrOfPlacesIt = 4 ; $nrOfPlacesIt <= $nrOfPlaces ; $nrOfPlacesIt++ ) {
            $nrOfCombinations += $this->getNrOfGamesPerPlaceTeamup( $nrOfPlacesIt );
        }
        return $nrOfCombinations;
    }
}