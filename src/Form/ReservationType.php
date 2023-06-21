<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('nom', TextType::class, [
            // 'mapped' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Ce champ ne peut pas être vide'
                ])
                // ,
                // new Length([
                //     'min' => 3,
                //     'minMessage' => 'Votre nom d\'utilisateur doit contenir au moins {{ limit }} caractères.'
                // ])
            ]
                ]);
    $builder->add('prenom', TextType::class, [
            // 'mapped' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Ce champ ne peut pas être vide'
                ]),
                new Length([
                    'min' => 3,
                    'minMessage' => 'Votre nom d\'utilisateur doit contenir au moins {{ limit }} caractères.',
                ]),
            ],
        ]);
        $builder->add('email',EmailType::class, [
            'constraints' => [
                new NotBlank([
                    'message' => 'Ce champ ne peut pas être vide'
                ]),
            ],
        ]);
        $builder->add('nombreCouvert');
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
                'input' => 'datetime',
                'hours' => ['11', '12', '13', '14','17','18','19', '20', '21', '22'],
                'minutes' => range(0, 45, 15), // Sélection par tranche de 15 minutes
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut pas être vide'
                    ])
                ]
            ]);
            
            $builder->add('allergie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
