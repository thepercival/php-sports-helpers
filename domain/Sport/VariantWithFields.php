<?php

declare(strict_types=1);

namespace SportsHelpers\Sport;

use SportsHelpers\Sport\Variant\Against\H2h as AgainstH2h;
use SportsHelpers\Sport\Variant\Against\GamesPerPlace as AgainstGpp;
use SportsHelpers\Sport\Variant\AllInOneGame;
use SportsHelpers\Sport\Variant\Single;

class VariantWithFields implements \Stringable
{
    public function __construct(
        protected AgainstH2h|AgainstGpp|Single|AllInOneGame $sportVariant,
        protected int $nrOfFields
    ) {
    }

    public function getSportVariant(): AgainstH2h|AgainstGpp|Single|AllInOneGame
    {
        return $this->sportVariant;
    }

    public function getPersistVariant(): PersistVariant {
        return $this->sportVariant->toPersistVariant();
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
