<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
            $builder->add('nombreCouvert', NumberType::class, [
                'label' => 'Le nombre de Couverts',
                'constraints' => [
                new NotBlank([
                    'message' => 'Ce champ ne peut pas être vide'
                    ])
                ]
            ]);

            $builder->add('date', DateType::class, [
                'label' => 'Choisir une date ',
                'widget' => 'single_text', 
                'format' => 'yyyy-MM-dd',
                'data' => new \DateTime(),
                'constraints' => [
                    new NotBlank([
                    'message' => 'Ce champ ne peut pas être vide'
                    ])
                    ]
            ]);
            $builder->add('heure', TimeType::class, [
                'label' => 'L’heure prévue',
                'widget' => 'choice',
                'data' => new \DateTime(),
                'constraints' => [
                        new NotBlank([
                        'message' => 'Ce champ ne peut pas être vide'
                        ])
                        ]
            ]);
            $builder->add('allergie', TextareaType::class, [
                'label' => 'La mention des allergies',
                'constraints' => [
                new NotBlank([
                    'message' => 'Ce champ ne peut pas être vide'
                    ])
                ]
            ]);
            
            $builder->add('submit', SubmitType::class, array(
            'label' => 'Enregistrer'
            ));
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
