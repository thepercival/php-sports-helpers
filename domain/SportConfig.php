<?php

namespace SportsHelpers;

class SportConfig
{
    /**
     * @var int
     */
    protected $nrOfFields;
    /**
     * @var int
     */
    protected $nrOfGamePlaces;

    public function __construct(int $nrOfFields, int $nrOfGamePlaces)
    {
        $this->nrOfFields = $nrOfFields;
        $this->nrOfGamePlaces = $nrOfGamePlaces;
    }

    public function getNrOfFields(): int
    {
        return $this->nrOfFields;
    }

    public function getNrOfGamePlaces(): int
    {
        return $this->nrOfGamePlaces;
    }

    public function toArray(): array {
        return ["nrOfFields" => $this->getNrOfFields(), "nrOfGamePlaces" => $this->getNrOfGamePlaces() ];
    }
}