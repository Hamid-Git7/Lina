<?php

namespace App\Controller\Client;

use App\Entity\Robe;
use App\Repository\RobeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/robe')]

class RobeClientController extends AbstractController
{
    #[Route('/', name: 'app_client_robe_index')]
    public function index(RobeRepository $robe): Response
    {
        $robes = $robe->findAll();
        
        return $this->render('client/robe_client/index.html.twig', [
            'controller_name' => 'RobeClientController',
            'robes' => $robes
        ]);
    }

    #[Route('/{id}', name: 'app_client_robe_show', methods: ['GET'])]
    public function show(Robe $robe): Response
    {
        return $this->render('client/robe_client/show.html.twig', [
            'robe' => $robe,
        ]);
    }
}
