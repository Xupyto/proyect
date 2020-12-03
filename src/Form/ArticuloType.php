<?php

namespace App\Form;

use App\Entity\Articulo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\NotNull;

class ArticuloType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('contenido')
            ->add('Fileimg', FileType::class, [
                'label' => 'Foto',
                'mapped' => false,
                'required' =>  false,
                'constraints' => [
                   
                    new File([
                        'mimeTypes' => [
                            'image/png', 'image/jpg'
                        ],
                        'mimeTypesMessage' => 'Solo se permiten imágenes',
                        'maxSize' => '5M',
                        'uploadErrorMessage' => 'Error al subir el archivo'  
                    ])
                   
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articulo::class,
        ]);
    }
}
