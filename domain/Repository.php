<?php
declare(strict_types=1);

namespace SportsHelpers;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Exception;

class Repository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em, ClassMetadata $class)
    {
        parent::__construct($em, $class);
    }

    public function remove(object $object): void
    {
        $this->_em->remove($object);
        $this->_em->flush();
    }

    public function getEM(): EntityManagerInterface
    {
        return $this->getEntityManager();
    }
}
