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
        "PHP" => ['project_0', 'project_1','project_2', 'project_3', 'project_4'],
        "SYMFONY" => ['project_3', 'project_4'],
        "HTML" => ['project_0', 'project_1', 'project_2', 'project_3', 'project_4'],
        "CSS" => ['project_0', 'project_1', 'project_2', 'project_3', 'project_4'],
        "JQUERY" => ['project_1', 'project_3', 'project_4'],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::TECHNOS as $key => $data) {
            $techno = new Techno();
            $techno ->setName($key);
            foreach ($data as $project) {
                $techno->addProject($this->getReference($project));
            }
            $manager->persist($techno);
        }
        $manager->flush();
    }
}