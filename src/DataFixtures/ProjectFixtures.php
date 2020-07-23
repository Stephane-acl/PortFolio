<?php


namespace App\DataFixtures;

use App\Entity\Project;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return [ClientFixtures::class];
    }

    const PROJECTS = [
        'Retro Invaders' => [
            'description' => 'Le policier Rick Grimes se réveille après un long coma.
             Il découvre avec effarement que le monde, ravagé par une épidémie, est envahi par les morts-vivants.',

            'client' => 'client_0',
        ],
        'Adventure Couch' => [
            'description' => 'Le policier Rick Grimes se réveille après un long coma.
             Il découvre avec effarement que le monde, ravagé par une épidémie, est envahi par les morts-vivants.',

            'client' => 'client_0',
        ],

        'SideBySide' => [
            'description' => 'Le policier Rick Grimes se réveille après un long coma.
             Il découvre avec effarement que le monde, ravagé par une épidémie, est envahi par les morts-vivants.',

            'client' => 'client_0',
        ],

        'Doctopet' => [
            'description' => 'Le policier Rick Grimes se réveille après un long coma.
             Il découvre avec effarement que le monde, ravagé par une épidémie, est envahi par les morts-vivants.',

            'client' => 'client_1',
        ],

        'La Gare Centrale' => [
            'description' => 'Le policier Rick Grimes se réveille après un long coma.
             Il découvre avec effarement que le monde, ravagé par une épidémie, est envahi par les morts-vivants.',

            'client' => 'client_2',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::PROJECTS as $title => $data) {
            $project = new Project();
            $project->setName($title);
            $project->setDescription($data['description']);
            $project->setDate(new DateTime('10-03-2020'));
            $project->setClient($this->getReference($data['client']));
            $manager->persist($project);
            $this->addReference('project_' . $i++, $project);
        }
        $manager->flush();
    }
}