<?php


namespace App\Controller;


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
     * @return Response
     */
    public function homeIndex(UserRepository $userRepository): Response
    {
        return $this->render('home.html.twig', [
            'users'=>$userRepository->findAll()
        ]);
    }
}
