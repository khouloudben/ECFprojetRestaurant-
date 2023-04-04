<?php
namespace App\Form;

use App\Entity\Menu;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;

class MenuType extends AbstractType
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
            // Bouton Envoyer
            $builder->add('submit', SubmitType::class, array(
                'label' => 'Enregistrer'
            ));
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}
