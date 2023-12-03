<?php

namespace App\Form;

use App\Entity\DetailIntervention;
use App\Entity\Intervention;
use App\Entity\Pompier;
use App\Entity\Vehicule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailInterventionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('heureDebut')
            ->add('heureFin')
            ->add('idIntervention', EntityType::class, [
                'class'=>Intervention::class,
                'choice_label'=>'libelle',
            ])
            ->add('idPompier', EntityType::class, [
                'class'=>Pompier::class,
                'choice_label'=>'nom',
            ])
            ->add('idVehicule', EntityType::class, [
                'class'=>Vehicule::class,
                'choice_label'=>'matricule',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DetailIntervention::class,
        ]);
    }
}
