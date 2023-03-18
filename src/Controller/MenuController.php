<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Menu;
use App\Entity\Category;
use App\Repository\MenuRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\MenuType;


class MenuController extends AbstractController
{
/** Lecture d'un menu */

#[Route('/menu/{id}', name: 'app_menu')]
public function index(ManagerRegistry $doctrine,MenuRepository $menuRepository, int $id): Response
{
    // Entity Manager de Symfony
    $entityManager = $doctrine->getManager();
    $menuRepository = $entityManager->getRepository(Menu::class);

    // On récupère le menu qui correspond à l'id passé dans l'url
    $menu = $menuRepository->findBy(['id' => $id]);

    return $this->render('menu/index.html.twig', [
        'controller_name' => 'MenuController',
        'menu' => $menu,
    ]);
}

#[Route('/MenuS', name: 'app_MenuS')]
public function MenuS(ManagerRegistry $doctrine,MenuRepository $menuRepository): Response
{

     // Entity Manager de Symfony
    $entityManager = $doctrine->getManager();
    $menuRepository = $entityManager->getRepository(Menu::class);
     // On récupère tous les articles disponibles en base de données
    $menus   = $menuRepository->findAll();
    return $this->render('menu/MenuS.html.twig', [
        'menus'  => $menus
    ]);

}
    /**
   * Création / Modification d'un Menu
   * 
   * @param   int     $id     Identifiant de le Menu
   * 
   * @return Response
   */
    #[Route('/menu_edit/{id}', name: 'menu_edit')]
    public function edit(ManagerRegistry $doctrine,MenuRepository $menuRepository,Request $request, int $id=null): Response
    {
    // Entity Manager de Symfony
    $entityManager = $doctrine->getManager();
    $menuRepository = $entityManager->getRepository(Menu::class);
    // Si un identifiant est présent dans l'url alors il s'agit d'une modification
    // Dans le cas contraire il s'agit d'une création dun Menu
    if($id) {
        $mode = 'update';
        // On récupère le menu qui correspond à l'id passé dans l'url
        $menu = $menuRepository->findBy(['id' => $id])[0];
    }
    else {
        $mode       = 'new';
        $menu    = new Menu();
    }

    // $categories =  $entityManager->getRepository(Category::class)->findAll();
    $form = $this->createForm(MenuType::class, $menu);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()) {
    $this->saveMenu($menu,$doctrine, $mode,);

    return $this->redirectToRoute('app_MenuS', array('id' => $menu->getId()));
    }

    $parameters = array(
            'form'      => $form->createView(),
            'menu'   => $menu,
            'mode'      => $mode
        );

    return $this->render('menu/edit.html.twig', $parameters);
    }
    #[Route('/save_menu/{id}', name: 'save_menu')]
    private function saveMenu(Menu $menu,ManagerRegistry $doctrine, string $mode){
        // $menu = $this->completeMenuBeforeSave($menu, $mode);
        $entityManager = $doctrine->getManager();
        $entityManager->persist($menu);
        $entityManager->flush();
        $this->addFlash('success', 'Enregistré avec succès');
    }

    /**
     * Création / Modification d'un menu
     * 
     * @param   int     $id     Identifiant de le menu
     * 
     * @return Response
     */
    #[Route('/remove_menu/{id}', name: 'remove_menu')]
    public function remove(ManagerRegistry $doctrine,MenuRepository $menuRepository,int $id): Response
    {
        /// Entity Manager de Symfony
        $entityManager = $doctrine->getManager();
        $menuRepository = $entityManager->getRepository(Menu::class);
        // On récupère l'article qui correspond à l'id passé dans l'URL
        $menu = $menuRepository->findBy(['id' => $id])[0];

        // Le menu est supprimé
        $entityManager->remove($menu);
        $entityManager->flush();

        return $this->redirectToRoute('app_MenuS');
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

    
}



