<?php

declare(strict_types=1);

namespace SportsHelpers\Sport;

use SportsHelpers\SportVariants\AgainstOneVsTwo;
use SportsHelpers\SportVariants\AgainstTwoVsTwo;
use SportsHelpers\SportVariants\AllInOneGame;
use SportsHelpers\SportVariants\AgainstOneVsOne;
use SportsHelpers\SportVariants\Single;

class VariantWithFields implements \Stringable
{
    protected PersistVariant $persistVariant;

    public function __construct(
        AgainstOneVsOne|AgainstOneVsTwo|AgainstTwoVsTwo|Single|AllInOneGame $sportVariant,
        protected int                                  $nrOfFields
    ) {
        $this->persistVariant = $sportVariant->toPersistVariant();
    }

    public function getSportVariant(): AgainstOneVsOne|AgainstOneVsTwo|AgainstTwoVsTwo|Single|AllInOneGame
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
