<?php

namespace SportsHelpers;

interface PlaceLocationInterface
{
    public function getPouleNr(): int;
    public function getPlaceNr(): int;
    public function getUniqueIndex(): string;
}