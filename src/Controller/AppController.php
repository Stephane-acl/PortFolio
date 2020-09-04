<?php


namespace App\Controller;

use App\Entity\Message;
use App\Entity\Project;
use App\Form\MessageType;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/project/{slug}", name="project_show", methods={"GET", "POST"})
     * @param Project $project
     * @param ProjectRepository $projectRepository
     * @return Response
     */
    public function showProject(Project $project, ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll();

        return $this->render('project/show.html.twig', [
            'project' => $project,
            'projects'=>$projects
        ]);
    }

    /**
     * @Route("/message/new", name="message_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre message message à bien été envoyé !'
            );

            return $this->redirectToRoute('message_new');
        }

        return $this->render('message/new.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
        ]);
    }
}
