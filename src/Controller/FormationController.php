<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationFormType;
use App\Repository\CategoryRepository;
use App\Repository\FormationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormationController extends AbstractController
{

    /**
     * @Route("/formation", name="formations_index")
     */
    public function index(FormationRepository $formationRepo, CategoryRepository $CategoryRepo, Request $request ): Response
    {
        $formations = $formationRepo->findAll();
        $listCcategories = $CategoryRepo->findAll();
        
        // Supprime les catégories vide du filtre
        foreach ($listCcategories as $category) {
            if($category->getFormations()->count() > 0) {
                $categories[] = $category;
            }
        }
        
        // On vérifie si on a une requête Ajax
        if($request->get('ajax')){
            $categoryId = $request->query->get('cat');
            if($categoryId > 0){
                $formByCat = $formationRepo->findByCat($categoryId);
    
                return new JsonResponse([
                    'content' => $this->renderView('formation/_content.html.twig',[
                        'formations' => $formByCat,
                        'categories' => $categories,
                    ])
                ]);
            }
            return new JsonResponse([
                'content' => $this->renderView('formation/_content.html.twig',[
                    'formations' => $formations,
                    'categories' => $categories,
                ])
            ]);
        }


        return $this->render('formation/index.html.twig', [
            'formations' => $formations,
            'categories' => $categories,
        ]);
    }

    /**
     * @IsGranted("ROLE_EDITOR", statusCode=401 ,message="Vous devez être connecté pour accéder à cette ressource")
     * @Route("/formation_new", name="formation_new")
     */
     public function new(Request $request, Security $security): Response
     {
         $formation = new Formation();
         $form = $this->createForm(FormationFormType::class, $formation);
         $form->handleRequest($request);
 
         if($form->isSubmitted() && $form->isValid() ) {
             $user = $security->getUser();
             $formation->setAuthor($user);
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($formation);
             $entityManager->flush();
 
             return $this->redirectToRoute('formations_index');
         }
 
         return $this->render('formation/new.html.twig', [
             'formation' =>$formation,
             'form' => $form->createView(),
         ]);
     }

    
    
    /**
     * @Route("/formation/{id}", name="formation_show")
     */
    public function show(Formation $formation, Request $request): Response
    {
        return $this->render('formation/show.html.twig', [
            'formation' =>$formation,
        ]);
    }



    /**
     * @IsGranted("ROLE_EDITOR", statusCode=401 ,message="Vous devez être connecté pour accéder à cette ressource")
     * @Route("formation_delete/{id}", name="formation_delete")
     */

    public function delete(Request $request, Formation $formation, Security $security): Response
    {
        $user = $security->getUser();
        $submittedToken = $request->request->get('token');
        
        if ($user === $formation->getAuthor()) {
            if ($this->isCsrfTokenValid('delete-formation', $submittedToken)) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($formation);
                $entityManager->flush();

                return $this->redirectToRoute('app_user_myformation');
            }
        }

        return $this->render('common/error.html.twig', [
            'error' => '401',
            'message' => 'Vous devez être connecté pour accéder à cette ressource',
        ]);
    }


    /**
     * @IsGranted("ROLE_EDITOR", statusCode=401 ,message="Vous devez être connecté pour avoir accès a cette ressource")
     * @Route("/formation_edit/{id}", name="formation_edit")
     */
     public function edit(Security $security, Formation $formation, Request $request): Response
     {
        $form = $this->createForm(FormationFormType::class, $formation);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ) {
            $user = $security->getUser();
            // $formation->setAuthor($user);
            $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($formation);
            $entityManager->flush();

            return $this->redirectToRoute('formations_index');
        }

        return $this->render('formation/new.html.twig', [
            'formation' =>$formation,
            'form' => $form->createView(),
        ]);
    }
    
}
