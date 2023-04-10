<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ImagesRepository;
use App\Repository\ImageAccueilRepository;
use App\Repository\ModifparagrapheRepository;


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
    public function viewImage(ImagesRepository $imageRepository, ImageAccueilRepository  $imageAccueilRepository ,ModifparagrapheRepository $modifparagrapheRepository): Response
    {
        return $this->render('accueil/index.html.twig', [
            'images' => $imageRepository->findAll(),
            'image_accueils' => $imageAccueilRepository->findAll(),
            'modifparagraphes' => $modifparagrapheRepository->findAll(),

        ]);
    }
}