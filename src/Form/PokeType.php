<?php

namespace App\Form;


use App\Entity\Pokemon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\NotNull;

class PokeType extends AbstractType
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
            ->add('tipoNombre')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pokemon::class,
        ]);
    }
}
