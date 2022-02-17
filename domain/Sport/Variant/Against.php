<?php

declare(strict_types=1);

namespace SportsHelpers\Sport\Variant;

use SportsHelpers\GameMode;
use SportsHelpers\Sport\PersistVariant;
use SportsHelpers\Sport\Variant;
use SportsHelpers\SportMath;

// gebruik bij 1 vs 1: Opgegeven in H2h(3 en 2 even vaak tegen elkaar)
// gebruik bij Mixed: NrOfGamesPerPlace(3 en 2 even veel wedstrijden)
abstract class Against extends Base implements Variant
{
    public function __construct(protected int $nrOfHomePlaces, protected int $nrOfAwayPlaces)
    {
        parent::__construct(GameMode::Against);

        if ($this->nrOfHomePlaces < 1 || $this->nrOfAwayPlaces < 1) {
            throw new \Exception('nrOfHomePlaces and nrOfAwayPlaces should be at least 1', E_ERROR);
        }
        if ($this->nrOfHomePlaces > $this->nrOfAwayPlaces) {
            throw new \Exception('nrOfHomePlaces should be smaller than nrOfAwayPlaces', E_ERROR);
        }
    }

    public function getNrOfHomePlaces(): int
    {
        return $this->nrOfHomePlaces;
    }

    public function getNrOfAwayPlaces(): int
    {
        return $this->nrOfAwayPlaces;
    }

    public function getNrOfGamePlaces(): int
    {
        return $this->nrOfHomePlaces + $this->nrOfAwayPlaces;
    }

//    public function isMixed(): bool
//    {
//        return $this->getNrOfGamePlaces() > 2;
//    }

//    protected function getNrOfPlacesOneH2H(int $nrOfPlaces): int
//    {
//        return $this->getNrOfGamesOneH2H($nrOfPlaces) * $this->getNrOfGamePlaces();
//    }
//

    public function canAllPlacesPlaySimultaneously(int $nrOfPlaces): bool
    {
        return $nrOfPlaces === $this->getMaxNrOfGamePlacesSimultaneously($nrOfPlaces);
    }

    protected function getMaxNrOfGamePlacesSimultaneously(int $nrOfPlaces): int
    {
        return $nrOfPlaces - ($nrOfPlaces % $this->getNrOfGamePlaces());
    }

//    public function getNrOfGamesOneGameRound(int $nrOfPlaces): int
//    {
//        $nrOfPlacesPerGameRound = $this->getNrOfPlacesOneGameRound($nrOfPlaces);
//        return (int)($nrOfPlacesPerGameRound / $this->getNrOfGamePlaces());
//    }


//    public function getNrOfGameRounds(int $nrOfPlaces): int
//    {
//        $nrOfGames = $this->getTotalNrOfGames($nrOfPlaces);
//        $nrOfGamesPerGameRound = (int)floor($nrOfPlaces / $this->getNrOfGamePlaces());
//        return (int)ceil($nrOfGames / $nrOfGamesPerGameRound);
//    }

//    protected function getNrOfPlacesPerGameRound(int $nrOfPlaces): int
//    {
//        return $nrOfPlaces - ($nrOfPlaces % $this->getNrOfGamePlaces());
//    }

    public function getNrOfGamesPerPlaceOneSerie(int $nrOfPlaces): int
    {
        return $this->getNrOfGamesPerPlaceOneH2H($nrOfPlaces) * 2;
    }

    // 1vs1: 2=>1, 3=>2, 4=>3, 5=>4
    // 1vs2: 3=>3, 4=>9(12-3), 5=>21(30-9)
    public function getNrOfGamesPerPlaceOneH2H(int $nrOfPlaces): int
    {
//        if (!$this->isMixed()) {
//            return $nrOfPlaces - 1;
//        }
        $nrOfGamesOneH2H = $this->getNrOfGamesOneH2H($nrOfPlaces);
        $nrOfGamesOneH2HOneLess = $this->getNrOfGamesOneH2H($nrOfPlaces - 1);
        return $nrOfGamesOneH2H - $nrOfGamesOneH2HOneLess;
    }

    public function getNrOfGamesOneH2H(int $nrOfPlaces): int
    {
        $q1 = (new SportMath())->above($nrOfPlaces, $this->getNrOfGamePlaces());
        $q2 = $this->getNrOfHomeAwayFormations();
        return $q1 * $q2;
    }


    /**
     * 2 gameplaces => 1 : 1 vs 2
     * 4 gameplaces => 3 : 1 2 vs 3 4, 1 3 vs 2 4, 1 4 vs 2 3
     * 6 gameplaces => 10 :  1 2 3 vs 4 5 6, 1 2 4 vs 3 5 6, 1 2 5 vs 3 5 6 ..
     *
     * @return int
     */
    protected function getNrOfHomeAwayFormations(): int
    {
        if ($this->getNrOfHomePlaces() !== $this->getNrOfAwayPlaces()) {
            return (new SportMath())->above($this->getNrOfGamePlaces(), $this->getNrOfHomePlaces())
                * (new SportMath())->above($this->getNrOfGamePlaces() - $this->getNrOfHomePlaces(), $this->getNrOfAwayPlaces());
        }
        $nrOfSides = 2;
        $nrOfFormations = (new SportMath())->above($this->getNrOfGamePlaces(), $this->getNrOfHomePlaces());
        return (int)($nrOfFormations / $nrOfSides); // remove symetric
    }

    public function __toString()
    {
        return 'against(' . $this->getNrOfHomePlaces() . 'vs' . $this->getNrOfAwayPlaces() . ')' . ' h2h:gpp=>';
    }
}
