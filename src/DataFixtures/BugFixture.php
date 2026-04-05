<?php

namespace App\DataFixtures;

use App\Entity\Bug;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BugFixture extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            CategoryFixture::class,
            ProjectFixture::class,
            UserFixtures::class
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $bugs = [
            [
                'id' => 1, 'project_id' => 1, 'reporter_id' => 2, 'handler_id' => 3,
                'duplicated_id' => 0 , 'priority' => 30 , 'severity' => 10, 'reproductibility' => 10,
                'status' => 50 , 'resolution' => 10 , 'projection' => 10 , 'eta' => 10 ,
                'bug_text_id' => 1, 'profile_id' => 0 , 'view_state' => 10 , 'summary' => 'Integrate telegram' ,
                'sponsorship_total' => 0 , 'sticky' => 0 , 'category_id' => 4 , 'date_submited' => time() , 'last_updated' => time() ,
                'due_date' => 1
            ],
            [
                'id' => 2, 'project_id' => 1, 'reporter_id' => 4, 'handler_id' => 3,
                'duplicated_id' => 0 , 'priority' => 30 , 'severity' => 10, 'reproductibility' => 10,
                'status' => 50 , 'resolution' => 10 , 'projection' => 10 , 'eta' => 10 ,
                'bug_text_id' => 1, 'profile_id' => 0 , 'view_state' => 10 , 'summary' => 'Integrate mail notification' ,
                'sponsorship_total' => 0 , 'sticky' => 0 , 'category_id' => 4 , 'date_submited' => time() , 'last_updated' => time() ,
                'due_date' => 1
            ],
        ];

        foreach($bugs as $bugInformation){
            $bug = new Bug();
            $bug->setId($bugInformation['id']);
            $bug->setProjectId($bugInformation['project_id']);
            $bug->setReporterId($bugInformation['reporter_id']);
            $bug->setHandlerId($bugInformation['handler_id']);

            $bug->setDuplicatedId($bugInformation['duplicated_id']);
            $bug->setPriority($bugInformation['priority']);
            $bug->setSeverity($bugInformation['severity']);
            $bug->setReproducibility($bugInformation['reproductibility']);

            $bug->setStatus($bugInformation['status']);
            $bug->setResolution($bugInformation['resolution']);
            $bug->setProjection($bugInformation['projection']);
            $bug->setEta($bugInformation['eta']);

            $bug->setBugTextId($bugInformation['bug_text_id']);
            $bug->setProfileId($bugInformation['profile_id']);
            $bug->setViewState($bugInformation['view_state']);
            $bug->setSummary($bugInformation['summary']);

            $bug->setSponshorshipTotal($bugInformation['sponsorship_total']);
            $bug->setSticky($bugInformation['sticky']);
            $bug->setCategoryId($bugInformation['category_id']);
            $bug->setDateSubmitted($bugInformation['date_submited']);
            $bug->setDueDat($bugInformation['due_date']);
            $bug->setLastUpdated($bugInformation['last_updated']);

            $manager->persist($bug);
        }


        $manager->flush();
    }
}
