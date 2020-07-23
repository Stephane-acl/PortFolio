<?php


namespace App\Controller;

use App\Repository\ProjectRepository;
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
     * @param ProjectRepository $projectRepository
     * @return Response
     */
    public function homeIndex(UserRepository $userRepository, ProjectRepository $projectRepository): Response
    {
        return $this->render('home.html.twig', [
            'users'=>$userRepository->findAll(),
            'projects'=>$projectRepository->findAll()
        ]);
    }
}
