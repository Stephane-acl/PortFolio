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
        'https://blog.grainedephotographe.com/wp-content/uploads/2013/10/Yago-Partal-photographe-10.jpg' => [
            'project' => 'project_2',
        ],
        'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRJHGFvdNf8RSRRl4pIIa464ugdHIbPbLiElg&usqp=CAU' => [
            'project' => 'project_3',
        ],
        'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTr-io7cRwc0YRZThwxoLRYR6oU1qtXqTwvVQ&usqp=CAU' => [
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