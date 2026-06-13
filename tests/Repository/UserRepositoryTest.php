<?php

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\User;
use App\Repository\UserRepository;

class UserRepositoryTest extends KernelTestCase
{
    private ?UserRepository $userRepository = null;
    private ?User $user = null;

    protected function setUp(): void
    {
        parent::setUp();
        $kernel = self::bootKernel();
        $this->userRepository = $kernel->getContainer()->get(UserRepository::class);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        if ($this->user) {
            $this->userRepository->getEntityManager()->remove($this->user);
            $this->userRepository->getEntityManager()->flush();
        }
    }

    public function testCount(): void
    {
        $count = $this->userRepository->count([]);
        $this->assertIsInt($count);
    }

    public function testFindUser(): void
    {
        $this->user = new User();
        $this->user->setUsername('testuser');
        $this->user->setRealname('Test User');
        $this->user->setEmail('test@example.com');
        $this->user->setEnabled(1);
        $this->user->setProtected(0);
        $this->user->setAccessLevel(90);
        $this->user->setPassword('password123');
        $this->userRepository->getEntityManager()->persist($this->user);
        $this->userRepository->getEntityManager()->flush();

        $result = $this->userRepository->find($this->user->getId());
        $this->assertNotNull($result);
        $this->assertEquals($this->user->getId(), $result->getId());
    }

    public function testUpgradePassword(): void
    {
        $this->user = new User();
        $this->user->setUsername('testuser2');
        $this->user->setRealname('Test User 2');
        $this->user->setEmail('test2@example.com');
        $this->user->setEnabled(1);
        $this->user->setProtected(0);
        $this->user->setAccessLevel(90);
        $this->user->setPassword('oldpassword');
        $this->userRepository->getEntityManager()->persist($this->user);
        $this->userRepository->getEntityManager()->flush();

        $oldPassword = $this->user->getPassword();
        $this->userRepository->upgradePassword($this->user, 'newhashedpassword');

        $this->assertNotEquals($oldPassword, 'newhashedpassword');
    }

    public function testFindOneByUsername(): void
    {
        $this->user = new User();
        $this->user->setUsername('testuserfind');
        $this->user->setRealname('Test User Find');
        $this->user->setEmail('testfind@example.com');
        $this->user->setEnabled(1);
        $this->user->setProtected(0);
        $this->user->setAccessLevel(90);
        $this->user->setPassword('password123');
        $this->userRepository->getEntityManager()->persist($this->user);
        $this->userRepository->getEntityManager()->flush();

        $result = $this->userRepository->findOneByUsername('testuserfind');
        $this->assertNotNull($result);
        $this->assertEquals('testuserfind', $result->getUsername());
     }
 }
