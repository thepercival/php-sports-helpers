<?php

declare(strict_types=1);

namespace SportsHelpers;

/**
 * @template T
 */
readonly class Counter implements \Countable
{
    /**
     * @param T $countedObject
     */
    public function __construct(protected mixed $countedObject, protected int $count = 0)
    {
    }

    public function count(): int
    {
        return $this->count;
    }
}
