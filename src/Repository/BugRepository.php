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
     * @param int $handlerId
     * @return mixed
     */

    public function getIncidenciasByHandlerId(int $handlerId)
    {
        return $this->createQueryBuilder('b')
            ->where('b.handlerId = :handlerId')
            ->setParameter('handlerId', $handlerId)
            ->getQuery()
            ->getResult();
    }

    /**
     * Bugs by reporter_id
     * @param int $reporterId
     * @return mixed
     */
    public function getIncidenciasByReporterId(int $reporterId)
    {
        return $this->createQueryBuilder('b')
            ->where('b.reporterId = :reporterId')
            ->setParameter('reporterId', $reporterId)
            ->getQuery()
            ->getResult();
    }
}
