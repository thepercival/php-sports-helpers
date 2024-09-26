<?php

namespace SportsHelpers\Sport\Variant\WithNrOfPlaces\Against;

use SportsHelpers\Sport\Variant\WithNrOfPlaces\Against\GamesPerPlace as AgainstGppWithNrOfPlaces;
use SportsHelpers\SportVariants\AgainstGpp;


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
                $againstGppWithNrOfPlaces = new AgainstGppWithNrOfPlaces($nrOfPlaces, $againstGpp);
                $nrOfPossibleCombinations = $againstGppWithNrOfPlaces->getNrOfPossibleAgainstCombinations();
                $totalNrOfGames += $againstGppWithNrOfPlaces->getTotalNrOfGames();
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
                $againstGppWithNrOfPlaces = new AgainstGppWithNrOfPlaces($nrOfPlaces, $againstGpp);
                $nrOfPossibleCombinations = $againstGppWithNrOfPlaces->getNrOfPossibleWithCombinations();
                $totalNrOfGames += $againstGppWithNrOfPlaces->getTotalNrOfGames();
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
        return $this->getNrOfDeficit($nrOfCombinations, $nrOfPossibleCombinations) === 0;
    }

    public function getNrOfDeficit(
        int $nrOfCombinations,
        int $nrOfPossibleCombinations ): int
    {
        if( $nrOfPossibleCombinations === 0) {
            return 0;
        }
        $rest = $nrOfCombinations % $nrOfPossibleCombinations;
        return $rest === 0 ? 0 : $nrOfPossibleCombinations - $rest;
    }

    public function getMaxAmount(
        int $nrOfCombinations,
        int $nrOfPossibleCombinations ): int
    {
        return (int)ceil( $nrOfCombinations / $nrOfPossibleCombinations );
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
        return $againstGpp->nrOfHomePlaces . '-' . $againstGpp->nrOfAwayPlaces;
    }
}