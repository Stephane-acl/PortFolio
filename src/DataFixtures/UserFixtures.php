<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // Création d’un utilisateur de type “administrateur”
        $admin = new User();
        $admin->setUsername('Stéphane');
        $admin->setLinkedin('https://www.linkedin.com/feed/');
        $admin->setFonction('Développeur Web');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPicture('steph.jpg');
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adminpassword'
        ));

        $manager->persist($admin);

        $manager->flush();
    }
}

