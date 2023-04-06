<?php

namespace App\Form;

use App\Entity\ImageAccueil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Validator\Constraints\NotBlank;


class ImageAccueilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('imageFile',FileType::class)
    ->add('updatedAt', DateType::class, [
        'label' => 'Date de mise à jour',
        'widget' => 'single_text',
        'format' => 'yyyy-MM-dd',
        'data' => new \DateTime(),
        'constraints' => [
            new NotBlank([
                'message' => 'Ce champ ne peut pas être vide'
            ])
        ]
    ])
    
;
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ImageAccueil::class,
        ]);
    }
}
