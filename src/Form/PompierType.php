<?php

namespace App\Form;

use App\Entity\Caserne;
use App\Entity\Pompier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PompierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('grade')
            ->add('email')
            ->add('adresse')
            ->add('telephone')
            ->add('idCaserne', EntityType::class, [
                'class'=>Caserne::class,
                'choice_label'=>'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pompier::class,
        ]);
    }
}
