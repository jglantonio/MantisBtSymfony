<?php

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Repository\StatusRepository;

class StatusRepositoryTest extends KernelTestCase
{
    private ?StatusRepository $statusRepository = null;

    protected function setUp(): void
    {
        parent::setUp();
        $kernel = self::bootKernel();
        $this->statusRepository = $kernel->getContainer()->get(StatusRepository::class);
    }

    public function testGetStatus(): void
    {
        $status = $this->statusRepository->getStatus();
        $this->assertIsArray($status);
        $this->assertArrayHasKey(10, $status);
        $this->assertArrayHasKey(20, $status);
        $this->assertArrayHasKey(50, $status);
        $this->assertArrayHasKey(70, $status);
        $this->assertEquals('En desarrollo', $status[10]);
        $this->assertEquals('Release', $status[20]);
        $this->assertEquals('Estable', $status[50]);
        $this->assertEquals('Obsoleto', $status[70]);
    }

    public function testGetStatusById(): void
    {
        $this->assertEquals('En desarrollo', StatusRepository::getStatusById(10));
        $this->assertEquals('Release', StatusRepository::getStatusById(20));
        $this->assertEquals('Estable', StatusRepository::getStatusById(50));
        $this->assertEquals('Obsoleto', StatusRepository::getStatusById(70));
    }
}
