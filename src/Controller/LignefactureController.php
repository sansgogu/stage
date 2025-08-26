<?php

namespace App\Controller;

use App\Entity\Lignefacture;
use App\Form\LignefactureType;
use App\Repository\LignefactureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/lignefacture')]
final class LignefactureController extends AbstractController
{
    #[Route(name: 'app_lignefacture_index', methods: ['GET'])]
    public function index(LignefactureRepository $lignefactureRepository): Response
    {
        return $this->render('lignefacture/index.html.twig', [
            'lignefactures' => $lignefactureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_lignefacture_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $lignefacture = new Lignefacture();
        $form = $this->createForm(LignefactureType::class, $lignefacture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($lignefacture);
            $entityManager->flush();

            return $this->redirectToRoute('app_lignefacture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('lignefacture/new.html.twig', [
            'lignefacture' => $lignefacture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lignefacture_show', methods: ['GET'])]
    public function show(Lignefacture $lignefacture): Response
    {
        return $this->render('lignefacture/show.html.twig', [
            'lignefacture' => $lignefacture,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_lignefacture_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lignefacture $lignefacture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LignefactureType::class, $lignefacture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_lignefacture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('lignefacture/edit.html.twig', [
            'lignefacture' => $lignefacture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lignefacture_delete', methods: ['POST'])]
    public function delete(Request $request, Lignefacture $lignefacture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lignefacture->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($lignefacture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_lignefacture_index', [], Response::HTTP_SEE_OTHER);
    }
}
