<?php


namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClientFixtures extends Fixture
{
    const CLIENTS = [
        'Wild Code School',
        'Doctolib',
        'The Greener Good',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CLIENTS as $key => $name) {
            $client = new Client();
            $client ->setName($name);
            $manager->persist($client );
            $this->addReference('client_' . $key, $client);
        }
        $manager->flush();
    }
}