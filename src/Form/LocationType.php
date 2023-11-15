<?php

namespace App\Form;

use App\Entity\Location;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Doctrine\ORM\EntityRepository;
use App\Entity\Client;
use App\Entity\Robe;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDebutLocation', DateType::class, [
                'widget' => 'single_text',
                'required' => true,
            ])
            ->add('dateFinLocation', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('prixTotal')
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'expanded' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.nom', 'ASC')
                        ->addOrderBy('c.prenom', 'ASC');
                }
            ])
            ->add('robes', EntityType::class, [
                'class' => Robe::class,
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('r')
                        ->orderBy('r.nomRobe', 'ASC');
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
