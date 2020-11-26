<?php

namespace App\Form;

use App\Entity\Formato;
use App\Entity\Pokemon;
use App\Entity\Tipo;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\NotNull;

class PokemonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('hp')
            ->add('atq')
            ->add('def')
            ->add('spa')
            ->add('spd')
            ->add('vel')
            ->add('Fileimg', FileType::class, [
                'label' => 'Foto',
                'mapped' => false,
                'required' =>  false,
                'constraints' => [
                    new NotNull([
                        'message' => 'Debes subir una imagen',
                    ]),
                    new File([
                        'mimeTypes' => [
                            'image/png'
                        ],
                        'mimeTypesMessage' => 'Solo se permiten imágenes',
                        'maxSize' => '5M',
                        'uploadErrorMessage' => 'Error al subir el archivo'  
                    ])
                   
                ]
            ])
            ->add('formato', EntityType::class, [
                'class' => Formato::class, 'placeholder' => 'Elige un formato',
                'mapped' => false,
            ])
            ->add('porcentajeuso', NumberType::class,[
                'mapped' => false,
                'required' => true,
            ])
            ->add('tipo1', EntityType::class, [
                'class' => Tipo::class, 'placeholder' => 'Elige el tipo primario',
                'mapped' => false,
                'required' => true,
            ])
            ->add('tipo2', EntityType::class, [
                'class' => Tipo::class, 'placeholder' => 'Elige el tipo secundario',
                'mapped' => false,
                'required' => false,
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pokemon::class,
        ]);
    }
}
