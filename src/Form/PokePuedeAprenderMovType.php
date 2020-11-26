<?php

namespace App\Form;

use App\Entity\PokePuedeAprenderMov;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PokePuedeAprenderMovType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('porcentajeUso')
            ->add('formato')
            ->add('movimiento')
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
