<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Constraints\Regex;

class UserType extends AbstractType
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $hasher = $this->hasher;

        $builder
            ->add('email')
            ->add('password', RepeatedType::class, [
                    'type' => PasswordType::class,
                    'options' => ['attr' => [
                        'class' => 'password-field',
                        'autocomplete' => 'new-password',
                        ]],
                    'first_options' => ['label' => 'Mot de passe'],
                    'second_options' => ['label' => 'Confirmer le mot de passe'],
                    'required' => true,
                    'constraints' => [
                        new Regex([
                            'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/',
                            'message' => 'Le mot de passe doit contenir au moins 8 caractères,
                            dont une lettre minuscule, une lettre majuscule et un chiffre.',
                        ]),
                    ],
            ])
            ->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) use ($hasher) {
                $user = $event->getData();
                $password = $user->getPassword();
                $hashedPassword = $hasher->hashPassword($user, $password);
                $user->setPassword($hashedPassword);
                $event->setData($user);
            })
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
