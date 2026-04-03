<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\Status;
use App\Repository\StatusRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjectFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $project = new Project();
        $project->setName('Mantis Bt');
        $project->setStatus(StatusRepository::STATUS_DEVELOPMENT);
        $project->setEnabled(1);
        $project->setViewState(10);
        $project->setAccessMin(10);
        //$project->setFilePath(null);
        $project->setDescription("Lorem ipsum project");
        $project->setCategoryId(1);
        $project->setInheritGlobal(1);
        $manager->persist($project);
        $manager->flush();
    }
}
