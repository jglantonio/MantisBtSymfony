<?php

namespace App\Repository;

use App\Entity\BugEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BugEntity>
 */
class BugEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BugEntity::class);
    }

    public function getIncidenciasByHandlerId(int $int)
    {
        return $this->createQueryBuilder('b')
            ->where('b.handler_id = :int')
            ->setParameter('int', $int)
            ->getQuery()
            ->getResult();
    }
}
