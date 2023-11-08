<?php

namespace App\Controller;

use App\Entity\Retouche;
use App\Form\RetoucheType;
use App\Repository\RetoucheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/retouche')]
class RetoucheController extends AbstractController
{
    #[Route('/', name: 'app_retouche_index', methods: ['GET'])]
    public function index(RetoucheRepository $retoucheRepository): Response
    {
        return $this->render('retouche/index.html.twig', [
            'retouches' => $retoucheRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_retouche_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $retouche = new Retouche();
        $form = $this->createForm(RetoucheType::class, $retouche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($retouche);
            $entityManager->flush();

            return $this->redirectToRoute('app_retouche_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('retouche/new.html.twig', [
            'retouche' => $retouche,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_retouche_show', methods: ['GET'])]
    public function show(Retouche $retouche): Response
    {
        return $this->render('retouche/show.html.twig', [
            'retouche' => $retouche,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_retouche_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Retouche $retouche, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RetoucheType::class, $retouche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_retouche_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('retouche/edit.html.twig', [
            'retouche' => $retouche,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_retouche_delete', methods: ['POST'])]
    public function delete(Request $request, Retouche $retouche, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$retouche->getId(), $request->request->get('_token'))) {
            $entityManager->remove($retouche);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_retouche_index', [], Response::HTTP_SEE_OTHER);
    }
}
