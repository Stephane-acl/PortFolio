<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/project")
 */
class ProjectController extends AbstractController
{
    /**
     * @Route("/{slug}", name="project_show", methods={"GET", "POST"})
     * @param Project $project
     * @param ProjectRepository $projectRepository
     * @return Response
     */
    public function show(Project $project, ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll();

        return $this->render('project/show.html.twig', [
            'project' => $project,
            'projects'=>$projects
        ]);
    }
}
