<?php

namespace App\Controller\Admin;

use App\Entity\Location;
use App\Form\LocationType;
use App\Repository\LocationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/location')]
class LocationController extends AbstractController
{
    #[Route('/', name: 'app_admin_location_index', methods: ['GET'])]
    public function index(LocationRepository $locationRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $locations = $paginator->paginate(
            $locationRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('location/index.html.twig', [
            'locations' => $locations,
        ]);
    }

    #[Route('/new', name: 'app_admin_location_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $location = new Location();
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($location);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('location/new.html.twig', [
            'location' => $location,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_location_show', methods: ['GET'])]
    public function show(Location $location): Response
    {
        return $this->render('location/show.html.twig', [
            'location' => $location,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_location_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Location $location, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);
        // 1) Créer une fonction calculate robePriceTotal qui va calculer le prix total des robes en prenant en parametre la collection de robes, il faudra parcourir la collection 
        /*robes tu la crée dans le repository de robe*/
        // 2) Enlever le input prixTotal et afficher à la place le robePriceTotal en appelant la fonction
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('location/edit.html.twig', [
            'location' => $location,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_location_delete', methods: ['POST'])]
    public function delete(Request $request, Location $location, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $location->getId(), $request->request->get('_token'))) {
            $entityManager->remove($location);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_location_index', [], Response::HTTP_SEE_OTHER);
    }
}
