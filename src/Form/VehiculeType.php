<?php

namespace App\Form;

use App\Entity\Caserne;
use App\Entity\Type;
use App\Entity\Vehicule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('matricule')
            ->add('marque')
            ->add('place')
            ->add('idCaserne', EntityType::class, [
                'class'=>Caserne::class,
                'choice_label'=>'adresse',
            ])
            ->add('idType', EntityType::class, [
                'class'=>Type::class,
                'choice_label'=>'libelle',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
