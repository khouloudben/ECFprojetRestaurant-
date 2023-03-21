<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use App\Entity\Reservation;
use App\Entity\User;
use App\Repository\ReservationRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\ReservationType;


class ReservationController extends AbstractController
{
/** Lecture d'une reservation */

#[Route('/reservation/{id}', name: 'app_reservation')]
public function index(ManagerRegistry $doctrine,ReservationRepository $reservationRepository, int $id): Response
{
    // Entity Manager de Symfony
    $entityManager = $doctrine->getManager();
    $reservationRepository = $entityManager->getRepository(Reservation::class);

    // On récupère la reservation qui correspond à l'id passé dans l'url
    $reservation = $reservationRepository->findBy(['id' => $id]);

    return $this->render('reservation/index.html.twig', [
        'controller_name' => 'ReservationController',
        'reservation' => $reservation,
    ]);
}

#[Route('/pageReservation', name: 'app_pageReservation'), IsGranted('ROLE_ADMIN')]
public function pageReservation(ManagerRegistry $doctrine,ReservationRepository $reservationRepository): Response
{

     // Entity Manager de Symfony
    $entityManager = $doctrine->getManager();
    $reservationRepository = $entityManager->getRepository(Reservation::class);
     // On récupère tous les articles disponibles en base de données
    $reservations   = $reservationRepository->findAll();
    return $this->render('reservation/pageReservation.html.twig', [
        'reservations'  => $reservations
    ]);

}

// #[Route('/pageReservationUser', name: 'app_pageReservationUser',methods:['GET'])]
// public function pageReservationUser(ManagerRegistry $doctrine,ReservationRepository $reservationRepository): Response
// {
// $user=$this->getUser();
//      // Entity Manager de Symfony
//     $entityManager = $doctrine->getManager();
//     $reservationRepository = $entityManager->getRepository(Reservation::class);
//      // On récupère tous les articles disponibles en base de données
//     $reservations = $reservationRepository->findBy(['user' => $user]);
//     return $this->render('reservation/pageReservationUser.html.twig', [
//         'reservations' => $reservations,
//     ]);

// }
    /**
   * Création / Modification d'une reservation
   * 
   * @param   int     $id     Identifiant de la reservation
   * 
   * @return Response
   */
    #[Route('/reservation_edit/{id}', name: 'reservation_edit')]
    public function edit(ManagerRegistry $doctrine,ReservationRepository $reservationRepository,Request $request, int $id=null): Response
    {
    // Entity Manager de Symfony
    $user=$this->getUser();
    $entityManager = $doctrine->getManager();
    $reservationRepository = $entityManager->getRepository(Reservation::class);
    // Si un identifiant est présent dans l'url alors il s'agit d'une modification
    // Dans le cas contraire il s'agit d'une création dune reservation
    if($id) {
        $mode = 'update';
        // On récupère la reservation qui correspond à l'id passé dans l'url
        $reservation = $reservationRepository->findBy(['id' => $id])[0];
    }
    else {
        $mode = 'new';
        $user=$this->getUser();
        $reservation = new Reservation();
        if($user){
            $reservation->setUser($user);
        }
    }

    // $categories =  $entityManager->getRepository(Category::class)->findAll();
    $form = $this->createForm(ReservationType::class, $reservation);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()) {
    $this->saveReservation($reservation,$doctrine, $mode,);

    return $this->redirectToRoute('app_pageReservation', array('id' => $reservation->getId()));
    
    }

    $parameters = array(
            'form'      => $form->createView(),
            'reservation'   => $reservation,
            'mode'      => $mode
        );

    return $this->render('reservation/edit.html.twig', $parameters);
    }



    #[Route('/save_reservation/{id}', name: 'save_reservation')]
    private function saveReservation(Reservation $reservation,ManagerRegistry $doctrine, string $mode){
        $entityManager = $doctrine->getManager();
        $entityManager->persist($reservation);
        $entityManager->flush();
        $this->addFlash('success', 'Enregistré avec succès');
    }

    /**
     * Création / Modification d'une reservation
     * 
     * @param   int     
     * 
     * @return Response
     */
    #[Route('/remove_reservation/{id}', name: 'remove_reservation')]
    public function remove(ManagerRegistry $doctrine,ReservationRepository $reservationRepository,Reservation $reservation,int $id): Response
    {
        /// Entity Manager de Symfony
        $entityManager = $doctrine->getManager();
        $reservationRepository = $entityManager->getRepository(Reservation::class);
        // On récupère la reservation qui correspond à l'id passé dans l'URL
        $reservation =   $reservationRepository ->findBy(['id' => $id])[0];

        // La reservation est supprimé
        $entityManager->remove($reservation);
        $entityManager->flush();

        return $this->redirectToRoute('app_pageReservation');
    }
    
    
}
