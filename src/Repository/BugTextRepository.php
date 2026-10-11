<?php

namespace App\Repository;

use App\Entity\BugText;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BugText>
 */
class BugTextRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BugText::class);
    }

    /**
     * Get BugTextById
     * @param int $id
     * @return BugText
     */
    public function findById(int $id) : BugText
    {
        return $this->findOneBy(['id' => $id]);
    }
}
