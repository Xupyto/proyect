<?php

namespace App\Form;

use App\Entity\PokemonEstaEnFormato;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PokemonEstaEnFormatoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('porcentajeUso')
            ->add('formato')
            ->add('pokemonIdpoke')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PokemonEstaEnFormato::class,
        ]);
    }
}
