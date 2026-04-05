<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\User;
use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjectUser extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $users = $manager->getRepository(User::class)->findAll();
        $project = $manager->getRepository(Project::class)->find(1);

        foreach($users as $user){
            if(!$user->getProjects()->contains($project)){
                $user->addProject($project);
                $manager->persist($user);
            }
        }

        $manager->flush();
    }
}
