<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ImagesRepository;
use App\Repository\ImageAccueilRepository;
use App\Repository\ModifparagrapheRepository;
use App\Repository\HoraireRepository;


class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
        
    }
    



#[Route('/accueil', name: 'app_accueil')]
    public function viewImage(ImagesRepository $imageRepository, ImageAccueilRepository  $imageAccueilRepository ,ModifparagrapheRepository $modifparagrapheRepository, HoraireRepository $horaireRepository): Response
    {
        return $this->render('accueil/index.html.twig', [
            'images' => $imageRepository->findAll(),
            'image_accueils' => $imageAccueilRepository->findAll(),
            'modifparagraphes' => $modifparagrapheRepository->findAll(),
            'horaires' => $horaireRepository->findAll(),
        ]);
    }
    // #[Route('/base', name: 'app_base')]
    // public function viewHoraires(HoraireRepository $horaireRepository): Response
    // {
    //     return $this->render('base.html.twig', [
    //         'horaires' => $horaireRepository->findAll(),
    //     ]);
    // }
    // #[Route('/accueil', name: 'app_accueil')]
    // public function viewHoraires( HorairesRepository $horairesRepository): Response
    // {
    //     return $this->render('base.html.twig', [
    //         'horaires' => $horairesRepository->findAll(),
    //     ]);
    // }
}