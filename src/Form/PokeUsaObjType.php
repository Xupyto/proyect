<?php

namespace App\Form;

use App\Entity\PokeUsaObj;
use App\Entity\Objeto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PokeUsaObjType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('porcentajeUso')
            ->add('formato')
            ->add('objetoIdobjeto', EntityType::class, [
                'class' => Objeto::class,
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
            'data_class' => PokeUsaObj::class,
        ]);
    }
}
