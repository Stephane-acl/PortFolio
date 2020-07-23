<?php


namespace App\DataFixtures;

use App\Entity\Projects;
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

            'client' => 'clients_0',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROJECTS as $title => $data) {
            $project = new Projects();
            $project ->setName($title);
            $project ->setDescription($data['description']);
            $project ->setDate(new \DateTime());
            $project->setClients($this->getReference($data['client']));
            $manager->persist($project );

        }
        $manager->flush();
    }
}