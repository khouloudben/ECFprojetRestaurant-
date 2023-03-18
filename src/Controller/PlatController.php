<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use App\Entity\Plat;
use App\Entity\Category;
use App\Repository\PlatRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\PlatType;


class PlatController extends AbstractController
{
/** Lecture d'un plat */

#[Route('/plat/{id}', name: 'app_plat'), IsGranted('ROLE_ADMIN')]
public function index(ManagerRegistry $doctrine,PlatRepository $platRepository, int $id): Response
{
    // Entity Manager de Symfony
    $entityManager = $doctrine->getManager();
    $platRepository = $entityManager->getRepository(Plat::class);

    // On récupère le plat qui correspond à l'id passé dans l'url
    $plat = $platRepository->findBy(['id' => $id]);

    return $this->render('plat/index.html.twig', [
        'controller_name' => 'PlatController',
        'plat' => $plat,
    ]);
}

#[Route('/listePlat', name: 'app_listeplat')]
public function listePlat(ManagerRegistry $doctrine,PlatRepository $platRepository): Response
{

     // Entity Manager de Symfony
    $entityManager = $doctrine->getManager();
    $platRepository = $entityManager->getRepository(Plat::class);
     // On récupère tous les articles disponibles en base de données
    $plats   = $platRepository->findAll();
    return $this->render('plat/listePlat.html.twig', [
        'plats'  => $plats
    ]);

}

    /**
   * Création / Modification d'un plat
   * 
   * @param   int     $id     Identifiant de le plat
   * 
   * @return Response
   */
    #[Route('/plat_edit/{id}', name: 'plat_edit')]
    public function edit(ManagerRegistry $doctrine,PlatRepository $platRepository,Request $request, int $id=null): Response
    {
    // Entity Manager de Symfony
    $entityManager = $doctrine->getManager();
    $platRepository = $entityManager->getRepository(Plat::class);
    // Si un identifiant est présent dans l'url alors il s'agit d'une modification
    // Dans le cas contraire il s'agit d'une création dun plat
    if($id) {
        $mode = 'update';
        // On récupère le plat qui correspond à l'id passé dans l'url
        $plat = $platRepository->findBy(['id' => $id])[0];
    }
    else {
        $mode       = 'new';
        $plat    = new Plat();
    }

    // $categories =  $entityManager->getRepository(Category::class)->findAll();
    $form = $this->createForm(PlatType::class, $plat);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()) {
    $this->savePlat($plat,$doctrine, $mode,);

    return $this->redirectToRoute('app_listeplat', array('id' => $plat->getId()));
    }

    $parameters = array(
            'form'      => $form->createView(),
            'plat'   => $plat,
            'mode'      => $mode
        );

    return $this->render('plat/edit.html.twig', $parameters);
    }
    #[Route('/save_plat/{id}', name: 'save_plat')]
    private function savePlat(Plat $plat,ManagerRegistry $doctrine, string $mode){
        // $plate = $this->completePlatBeforeSave($plat, $mode);
        $entityManager = $doctrine->getManager();
        $entityManager->persist($plat);
        $entityManager->flush();
        $this->addFlash('success', 'Enregistré avec succès');
    }

    /**
     * Création / Modification d'un plat
     * 
     * @param   int     $id     Identifiant de le plat 
     * 
     * @return Response
     */
    #[Route('/remove_plat/{id}', name: 'remove_plat')]
    public function remove(ManagerRegistry $doctrine,PlatRepository $platRepository,Plat $plat,int $id): Response
    {
        /// Entity Manager de Symfony
        $entityManager = $doctrine->getManager();
        $platRepository = $entityManager->getRepository(Plat::class);
        // On récupère l'article qui correspond à l'id passé dans l'URL
        $plat =   $platRepository ->findBy(['id' => $id])[0];

        // Le plat est supprimé
        $entityManager->remove($plat);
        $entityManager->flush();

        return $this->redirectToRoute('app_listeplat');
    }


    // /**
    //  * Compléter le plat avec des informations avant enregistrement
    //  * 
    //  * @param   Plat    $plat
    //  * @param   string      $mode 
    //  * 
    //  * @return Plat
    //  */
    // #[Route('/PlatBeforeSave/{id}', name: 'PlatBeforeSave')]
    // private function completePlatBeforeSave(Plat $plat,ManagerRegistry $doctrine, string $mode) {
    //     $entityManager = $doctrine->getManager();
    //     if($plat->getIsPublished()){
    //         $plat->setPublishedAt(new \DateTime());
    //     }
    //     $plat->setAuthor($this->getUser());

    //     return $plat;
    // }

    /**
     * Enregistrer un plat en base de données
     * 
     * @param   Plat     $plat
     * @param   string      $mode 
     */
    
}


