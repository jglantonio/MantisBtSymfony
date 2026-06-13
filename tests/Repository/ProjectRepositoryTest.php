<?php

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\Project;
use App\Entity\User;
use App\Repository\ProjectRepository;

class ProjectRepositoryTest extends KernelTestCase
{
    private ?ProjectRepository $projectRepository = null;
    private ?Project $project = null;

    protected function setUp(): void
    {
        parent::setUp();
        $kernel = self::bootKernel();
        $this->projectRepository = $kernel->getContainer()->get(ProjectRepository::class);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        if ($this->project) {
            $this->projectRepository->getEntityManager()->remove($this->project);
            $this->projectRepository->getEntityManager()->flush();
        }
    }

    public function testFindProject(): void
    {
        $this->project = new Project();
        $this->project->setName('Test Project');
        $this->project->setStatus('10');
        $this->project->setEnabled('1');
        $this->project->setAccessMin(90);
        $this->project->setViewState(10);
        $this->projectRepository->getEntityManager()->persist($this->project);
        $this->projectRepository->getEntityManager()->flush();

        $result = $this->projectRepository->find($this->project->getId());
        $this->assertNotNull($result);
        $this->assertEquals($this->project->getId(), $result->getId());
        $this->assertEquals('Test Project', $result->getName());
    }

    public function testFindByUser(): void
    {
        $user = new User();
        $user->setUsername('projectuser');
        $user->setRealname('Project User');
        $user->setEmail('project@example.com');
        $user->setEnabled(1);
        $user->setProtected(0);
        $user->setAccessLevel(90);
        $user->setPassword('password');
        $this->projectRepository->getEntityManager()->persist($user);
        $this->projectRepository->getEntityManager()->flush();

        $this->project = new Project();
        $this->project->setName('Test Project for User');
        $this->project->setStatus('10');
        $this->project->setEnabled('1');
        $this->project->setAccessMin(90);
        $this->project->setViewState(10);
        $this->projectRepository->getEntityManager()->persist($this->project);
        $this->projectRepository->getEntityManager()->flush();

        $this->projectRepository->getEntityManager()->flush();

        $result = $this->projectRepository->findByUser($user->getId());
        $this->assertNotNull($result);
        $this->assertGreaterThan(0, count($result));
    }

    public function testCount(): void
    {
        $count = $this->projectRepository->count([]);
        $this->assertIsInt($count);
    }
}
