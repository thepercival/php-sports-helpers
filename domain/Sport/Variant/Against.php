<?php
declare(strict_types=1);

namespace SportsHelpers\Sport\Variant;

use SportsHelpers\GameMode;
use SportsHelpers\Identifiable;
use SportsHelpers\Sport\PersistVariant;
use SportsHelpers\Sport\Variant;
use SportsHelpers\Sport\Variant as SportVariant;
use SportsHelpers\SportMath;

class Against extends Identifiable implements Variant
{
    protected int $gameMode;

    public function __construct(protected int $nrOfHomePlaces, protected int $nrOfAwayPlaces, protected int $nrOfH2H, protected int $nrOfPartials)
    {
        $this->gameMode = GameMode::AGAINST;
    }

    public function getGameMode(): int
    {
        return $this->gameMode;
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

    public function isMixed(): bool
    {
        return $this->getNrOfGamePlaces() > 2;
    }

    public function getNrOfH2H(): int
    {
        return $this->nrOfH2H;
    }

    public function getNrOfPartials(): int
    {
        return $this->nrOfPartials;
    }

    public function allPlacesParticipate(int $nrOfPlaces): bool
    {
        return $this->getNrOfGamePlaces() >= $nrOfPlaces;
    }

    public function getNrOfGamesPerPartial(int $nrOfPlaces): int
    {
        if (!$this->isMixed()) {
            throw new \Exception('getNrOfGamesPerPartial can not be called when not in mixed mode', E_ERROR);
        }
        if ($nrOfPlaces > $this->getNrOfGamePlaces() && ($nrOfPlaces % $this->getNrOfGamePlaces()) === 0) {
            return $nrOfPlaces / $this->getNrOfGamePlaces();
        }
        $smallestCommonDividend = (new SportMath())->getSmallestCommonDividend($nrOfPlaces, $this->getNrOfGamePlaces());
        return $smallestCommonDividend / $this->getNrOfGamePlaces();
    }

    public function getTotalNrOfGames(int $nrOfPlaces): int
    {
        if ($this->isMixed()) {
            return $this->getNrOfPartials() * $this->getNrOfGamesPerPartial($nrOfPlaces);
        }
        return $this->getTotalNrOfGamesOneH2H($nrOfPlaces) * $this->getNrOfH2H();
    }

    public function getNrOfPartialsPerH2H(int $nrOfPlaces): int
    {
        if (!$this->isMixed()) {
            throw new \Exception('getNrOfPartialsPerH2H can not be called when not in mixed mode', E_ERROR);
        }
        $nrOfGamesPerPartial = $this->getNrOfGamesPerPartial($nrOfPlaces);
        return (int)($this->getTotalNrOfGamesOneH2H($nrOfPlaces) / $nrOfGamesPerPartial);
    }

    protected function getTotalNrOfGamesOneH2H(int $nrOfPlaces): int
    {
        $nrOfHomeCombinations = (new SportMath())->above($nrOfPlaces, $this->getNrOfHomePlaces());
        $nrOfAwayCombinations = (new SportMath())->above($nrOfPlaces - $this->getNrOfHomePlaces(), $this->getNrOfAwayPlaces());

        $nrOfCombinations = $nrOfHomeCombinations * $nrOfAwayCombinations;
        if ($this->getNrOfHomePlaces() === $this->getNrOfAwayPlaces()) {
            return (int)($nrOfCombinations / 2);
        }
        return $nrOfCombinations;
    }

    public function getNrOfGameRounds(int $nrOfPlaces): int
    {
        $nrOfGames = $this->getTotalNrOfGames($nrOfPlaces);
        $nrOfGamesPerGameRound = (int)floor($nrOfPlaces / $this->getNrOfGamePlaces());
        return (int)ceil($nrOfGames / $nrOfGamesPerGameRound);
    }

    public function getTotalNrOfGamesPerPlaceOneH2H(int $nrOfPlaces): int
    {
        // bij mixed 2vs2 en 6 deelnemers d
        $nrOfGamesOneH2H = $this->getTotalNrOfGamesOneH2H($nrOfPlaces);
        $nrOfGamesOneH2HOneLess = $this->getTotalNrOfGamesOneH2H($nrOfPlaces-1);
        return $nrOfGamesOneH2H - $nrOfGamesOneH2HOneLess;
    }

    public function getTotalNrOfGamesPerPlace(int $nrOfPlaces): int
    {
        if ($this->isMixed()) {
            return $this->getNrOfGamePlaces() * $this->getNrOfPartials();
        }
        return $this->getTotalNrOfGamesPerPlaceOneH2H($nrOfPlaces) * $this->getNrOfH2H();
    }

    public function createPersistVariant(): PersistVariant
    {
        return new PersistVariant(
            $this->getGameMode(),
            $this->getNrOfHomePlaces(),
            $this->getNrOfAwayPlaces(),
            $this->getNrOfH2H(),
            $this->getNrOfPartials(),
            0,
            0
        );
    }

    public function __toString()
    {
        $base = 'AGAINST : ' . $this->getNrOfHomePlaces() . 'vs' . $this->getNrOfAwayPlaces();
        if ($this->isMixed()) {
            return $base . ' : partials ' . $this->getNrOfPartials();
        }
        return $base . ' : h2h ' . $this->getNrOfH2H();
    }
}
