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
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/client/location')]
class LocationClientController extends AbstractController
{
    #[Route('/client', name: 'app_client_location_client')]
    public function index(Request $request, LocationRepository $locations, UserRepository $user, ClientRepository $client): Response
    {
        
        $user = $this->getUser();
       /** @var User $user */
        $client = $user->getClient();
        $locations = $locations->findByClient($client);

        return $this->render('client/location_client/index.html.twig', [
            'controller_name' => 'LocationClientController',
            'locations' => $locations,
            'user' => $user
        ]);
    }

    #[Route('/new', name: 'app_client_location_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $location = new Location();
        $form = $this->createForm(LocationClientType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { 
            
            $entityManager->persist($location);
            $entityManager->flush();

            return $this->redirectToRoute('app_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('location/new.html.twig', [
            'location' => $location,
            'form' => $form,
        ]);
    }
}
