<?php

declare(strict_types=1);

namespace SportsHelpers\SportVariants;

use SportsHelpers\Against\Side;
use SportsHelpers\GameModeBase;
use SportsHelpers\GameMode;
use SportsHelpers\Sport\Variant;
use SportsHelpers\SportMath;

// gebruik bij 1 vs 1: Opgegeven in H2h(3 en 2 even vaak tegen elkaar)
// gebruik bij Mixed: NrOfGamesPerPlace(3 en 2 even veel wedstrijden)
readonly abstract class AgainstAbstract implements Variant
{
    public function __construct(public int $nrOfHomePlaces, public int $nrOfAwayPlaces)
    {
        if ($this->nrOfHomePlaces < 1 || $this->nrOfAwayPlaces < 1) {
            throw new \Exception('nrOfHomePlaces and nrOfAwayPlaces should be at least 1', E_ERROR);
        }
        if ($this->nrOfHomePlaces > $this->nrOfAwayPlaces) {
            throw new \Exception('nrOfHomePlaces should be smaller than nrOfAwayPlaces', E_ERROR);
        }
    }

    public function getGameMode(): GameMode {
        return GameMode::Against;
    }

    public function getNrOfSidePlaces(Side $side): int
    {
        return $side === Side::Home ? $this->nrOfHomePlaces : $this->nrOfAwayPlaces;
    }

    public function getNrOfGamePlaces(): int
    {
        return $this->nrOfHomePlaces + $this->nrOfAwayPlaces;
    }

    public function hasMultipleSidePlaces(): bool
    {
        return $this->getNrOfGamePlaces() > 2;
    }

    public function getNrOfGamesOneH2h(int $nrOfPlaces): int
    {
        $nrOfCombinations = (new SportMath())->above($nrOfPlaces, $this->getNrOfGamePlaces());
        return (int)($nrOfCombinations * $this->getNrOfHomeAwayCombinations());
    }

    /**
     * 2 gameplaces => 1 : 1 vs 2
     * 3 gameplaces => 2 : 1 vs 3 & 2 vs 3
     * 4 gameplaces => 4 : 1 vs 3, 1 vs 4, 2 vs 3 & 2 vs 4
     * 6 gameplaces => 9 :  1 vs 4, 1 vs 5, 1 vs 6, 2 vs 4, 2 vs 5, 2 vs 6, 3 vs 4, 3 vs 5 & 3 vs 6
     *
     * @return int
     */
    public function getNrOfAgainstCombinationsPerGame(Side|null $side = null): int {
        if( $side === Side::Home) {
            return $this->nrOfAwayPlaces;
        } else if( $side === Side::Away) {
            return $this->nrOfHomePlaces;
        }
        return (int)($this->nrOfHomePlaces * $this->nrOfAwayPlaces);

    }

    public function getNrOfWithCombinationsPerGame(Side|null $side = null): int {
//        $nrOfHomeWithCombinations = $this->nrOfHomePlaces > 1 ? 1 : 0;
//        $nrOfAwayWithCombinations = $this->nrOfAwayPlaces() > 1 ? 1 : 0;
        if( $side === Side::Home) {
            return 1;
        } else if( $side === Side::Away) {
            return 1;
        }
        return 2;
    }

    /**
     * 2 gameplaces => 1 : 1 vs 2
     * 4 gameplaces => 3 : 1 2 vs 3 4, 1 3 vs 2 4, 1 4 vs 2 3
     * 6 gameplaces => 10 :  1 2 3 vs 4 5 6, 1 2 4 vs 3 5 6, 1 2 5 vs 3 5 6 ..
     *
     * @return int
     */
    public function getNrOfHomeAwayCombinations(): int
    {
        if ($this->nrOfHomePlaces !== $this->nrOfAwayPlaces) {
            return (new SportMath())->above($this->getNrOfGamePlaces(), $this->nrOfHomePlaces)
                * (new SportMath())->above($this->getNrOfGamePlaces() - $this->nrOfHomePlaces, $this->nrOfAwayPlaces);
        }
        $nrOfSides = 2;
        $nrOfFormations = (new SportMath())->above($this->getNrOfGamePlaces(), $this->nrOfHomePlaces);
        return (int)($nrOfFormations / $nrOfSides); // remove symetric
    }

    public function __toString()
    {
        return 'against(' . $this->nrOfHomePlaces . 'vs' . $this->nrOfAwayPlaces . ')' . ' h2h:gpp=>';
    }
}
