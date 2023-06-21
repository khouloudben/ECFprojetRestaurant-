<?php

namespace App\Controller;

use App\Entity\ImageAccueil;
use App\Form\ImageAccueilType;
use App\Repository\ImageAccueilRepository;
use App\Repository\HoraireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/image/accueil')]
class ImageAccueilController extends AbstractController
{
    #[Route('/ImageAccueil', name: 'app_image_accueil_index', methods: ['GET'])]
    public function index(ImageAccueilRepository $imageAccueilRepository,HoraireRepository $horaireRepository): Response
    {
        return $this->render('image_accueil/index.html.twig', [
            'image_accueils' => $imageAccueilRepository->findAll(),
            'horaires' => $horaireRepository->findAll(),
            
        ]);
    }

    #[Route('/newImageAccueil', name: 'app_image_accueil_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ImageAccueilRepository $imageAccueilRepository,HoraireRepository $horaireRepository): Response
    {
        $imageAccueil = new ImageAccueil();
        $form = $this->createForm(ImageAccueilType::class, $imageAccueil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageAccueilRepository->save($imageAccueil, true);

            return $this->redirectToRoute('app_image_accueil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('image_accueil/new.html.twig', [
            'image_accueil' => $imageAccueil,
            'form' => $form,
            'horaires' => $horaireRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_image_accueil_show', methods: ['GET'])]
    public function show(ImageAccueil $imageAccueil,HoraireRepository $horaireRepository): Response
    {
        return $this->render('image_accueil/show.html.twig', [
            'image_accueil' => $imageAccueil,
            'horaires' => $horaireRepository->findAll(),
        ]);
    }

    #[Route('/{id}/editImageAccueil', name: 'app_image_accueil_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ImageAccueil $imageAccueil, ImageAccueilRepository $imageAccueilRepository,HoraireRepository $horaireRepository): Response
    {
        $form = $this->createForm(ImageAccueilType::class, $imageAccueil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageAccueilRepository->save($imageAccueil, true);

            return $this->redirectToRoute('app_image_accueil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('image_accueil/edit.html.twig', [
            'image_accueil' => $imageAccueil,
            'form' => $form,
            'horaires' => $horaireRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_image_accueil_delete', methods: ['POST'])]
    public function delete(Request $request, ImageAccueil $imageAccueil, ImageAccueilRepository $imageAccueilRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$imageAccueil->getId(), $request->request->get('_token'))) {
            $imageAccueilRepository->remove($imageAccueil, true);
        }

        return $this->redirectToRoute('app_image_accueil_index', [], Response::HTTP_SEE_OTHER);
    }
}
