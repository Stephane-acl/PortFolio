<?php


namespace App\Controller;

use App\Entity\Client;
use App\Entity\Message;
use App\Entity\Picture;
use App\Entity\Project;
use App\Entity\Techno;
use App\Form\ClientType;
use App\Form\MessageType;
use App\Form\PictureType;
use App\Form\ProjectType;
use App\Form\TechnoType;
use App\Repository\ClientRepository;
use App\Repository\MessageRepository;
use App\Repository\PictureRepository;
use App\Repository\ProjectRepository;
use App\Repository\TechnoRepository;
use App\Service\Slugify;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */

class AdminController extends AbstractController
{
    /** CLIENTS **/

    /**
     * @Route("/client", name="client_index", methods={"GET"})
     * @param ClientRepository $clientRepository
     * @return Response
     */
    public function indexClient(ClientRepository $clientRepository): Response
    {
        return $this->render('admin/client/index.html.twig', [
            'clients' => $clientRepository->findAll(),
        ]);
    }

    /**
     * @Route("/client/new", name="client_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function newClient(Request $request): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('admin_client_index');
        }

        return $this->render('admin/client/new.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/client/{id}/edit", name="client_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Client $client
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function editClient(Request $request, Client $client): Response
    {
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_client_index');
        }

        return $this->render('admin/client/edit.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/client/{id}", name="client_delete", methods={"DELETE"})
     * @param Request $request
     * @param Client $client
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteClient(Request $request, Client $client): Response
    {
        if ($this->isCsrfTokenValid('delete'.$client->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($client);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_client_index');
    }

    /** PROJECTS **/

    /**
     * @Route("/project", name="project_index", methods={"GET"})
     * @param ProjectRepository $projectRepository
     * @return Response
     */
    public function indexProject(ProjectRepository $projectRepository): Response
    {
        return $this->render('admin/project/index.html.twig', [
            'projects' => $projectRepository->findAll(),
        ]);
    }

    /**
     * @Route("/project/new", name="project_new")
     * @param Request $request
     * @param Slugify $slugify
     * @return Response
     */
    public function newProject(Request $request,  Slugify $slugify): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $slug = $slugify->generate($project->getName());
            $project->setSlug($slug);
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('admin_project_index');
        }

        return $this->render('admin/project/new.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/project/{slug}/edit", name="project_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     * @param Request $request
     * @param Project $project
     * @param Slugify $slugify
     * @return Response
     */
    public function editProject(Request $request, Project $project, Slugify $slugify): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $project->setSlug($slugify->generate($project->getName()));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_project_index');
        }

        return $this->render('admin/project/edit.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("project/{id}", name="project_delete", methods={"DELETE"})
     * @param Request $request
     * @param Project $project
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteProject(Request $request, Project $project): Response
    {
        if ($this->isCsrfTokenValid('delete'.$project->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($project);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_project_index');
    }

    /** PICTURES **/

    /**
     * @Route("/picture", name="picture_index", methods={"GET"})
     * @param PictureRepository $pictureRepository
     * @return Response
     */
    public function indexPicture(PictureRepository $pictureRepository): Response
    {
        return $this->render('admin/picture/index.html.twig', [
            'pictures' => $pictureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/picture/new", name="picture_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function newPicture(Request $request): Response
    {
        $picture = new Picture();
        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($picture);
            $entityManager->flush();

            return $this->redirectToRoute('admin_picture_index');
        }

        return $this->render('admin/picture/new.html.twig', [
            'picture' => $picture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/picture/{id}", name="picture_show", methods={"GET"})
     * @param Picture $picture
     * @return Response
     */
    public function showPicture(Picture $picture): Response
    {
        return $this->render('admin/picture/show.html.twig', [
            'picture' => $picture,
        ]);
    }

    /**
     * @Route("/picture/{id}/edit", name="picture_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Picture $picture
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function editPicture(Request $request, Picture $picture): Response
    {
        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            // Set the pictureFile property to null to avoid serialization error
            $picture->setPictureFile(null);

            $this->addFlash('success', "Votre photo a été modifié avec succès");

            return $this->redirectToRoute('admin_picture_index');
        }

        return $this->render('admin/picture/edit.html.twig', [
            'picture' => $picture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/picture/{id}", name="picture_delete", methods={"DELETE"})
     * @param Request $request
     * @param Picture $picture
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function deletePicture(Request $request, Picture $picture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$picture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($picture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_picture_index');
    }

    /** TECHNOS **/

    /**
     * @Route("/techno", name="techno_index", methods={"GET"})
     * @param TechnoRepository $technoRepository
     * @return Response
     */
    public function indexTechno(TechnoRepository $technoRepository): Response
    {
        return $this->render('admin/techno/index.html.twig', [
            'technos' => $technoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/techno/new", name="techno_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function newTechno(Request $request): Response
    {
        $techno = new Techno();
        $form = $this->createForm(TechnoType::class, $techno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($techno);
            $entityManager->flush();

            return $this->redirectToRoute('admin_techno_index');
        }

        return $this->render('admin/techno/new.html.twig', [
            'techno' => $techno,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/techno/{id}/edit", name="techno_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Techno $techno
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function editTechno(Request $request, Techno $techno): Response
    {
        $form = $this->createForm(TechnoType::class, $techno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_techno_index');
        }

        return $this->render('admin/techno/edit.html.twig', [
            'techno' => $techno,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/techno/{id}", name="techno_delete", methods={"DELETE"})
     * @param Request $request
     * @param Techno $techno
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteTechno(Request $request, Techno $techno): Response
    {
        if ($this->isCsrfTokenValid('delete'.$techno->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($techno);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_techno_index');
    }

    /** MESSAGE **/

    /**
     * @Route("/message", name="message_index", methods={"GET"})
     * @param MessageRepository $messageRepository
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function messageIndex(MessageRepository $messageRepository): Response
    {
        return $this->render('admin/message/index.html.twig', [
            'messages' => $messageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/message/{id}", name="message_show", methods={"GET"})
     * @param Message $message
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function messageShow(Message $message): Response
    {
        return $this->render('admin/message/show.html.twig', [
            'message' => $message,
        ]);
    }

    /**
     * @Route("/message/{id}/edit", name="message_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Message $message
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function messageEdit(Request $request, Message $message): Response
    {
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_message_index');
        }

        return $this->render('admin/message/edit.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/message/{id}", name="message_delete", methods={"DELETE"})
     * @param Request $request
     * @param Message $message
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function messageDelete(Request $request, Message $message): Response
    {
        if ($this->isCsrfTokenValid('delete'.$message->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($message);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_message_index');
    }
}