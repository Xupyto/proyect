<?php

namespace App\Form;

use App\Entity\PokemonTieneSpread;
use App\Entity\Spread;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PokemonTieneSpreadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('porcentajeUso')
            ->add('formato')
            ->add('pokemonIdpoke')
            ->add('spreadIdspread', EntityType::class, [
                'class' => Spread::class,
                'choice_label' => function($mov){
                    return $mov->getStats();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PokemonTieneSpread::class,
        ]);
    }
}
