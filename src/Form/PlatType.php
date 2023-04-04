<?php

namespace App\Form;

use App\Entity\Plat;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;

class PlatType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
   {        // Titre
            $builder->add('titre', TextType::class, [
                'label' => 'Titre*',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut pas être vide'
                    ])
                ]
            ]);
            $builder->add('categoriserlesplats', TextareaType::class, [
                'label' => 'Catégoriser Les Plats',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut pas  être vide'
                    ])
                ]
            ]);
            // Contenu
            $builder->add('description', TextareaType::class, [
                'label' => 'Description',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut pas être vide'
                    ])
                ]
            ]);
            // Statut
            $builder->add('prix', MoneyType::class, [
                'label' => 'Prix',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut pas être vide'
                    ])
                ]
            ]);
            // Bouton Envoyer
            $builder->add('submit', SubmitType::class, array(
                'label' => 'Enregistrer'
            ));
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plat::class,
        ]);
    }
}
