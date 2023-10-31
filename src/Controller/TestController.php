<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/test')]
class TestController extends AbstractController
{
    #[Route('/user', name: 'app_test_user')]
    public function user(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $repository = $em->getRepository(User::class);

        $users = $repository->findAllUsersOrderByMail();

        $title = 'Liste des utilisateurs';

        return $this->render('test/user.html.twig', [
            'users' => $users,
            'title' => $title,
        ]);
    }
}
