<?php

namespace App\Form;

use App\Entity\PokePuedeAprenderMov;
use App\Entity\Movimiento;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PokePuedeAprenderMovType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('porcentajeUso')
            ->add('formato')
            ->add('movimiento', EntityType::class, [
                'class' => Movimiento::class,
                'choice_label' => function($mov){
                    return $mov->getNombre();
                }
            ])
            ->add('pokemonIdpoke')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PokePuedeAprenderMov::class,
        ]);
    }
}
