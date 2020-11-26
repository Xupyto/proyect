<?php

namespace App\Form;

use App\Entity\Formato;
use App\Entity\PokemonEstaEnFormato;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PokeIsFormato extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('porcentajeUso')
            ->add('formato', EntityType::class, [
                'class' => Formato::class, 'placeholder' => 'Elige un formato'
            ])
            ;
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PokemonEstaEnFormato::class,
        ]);
    }
}
