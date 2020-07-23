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
            'description' => 'Retro Invaders est mon premier projet que j\'ai fait en arrivant à la Wild Code School.
             C\'est un site qui permet de voir la cote des prix de jeux vidéos retro.
             Nous avons développer ce projet en une semaine, c\'était un site statique mais au cours de ma formation 
             je l\'ai dynamisé avec du Php.
             C\'est un projet que j\'aimerais beaucoup retravailler dans le futur.',

            'link' => '#',

            'client' => 'client_0',
        ],
        'Adventure Couch' => [
            'description' => "Adventure Couch est un jeu qui permet de déplacer un canapé sur une grille
             et de faire voyagé ce canapé en prenant l'avion mais pour cela il va falloir répondre à des questions.
             Nous avons développé ce projet à 6 et en 24 heures lors d'un Hackathon organisé par la Wild Code School.
             Le thème était 'Voyager depuis son canapé'.
             Nous avons beaucoup utilisé de Jquery et de Php pour développer cette application.",

            'link' => '#',

            'client' => 'client_0',
        ],

        'SideBySide' => [
            'description' => "SideBySide est un projet de projets qui permet aux personnes qui ont des compétences de se les échanger
            pour travailler ensemble sur les projets de l'un et de l'autre tout en étant bénévole.
            Le site à été développé en 6 semaines a 4. Nous avons utilisé le simple MVC pour réaliser cette application.",

            'link' => 'https://sidebysides.herokuapp.com/',

            'client' => 'client_0',
        ],

        'Doctopet' => [
            'description' => "Doctopet est un pilulier style Tamagochi qui envois une notifications pour rappeler aux enfants de bien prendre leurs médicaments.
            Nous avons choisis de cibler ce type de patients car un enfant qui est atteint de maladies chroniques ne va pas forcément prendre
             ses médicaments pour ' reprendre sois disant reprendre le controle ' car c'est la seule action qu'il peut faire pour pouvoir s'affirmer.
             En faisant cette application nous voulions que l'enfant prenne soin de son tamagochi et qu'il voit que c'est important de prendre ses médicaments
             pour garder une bonne santé. Nous avons développé cette appliaction à  durant un Hackathon organisé par la Wild Code School ainsi que Doctolib.
             Nous avions 48 heures et nous avons utilisé du Php Symfony ainsi que du JQuery.",

            'link' => '#',

            'client' => 'client_1',
        ],

        'La Gare Centrale' => [
            'description' => "La Gare Centrale est un projet pour l'association The Greener Good, c'est un site à usage interne qui va permettre 
            de guider les nouveaux membres au sein de cette association.
            Nous avons réalisé cette application à 5 durant 2 mois.
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