<?php
declare(strict_types=1);

namespace SportsHelpers;

use SportsHelpers\Sport\Variant as SportVariant;
use Stringable;

class PouleStructure implements Stringable
{
    /**
     * @var list<int> $poules
     */
    protected $poules;
    protected int|null $nrOfGamePlaces = null;

    public function __construct(int ...$nrOfPlaces)
    {
        uasort(
            $nrOfPlaces,
            function (int $nrOfPlacesPouleA, int $nrOfPlacesPouleB): int {
                return $nrOfPlacesPouleA > $nrOfPlacesPouleB ? -1 : 1;
            }
        );
        $this->poules = [];
        foreach ($nrOfPlaces as $nrOfPlacesIt) {
            array_push($this->poules, $nrOfPlacesIt);
        }
        $this->poules = array_values($this->poules);
    }

    public function getNrOfPoules(): int
    {
        return count($this->poules);
    }

    public function getNrOfPlaces(): int
    {
        if ($this->nrOfGamePlaces === null) {
            $this->nrOfGamePlaces = array_sum($this->poules);
        }
        return $this->nrOfGamePlaces;
    }

    public function getBiggestPoule(): int
    {
        return reset($this->poules);
    }

    public function getSmallestPoule(): int
    {
        return end($this->poules);
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

    /**
     * @param list<SportVariant> $sportVariants
     * @return int
     */
    public function getTotalNrOfGames(array $sportVariants): int
    {
        $nrOfGames = 0;
        foreach ($this->poules as $nrOfPlaces) {
            foreach ($sportVariants as $sportVariant) {
                $nrOfGames += $sportVariant->getTotalNrOfGames($nrOfPlaces);
            }
        }
        return $nrOfGames;
    }

    /**
     * @param SelfReferee $selfReferee
     * @param list<SportVariant> $sports
     * @return bool
     */
    public function isSelfRefereeBeAvailable(SelfReferee $selfReferee, array $sports): bool
    {
        if ($selfReferee === SelfReferee::SAMEPOULE) {
            return $this->isSelfRefereeSamePouleBeAvailable($sports);
        } elseif ($selfReferee === SelfReferee::OTHERPOULES) {
            return $this->isSelfRefereeOtherPoulesBeAvailable();
        }
        return false;
    }

    protected function isSelfRefereeOtherPoulesBeAvailable(): bool
    {
        return $this->getNrOfPoules() > 1;
    }

    /**
     * @param list<SportVariant> $sportVariants
     * @return bool
     */
    protected function isSelfRefereeSamePouleBeAvailable(array $sportVariants): bool
    {
        $smallestNrOfPlaces = $this->getSmallestPoule();
        foreach ($sportVariants as $sportVariant) {
            if ($sportVariant->allPlacesParticipateInGameRound($smallestNrOfPlaces)) {
                return false;
            }
        }
        return true;
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
     * @return list<int>
     */
    public function toArray(): array
    {
        return $this->poules;
    }

    public function __toString(): string
    {
        return implode(',', $this->toArray());
    }
}
