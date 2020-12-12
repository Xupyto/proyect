<?php

namespace App\Form;

use App\Entity\Habilidad;
use App\Entity\JugadorPokesCampeonato;
use App\Entity\Objeto;
use App\Entity\Movimiento;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JugadorPokesCampeonatoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mov1', EntityType::class, [
                'class' => Movimiento::class,
                'choice_label' => function($mov){
                    return $mov->getNombre();
                }
            ])
            ->add('mov2', EntityType::class, [
                'class' => Movimiento::class,
                'choice_label' => function($mov){
                    return $mov->getNombre();
                }
            ])
            ->add('mov3', EntityType::class, [
                'class' => Movimiento::class,
                'choice_label' => function($mov){
                    return $mov->getNombre();
                }
            ])
            ->add('mov4', EntityType::class, [
                'class' => Movimiento::class,
                'choice_label' => function($mov){
                    return $mov->getNombre();
                }
            ])
            ->add('objeto', EntityType::class, [
                'class' => Objeto::class,
                'choice_label' => function($obj){
                    return $obj->getNombre();
                }
            ])
            ->add('habilidad', EntityType::class, [
                'class' => Habilidad::class,
                'choice_label' => function($hab){
                    return $hab->getNombre();
                }
            ])
            ->add('campeonatoIdcampeonato')
            ->add('jugadorIdjugador')
            ->add('pokemonIdpoke')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JugadorPokesCampeonato::class,
        ]);
    }
}
