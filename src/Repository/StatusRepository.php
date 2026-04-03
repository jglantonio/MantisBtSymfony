<?php

namespace App\Repository;

use App\Entity\Status;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Status>
 */
class StatusRepository extends ServiceEntityRepository
{
    const STATUS_DEVELOPMENT = 10;
    const STATUS_RELEASE = 20;
    const STATUS_ESTABLE = 50;
    const STATUS_OBSOLETE = 70;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Status::class);
    }

    public function getStatus(){
        return [
            self::STATUS_DEVELOPMENT  => 'En desarrollo',
            self::STATUS_RELEASE => 'Release',
            self::STATUS_ESTABLE => 'Estable',
            self::STATUS_OBSOLETE => 'Obsoleto',
        ];
    }

    public static function getStatusById($id): string
    {
        return [
            10  => 'En desarrollo',
            self::STATUS_RELEASE => 'Release',
            self::STATUS_ESTABLE => 'Estable',
            self::STATUS_OBSOLETE => 'Obsoleto',
        ][$id];
    }
}
