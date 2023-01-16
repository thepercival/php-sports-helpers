<?php

declare(strict_types=1);

namespace SportsHelpers\Sport\Variant;

use SportsHelpers\Against\Side;
use SportsHelpers\GameMode;
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
            return $this->getNrOfAwayPlaces();
        } else if( $side === Side::Away) {
            return $this->getNrOfHomePlaces();
        }
        return (int)($this->getNrOfHomePlaces() * $this->getNrOfAwayPlaces());

    }

    public function getNrOfWithCombinationsPerGame(Side|null $side = null): int {
//        $nrOfHomeWithCombinations = $this->getNrOfHomePlaces() > 1 ? 1 : 0;
//        $nrOfAwayWithCombinations = $this->getNrOfAwayPlaces() > 1 ? 1 : 0;
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
