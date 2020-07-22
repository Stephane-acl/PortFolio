<?php


namespace App\Controller;

use App\Entity\Clients;
use App\Entity\Pictures;
use App\Entity\Projects;
use App\Entity\Technos;
use App\Form\ClientsType;
use App\Form\PicturesType;
use App\Form\ProjectsType;
use App\Form\TechnosType;
use App\Repository\ClientsRepository;
use App\Repository\PicturesRepository;
use App\Repository\ProjectsRepository;
use App\Repository\TechnosRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */

class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_index")
     */
    public function index(): Response
    {
        return $this->render("admin/index.html.twig");
    }

    /** CLIENTS **/

    /**
     * @Route("/clients", name="clients_index", methods={"GET"})
     * @param ClientsRepository $clientsRepository
     * @return Response
     */
    public function indexClients(ClientsRepository $clientsRepository): Response
    {
        return $this->render('admin/clients/index.html.twig', [
            'clients' => $clientsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/clients/new", name="clients_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function newClients(Request $request): Response
    {
        $client = new Clients();
        $form = $this->createForm(ClientsType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('clients_index');
        }

        return $this->render('admin/clients/new.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/clients/{id}/edit", name="clients_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Clients $client
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function editClients(Request $request, Clients $client): Response
    {
        $form = $this->createForm(ClientsType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('clients_index');
        }

        return $this->render('admin/clients/edit.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/clients/{id}", name="clients_delete", methods={"DELETE"})
     * @param Request $request
     * @param Clients $client
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteClients(Request $request, Clients $client): Response
    {
        if ($this->isCsrfTokenValid('delete'.$client->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($client);
            $entityManager->flush();
        }

        return $this->redirectToRoute('clients_index');
    }

    /** PROJECTS **/

    /**
     * @Route("/projects", name="projects_index", methods={"GET"})
     * @param ProjectsRepository $projectsRepository
     * @return Response
     */
    public function indexProjects(ProjectsRepository $projectsRepository): Response
    {
        return $this->render('admin/projects/index.html.twig', [
            'projects' => $projectsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/projects/new", name="projects_new")
     * @param Request $request
     * @return Response
     */
    public function newProjects(Request $request): Response
    {
        $project = new Projects();
        $form = $this->createForm(ProjectsType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('projects_index');
        }

        return $this->render('admin/projects/new.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/projects/{id}/edit", name="projects_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     * @param Request $request
     * @param Projects $project
     * @return Response
     */
    public function editProjects(Request $request, Projects $project): Response
    {
        $form = $this->createForm(ProjectsType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('projects_index');
        }

        return $this->render('admin/projects/edit.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("projects/{id}", name="projects_delete", methods={"DELETE"})
     * @param Request $request
     * @param Projects $project
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteProjects(Request $request, Projects $project): Response
    {
        if ($this->isCsrfTokenValid('delete'.$project->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($project);
            $entityManager->flush();
        }

        return $this->redirectToRoute('projects_index');
    }

    /** PICTURES **/

    /**
     * @Route("/pictures", name="pictures_index", methods={"GET"})
     * @param PicturesRepository $picturesRepository
     * @return Response
     */
    public function indexPictures(PicturesRepository $picturesRepository): Response
    {
        return $this->render('admin/pictures/index.html.twig', [
            'pictures' => $picturesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/pictures/new", name="pictures_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function newPictures(Request $request): Response
    {
        $picture = new Pictures();
        $form = $this->createForm(PicturesType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($picture);
            $entityManager->flush();

            return $this->redirectToRoute('pictures_index');
        }

        return $this->render('admin/pictures/new.html.twig', [
            'picture' => $picture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/pictures/{id}", name="pictures_show", methods={"GET"})
     * @param Pictures $pictures
     * @return Response
     */
    public function showPictures(Pictures $pictures): Response
    {
        return $this->render('admin/pictures/show.html.twig', [
            'picture' => $pictures,
        ]);
    }

    /**
     * @Route("/pictures/{id}/edit", name="pictures_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Pictures $picture
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function editPictures(Request $request, Pictures $picture): Response
    {
        $form = $this->createForm(PicturesType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pictures_index');
        }

        return $this->render('admin/pictures/edit.html.twig', [
            'picture' => $picture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/pictures/{id}", name="pictures_delete", methods={"DELETE"})
     * @param Request $request
     * @param Pictures $picture
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function deletePictures(Request $request, Pictures $picture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$picture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($picture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pictures_index');
    }

    /** TECHNOS **/

    /**
     * @Route("/technos", name="technos_index", methods={"GET"})
     * @param TechnosRepository $technosRepository
     * @return Response
     */
    public function indexTechnos(TechnosRepository $technosRepository): Response
    {
        return $this->render('admin/technos/index.html.twig', [
            'technos' => $technosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/technos/new", name="technos_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function newTechnos(Request $request): Response
    {
        $techno = new Technos();
        $form = $this->createForm(TechnosType::class, $techno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($techno);
            $entityManager->flush();

            return $this->redirectToRoute('technos_index');
        }

        return $this->render('admin/technos/new.html.twig', [
            'techno' => $techno,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/technos/{id}/edit", name="technos_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Technos $techno
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function editTechnos(Request $request, Technos $techno): Response
    {
        $form = $this->createForm(TechnosType::class, $techno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('technos_index');
        }

        return $this->render('admin/technos/edit.html.twig', [
            'techno' => $techno,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/technos/{id}", name="technos_delete", methods={"DELETE"})
     * @param Request $request
     * @param Technos $techno
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteTechnos(Request $request, Technos $techno): Response
    {
        if ($this->isCsrfTokenValid('delete'.$techno->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($techno);
            $entityManager->flush();
        }

        return $this->redirectToRoute('technos_index');
    }
}