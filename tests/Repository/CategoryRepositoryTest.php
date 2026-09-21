<?php

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Repository\CategoryRepository;

class CategoryRepositoryTest extends KernelTestCase
{
    private ?CategoryRepository $categoryRepository = null;

    protected function setUp(): void
    {
        parent::setUp();
        $kernel = self::bootKernel();
        $this->categoryRepository = $kernel->getContainer()->get(CategoryRepository::class);
    }


    public function testCount(): void
    {
        $count = $this->categoryRepository->count([]);
        $this->assertIsInt($count);
    }
}
