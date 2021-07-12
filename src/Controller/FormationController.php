<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationFormType;
use App\Repository\FormationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormationController extends AbstractController
{

    /**
     * @Route("/formation", name="formations_index")
     */
    public function index(FormationRepository $formationRepo, Request $request ): Response
    {
        // $user = $this->getUser();
        $formations = $formationRepo->findAll();

        return $this->render('formation/index.html.twig', [
            'formations' => $formations,
        ]);
    }

    /**
     * @Route("/formation_edit/{id}", name="formation_edit")
     */
    public function edit(Formation $formation, Request $request): Response
    {
        
    }
    

    /**
     * @IsGranted("ROLE_EDITOR", statusCode=401 ,message="Vous devez avoir le role Editeur pour accéder à cette ressource")
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
     * @IsGranted("ROLE_USER", statusCode=401 ,message="You have to be logged-in to access this ressource")
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
            'message' => 'You have to be logged-in to access this ressource',
        ]);
    }

}
