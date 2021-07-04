<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new Length([
                        'min' => 6,
                        'minMessage' => "Votre email doit comporter au moins 6 caractères",
                        'max' => 60,
                    ])
                ]
            ])
            ->add('pseudo', TextType::class, [
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => "Votre nom d'utilisateur doit comporter au moins 2 caractères",
                        'max' => 15,
                    ])
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne sont pas identiques.',
                'options' => ['attr' => ['class' => 'password-field input']],
                'required' => true,
                'first_options' => ['label' => 'Votre mot de passe'],
                'second_options' => ['label' => 'confirmez votre mot de passe'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
