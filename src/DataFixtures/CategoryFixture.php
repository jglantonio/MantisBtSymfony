<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Repository\StatusRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $category = new Category();

        $categories = [
            'Priority',
            'Fixture',
            'Bug',
        ];

        foreach ($categories as $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $category->setStatus(1);
            $category->setProjectId(1);
            $category->setUserId(1);
            $manager->persist($category);
        }
        $manager->flush();
    }
}
