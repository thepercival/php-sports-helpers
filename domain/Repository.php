<?php

declare(strict_types=1);

namespace SportsHelpers;

use Exception;

/**
 * @template T
 */
trait Repository
{
    /**
     * @param T $object
     * @param bool $noFlush
     * @return T
     * @throws Exception
     */
    public function save(mixed $object, bool $onlyFlushObject = false): mixed
    {
        try {
            $this->getEntityManager()->persist($object);
            $this->flush($onlyFlushObject ? $object : null);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), E_ERROR);
        }

        return $object;
    }


    /**
     * @param T $object
     * @param bool $noFlush
     */
    public function remove(mixed $object, bool $onlyFlushObject = false): void
    {
        $this->getEntityManager()->remove($object);
        $this->flush($onlyFlushObject ? $object : null);
    }

    /**
     * @param T|null $object
     */
    public function flush(mixed $object = null): void
    {
        $this->getEntityManager()->flush($object);
    }
}
