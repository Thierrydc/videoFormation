<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormationController extends AbstractController
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/formation", name="formations_index")
     */
    public function index(): Response
    {
        return $this->render('formation/index.html.twig', [
            'controller_name' => 'FormationController',
        ]);
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
            $user = $this->security->getUser();
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
}