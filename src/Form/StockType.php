<?php

namespace App\Form;

use App\Entity\Caserne;
use App\Entity\Equipement;
use App\Entity\Stock;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite')
            ->add('limiteStock')
            ->add('idCaserne', EntityType::class, [
                'class'=>Caserne::class,
                'choice_label'=>'adresse',
            ])
            ->add('idEquipement', EntityType::class, [
                'class'=>Equipement::class,
                'choice_label'=>'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stock::class,
        ]);
    }
}
