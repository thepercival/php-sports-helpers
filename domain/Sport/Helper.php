<?php
declare(strict_types=1);

namespace SportsHelpers\Sport;

interface Helper
{
    public function getGameMode(): int;
    public function getNrOfGamePlaces(): int;
    public function getGameAmount(): int;
}
