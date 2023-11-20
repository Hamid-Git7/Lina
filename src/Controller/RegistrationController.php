<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/créer_un_compte', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, LoginFormAuthenticator $authenticator, EntityManagerInterface $entityManager,   TokenStorageInterface $tokenStorage): Response
    {

        $user = new User();
        $user->setRoles(['ROLE_USER']);

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $plainPassword = $form->get('plainPassword')->getData();
            $confirmedPassword = $form->get('confirmedPassword')->getData();

            if ($plainPassword !== $confirmedPassword) {
                $form->get('confirmedPassword')->addError(new FormError('Le mot de passe doit être identique'));
            } else {
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $plainPassword
                    )
                );
            

            $entityManager->persist($user);
            $entityManager->flush();

            // initialisation d'une variable token créant un objet qui représente les infos d'idetifications du user :
            // l'objet user qui s'inscrit, le mdp qui est nul car déjà authentifié, le nom du pare-feu utilisé par symfony
            // pour l'authentification, et le role
            $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
            // assignation du token, symfony reconnaitra cet utilisateur comme étant authentifié
            
            $tokenStorage->setToken($token);
            // à compléter la route avec la route du controller qui sera créér au nom de CreationClientController
            return $this->redirectToRoute('app_compte_client');
            }
        }

     
        

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
