<?php

declare(strict_types=1);

namespace SportsHelpers\Sport;

use SportsHelpers\Sport\Variant\Against as AgainstSportVariant;
use SportsHelpers\Sport\Variant\AllInOneGame as AllInOneGameSportVariant;
use SportsHelpers\Sport\Variant\Single as SingleSportVariant;

class VariantWithFields implements \Stringable
{
    public function __construct(
        protected AgainstSportVariant|SingleSportVariant|AllInOneGameSportVariant $sportVariant,
        protected int $nrOfFields
    ) {
    }

    public function getSportVariant(): AgainstSportVariant|SingleSportVariant|AllInOneGameSportVariant
    {
        return $this->sportVariant;
    }

    public function getNrOfFields(): int
    {
        return $this->nrOfFields;
    }

    public function __toString(): string
    {
        return $this->getSportVariant() . ' f(' . $this->nrOfFields . ')';
    }
}
