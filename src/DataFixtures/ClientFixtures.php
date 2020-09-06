<?php


namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClientFixtures extends Fixture
{
    const CLIENTS = [
        'La Wild Code School' => ['picture' => 'wild.png'],
        'Doctolib' => ['picture' => 'doctolib.png'],
        'The Greener Good' => ['picture' => 'tgg.png']
    ];

    public function load(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::CLIENTS as $key => $data) {
            $client = new Client();
            $client->setName($key);
            $client->setPicture($data['picture']);
            $manager->persist($client);
            $this->addReference('client_' . $i++, $client);
        }
        $manager->flush();
    }
}