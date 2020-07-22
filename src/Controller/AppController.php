<?php


namespace App\Controller;


use App\Entity\Pictures;
use App\Entity\Projects;
use App\Repository\PicturesRepository;
use App\Repository\ProjectsRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(name="app_")
 */
class AppController extends AbstractController
{
    /**
     * @Route("/", name="homeIndex")
     * @param UserRepository $userRepository
     * @param PicturesRepository $picturesRepository
     * @param ProjectsRepository $projectsRepository
     * @return Response
     */
    public function homeIndex(UserRepository $userRepository, ProjectsRepository $projectsRepository): Response
    {
        return $this->render('home.html.twig', [
            'users'=>$userRepository->findAll(),
            'projects'=>$projectsRepository->findAll()
        ]);
    }
}
