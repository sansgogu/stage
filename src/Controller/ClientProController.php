<?php

namespace App\Controller;

use App\Entity\ClientPro;
use App\Form\ClientProType;
use App\Repository\ClientProRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/client/pro')]
final class ClientProController extends AbstractController
{
    #[Route(name: 'app_client_pro_index', methods: ['GET'])]
    public function index(ClientProRepository $clientProRepository): Response
    {
        return $this->render('client_pro/index.html.twig', [
            'client_pros' => $clientProRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_client_pro_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $clientPro = new ClientPro();
        $form = $this->createForm(ClientProType::class, $clientPro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($clientPro);
            $entityManager->flush();

            return $this->redirectToRoute('app_client_pro_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('client_pro/new.html.twig', [
            'client_pro' => $clientPro,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_client_pro_show', methods: ['GET'])]
    public function show(ClientPro $clientPro): Response
    {
        return $this->render('client_pro/show.html.twig', [
            'client_pro' => $clientPro,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_client_pro_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ClientPro $clientPro, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ClientProType::class, $clientPro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_client_pro_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('client_pro/edit.html.twig', [
            'client_pro' => $clientPro,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_client_pro_delete', methods: ['POST'])]
    public function delete(Request $request, ClientPro $clientPro, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$clientPro->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($clientPro);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_client_pro_index', [], Response::HTTP_SEE_OTHER);
    }
}
