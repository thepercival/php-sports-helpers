<?php

declare(strict_types=1);

namespace SportsHelpers;

use SportsHelpers\Sport\HelperTrait;
use SportsHelpers\Sport\Helper as SportHelper;

class SportConfig implements SportHelper
{
    use HelperTrait;

    public function __construct(
        protected SportBase $sportBase,
        protected int $nrOfFields,
        protected int $gameAmount
    ){
    }

    public function getSport(): SportBase
    {
        return $this->sportBase;
    }

    public function getNrOfFields(): int
    {
        return $this->nrOfFields;
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
}
