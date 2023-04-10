<?php

namespace App\Controller;

use App\Entity\Modifparagraphe;
use App\Form\ModifparagrapheType;
use App\Repository\ModifparagrapheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/modifparagraphe')]
class ModifparagrapheController extends AbstractController
{
    #[Route('/modifparagraphe', name: 'app_modifparagraphe_index', methods: ['GET'])]
    public function index(ModifparagrapheRepository $modifparagrapheRepository): Response
    {
        return $this->render('modifparagraphe/index.html.twig', [
            'modifparagraphes' => $modifparagrapheRepository->findAll(),
        ]);
    }

    #[Route('/newmodifparagraphe', name: 'app_modifparagraphe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ModifparagrapheRepository $modifparagrapheRepository): Response
    {
        $modifparagraphe = new Modifparagraphe();
        $form = $this->createForm(ModifparagrapheType::class, $modifparagraphe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modifparagrapheRepository->save($modifparagraphe, true);

            return $this->redirectToRoute('app_modifparagraphe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('modifparagraphe/new.html.twig', [
            'modifparagraphe' => $modifparagraphe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_modifparagraphe_show', methods: ['GET'])]
    public function show(Modifparagraphe $modifparagraphe): Response
    {
        return $this->render('modifparagraphe/show.html.twig', [
            'modifparagraphe' => $modifparagraphe,
        ]);
    }

    #[Route('/{id}/editmodifparagraphe', name: 'app_modifparagraphe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Modifparagraphe $modifparagraphe, ModifparagrapheRepository $modifparagrapheRepository): Response
    {
        $form = $this->createForm(ModifparagrapheType::class, $modifparagraphe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modifparagrapheRepository->save($modifparagraphe, true);

            return $this->redirectToRoute('app_modifparagraphe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('modifparagraphe/edit.html.twig', [
            'modifparagraphe' => $modifparagraphe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_modifparagraphe_delete', methods: ['POST'])]
    public function delete(Request $request, Modifparagraphe $modifparagraphe, ModifparagrapheRepository $modifparagrapheRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$modifparagraphe->getId(), $request->request->get('_token'))) {
            $modifparagrapheRepository->remove($modifparagraphe, true);
        }

        return $this->redirectToRoute('app_modifparagraphe_index', [], Response::HTTP_SEE_OTHER);
    }
}
