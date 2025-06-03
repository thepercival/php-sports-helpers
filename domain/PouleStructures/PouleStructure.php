<?php

declare(strict_types=1);

namespace SportsHelpers\PouleStructures;

use SportsHelpers\SelfReferee;
use SportsHelpers\Sports\AgainstOneVsOne;
use SportsHelpers\Sports\AgainstOneVsTwo;
use SportsHelpers\Sports\AgainstTwoVsTwo;
use SportsHelpers\Sports\TogetherSport;

readonly class PouleStructure
{
    /**
     * @var non-empty-list<int> $poules
     */
    public array $poules;

    public function __construct(int ...$nrOfPlaces)
    {
        uasort(
            $nrOfPlaces,
            function (int $nrOfPlacesPouleA, int $nrOfPlacesPouleB): int {
                return $nrOfPlacesPouleA > $nrOfPlacesPouleB ? -1 : 1;
            }
        );
        if (count($nrOfPlaces) === 0) {
            throw new \Exception('nrOfPlaces-list can not be empty', E_ERROR);
        }
        $this->poules = array_values($nrOfPlaces);
    }

    public function getNrOfPoules(): int
    {
        return count($this->poules);
    }

    public function getNrOfPlaces(): int
    {
        return array_sum($this->poules);;
    }

    public function getBiggestPoule(): int
    {
        return $this->poules[0];
    }

    public function getSmallestPoule(): int
    {
        return $this->poules[count($this->poules)-1];
    }

    public function isAlmostBalanced(): bool
    {
        return ($this->getBiggestPoule() - 1) <= $this->getSmallestPoule();
    }

    public function isBalanced(): bool
    {
        return $this->getBiggestPoule() === $this->getSmallestPoule();
    }

    /**
     * @return array<int,int>
     */
    public function getNrOfPoulesByNrOfPlaces(): array
    {
        $nrOfPoulesByNrOfPlaces = [];
        foreach ($this->poules as $pouleNrOfPlaces) {
            if (array_key_exists($pouleNrOfPlaces, $nrOfPoulesByNrOfPlaces) === false) {
                $nrOfPoulesByNrOfPlaces[$pouleNrOfPlaces] = 0;
            }
            $nrOfPoulesByNrOfPlaces[$pouleNrOfPlaces]++;
        }
        return $nrOfPoulesByNrOfPlaces;
    }

//    /**
//     * @param array|SportConfig[] $sportConfigs
//     * @param int $gameMode
//     * @return int
//     */
//    public function getNrOfGameRounds(array $sportConfigs, int $gameMode ): int
//    {
//        $nrOfGames = 0;
//        foreach ($this->poules as $nrOfPlaces ) {
//            foreach( $sportConfigs as $sportConfig ) {
//                $nrOfGames += $sportConfig->getNrOfGameRounds( $nrOfPlaces, $gameMode );
//            }
//        }
//        return $nrOfGames;
//    }

    /**
     * @param list<AgainstOneVsOne|AgainstOneVsTwo|AgainstTwoVsTwo|TogetherSport> $sports
     * @param SelfReferee $selfReferee
     * @return bool
     */
    public function isCompatibleWithSportsAndSelfReferee(array $sports, SelfReferee $selfReferee): bool
    {
        if ($selfReferee === SelfReferee::SamePoule) {
            foreach ($sports as $sport) {
                if( $sport instanceof TogetherSport) {
                    if( $sport->nrOfGamePlaces === null) {
                        return false;
                    }
                    $nrOfGamePlaces = $sport->nrOfGamePlaces;
                } else {
                    $nrOfGamePlaces = $sport->getNrOfGamePlaces();
                }
                if( $nrOfGamePlaces >= $this->getSmallestPoule() ) {
                    return false;
                }
            }
        } elseif ($selfReferee === SelfReferee::OtherPoules) {
            return $this->getNrOfPoules() > 1;
        }
        return true;
    }

    /**
     * @param list<AgainstOneVsOne|AgainstOneVsTwo|AgainstTwoVsTwo|TogetherSport> $sports
     * @return bool
     */
    public function isCompatibleWithSports(array $sports): bool
    {
        foreach ($sports as $sport) {
            if (!($sport instanceof TogetherSport && $sport->nrOfGamePlaces === null)) {
                $nrOfGamePlaces = $sport->nrOfGamePlaces ?? 0;
                if( $nrOfGamePlaces > $this->getSmallestPoule()) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * @return non-empty-list<int>
     */
    public function toArray(): array
    {
        return $this->poules;
    }
}
