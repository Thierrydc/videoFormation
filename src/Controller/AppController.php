<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app_main_home")
     */
    public function index(): Response
    {
        $user = $this->getUser();

        return $this->render('app/index.html.twig', [
            'user' => $user,
        ]);
    }
}
