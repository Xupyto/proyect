<?php

namespace App\Form;

use App\Entity\EquipoContienePokemon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipoContienePokemonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mov1')
            ->add('mov2')
            ->add('mov3')
            ->add('mov4')
            ->add('objeto')
            ->add('habilidad')
            ->add('spread')
            ->add('pokemonIdpoke')
            ->add('equipoIdequipo')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EquipoContienePokemon::class,
        ]);
    }
}
