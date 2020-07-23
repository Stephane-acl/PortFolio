<?php


namespace App\DataFixtures;

use App\Entity\Techno;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TechnoFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [ProjectFixtures::class];
    }

    const TECHNOS = [
        "Php" => ['project_0', 'project_1'],
        "Symfony" => ['project_1'],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::TECHNOS as $key => $data) {
            $client = new Techno();
            $client ->setName($key);
            foreach ($data as $project) {
                $client->addProject($this->getReference($project));
            }
            $manager->persist($client);
        }
        $manager->flush();
    }
}