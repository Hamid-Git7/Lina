<?php

namespace App\Controller;

use App\Entity\User;
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
        $user1 = $repository->find(2);
        $maryamUser = $repository->findByEmail('maryam@exemple.com');
        $roles = $repository->roles();
        // $user14 = $repository->find(14);
        $user13 = $repository->find(13);

        // Générer une adresse e-mail aléatoire
        $randomEmail = uniqid('user', true) . '@example.com';

        // Creation d'un nouveau user
        $newUser = new User ();
        $newUser->setEmail($randomEmail);
        $newUser->setPassword('123');
        $newUser->setRoles(['ROLE_USER']);
        
        $em->persist($newUser);
        $em->flush();

        // // Modifier un user
        // $user14->setEmail('ikrame@example.com');
        // $user14->setPassword('456');
        // $user14->setRoles(['ROLE_USER']);
        // $em->persist($user14);
        // $em->flush();

        // Supprimer un user
        if ($user13) {
            $em->remove($user13);
            $em->flush();
        }
        

        $title = 'Test User';

        return $this->render('test/user.html.twig', [
            'controller_name' => 'TestController',
            'users' => $users,
            'user1' => $user1,
            'maryamUser' => $maryamUser,
            'title' => $title,
            'roles' => $roles,

        ]);
    }
}
