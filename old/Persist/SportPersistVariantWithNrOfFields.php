<?php

declare(strict_types=1);

namespace oldsportshelpers\old\Persist;

use oldsportshelpers\old\AllInOneGame;
use oldsportshelpers\old\Single;
use SportsHelpers\Sports\AgainstSportOneVsOne;
use SportsHelpers\Sports\AgainstSportOneVsTwo;
use SportsHelpers\Sports\AgainstSportTwoVsTwo;

readonly class SportPersistVariantWithNrOfFields implements \Stringable
{    protected SportPersistVariant $persistVariant;

    public function __construct(
        AgainstSportOneVsOne|AgainstSportOneVsTwo|AgainstSportTwoVsTwo|Single|AllInOneGame $sportVariant,
        public int                                                                         $nrOfFields
    ) {
        $this->persistVariant = $sportVariant->toPersistVariant();
    }

    public function createSportVariant(): AgainstSportOneVsOne|AgainstSportOneVsTwo|AgainstSportTwoVsTwo|Single|AllInOneGame
    {
        return $this->persistVariant->createVariant();
    }

    public function __toString(): string
    {
        return $this->createSportVariant() . ' f(' . $this->nrOfFields . ')';
    }
}
