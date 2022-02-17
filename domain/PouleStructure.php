<?php

declare(strict_types=1);

namespace SportsHelpers;

use SportsHelpers\Sport\Variant as SportVariant;
use SportsHelpers\Sport\Variant\Against\GamesPerPlace as AgainstGpp;
use SportsHelpers\Sport\Variant\Against\H2h as AgainstH2h;
use SportsHelpers\Sport\Variant\AllInOneGame;
use SportsHelpers\Sport\Variant\Single;
use SportsHelpers\Sport\VariantWithFields;
use SportsHelpers\Sport\VariantWithPoule;
use Stringable;

class PouleStructure implements Stringable
{
    /**
     * @var list<int> $poules
     */
    protected array $poules;
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
     * @param list<AllInOneGame|Single|AgainstH2h|AgainstGpp> $sportVariants
     * @return int
     */
    public function getTotalNrOfGames(array $sportVariants): int
    {
        $nrOfGames = 0;
        foreach ($this->poules as $nrOfPlaces) {
            foreach ($sportVariants as $sportVariant) {
                $sportVariantWithPoule = new VariantWithPoule($sportVariant, $nrOfPlaces);
                $nrOfGames += $sportVariantWithPoule->getTotalNrOfGames();
            }
        }
        return $nrOfGames;
    }

    /**
     * @param SelfReferee $selfReferee
     * @param list<AllInOneGame|Single|AgainstH2h|AgainstGpp> $sports
     * @return bool
     */
    public function isSelfRefereeBeAvailable(SelfReferee $selfReferee, array $sports): bool
    {
        if ($selfReferee === SelfReferee::SamePoule) {
            return $this->isSelfRefereeSamePouleBeAvailable($sports);
        } elseif ($selfReferee === SelfReferee::OtherPoules) {
            return $this->isSelfRefereeOtherPoulesBeAvailable();
        }
        return false;
    }

    protected function isSelfRefereeOtherPoulesBeAvailable(): bool
    {
        return $this->getNrOfPoules() > 1;
    }

    /**
     * @param list<AllInOneGame|Single|AgainstH2h|AgainstGpp> $sportVariants
     * @return bool
     */
    protected function isSelfRefereeSamePouleBeAvailable(array $sportVariants): bool
    {
        foreach ($this->poules as $nrOfPlaces) {
            foreach ($sportVariants as $sportVariant) {
                $sportVariantWithPoule = new VariantWithPoule($sportVariant, $nrOfPlaces);
                if ($sportVariantWithPoule->canAllPlacesPlaySimultaneously()) {
                    return false;
                };
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
