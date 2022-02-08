<?php

namespace App\Controller;

use App\Entity\Clues;
use App\Form\CluesType;
use App\Repository\CluesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/clues")
 */
class CluesController extends AbstractController
{
    /**
     * @Route("/", name="clues_index", methods={"GET"})
     */
    public function index(CluesRepository $cluesRepository): Response
    {
        return $this->render('clues/index.html.twig', [
            'clues' => $cluesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="clues_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $clue = new Clues();
        $form = $this->createForm(CluesType::class, $clue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($clue);
            $entityManager->flush();

            return $this->redirectToRoute('clues_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('clues/new.html.twig', [
            'clue' => $clue,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="clues_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Clues $clue, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CluesType::class, $clue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('clues_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('clues/edit.html.twig', [
            'clue' => $clue,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="clues_delete", methods={"POST"})
     */
    public function delete(Request $request, Clues $clue, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$clue->getId(), $request->request->get('_token'))) {
            $entityManager->remove($clue);
            $entityManager->flush();
        }

        return $this->redirectToRoute('clues_index', [], Response::HTTP_SEE_OTHER);
    }
}
