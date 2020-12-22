<?php

namespace SportsHelpers\SportConfig;

use SportsHelpers\SportConfig;

class Service
{
    public function __construct()
    {
    }

    /**
     * @param array|SportConfig[] $sportConfigs
     * @param bool $selfReferee
     * @return int
     */
    public function getMaxNrOfGamePlaces(array $sportConfigs, bool $selfReferee): int
    {
        $maxNrOfGamePlaces = 0;
        foreach ($sportConfigs as $sportConfig) {
            $nrOfGamePlaces = $this->getNrOfGamePlaces($sportConfig->getNrOfGamePlaces(), $selfReferee);
            if ($nrOfGamePlaces > $maxNrOfGamePlaces) {
                $maxNrOfGamePlaces = $nrOfGamePlaces;
            }
        }
        return $maxNrOfGamePlaces;
    }

    public function getNrOfGamePlaces(int $nrOfGamePlaces, bool $selfReferee): int
    {
        return $selfReferee ? $nrOfGamePlaces + 1 : $nrOfGamePlaces;
    }

    public function getNrOfGamesPerPlace(int $gameMode, int $nrOfPlaces, array $sportConfigs ): int {
        $nrOfGamesPerPlace = 0;
        foreach ($sportConfigs as $sportConfig) {
            $nrOfGamesPerPlace += $sportConfig->getNrOfGamesPerPlace($gameMode, $nrOfPlaces);
        }
        return $nrOfGamesPerPlace;
    }
}