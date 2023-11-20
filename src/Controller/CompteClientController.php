<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\CompteClientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompteClientController extends AbstractController
{
    #[Route('/compte/client', name: 'app_compte_client')]
    public function compteClient(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        /** @var \App\Entity\User $user */
        $client = $user->getClient();
        $client = new Client();

        $form = $this->createForm(CompteClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $client->setUser($user);
            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile_index');
        }


        return $this->render('compte_client/index.html.twig', [
            'controller_name' => 'CompteClientController',
            'form' => $form->createView(),
        ]);
    }
}