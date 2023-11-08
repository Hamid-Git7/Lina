<?php

namespace App\Controller;

use App\Entity\Robe;
use App\Form\RobeType;
use App\Repository\RobeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/robe')]
class RobeController extends AbstractController
{
    #[Route('/', name: 'app_robe_index', methods: ['GET'])]
    public function index(RobeRepository $robeRepository): Response
    {
        return $this->render('robe/index.html.twig', [
            'robes' => $robeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_robe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $robe = new Robe();
        $form = $this->createForm(RobeType::class, $robe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($robe);
            $entityManager->flush();

            return $this->redirectToRoute('app_robe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('robe/new.html.twig', [
            'robe' => $robe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_robe_show', methods: ['GET'])]
    public function show(Robe $robe): Response
    {
        return $this->render('robe/show.html.twig', [
            'robe' => $robe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_robe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Robe $robe, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RobeType::class, $robe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_robe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('robe/edit.html.twig', [
            'robe' => $robe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_robe_delete', methods: ['POST'])]
    public function delete(Request $request, Robe $robe, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$robe->getId(), $request->request->get('_token'))) {
            $entityManager->remove($robe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_robe_index', [], Response::HTTP_SEE_OTHER);
    }
}
