<?php
declare(strict_types=1);

namespace SportsHelpers\Sport;

use SportsHelpers\Sport\Variant as SportVariant;

class VariantWithFields implements \Stringable
{
    public function __construct(
        protected SportVariant $sportVariant,
        protected int $nrOfFields
    ) {
    }

    public function getSportVariant(): SportVariant
    {
        return $this->sportVariant;
    }

    public function getNrOfFields(): int
    {
        return $this->nrOfFields;
    }

    public function __toString(): string {
        return $this->getSportVariant() . ' f(' . $this->nrOfFields . ')';
    }
}
