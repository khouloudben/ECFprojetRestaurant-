<?php

namespace App\Controller;
use App\Repository\HoraireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\Persistence\ManagerRegistry;
// use App\Entity\Reservation;
use App\Repository\ImageAccueilRepository;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils,ManagerRegistry $doctrine,ImageAccueilRepository  $imageAccueilRepository,HoraireRepository $horaireRepository): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_accueil');
            // $entityManager = $doctrine->getManager();
            // $user = $this->getUser();
            // $reservation =$entityManager->getRepository(Reservation::class)->findBy(['utilisateur' => $user]);

        // Do something with $reservation

        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'image_accueils' => $imageAccueilRepository->findAll(),
            'horaires' => $horaireRepository->findAll(),
        ]);
    }
    

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
        
    }

}
