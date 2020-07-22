<?php

namespace App\Controller;

use App\Entity\Technos;
use App\Form\TechnosType;
use App\Repository\TechnosRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/technos")
 */
class TechnosController extends AbstractController
{
    /**
     * @Route("/", name="technos_index", methods={"GET"})
     * @param TechnosRepository $technosRepository
     * @return Response
     */
    public function index(TechnosRepository $technosRepository): Response
    {
        return $this->render('technos/index.html.twig', [
            'technos' => $technosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="technos_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
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

        return $this->render('technos/new.html.twig', [
            'techno' => $techno,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="technos_show", methods={"GET"})
     * @param Technos $techno
     * @return Response
     */
    public function show(Technos $techno): Response
    {
        return $this->render('technos/show.html.twig', [
            'techno' => $techno,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="technos_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Technos $techno
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Technos $techno): Response
    {
        $form = $this->createForm(TechnosType::class, $techno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('technos_index');
        }

        return $this->render('technos/edit.html.twig', [
            'techno' => $techno,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="technos_delete", methods={"DELETE"})
     * @param Request $request
     * @param Technos $techno
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Technos $techno): Response
    {
        if ($this->isCsrfTokenValid('delete'.$techno->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($techno);
            $entityManager->flush();
        }

        return $this->redirectToRoute('technos_index');
    }
}
