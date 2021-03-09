<?php

declare(strict_types=1);

namespace SportsHelpers;

class SportConfig
{
    protected int $nrOfFields;
    protected SportBase $sportBase;
    protected int $gameAmount;

    public function __construct(SportBase $sportBase, int $nrOfFields, int $gameAmount)
    {
        $this->nrOfFields = $nrOfFields;
        $this->sportBase = $sportBase;
        $this->gameAmount = $gameAmount;
    }

    public function getSport(): SportBase
    {
        return $this->sportBase;
    }

    public function getNrOfFields(): int
    {
        return $this->nrOfFields;
    }

    public function getGameMode(): int
    {
        return $this->sportBase->getGameMode();
    }

    public function getNrOfGamePlaces(): int
    {
        return $this->sportBase->getNrOfGamePlaces();
    }

    public function getGameAmount(): int
    {
        return $this->gameAmount;
    }

    public function getNrOfGames(int $nrOfPlaces): int
    {
        if ($this->getGameMode() === GameMode::TOGETHER) {
            $nrOfTotalGamePlaces = $this->getGameAmount() * $nrOfPlaces;
            $nrOfTotalGamePlaces += ($this->getNrOfGamePlaces() - ($nrOfTotalGamePlaces % $this->getNrOfGamePlaces()));
            return $nrOfTotalGamePlaces / $this->getNrOfGamePlaces();
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

    public function toArray(): array
    {
        return [
            "gameMode" => $this->getGameMode(),
            "nrOfFields" => $this->getNrOfFields(),
            "nrOfGamePlaces" => $this->getNrOfGamePlaces(),
            "gameAmount" => $this->getGameAmount()];
    }
}
