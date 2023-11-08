<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Client;
use App\Entity\Couleur;
use App\Entity\Fournisseur;
use App\Entity\Location;
use App\Entity\Retoucheur;
use App\Entity\Robe;
use App\Entity\Taille;
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
        $user14 = $repository->find(14);
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

        // Modifier un user
        $user14->setEmail('ikrame@example.com');
        $user14->setPassword('456');
        $user14->setRoles(['ROLE_USER']);
        $em->persist($user14);
        $em->flush();

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

    #[Route('/robe', name: 'app_test_robe')]
    public function Robe(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $repositoryRobe = $em->getRepository(Robe::class);
        $repositoryCouleur = $em->getRepository(Couleur::class);
        $repositoryFournisseur = $em->getRepository(Fournisseur::class);
        $repositoryTaille = $em->getRepository(Taille::class);
        $repositoryCategorie = $em->getRepository(Categorie::class);

        $repositoryRobe->findAll();
        $robes = $repositoryRobe->findByNomRobe();
        $robeMod = $repositoryRobe->find(2);
        $robeSup = $repositoryRobe->find(12);


        $title = 'Test Robe';
        // $newRobe = new Robe();
        // $newRobe->setNomRobe('Lina');
        // $newRobe->setDescription('Robe de lina');
        // $newRobe->setPrix(199.99);
        // $newRobe->setTaille($repositoryTaille->find(1));
        // $newRobe->addCouleur($repositoryCouleur->find(1));
        // $newRobe->setFournisseur($repositoryFournisseur->find(1));
        // $newRobe->setCategorie($repositoryCategorie->find(1));

        // $em->persist($newRobe);
        // $em->flush();

        // modifier une robe
        $robeMod->setNomRobe('Nouveau nom de robe');
        $robeMod->setDescription('Nouvelle description de robe');
        $robeMod->setPrix(299.99);
        $robeMod->setTaille($repositoryTaille->find(2));
        $robeMod->addCouleur($repositoryCouleur->find(2));
        $robeMod->setFournisseur($repositoryFournisseur->find(2));
        $robeMod->setCategorie($repositoryCategorie->find(2));

        $em->flush();

        // supprimer une robe
        if ($robeSup) {
            $em->remove($robeSup);
            $em->flush();
        }

        return $this->render('test/robe.html.twig', [
            'controller_name' => 'TestController',

            'robes' => $robes,
            'title' => $title,

        ]);
    }

    #[Route('/fournisseur', name: 'app_test_fournisseur')]
    public function Fournisseur(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $repositoryFournisseur = $em->getRepository(Fournisseur::class);

        $fournisseurs = $repositoryFournisseur->findAll();
        $fournisseurMod = $repositoryFournisseur->find(2);
        $fournisseurSup = $repositoryFournisseur->find(10);
        $title = 'Test Fournisseur';

        // // creer un nouveau fournisseur
        // $newFournisseur = new Fournisseur();
        // $newFournisseur->setNomEntreprise('1000 et une nuit');
        // $newFournisseur->setNumeroSiret('12341111912345');
        // $newFournisseur->setAdresse('30 rue Louis Pasteur, 75015 Paris');
        // $newFournisseur->setEmail('1000etunenuit@example.com');
        // $newFournisseur->setTel('0165987532');

        // $em->persist($newFournisseur);
        // $em->flush();

        // modifier un fournisseur
        $fournisseurMod = $repositoryFournisseur->find(2);
        if ($fournisseurMod) {
            $fournisseurMod->setAdresse('Nouvelle adresse');
            $fournisseurMod->setEmail('nouveau-email@example.com');
            $fournisseurMod->setTel('0123456789');
            
            $em->flush();
        }

        // supprimer un fournisseur
        if ($fournisseurSup) {
            $em->remove($fournisseurSup);
            $em->flush();
        }


        return $this->render('test/fournisseur.html.twig', [
            'controller_name' => 'TestController',
            'title' => $title,
            'fournisseurs' => $fournisseurs,
        ]);
    }

    #[Route('/location', name: 'app_test_location')]
    public function Location(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $repositoryLocation = $em->getRepository(Location::class);
        $repositoryClient = $em->getRepository(Client::class);        
        
        $title = 'Test Location';

        $locations = $repositoryLocation->findAll();
        $clientId1 = $repositoryClient->find(1);
        $locationReturn3 = $repositoryLocation->find(3);
        $findLocation1 = $repositoryLocation->findLocation1();
        $location10 = $repositoryLocation->find(10);
        

        // creer une nouvelle location

        $newLocation = new Location();
        $newLocation->setDateDebutLocation(new \DateTime('2023-07-07 20:00:00'));
        $newLocation->setDateFinLocation(new \DateTime('2023-07-17 20:00:00'));
        $newLocation->setPrixTotal(399.99);
        $newLocation->setClient($clientId1);

        $em->persist($newLocation);
        $em->flush();

        // modifier une location
        $locationReturn3->setDateFinLocation(new \DateTime('2023-12-07 20:00:00'));
        $em->flush();

        // supprimer une location
        if ($location10) {
            $em->remove($location10);
            $em->flush();
        }

        return $this->render('test/location.html.twig', [
            'controller_name' => 'TestController',
            'title' => $title,
            'locations' => $locations,
            'findLocation1' => $findLocation1

        ]);

    }

    #[Route('/retoucheur', name: 'app_test_retoucheur')]
    public function Retoucheur(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $repositoryRetoucheur = $em->getRepository(Retoucheur::class);

        $retoucheurs = $repositoryRetoucheur->findAll();
        $retoucheurMod = $repositoryRetoucheur->find(2);
        $retoucheurSup = $repositoryRetoucheur->find(4);
        $title = 'Test Retoucheur';

        // creation d'un nouveau retoucheur
        $newRetoucheur = new Retoucheur();
        $newRetoucheur->setNomEntreprise("Retoucheur 1000 et une nuit");
        $newRetoucheur->setNumeroSiret("22596387412569");
        $newRetoucheur->setAdresse("123 rue de la paix, 75000 Paris");
        $newRetoucheur->setTel("0198653278");
        $newRetoucheur->setEmail("retoucheur1000etunenuit@example.com");

        $em->persist($newRetoucheur);
        $em->flush();

        // modifier un retoucheur
        $retoucheurMod->setTel("0123456789");
        $em->flush();

        // supprimer un retoucheur
        if ($retoucheurSup) {
            $em->remove($retoucheurSup);
            $em->flush();
        }



        return $this->render('test/retoucheur.html.twig', [
            'controller_name' => 'TestController',
            'title' => $title,
        ]);


    }
}
