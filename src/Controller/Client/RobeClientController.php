<?php

namespace App\Controller\Client;

use App\Entity\Robe;
use App\Repository\RobeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RobeClientController extends AbstractController
{
    #[Route('/client/robe', name: 'app_client_robe_client')]
    public function index(RobeRepository $robe): Response
    {
        $robes = $robe->findAll();
        
        return $this->render('client/robe_client/index.html.twig', [
            'controller_name' => 'RobeClientController',
            'robes' => $robes
        ]);
    }
}
