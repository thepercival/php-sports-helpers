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

    /**
     * @return self<T>
     */
    public function reset2(): self
    {
        return new self($this->countedObject);
    }

    /**
     * @return self<T>
     */
    public function decrement(): self
    {
        return new self($this->countedObject, $this->count - 1 );
    }

    /**
     * @return self<T>
     */
    public function increment(): self
    {
        return new self($this->countedObject, $this->count + 1 );
    }

    /**
     * @return self<T>
     */
    public function increase(int $count): self
    {
        return new self($this->countedObject, $this->count + $count );
    }

    public function count(): int
    {
        return $this->count;
    }
}
