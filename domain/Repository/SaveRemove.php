<?php

namespace SportsHelpers\Repository;

/**
 * @template T
 */
interface SaveRemove
{
    /**
     * @var T
     * @return T
     */
    public function save(mixed $object): mixed;
    /**
     * @var T
     */
    public function remove(mixed $object): void;
}
