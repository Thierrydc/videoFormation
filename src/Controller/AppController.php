<?php

namespace App\Controller;

use App\Repository\FormationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppController extends AbstractController
{
    /**
     * @Route("/home", name="main_home")
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
     * @Route("/", name="app_root")
     */
    public function root(): Response
    {
        return $this->redirectToRoute('formations_index');
    }
}
