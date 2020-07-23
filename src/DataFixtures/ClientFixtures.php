<?php


namespace App\DataFixtures;

use App\Entity\Clients;
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
            $client = new Clients();
            $client ->setName($name);
            $manager->persist($client );
            $this->addReference('clients_' . $key, $client);
        }
        $manager->flush();
    }
}