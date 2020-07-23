<?php

namespace App\Controller;

use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/project")
 */
class ProjectController extends AbstractController
{
    /**
     * @Route("/{id}", name="project_show", methods={"GET"})
     * @param Project $project
     * @return Response
     */
    public function show(Project $project): Response
    {
        return $this->render('project/show.html.twig', [
            'project' => $project,
        ]);
    }
}
