<?php

namespace App\Repository;

use App\Entity\Bug;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bug>
 */
class BugRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bug::class);
    }

    /**
     * Bugs by handler_id
     * @param int $int
     * @return mixed
     */

    public function getIncidenciasByHandlerId(int $int)
    {
        return $this->createQueryBuilder('b')
            ->where('b.handler_id = :int')
            ->setParameter('int', $int)
            ->getQuery()
            ->getResult();
    }

    /**
     * Bugs by reporter_id
     * @param int $int
     * @return mixed
     */
    public function getIncidenciasByReporterId(int $int)
    {
        return $this->createQueryBuilder('b')
            ->where('b.reporter_id = :int')
            ->setParameter('int', $int)
            ->getQuery()
            ->getResult();
    }
}
