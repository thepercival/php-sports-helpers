<?php
declare(strict_types=1);

namespace SportsHelpers;

/**
 * @template T
 */
class Counter implements \Countable
{
    /**
     * @param T $countedObject
     */
    public function __construct(protected mixed $countedObject, protected int $count = 0)
    {
    }

    public function decrement(): void
    {
        $this->count--;
    }

    public function increment(): void
    {
        $this->count++;
    }

    public function count(): int
    {
        return $this->count;
    }
}
