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
     * @return T
     * @throws Exception
     */
    public function save(mixed $object): mixed
    {
        try {
            $this->_em->persist($object);
            $this->_em->flush();
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), E_ERROR);
        }

        return $object;
    }

    /**
     * @param T $object
     */
    public function remove(mixed $object): void
    {
        $this->_em->remove($object);
        $this->_em->flush();
    }
}
