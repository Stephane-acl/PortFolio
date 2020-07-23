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
        'https://static.boredpanda.com/blog/wp-content/uuuploads/funny-zoo-animal-portraits-yago-partal/funny-zoo-animal-portraits-yago-partal-4.jpg' => [
            'project' => 'project_1',
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