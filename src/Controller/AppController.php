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
     * @Route("/", name="app_main_home")
     */
    public function index(FormationRepository $formationRepo, Request $request ): Response
    {
        $user = $this->getUser();
        $formations = $formationRepo->findAll();

        return $this->render('formation/index.html.twig', [
            'user' => $user,
            'formations' => $formations,
        ]);
    }
}
