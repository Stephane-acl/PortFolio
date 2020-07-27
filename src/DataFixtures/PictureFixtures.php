<?php


namespace App\DataFixtures;

use App\Entity\Picture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PictureFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return [ProjectFixtures::class];
    }

    const PICTURES = [
        'retro.png' => [
            'project' => 'project_0',
        ],
        'retro-card.png' => [
            'project' => 'project_0',
        ],
        'retro-game.png' => [
            'project' => 'project_0',
        ],
        'adventure.png' => [
            'project' => 'project_1',
        ],
        'adventure-couch.png' => [
            'project' => 'project_1',
        ],
        'side.png' => [
            'project' => 'project_2',
        ],
        'side2.png' => [
            'project' => 'project_2',
        ],
        'side3.png' => [
            'project' => 'project_2',
        ],
        'side4.png' => [
            'project' => 'project_2',
        ],
        'doc.png' => [
            'project' => 'project_3',
        ],
        'doc1.png' => [
            'project' => 'project_3',
        ],
        'doc2.png' => [
            'project' => 'project_3',
        ],
        'green.png' => [
            'project' => 'project_4',
        ],
        'green2.png' => [
            'project' => 'project_4',
        ],
        'green3.png' => [
            'project' => 'project_4',
        ],
        'green4.png' => [
            'project' => 'project_4',
        ],
        'green5.png' => [
            'project' => 'project_4',
        ],
        'green6.png' => [
            'project' => 'project_4',
        ],
        'green7.png' => [
            'project' => 'project_4',
        ],
        'green8.png' => [
            'project' => 'project_4',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PICTURES as $name => $data) {
            $picture = new Picture();
            $picture->setName($name);
            $picture->setProject($this->getReference($data['project']));
            $manager->persist($picture);
        }
        $manager->flush();
    }
}