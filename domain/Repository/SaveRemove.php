<?php

namespace SportsHelpers\Repository;

/**
 * @template T
 */
interface SaveRemove
{
    /**
     * @param T $object
     * @return T
     */
    public function save(mixed $object): mixed;
    /**
     * @param T $object
     */
    public function remove(mixed $object): void;
}
