<?php

declare(strict_types=1);

namespace SportsHelpers\Sport;

use SportsHelpers\Sport\Variant\Against\H2h as AgainstH2h;
use SportsHelpers\Sport\Variant\Against\GamesPerPlace as AgainstGpp;
use SportsHelpers\Sport\Variant\AllInOneGame;
use SportsHelpers\Sport\Variant\Single;

final class VariantWithFields implements \Stringable
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

    #[\Override]
    public function __toString(): string
    {
        return ((string)$this->getSportVariant()) . ' f(' . $this->nrOfFields . ')';
    }
}
