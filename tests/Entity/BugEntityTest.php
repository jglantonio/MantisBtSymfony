<?php

namespace App\Tests\Repository;

use App\Entity\Bug;
use App\Repository\BugRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BugEntityTest extends KernelTestCase
{
    private $entityManager;
    private $bugRepository;
    protected function setUp(): void{
        self::bootKernel();
        $container = static::getContainer();
        $this->entityManager = $container->get(EntityManagerInterface::class);
        $this->bugRepository = $container->get(BugRepository::class);
    }

    public function testCreateBug(){

        $bug = new Bug();
        $bug->setProjectId(1);
        $bug->setReporterId(100);
        $bug->setHandlerId(200);
        $bug->setDuplicatedId(0);
        $bug->setPriority(30);
        $bug->setSeverity(10);
        $bug->setReproducibility(10);
        $bug->setStatus(50);
        $bug->setResolution(10);
        $bug->setEta(10);
        $bug->setBugTextId(10);
        $bug->setSummary("Test bug");
        $bug->setCategoryId(1);
        $bug->setLastUpdated(time());
        $bug->setDateSubmitted(time());
        $this->entityManager->persist($bug);
        $this->entityManager->flush();
        $this->entityManager->clear();

        $this->assertIsObject($this->bugRepository->find($bug->getId()));
    }
}

