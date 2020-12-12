<?php

namespace App\Form;

use App\Entity\PokeTieneHabilidad;
use App\Entity\Habilidad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PokeTieneHabilidadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('porcentajeUso')
            ->add('formato')
            ->add('habilidad', EntityType::class, [
                'class' => Habilidad::class,
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
            'data_class' => PokeTieneHabilidad::class,
        ]);
    }
}
