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
        '/img/retro.png' => [
            'project' => 'project_0',
        ],
        '/img/retro-card.png' => [
            'project' => 'project_0',
        ],
        '/img/retro-game.png' => [
            'project' => 'project_0',
        ],
        '/img/adventure.png' => [
            'project' => 'project_1',
        ],
        '/img/adventure-couch.png' => [
            'project' => 'project_1',
        ],
        '/img/side.png' => [
            'project' => 'project_2',
        ],
        '/img/side2.png' => [
            'project' => 'project_2',
        ],
        '/img/side3.png' => [
            'project' => 'project_2',
        ],
        '/img/side4.png' => [
            'project' => 'project_2',
        ],
        '/img/doc.png' => [
            'project' => 'project_3',
        ],
        '/img/doc1.png' => [
            'project' => 'project_3',
        ],
        '/img/doc2.png' => [
            'project' => 'project_3',
        ],
        '/img/greenerGood/green.png' => [
            'project' => 'project_4',
        ],
        '/img/greenerGood/green2.png' => [
            'project' => 'project_4',
        ],
        '/img/greenerGood/green3.png' => [
            'project' => 'project_4',
        ],
        '/img/greenerGood/green4.png' => [
            'project' => 'project_4',
        ],
        '/img/greenerGood/green5.png' => [
            'project' => 'project_4',
        ],
        '/img/greenerGood/green6.png' => [
            'project' => 'project_4',
        ],
        '/img/greenerGood/green7.png' => [
            'project' => 'project_4',
        ],
        '/img/greenerGood/green8.png' => [
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