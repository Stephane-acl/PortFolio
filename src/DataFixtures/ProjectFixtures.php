<?php


namespace App\DataFixtures;

use App\Entity\Project;
use App\Service\Slugify;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return [ClientFixtures::class];
    }

    const PROJECTS = [
        'Retro Invaders' => [
            'description' => 'Retro Invaders est mon premier projet réalisé que j\'ai fait en arrivant à la Wild Code School.
             C\'est un site qui permet de voir la côte des prix de jeux vidéos rétro.
             Nous avons développé ce projet en une semaine, c\'était un site statique que j\'ai dynamisé tout au long de ma formation avec du Php.
             C\'est un projet que j\'aimerais beaucoup retravailler dans le futur.',

            'link' => '#',

            'client' => 'client_0',
        ],
        'Adventure Couch' => [
            'description' => "Adventure Couch est un jeu qui permet de déplacer un canapé sur une grille et de faire voyager ce canapé en prenant l'avion. 
             Mais pour cela il va falloir répondre à des questions.
             Nous avons développé ce projet à 6 et en 24 heures lors d'un Hackathon organisé par la Wild Code School.
             Le thème était 'Voyager depuis son canapé'.
             Nous avons beaucoup utilisé de Jquery et de Php pour développer cette application.",

            'link' => '#',

            'client' => 'client_0',
        ],

        'SideBySide' => [
            'description' => "SideBySide est un projet qui permet aux personnes de partager leurs compétences sur des projets en commun.
             Le site à été développé en 6 semaines à 4. 
             Nous avons utilisé le simple MVC et du Php pour réaliser cette application.",

            'link' => 'https://sidebysides.herokuapp.com/',

            'client' => 'client_0',
        ],

        'Doctopet' => [
            'description' => "Doctopet est un pilulier style Tamagochi qui envoie une notification pour rappeler aux enfants de bien prendre leurs médicaments.
             Nous avons choisi de cibler ce type de patients car un enfant qui est atteint de maladie chronique ne va pas forcément avoir envie de prendre ses médicaments.
             En faisant cette application nous voulions que l'enfant se responsabilise en prenant soin de son tamagochi et qu'il comprenne que c'est important de prendre ses médicaments pour garder une bonne santé. 
             Nous avons développé cette application à 4 durant un Hackathon organisé par la Wild Code School et par Doctolib.
             Nous avions 48 heures pour la réalisation et nous avons utilisé du Php Symfony ainsi que du JQuery.",

            'link' => '#',

            'client' => 'client_1',
        ],

        'La Gare Centrale' => [
            'description' => "La Gare Centrale est un projet pour l'association écologique The Greener Good.
             C'est un site à usage interne qui va permettre de guider les nouveaux membres afin de leur faire connaitre les procédures au sein de cette association ( exemple : comment gérer un événement). 
             Nous avons réalisé cette application à 5 durant 2 mois et demi.
             Nous avons principalement utilisé du Php Symfony pour cette application.",

            'link' => 'http://garecentrale.thegreenergood.fr/login',

            'client' => 'client_2',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        $slugify = new Slugify();
        $i = 0;
        foreach (self::PROJECTS as $title => $data) {
            $project = new Project();
            $project->setName($title);
            $project->setDescription($data['description']);
            $project->setDate(new DateTime('10-03-2020'));
            $project->setLink($data['link']);
            $project->setClient($this->getReference($data['client']));
            $slug = $slugify->generate($project->getName());
            $project->setSlug($slug);
            $manager->persist($project);
            $this->addReference('project_' . $i++, $project);
        }
        $manager->flush();
    }
}