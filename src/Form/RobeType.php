<?php

namespace App\Form;

use App\Entity\Robe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RobeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomRobe')
            ->add('description')
            ->add('prix')
            ->add('fournisseur')
            ->add('categorie')
            ->add('taille')
            ->add('couleurs')
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image de la robe',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Robe::class,
        ]);
    }
}
