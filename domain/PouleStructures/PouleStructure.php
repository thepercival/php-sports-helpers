<?php

declare(strict_types=1);

namespace SportsHelpers\PouleStructures;

use SportsHelpers\PouleStructure as PouleStructureBase;
use SportsHelpers\SelfReferee;
use SportsHelpers\Sport\Variant\Against\GamesPerPlace as AgainstGpp;
use SportsHelpers\Sport\Variant\Against\H2h as AgainstH2h;
use SportsHelpers\Sport\Variant\AllInOneGame;
use SportsHelpers\Sport\Variant\Single;
use SportsHelpers\Sport\Variant\Creator as VariantCreator;
use Stringable;

readonly class PouleStructure implements Stringable
{
    /**
     * @var non-empty-list<int> $poules
     */
    protected array $poules;
    protected int $nrOfGamePlaces;

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
        $this->nrOfGamePlaces = array_sum($this->poules);
    }

    public function getNrOfPoules(): int
    {
        return count($this->poules);
    }

    public function getNrOfPlaces(): int
    {
        return $this->nrOfGamePlaces;
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

    /**
     * @param list<AllInOneGame|Single|AgainstH2h|AgainstGpp> $sportVariants
     * @return int
     */
    public function getTotalNrOfGames(array $sportVariants): int
    {
        $nrOfGames = 0;
        foreach ($this->poules as $nrOfPlaces) {
            foreach ($sportVariants as $sportVariant) {
                $nrOfGames += (new VariantCreator())->createWithPoule($nrOfPlaces, $sportVariant)->getTotalNrOfGames();
            }
        }
        return $nrOfGames;
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
     * @param list<Single|AgainstH2h|AgainstGpp|AllInOneGame> $sportVariants
     * @param SelfReferee $selfReferee
     * @return bool
     */
    public function sportsAndSelfRefereeAreCompatible(
        array     $sportVariants,
        SelfReferee $selfReferee): bool
    {
        if ($selfReferee === SelfReferee::SamePoule) {
            foreach ($sportVariants as $sportVariant) {
                if ($sportVariant instanceof AllInOneGame) {
                    return false;
                }
                if ($sportVariant->getNrOfGamePlaces() >= $this->getSmallestPoule()) {
                    return false;
                }
            }
        }
        elseif ($selfReferee === SelfReferee::OtherPoules) {
            return $this->getNrOfPoules() > 1;
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

    #[\Override]
    public function __toString(): string
    {
        return implode(',', $this->toArray());
    }

}
