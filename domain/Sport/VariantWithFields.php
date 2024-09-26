<?php

declare(strict_types=1);

namespace SportsHelpers\Sport;

use SportsHelpers\SportVariants\AllInOneGame;
use SportsHelpers\SportVariants\AgainstGpp;
use SportsHelpers\SportVariants\AgainstH2h;
use SportsHelpers\SportVariants\Single;

class VariantWithFields implements \Stringable
{
    protected PersistVariant $persistVariant;

    public function __construct(
        AgainstH2h|AgainstGpp|Single|AllInOneGame $sportVariant,
        protected int $nrOfFields
    ) {
        $this->persistVariant = $sportVariant->toPersistVariant();
    }

    public function getSportVariant(): AgainstH2h|AgainstGpp|Single|AllInOneGame
    {
        return $this->persistVariant->createVariant();
    }

    public function getPersistVariant(): PersistVariant {
        return $this->persistVariant;
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
