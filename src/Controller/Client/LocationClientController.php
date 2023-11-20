<?php

namespace App\Controller\Client;

use App\Entity\Location;
use App\Entity\User;
use App\Form\LocationClientType;
use App\Repository\ClientRepository;
use App\Repository\LocationRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/location')]
class LocationClientController extends AbstractController
{
    #[Route('/', name: 'app_location_index', methods: ['GET'])]
    public function index(LocationRepository $locationRepository, UserRepository $user, ClientRepository $client): Response
    {
        
        $user = $this->getUser();
       /** @var User $user */
        $client = $user->getClient();
        $locations = $locationRepository->findByClient($client);

        return $this->render('client/location_client/index.html.twig', [
            'controller_name' => 'LocationClientController',
            'locations' => $locations,
            'user' => $user
        ]);
    }

    #[Route('/new', name: 'app_location_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        /** @var User $user */
        $client = $user->getClient();
        
        $location = new Location();
        $form = $this->createForm(LocationClientType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { 
        
            $location->setClient($client);
            $entityManager->persist($location);
            $entityManager->flush();

            return $this->redirectToRoute('app_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('client/location_client/new.html.twig', [
            'location' => $location,
            'form' => $form,
        ]);
    }
}
