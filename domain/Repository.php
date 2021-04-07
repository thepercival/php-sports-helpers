<?php
declare(strict_types=1);

namespace SportsHelpers;

use Exception;

/**
 * @psalm-template T
 */
trait Repository
{
    /**
     * @psalm-var T
     * @psalm-return T
     */
    public function save(object $object): object
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
     * @psalm-var T
     */
    public function remove(object $object): void
    {
        $this->_em->remove($object);
        $this->_em->flush();
    }
}
