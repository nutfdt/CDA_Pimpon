<?php

namespace App\Form;

use App\Entity\Pompier;
use App\Entity\Formation;
use App\Entity\FormationPimpon;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationPimponType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('duree')
            ->add('adresse')
            ->add('statut')
            ->add('idPompier', EntityType::class, [
                'class'=>Pompier::class,
                'choice_label'=>'nom',
            ])
            ->add('idFormation', EntityType::class, [
                'class'=>Formation::class,
                'choice_label'=>'libelle',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FormationPimpon::class,
        ]);
    }
}
