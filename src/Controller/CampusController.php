<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Form\Campus1Type;
use App\Repository\CampusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/campus")
 */
class CampusController extends AbstractController
{
    /**
     * @Route("/", name="campus_index", methods={"GET"})
     */
    public function index(CampusRepository $campusRepository): Response
    {
        return $this->render('campus/index.html.twig', [
            'campuses' => $campusRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="campus_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $campus = new Campus();
        $form = $this->createForm(Campus1Type::class, $campus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($campus);
            $entityManager->flush();

            return $this->redirectToRoute('campus_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('campus/new.html.twig', [
            'campus' => $campus,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="campus_show", methods={"GET"})
     */
    public function show(Campus $campus): Response
    {
        return $this->render('campus/show.html.twig', [
            'campus' => $campus,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="campus_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Campus $campus, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Campus1Type::class, $campus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('campus_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('campus/edit.html.twig', [
            'campus' => $campus,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="campus_delete", methods={"POST"})
     */
    public function delete(Request $request, Campus $campus, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$campus->getId(), $request->request->get('_token'))) {
            $entityManager->remove($campus);
            $entityManager->flush();
        }

        return $this->redirectToRoute('campus_index', [], Response::HTTP_SEE_OTHER);
    }
}
