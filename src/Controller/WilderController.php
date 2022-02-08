<?php

namespace App\Controller;

use App\Entity\Wilder;
use App\Form\WilderType;
use App\Repository\WilderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/wilder")
 */
class WilderController extends AbstractController
{
    /**
     * @Route("/", name="wilder_index", methods={"GET"})
     */
    public function index(WilderRepository $wilderRepository): Response
    {
        return $this->render('wilder/index.html.twig', [
            'wilders' => $wilderRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="wilder_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $wilder = new Wilder();
        $form = $this->createForm(WilderType::class, $wilder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($wilder);
            $entityManager->flush();

            return $this->redirectToRoute('wilder_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('wilder/new.html.twig', [
            'wilder' => $wilder,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="wilder_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Wilder $wilder, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WilderType::class, $wilder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('wilder_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('wilder/edit.html.twig', [
            'wilder' => $wilder,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="wilder_delete", methods={"POST"})
     */
    public function delete(Request $request, Wilder $wilder, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $wilder->getId(), $request->request->get('_token'))) {
            $entityManager->remove($wilder);
            $entityManager->flush();
        }

        return $this->redirectToRoute('wilder_index', [], Response::HTTP_SEE_OTHER);
    }
}
