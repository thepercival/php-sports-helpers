<?php
declare(strict_types=1);

namespace SportsHelpers\Sport\Variant;

use SportsHelpers\GameMode;
use SportsHelpers\Sport\PersistVariant;
use SportsHelpers\Sport\Variant;
use SportsHelpers\SportMath;

// gebruik bij 1 vs 1: Opgegeven in H2h(3 en 2 even vaak tegen elkaar)
// gebruik bij Mixed: NrOfGamesPerPlace(3 en 2 even veel wedstrijden)
class Against extends Base implements Variant
{
    public function __construct(
        protected int $nrOfHomePlaces,
        protected int $nrOfAwayPlaces,
        protected int $nrOfH2H,
        int $nrOfGamesPerPlace
    ) {
        parent::__construct(GameMode::AGAINST, $nrOfGamesPerPlace);
        if ($this->isMixed() && $nrOfH2H !== 0) {
            throw new \Exception('nrOfH2 should be 0 when in mixed mode', E_ERROR);
        }
        if (!$this->isMixed() && $nrOfGamesPerPlace !== 0) {
            throw new \Exception('nrOfGamesPerPlace should be 0 when not in mixed mode', E_ERROR);
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

    public function getNrOfH2H(): int
    {
        return $this->nrOfH2H;
    }

    public function getNrOfGamePlaces(): int
    {
        return $this->nrOfHomePlaces + $this->nrOfAwayPlaces;
    }

    public function isMixed(): bool
    {
        return $this->getNrOfGamePlaces() > 2;
    }

//    protected function getNrOfPlacesOneH2H(int $nrOfPlaces): int
//    {
//        return $this->getNrOfGamesOneH2H($nrOfPlaces) * $this->getNrOfGamePlaces();
//    }
//

    public function allPlacesParticipateInGameRound(int $nrOfPlaces): bool
    {
        return $nrOfPlaces === $this->getNrOfPlacesOneGameRound($nrOfPlaces);
    }

    protected function getNrOfPlacesOneGameRound(int $nrOfPlaces): int
    {
        return $nrOfPlaces - ($nrOfPlaces % $this->getNrOfGamePlaces());
    }

    public function getNrOfGamesOneGameRound(int $nrOfPlaces): int
    {
        $nrOfPlacesPerGameRound = $this->getNrOfPlacesOneGameRound($nrOfPlaces);
        return (int)($nrOfPlacesPerGameRound / $this->getNrOfGamePlaces());
    }

//    public function getNrOfGamesPerPlaceOnePartial(int $nrOfPlaces): int
//    {
//        if ($this->getNrOfHomePlaces() === $this->getNrOfAwayPlaces() && $nrOfPlaces === $this->getNrOfGamePlaces()) {
//            return 1;
//        }
//        return $this->getNrOfGamePlaces();
//    }
//
//    public function getNrOfGamesOnePartial(int $nrOfPlaces): int
//    {
//        if ($this->getNrOfHomePlaces() === $this->getNrOfAwayPlaces() && $nrOfPlaces === $this->getNrOfGamePlaces()) {
//            return 1;
//        }
//        return $nrOfPlaces;
//    }

    public function getTotalNrOfGames(int $nrOfPlaces): int
    {
        if ($this->isMixed()) {
            $totalNrOfGamePlaces = $this->getTotalNrOfGamesPerPlace($nrOfPlaces) * $nrOfPlaces;
        } else {
            $totalNrOfGamePlaces = $nrOfPlaces * $this->getNrOfGamesPerPlaceOneH2H($nrOfPlaces) * $this->getNrOfH2H();
        }
        return (int)ceil($totalNrOfGamePlaces / $this->getNrOfGamePlaces());
    }

//    public function getNrOfGamesOneSerie(int $nrOfPlaces): int
//    {
//        return $this->getNrOfGamesOneH2H($nrOfPlaces) * 2;
//    }

    public function getNrOfGamesOneH2H(int $nrOfPlaces): int
    {
        return (new SportMath())->above($nrOfPlaces, $this->getNrOfGamePlaces()) * $this->getNrOfHomeAwayFormations();
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

//    public function equalNrOfHomeAwaysOnePartial(int $nrOfPlaces): bool
//    {
//        return $this->getNrOfHomePlaces() !== $this->getNrOfAwayPlaces()
//            || $this->getNrOfGamePlaces() !== $nrOfPlaces;
    ////        $nrOfGames = $this->getNrOfGamesPerPlaceOnePartial($nrOfPlaces) * $this->getNrOfPartials();
    ////        $nrOfGamesOneH2H = $this->getNrOfGamesOneH2H($nrOfPlaces);
    ////        return $nrOfGames % $nrOfGamesOneH2H === 0;
//    }
//
//    public function equalNrOfHomeAwaysOneSerie(int $nrOfPlaces): bool
//    {
//        return !($this->getNrOfHomePlaces() === $this->getNrOfAwayPlaces()
//            && $this->getNrOfGamePlaces() === $nrOfPlaces
//            && ($this->getNrOfPartials() % $this->getNrOfPartialsOneSerie($nrOfPlaces)) !== 0);
    ////        $nrOfGames = $this->getNrOfGamesPerPlaceOnePartial($nrOfPlaces) * $this->getNrOfPartials();
    ////        $nrOfGamesOneH2H = $this->getNrOfGamesOneH2H($nrOfPlaces);
    ////        return $nrOfGames % $nrOfGamesOneH2H === 0;
//    }
//
    public function withAgainstMustBeEquallyAssigned(int $nrOfPlaces): bool
    {
        return $this->getNrOfGamesPerPlace() % $this->getNrOfGamesPerPlaceOneH2H($nrOfPlaces) === 0;
    }

    public function homeAwayMustBeQuallyAssigned(): bool
    {
        return !$this->isMixed();
    }

    public function mustBeEquallyAssigned(int $nrOfPlaces): bool
    {
        if ($this->getNrOfH2H() > 0) {
            return true;
        }
        $totalNrOfGamePlaces = $nrOfPlaces * $this->getNrOfGamesPerPlace();
        return $totalNrOfGamePlaces % $this->getNrOfGamePlaces() === 0;
    }

//
//    /*public function getNrOfGameRounds(int $nrOfPlaces): int
//    {
//        $nrOfGames = $this->getTotalNrOfGames($nrOfPlaces);
//        $nrOfGamesPerGameRound = (int)floor($nrOfPlaces / $this->getNrOfGamePlaces());
//        return (int)ceil($nrOfGames / $nrOfGamesPerGameRound);
//    }*/
//
//    public function getNrOfPartialsOneSerie(int $nrOfPlaces): int
//    {
//        $nrOfGamesOneSerie = $this->getNrOfGamesOneSerie($nrOfPlaces);
//        $nrOfGamesOnePartial = $this->getNrOfGamesOnePartial($nrOfPlaces);
//        return (int) ($nrOfGamesOneSerie / $nrOfGamesOnePartial);
//    }
//

    // 1vs1: 2=>1, 3=>2, 4=>3, 5=>4
    // 1vs2: 3=>3, 4=>9(12-3), 5=>21(30-9)
    public function getNrOfGamesPerPlaceOneH2H(int $nrOfPlaces): int
    {
        if (!$this->isMixed()) {
            return $nrOfPlaces - 1;
        }
        $nrOfGamesOneH2H = $this->getNrOfGamesOneH2H($nrOfPlaces);
        $nrOfGamesOneH2HOneLess = $this->getNrOfGamesOneH2H($nrOfPlaces-1);
        return $nrOfGamesOneH2H - $nrOfGamesOneH2HOneLess;
    }

    public function getTotalNrOfGamesPerPlace(int $nrOfPlaces): int
    {
        if ($this->getNrOfGamesPerPlace() > 0) {
            return $this->getNrOfGamesPerPlace();
        }
        return $this->getNrOfGamesPerPlaceOneH2H($nrOfPlaces) * $this->getNrOfH2H();
    }

//    protected function getNrOfPlacesPerGameRound(int $nrOfPlaces): int
//    {
//        return $nrOfPlaces - ($nrOfPlaces % $this->getNrOfGamePlaces());
//    }

//    public function getMaxTotalNrOfGamesPerPlace(int $nrOfPlaces): int
//    {
//        $nrOfPartials = $this->getNrOfPartials();
//        if ($nrOfPartials > 0) {
//            return $this->getNrOfGamesPerPlaceOnePartial($nrOfPlaces) * $nrOfPartials;
//        }
//        $nrOfGamesPerPlaceOneH2H = $this->getNrOfGamesPerPlaceOneSerie($nrOfPlaces) / 2;
//        return $this->getNrOfH2H() * $nrOfGamesPerPlaceOneH2H;
//    }

    public function toPersistVariant(): PersistVariant
    {
        return new PersistVariant(
            $this->getGameMode(),
            $this->getNrOfHomePlaces(),
            $this->getNrOfAwayPlaces(),
            0,
            $this->getNrOfH2H(),
            $this->getNrOfGamesPerPlace()
        );
    }

    public function __toString()
    {
        $base = 'against : ' . $this->getNrOfHomePlaces() . 'vs' . $this->getNrOfAwayPlaces();
        return $base . ' : h2h-nrofgamesperplace => ' . $this->getNrOfH2H() . '-' . $this->getNrOfGamesPerPlace();
    }
}