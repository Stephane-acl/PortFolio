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
            'description' => 'Retro Invaders est le premier projet que j\'ai réalisé en arrivant à la Wild Code School.
             C\'est un site qui permet de consulter la côte des jeux vidéos rétros.
             Nous avons développé ce projet en une semaine.
             J\'ai dynamisé ce site statique tout au long de ma formation en utilisant du PHP.
             C\'est un projet que j\'aimerais beaucoup retravailler dans le futur.
             Il s\'adresse aux passionnés de jeux vidéos.',

            'link' => '',

            'client' => 'client_0',
        ],
        'Adventure Couch' => [
            'description' => "Adventure Couch est un jeu qui permet de déplacer un canapé sur une grille et de faire voyager celui-ci en prenant l'avion.
             En prenant l'avion vous passez au niveau supérieur.
             Mais pour cela il faudra répondre à des questions.
             Nous étions 6 personnes pour développer ce projet en 24 heures lors d'un Hackathon organisé par la Wild Code School.
             Le thème était \"Voyager depuis son canapé\".
             Nous avons utilisé JQuery et PHP pour développer cette application",

            'link' => '',

            'client' => 'client_0',
        ],

        'SideBySide' => [
            'description' => "SideBySide est une application permettant de réunir les compétences de différents acteurs pour participer à la réalisation d'un projet commun.
             Le site a été développé par 4 personnes en 6 semaines.
             Nous avons utilisé le simple MVC et du PHP pour mettre en œuvre cette application.",

            'link' => 'https://sidebysides.herokuapp.com/',

            'client' => 'client_0',
        ],

        'Doctopet' => [
            'description' => "DoctoPet est un pilulier style Tamagochi qui envoie une notification pour rappeler aux enfants de bien prendre leurs médicaments.
             Nous avons choisi de cibler ce type de patients car un enfant atteint de maladie chronique n'aura pas forcément envie de prendre ses médicaments.
             C'est une manière ludique pour lui de prendre son traitement sans astreinte.
             En créant cette application, nous voulions que l'enfant se responsabilise en prenant soin de son tamagochi et comprenne l'importance de prendre ses médicaments pour garder une bonne santé.
             Nous avons développé cette application à 4 personnes durant un Hackathon organisé par la Wild Code School et DOCTOLIB.
             Nous disposions de 48 heures pour la réalisation du projet et avons utilisé du PHP Symfony et JQuery.",

            'link' => '',

            'client' => 'client_1',
        ],

        'La Gare Centrale' => [
            'description' => "La Gare Centrale est un projet pour l'association écologique The Greener Good.
             C'est un site à usage interne qui va permettre de guider les nouveaux membres afin de leur faire connaitre les procédures au sein de cette association ( exemple : comment gérer un événement). 
             Nous avons réalisé cette application à 5 personnes durant 2 mois et demi.
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