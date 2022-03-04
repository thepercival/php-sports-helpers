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

    public function reset(): void
    {
        $this->count = 0;
    }

    public function decrement(): int
    {
        $this->count--;
        return $this->count;
    }

    public function increment(): int
    {
        $this->count++;
        return $this->count;
    }

    public function increase(int $count): void
    {
        $this->count += $count;
    }

    public function count(): int
    {
        return $this->count;
    }
}
