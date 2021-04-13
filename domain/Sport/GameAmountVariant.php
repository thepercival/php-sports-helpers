<?php
declare(strict_types=1);

namespace SportsHelpers\Sport;

use SportsHelpers\GameMode;
use SportsHelpers\Identifiable;
use SportsHelpers\SportMath;

class GameAmountVariant extends Identifiable implements Variant, \Stringable
{
    public function __construct(
        protected int $gameMode,
        protected int $nrOfGamePlaces,
        protected int $nrOfFields,
        protected int $gameAmount
    ) {
    }

    public function getNrOfFields(): int
    {
        return $this->nrOfFields;
    }

    public function getGameMode(): int
    {
        return $this->gameMode;
    }

    public function getNrOfGamePlaces(): int
    {
        return $this->nrOfGamePlaces;
    }

    public function getGameAmount(): int
    {
        return $this->gameAmount;
    }

    public function allPlacesAreGamePlaces(): bool
    {
        return $this->getNrOfGamePlaces() === 0;
    }

    public function getNrOfGames(int $nrOfPlaces): int
    {
        if ($this->getGameMode() === GameMode::TOGETHER) {
            $nrOfTotalGamePlaces = $this->getGameAmount() * $nrOfPlaces;
            $nrOfTotalGamePlaces += ($this->getNrOfGamePlaces() - ($nrOfTotalGamePlaces % $this->getNrOfGamePlaces()));
            return (int)($nrOfTotalGamePlaces / $this->getNrOfGamePlaces());
        }
        $nrOfHomePlaces = (int)ceil($this->getNrOfGamePlaces() / 2);
        $nrOfAwayPlaces = $this->getNrOfGamePlaces() - $nrOfHomePlaces;

        $nrOfHomeCombinations = (new SportMath())->above($nrOfPlaces, $nrOfHomePlaces);
        $nrOfAwayCombinations = (new SportMath())->above($nrOfPlaces - $nrOfHomePlaces, $nrOfAwayPlaces);

        $nrOfGames = (int)(($nrOfHomeCombinations * $nrOfAwayCombinations) / 2);
        return $nrOfGames * $this->getGameAmount();
    }

    public function getNrOfGameRounds(int $nrOfPlaces): int
    {
        if ($this->getGameMode() === GameMode::TOGETHER) {
            return $this->gameAmount;
        }
        $nrOfGames = $this->getNrOfGames($nrOfPlaces);
        $nrOfGamesPerGameRound = (int)floor($nrOfPlaces / $this->getNrOfGamePlaces());
        return (int)ceil($nrOfGames / $nrOfGamesPerGameRound);
    }

//    public function getNrOfGamePlacesSimultaneously(bool $selfReferee): int
//    {
//        $delta = $selfReferee ? 1 : 0;
//        return ($this->getNrOfGamePlaces() + $delta) * $this->getNrOfFields();
//    }

    public function getNrOfGamesPerPlace(int $nrOfPlaces): int
    {
        if ($this->getGameMode() === GameMode::TOGETHER) {
            return $this->getGameAmount();
        }
        $nrOfHomeGames = $this->getNrOfGames($nrOfPlaces);
        $nrOfHomeGamesOneLess = $this->getNrOfGames($nrOfPlaces-1);
        return ($nrOfHomeGames - $nrOfHomeGamesOneLess) * $this->getGameAmount();
    }

    /**
     * @return array<string,int>
     */
    public function toArray(): array
    {
        return [
            "gameMode" => $this->getGameMode(),
            "nrOfFields" => $this->getNrOfFields(),
            "nrOfGamePlaces" => $this->getNrOfGamePlaces(),
            "gameAmount" => $this->getGameAmount()];
    }

    public function __toString()
    {
        return ($this->getGameMode() === GameMode::AGAINST ? 'A' : 'T') . '-' .
            $this->getNrOfFields() . '-' .
            $this->getNrOfGamePlaces() . '-' .
            $this->getGameAmount();
    }
}
