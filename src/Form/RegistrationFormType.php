<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
// use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
    $builder
        ->add('nom', TextType::class, [
            'mapped' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Ce champ ne peut être vide'
                ]),
                new Length([
                    'min' => 3,
                    'minMessage' => 'Votre nom d\'utilisateur doit contenir au moins {{ limit }} caractères.',
                ]),
            ],
        ])
        ->add('prenom', TextType::class, [
            'mapped' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Ce champ ne peut être vide'
                ]),
                new Length([
                    'min' => 3,
                    'minMessage' => 'Votre nom d\'utilisateur doit contenir au moins {{ limit }} caractères.',
                ]),
            ],
        ])
        ->add('numtel', TextType::class, [
            'mapped' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Ce champ ne peut être vide'
                ]),
                new Length([
                    'min' => 10,
                    'max'=>10,
                ]),
            ],
        ])
        ->add('adresse', TextType::class, [
            'mapped' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Ce champ ne peut être vide'
                ]),
                new Length([
                    'min' => 3,
                ]),
            ],
        ])
        ->add('allergie', TextType::class, [
            'mapped' => false,
            ])

            ->add('email')
            // ->add('agreeTerms', CheckboxType::class, [
            //     'mapped' => false,
            //     'constraints' => [
            //         new IsTrue([
            //             'message' => 'Vous devez accepter nos conditions.',
            //         ]),
            //     ],                                                                                                                                                                                                                                                                                                                                                                                                           
            // ])
            ->add('password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit avoir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('confirmpassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit avoir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}