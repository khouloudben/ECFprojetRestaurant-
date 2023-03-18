<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Doctrine\Persistence\ManagerRegistry;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request,ManagerRegistry $doctrine, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $entityManager = $doctrine->getManager();
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setNom($form->get('nom')->getData());
            $user->setPrenom($form->get('prenom')->getData());
            $user->setNumtel($form->get('numtel')->getData());
            $user->setAdresse($form->get('adresse')->getData());
            $user->setEmail($form->get('email')->getData());
            $user->setPassword($form->get('password')->getData());
            $user->setConfirmpassword($form->get('confirmpassword')->getData());
            $user->setAllergie($form->get('allergie')->getData());
            
            // encode the plain password
                $user->setPassword(
                $userPasswordHasher->hashPassword(
                $user,
                $form->get('password')->getData()
                )
                );
                $user->setConfirmpassword(
                    $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('confirmpassword')->getData()
                    )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_accueil');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}

