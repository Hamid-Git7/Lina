<?php

namespace App\Controller\Admin;

use App\Entity\Retoucheur;
use App\Form\RetoucheurType;
use App\Repository\RetoucheurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/retoucheur')]
class RetoucheurController extends AbstractController
{
    #[Route('/', name: 'app_admin_retoucheur_index', methods: ['GET'])]
    public function index(RetoucheurRepository $retoucheurRepository): Response
    {
        return $this->render('retoucheur/index.html.twig', [
            'retoucheurs' => $retoucheurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_retoucheur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $retoucheur = new Retoucheur();
        $form = $this->createForm(RetoucheurType::class, $retoucheur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($retoucheur);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_retoucheur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('retoucheur/new.html.twig', [
            'retoucheur' => $retoucheur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_retoucheur_show', methods: ['GET'])]
    public function show(Retoucheur $retoucheur): Response
    {
        return $this->render('retoucheur/show.html.twig', [
            'retoucheur' => $retoucheur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_retoucheur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Retoucheur $retoucheur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RetoucheurType::class, $retoucheur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_retoucheur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('retoucheur/edit.html.twig', [
            'retoucheur' => $retoucheur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_retoucheur_delete', methods: ['POST'])]
    public function delete(Request $request, Retoucheur $retoucheur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$retoucheur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($retoucheur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_retoucheur_index', [], Response::HTTP_SEE_OTHER);
    }
}
