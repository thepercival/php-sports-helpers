<?php
declare(strict_types=1);

namespace SportsHelpers\Sport;

interface Variant
{
    public function getGameMode(): int;
    public function getNrOfGamePlaces(): int;
}
