<?php
declare(strict_types=1);

namespace SportsHelpers;

class Identifiable {
    protected int|string $id;

    public function getId(): int|string
    {
        return $this->id;
    }

    public function setId(int|string $id)
    {
        $this->id = $id;
    }
}