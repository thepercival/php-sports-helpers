<?php
declare(strict_types=1);

namespace SportsHelpers;

use Exception;
use SportsHelpers\Repository\SaveRemove;

/**
 * @template-implements SaveRemove<T>
 */
trait Repository
{
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

    public function remove(mixed $object): void
    {
        $this->_em->remove($object);
        $this->_em->flush();
    }
}