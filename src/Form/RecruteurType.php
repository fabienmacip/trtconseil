<?php

namespace App\Form;

use App\Entity\Recruteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecruteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('entreprise_nom')
            ->add('entreprise_adresse')
            ->add('entreprise_code_postal')
            ->add('entreprise_ville')
            ->add('user')
            ->add('consultant')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recruteur::class,
        ]);
    }
}
