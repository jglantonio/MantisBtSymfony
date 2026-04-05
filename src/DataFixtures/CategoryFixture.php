<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Repository\StatusRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryFixture extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [ProjectFixture::class];
    }

    public function load(ObjectManager $manager): void
    {

        $categories = [
            'Priority',
            'Important',
            'Fix',
            'Bug',
        ];

        foreach ($categories as $k => $categoryName) {
            $exists = $manager->getRepository(Category::class)->findOneBy(['name' => $categoryName]);
            if($exists){
                continue;
            }

            $category = new Category();
            $category->setId($k+1);
            $category->setName($categoryName);
            $category->setStatus(1);
            $category->setProjectId(1);
            $category->setUserId(1);
            $manager->persist($category);

        }
        $manager->flush();
    }
}
