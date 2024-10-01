<?php

declare(strict_types=1);

namespace SportsHelpers\SportVariants\Persist;

use SportsHelpers\SportVariants\AgainstOneVsOne;
use SportsHelpers\SportVariants\AgainstOneVsTwo;
use SportsHelpers\SportVariants\AgainstTwoVsTwo;
use SportsHelpers\SportVariants\AllInOneGame;
use SportsHelpers\SportVariants\Single;

readonly class SportPersistVariantWithNrOfFields implements \Stringable
{    protected SportPersistVariant $persistVariant;

    public function __construct(
        AgainstOneVsOne|AgainstOneVsTwo|AgainstTwoVsTwo|Single|AllInOneGame $sportVariant,
        public int $nrOfFields
    ) {
        $this->persistVariant = $sportVariant->toPersistVariant();
    }

    public function createSportVariant(): AgainstOneVsOne|AgainstOneVsTwo|AgainstTwoVsTwo|Single|AllInOneGame
    {
        return $this->persistVariant->createVariant();
    }

    public function __toString(): string
    {
        return $this->createSportVariant() . ' f(' . $this->nrOfFields . ')';
    }
}
