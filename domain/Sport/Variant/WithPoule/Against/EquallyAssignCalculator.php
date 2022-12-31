<?php

namespace SportsHelpers\Sport\Variant\WithPoule\Against;

use SportsHelpers\Against\Side;
use SportsHelpers\Sport\Variant\WithPoule\Against\GamesPerPlace as AgainstGppWithPoule;
use SportsHelpers\Sport\Variant\Against\GamesPerPlace as AgainstGpp;
use SportsHelpers\SportMath;


class EquallyAssignCalculator
{
    /**
     * @param int $nrOfPlaces
     * @param list<AgainstGpp> $againstGppVariants
     * @return bool
     */
    public function assignAgainstSportsEqually(int $nrOfPlaces, array $againstGppVariants): bool {

        $perCombination = $this->getAgainstGppWithPoulesPerGamePlacesCombination($againstGppVariants);
        foreach( $perCombination as $againstGpps) {
            $totalNrOfGames = 0;
            $uniqueNrOfCombinationsPerGame = null;
            $nrOfPossibleCombinations = null;
            foreach( $againstGpps as $againstGpp) {
                $uniqueNrOfCombinationsPerGame = $againstGpp->getNrOfAgainstCombinationsPerGame();
                $againstGppWithPoule = new AgainstGppWithPoule($nrOfPlaces, $againstGpp);
                $nrOfPossibleCombinations = $againstGppWithPoule->getNrOfPossibleAgainstCombinations();
                $totalNrOfGames += $againstGppWithPoule->getTotalNrOfGames();
            }
            if( $uniqueNrOfCombinationsPerGame !== null && $totalNrOfGames > 0
                && $nrOfPossibleCombinations !== null &&
                !$this->assignEqually(
                    $totalNrOfGames,
                    $nrOfPossibleCombinations,
                    $uniqueNrOfCombinationsPerGame) ) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param int $nrOfPlaces
     * @param list<AgainstGpp> $againstGppVariants
     * @return bool
     */
    public function assignWithSportsEqually(int $nrOfPlaces, array $againstGppVariants): bool {

        $perCombination = $this->getAgainstGppWithPoulesPerGamePlacesCombination($againstGppVariants);
        foreach( $perCombination as $againstGpps) {
            $totalNrOfGames = 0;
            $uniqueNrOfCombinationsPerGame = null;
            $nrOfPossibleCombinations = null;
            foreach( $againstGpps as $againstGpp) {
                $uniqueNrOfCombinationsPerGame = $againstGpp->getNrOfWithCombinationsPerGame();
                $againstGppWithPoule = new AgainstGppWithPoule($nrOfPlaces, $againstGpp);
                $nrOfPossibleCombinations = $againstGppWithPoule->getNrOfPossibleWithCombinations();
                $totalNrOfGames += $againstGppWithPoule->getTotalNrOfGames();
            }
            if( $uniqueNrOfCombinationsPerGame !== null && $totalNrOfGames > 0
                && $nrOfPossibleCombinations !== null &&
                !$this->assignEqually(
                    $totalNrOfGames,
                    $nrOfPossibleCombinations,
                    $uniqueNrOfCombinationsPerGame) ) {
                return false;
            }
        }
        return true;
    }

    public function assignEqually(
        int $totalNrOfGames,
        int $nrOfPossibleCombinations,
        int $nrOfCombinationsPerGame,

    ): bool
    {
        $nrOfCombinations = $nrOfCombinationsPerGame * $totalNrOfGames;
        return ($nrOfCombinations % $nrOfPossibleCombinations) === 0;
    }

    /**
     * @param list<AgainstGpp> $againstGppVariants
     * @return array<string, list<AgainstGpp>>
     */
    private function getAgainstGppWithPoulesPerGamePlacesCombination(array $againstGppVariants): array {
        $perCombinations = [];
        foreach( $againstGppVariants as $againstGpp) {
            $id = $this->getGamePlacesId($againstGpp);
            if( !array_key_exists($id, $perCombinations)) {
                $perCombinations[$id] = [];
            }
            $perCombinations[$id][] = $againstGpp;
        }
        return $perCombinations;
    }

    private function getGamePlacesId(AgainstGpp $againstGpp): string {
        return $againstGpp->getNrOfHomePlaces() . '-' . $againstGpp->getNrOfAwayPlaces();
    }
}