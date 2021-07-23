<?php

namespace App\Controller;

use App\Form\ProfileEditType;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="app_user_profile")
     */
    public function profile(): Response
    {
        $user = $this->getUser();

        return $this->render('user/profile.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/profile/edit", name="app_user_edit")
     */
    public function edit(EntityManagerInterface $em, UserPasswordHasherInterface $passwordEncoder, Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(RegistrationFormType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isvalid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $em->flush();
            return $this->redirectToRoute('app_user_profile');
        }

        return $this->render('registration/register.html.twig', [
            'user' => $user,
            'registrationForm' =>$form->createView(),
        ]);
    }

    /**
     * @Route("/user_myformation", name="app_user_myformation")
     */
    public function myFormation(Security $security, Request $request) : Response
    {
        $user = $security->getUser();
        // $formations = $user->getFormations();

        return $this->render('user/myformation.html.twig', [
            'user' => $user
        ]);
    }
}
